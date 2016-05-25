<?php
class Events_model extends CI_Model {

	public function get_rowset_desc($page = false,$perPage = false) {

		$this->db->order_by('start','desc');

		if(!$page){
			$page = 1;
		}

		if(!is_numeric($page)){
			$page = 1;
		}

		if (isset($page,$perPage))
		{
			$offset = ($page - 1) * $perPage;
			$query = $this->db->get('events',$perPage,$offset);
		}else{
			$query = $this->db->get('events');
		}

		return $query->result('Events_model');
	}

	public function get_rowset_desc_today($page = false,$perPage = false)
	{
		$this->db->order_by('start','desc');
		$this->db->where('start>=', date('Y/m/d 00:00:00'));
		$this->db->where('start<=', date('Y/m/d 23:59:59'));

		if(!$page){
			$page = 1;
		}

		if(!is_numeric($page)){
			$page = 1;
		}

		if (isset($page,$perPage))
		{
			$offset = ($page - 1) * $perPage;
			$query = $this->db->get('events',$perPage,$offset);
		}else{
			$query = $this->db->get('events');
		}

		return $query->result('Events_model');
	}

	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('events', array('id' => $id));
		return $query->row(0,'Events_model');
	}

	public function get_rowset_by_id($id)
	{
		$this->db->where_in('id', $id);
		$query = $this->db->get('events');
		return $query->result('Events_model');
	}

	public function update($id,$val){
		$this->db->where('id', $id);
		$this->db->update('events', $val);
	}

	public function insert($val) {
		$val['created'] = date('Y/m/d H:i:s');
		return $this->db->insert('events',$val);
	}

	public function delete($val) {
		$this->db->where('id', $val);
		$this->db->delete('events');
	}

	//----------------row---------------------------------------

	//イベントに参加しているユーザーリスト取得
	public function get_joined_user_rowset() {
		$this->load->model('attends_model');
		$this->load->model('users_model');

		if (!($attends_rowset = $this->attends_model->get_rowset_by_event_id($this->get_id()))) {
			return false;
		}
		$user_id_list = [];
		foreach ($attends_rowset as $attends_row){
			$user_id_list[] = $attends_row->get_user_id();
		}

		return $this->users_model->get_rowset_by_id($user_id_list);
	}

	//イベントに参加しているユーザーリストを文字列化
	public function get_string_joined_user_rowset() {
		if (!($joined_user_rowset = $this->get_joined_user_rowset())) {
			return false;
		}

		$string = '';
		$number = 0;
		$length = count($joined_user_rowset);

		foreach ($joined_user_rowset as $joined_user_row){
			$number++;
			$string .= $joined_user_row->get_name();

			if ($length != $number) {
				$string .= ',';
			}
		}

		return $string;
	}
	//----------------------------------------------------------
	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_title() {
		return isset($this->title) ? $this->title : false;
	}

	public function get_start() {
		return isset($this->start) ? $this->start : false;
	}

	public function get_start_to_string() {
		$weekJP = ['日','月','火','水','木','金','土'];
		$weekNum = date('w',strtotime($this->get_start()));

		return date('Y年m月d日('.$weekJP[$weekNum].') H時i分',strtotime($this->get_start()));
	}

	public function get_end() {
		return isset($this->end) ? $this->end : false;
	}

	public function get_end_to_string() {
		$weekJP = ['日','月','火','水','木','金','土'];
		$weekNum = date('w',strtotime($this->get_end()));

		return date('Y年m月d日('.$weekJP[$weekNum].') H時i分',strtotime($this->get_end()));
	}

	public function get_place() {
		return isset($this->place) ? $this->place : false;
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

	public function get_detail() {
		return isset($this->detail) ? $this->detail : false;
	}

	public function get_registered_by() {
		return isset($this->registered_by) ? $this->registered_by : false;
	}

	public function get_registered_by_name() {
		$this->load->model('users_model');

		if (!($user_row = $this->users_model->get_row_by_id($this->get_registered_by()))) {
			return false;
		}
		return $user_row->get_name();
	}

	public function get_created() {
		return isset($this->created) ? $this->created : false;
	}
	//-----------------------------------------------------------
}