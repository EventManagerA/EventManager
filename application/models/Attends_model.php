<?php
class Attends_model extends CI_Model {

	public $id;
	public $user_id;
	public $event_id;

	//イベントidからリストを取得
	public function get_rowset_by_event_id($id)
	{
		$query = $this->db->get_where('attends', array('event_id' => $id));
		return $query->result('Attends_model');
	}

	//ユーザーidからリストを取得
	public function get_rowset_by_user_id($id)
	{

		$query = $this->db->get_where('attends', array('user_id' => $id));
		return $query->result('Attends_model');
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
		return isset($this->user_id) ? $this->user_id : false;
	}

	public function get_event_id() {
		return isset($this->event_id) ? $this->event_id : false;
	}
	//-----------------------------------------------------------
}