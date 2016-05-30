<?php
class Login_log_model extends CI_Model {

	public $id;
	public $user_id;
	public $login_at;

	//idから取得
	public function get_row_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row(0,'Login_log');
	}

	//user_idから最後のログインデータ取得
	public function get_row_last_by_user_id($id)
	{
		$query = $this->db->order_by('id','desc');
		$query = $this->db->get_where('login_log', array('user_id' => $id));
		return $query->row(0,'Login_log_model');
	}

	public function insert($val) {
		$val['login_at'] = date('Y/m/d H:i:s');
		return $this->db->insert('login_log',$val);
	}
	//-------------------row------------------------------------

	public function get_id() {
		return isset($this->id) ? $this->id : false;
	}

	public function get_login_at() {
		return isset($this->login_at) ? $this->login_at : false;
	}

	public function get_user_id() {
		return isset($this->user_id) ? $this->user_id : false;
	}
	//-----------------------------------------------------------
}