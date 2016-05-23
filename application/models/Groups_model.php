<?php
class Groups_model extends CI_Model {

	public $id;
	public $name;

	public function get_rowset() {

		$query = $this->db->get('groups');

		return $query->result_array('Groups_model');
	}

	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row(0,'Users_model');
	}

	public function update($id,$val){

		$this->db->where('id', $id);
		$this->db->update('groups', $val);
	}

	public function insert($val) {
		return $this->db->insert('groups',$val);
	}

	public function delete($val) {
		$this->db->where('id', $val);
		$this->db->delete('groups');
	}

	//----------------------------------------------------------
	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_name() {
		return isset($this->name) ? $this->name : false;
	}
}