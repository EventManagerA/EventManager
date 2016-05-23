<?php
class Events_model extends CI_Model {

	public $id;
	public $title;
	public $start;
	public $end;
	public $place;
	public $group_id;
	public $detail;
	public $registerd_by;
	public $created;

	//イベントＩＤから参加しているユーザーリスト取得
	public function get_user_rowset_by_event_id($id) {
		$this->load->model('attends_model');
		$this->load->model('users_model');

		$idlist = $this->attends_model->get_rowset_by_event_id($id);
		return $this->users_model->get_rowset_by_id($idlist);
	}

	public function get_rowset_desc($page = false,$perPage = false) {

		$query = $this->db ->order_by('created','desc');

		if (isset($page,$perPage))
		{
			$offset = ($page - 1) * $perPage;
			$query = $this->db->get('users',$perPage,$offset);
		}else{
			$query = $this->db->get('users');
		}


		return $query->result('Users_model');
	}

	public function get_rowset_today()
	{
		$this->db->where('start>=', date('Y/m/d 00:00:00'));
		$this->db->where('start<=', date('Y/m/d 23:59:59'));
		$query = $this->db->get('events');
		return $query->result(0,'Events_model');
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
		return $query->result(0,'Events_model');
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

	public function get_end() {
		return isset($this->end) ? $this->end : false;
	}

	public function get_place() {
		return isset($this->place) ? $this->place : false;
	}

	public function get_group_id() {
		return isset($this->group_id) ? $this->group_id : false;
	}

	public function get_detail() {
		return isset($this->detail) ? $this->detail : false;
	}

	public function get_registerd_by() {
		return isset($this->registerd_by) ? $this->registerd_by : false;
	}

	public function get_created() {
		return isset($this->created) ? $this->created : false;
	}
	//-----------------------------------------------------------
}