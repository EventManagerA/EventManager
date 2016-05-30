<?php
class Users_model extends CI_Model {

	public $id;
	public $login_id;
	public $login_pass;
	public $name;
	public $type_id;
	public $group_id;
	public $created;


	//ユーザーＩＤから参加しているイベント取得
	public function get_event_id_list_by_user_id() {
		$this->load->model('attends_model');

		$attends_rowset = $this->attends_model->get_rowset_by_user_id($this->get_id());

		$event_id_list = [];
		foreach ($attends_rowset as $attends_row){
			$event_id_list[] = $attends_row->get_event_id();
		}

		return $event_id_list;
	}

	//リストを降順で取得
	public function get_rowset_desc($page = false,$perPage = false) {

		$query = $this->db->order_by('created','desc');

		if(!$page){
			$page = 1;
		}

// 		//データの取得
// 		if(!is_numeric($page)){
// 			$page=1;
// 		}

		if (isset($page,$perPage))
		{
			$offset = ($page - 1) * $perPage;
			$query = $this->db->get('users',$perPage,$offset);
		}else{
			$query = $this->db->get('users');
		}

		return $query->result('Users_model');
	}

	//idとpass
	public function login($login_id, $password)
	{
		//ログイン認証
		$query = $this->db->get_where('users', array('login_id' => $login_id, 'login_pass' => SHA1($password.$login_id)));
		$var = $query->row(0,'Users_model');
		if(isset($var)){
			//セッション登録
			$_SESSION['id'] = $var->get_id();
			$_SESSION['auth'] = TRUE;
		}
		return $var;
	}

	public function logout()
	{
		//セッション削除
		$_SESSION = array();
		$params = session_get_cookie_params();
		setcookie(session_name(), "", time()-36000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
		session_destroy();
	}

	//idから取得
	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row(0,'Users_model');
	}

	//login_idから取得
	public function get_row_by_login_id($id)
	{
		$query = $this->db->get_where('users', array('login_id' => $id));
		return $query->row(0,'Users_model');
	}

	//複数のidから複数のユーザー取得
	public function get_rowset_by_id($idlist)
	{
		$this->db->where_in('id', $idlist);
		$query = $this->db->get('users');
		return $query->result('Users_model');
	}


	//ページネーション
// 	public function total_count(){
// 		return $this->db->count_all('users');
// 	}

	public function update($id,$val){
		$this->load->model('user_types_model');
		$user_types_table = $this->user_types_model;

		if (isset($val['login_pass'])) {
			$val['login_pass'] = sha1($val['login_pass'].$val['login_id']);
		}
		$val['type_id'] = $user_types_table::USER_TYPE__NORMAL;

		$this->db->where('id', $id);
		$this->db->update('users', $val);
	}

	public function insert($val) {
		$val['login_pass'] = sha1($val['login_pass'].$val['login_id']);
		$val['created'] = date('Y/m/d H:i:s');
		return $this->db->insert('users',$val);
	}

	public function delete($val) {
		$this->db->where('id', $val);
		$this->db->delete('users');
	}

	//-------------------row------------------------------------

	public function is_admin_user() {
		$this->load->model('user_types_model');
		$User_types_table = $this->user_types_model;

		return $this->get_type_id() == $User_types_table::USER_TYPE__ADMIN ? true : false;
	}

	public function get_rowset_new_event() {
		$this->load->model('events_model');
		return $this->events_model->get_new_rowset_by_user_id($this->get_id());
	}

	public function get_rowset_new_event_to_string() {
		if(!$event_rowset = $this->get_rowset_new_event()){
			return false;
		}

		$string = '<br/>';
		foreach ($event_rowset as $event_row) {
			$string .= htmlspecialchars($event_row->get_title(),ENT_QUOTES);
			$string .= '<br/>';
		}
		return $string;
	}

	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_login_id() {
		return isset($this->login_id) ? $this->login_id : false;
	}

	public function get_login_pass() {
		return isset($this->login_pass) ? $this->login_pass : false;
	}

	public function get_name() {
		return isset($this->name) ? $this->name : false;
	}

	public function get_group_id() {
		return isset($this->group_id) ? $this->group_id : false;
	}

	public function get_group_name() {
		$this->load->model('groups_model');

		if (!$this->get_group_id() || !$group_row = $this->groups_model->get_row_by_id($this->get_group_id())) {
			return false;
		}

		return $group_row->get_name();
	}

	public function get_type_id() {
		return isset($this->type_id) ? $this->type_id : false;
	}

	public function get_created() {
		return isset($this->created) ? $this->created : false;
	}
	//-----------------------------------------------------------
}