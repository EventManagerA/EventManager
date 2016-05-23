<?php
class User_types_model extends CI_Model {

	const USER_TYPE__ADMIN = 1;
	const USER_TYPE__NORMAL = 2;

	public $id;
	public $name;

	public function get_rowset() {

		$query = $this->db->get('user_types');

		return $query->result_array('User_types_model');
	}

	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('user_types', array('id' => $id));
		return $query->row(0,'User_types_model');
	}

	//----------------------------------------------------------
	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_name() {
		return isset($this->name) ? $this->name : false;
	}
}