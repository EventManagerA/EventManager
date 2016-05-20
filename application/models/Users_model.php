<?php
class Users_model extends CI_Model {

	public $id;
	public $login_id;
	public $login_pass;
	public $name;
	public $type_id;
	public $group_id;
	public $created;



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

	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row(0,'Users_model');
	}

	public function get_rowset_by_id($id)
	{
		$this->db->where_in('id', $id);
		$query = $this->db->get('users');
		return $query->result(0,'Users_model');
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

	//----------------------------------------------------------
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

	public function get_type_id() {
		return isset($this->type_id) ? $this->type_id : false;
	}

	public function get_created() {
		return isset($this->created) ? $this->created : false;
	}
	//-----------------------------------------------------------
}