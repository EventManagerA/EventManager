<?php
class Attends_model extends CI_Model {

	public $id;
	public $user_id;
	public $event_id;

	public function get_user_rowset_by_event_id($id) {

		$idlist = $this->__get_rowset_by_event_id($id);

		$this->load->model('users_model');

		return $this->users_model->get_rowset_by_id($idlist);
	}

	private function __get_rowset_by_event_id($id)
	{
		$query = $this->db->get_where('attends', array('id' => $id));
		return $query->result_array(0,'Attends_model');
	}

	//------途中

	public function get_event_rowset_by_user_id($id) {


	}

	private function __get_rowset_by_user_id($id)
	{

	}



	public function insert($val) {
		return $this->db->insert('atteds',$val);
	}

	public function delete($userid,$eventid) {
		$this->db->where('event_id', $eventid);
		$this->db->where('user_id', $userid);
		$this->db->delete('attends');
	}

	//----------------------------------------------------------
	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_user_id() {
		return isset($this->login_id) ? $this->login_id : false;
	}

	public function get_event_id() {
		return isset($this->group_id) ? $this->group_id : false;
	}
	//-----------------------------------------------------------
}