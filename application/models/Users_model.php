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
	public function get_event_rowset_by_user_id($id) {
		$this->load->model('attends_model');
		$this->load->model('events_model');

		$attends_rowset = $this->attends_model->get_rowset_by_user_id($id);
		foreach ($attends_rowset as $attends_row){
			$event_id_list[] = $attends_row->get_event_id();
		}


		return $this->events_model->get_rowset_by_id($event_id_list);
	}

	//リストを降順で取得
	public function get_rowset_desc($page = false,$perPage = false) {

		$query = $this->db->order_by('created','desc');

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
	public function get_row_login($login_id, $login_pass)
	{
		$this->db->select('id');
		$query = $this->db->get_where('users', array('login_id' => $login_id,'login_pass' => $login_pass));
		return $query->row(0,'Users_model');
	}

	//idから取得
	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row(0,'Users_model');
	}

	//複数のidから複数のユーザー取得
	public function get_rowset_by_id($idlist)
	{
		$this->db->where_in('id', $idlist);
		$query = $this->db->get('users');
		return $query->result('Users_model');
	}

	public function update($id,$val){

		if ($val['login_pass']) {
			$val['login_pass'] = sha1($val['login_pass'].$id);
		}

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


	public function is_admin_user() {
		$this->load->model('user_types_model');
		$UserTypesTable = $this->user_types_model;

		return $this->type_id == $UserTypesTable::USER_ADMIN__AUTH ? true : false;
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

		if (!$this->get_group_id()) {
			return false;
		}
		$group_row = $this->groups_model->get_row_by_id($this->get_group_id());
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