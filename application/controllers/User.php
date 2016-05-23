<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}


	public function index(){
		$data['users'] = $this->users_model->get_row_by_id();
		$this->load->view('user/index',$data);
	}
	public function detail(){
		$this->load->view('user/detail');
	}

	public function add(){
		$this->load->view('user/add');
	}

	public function edit(){
		$this->load->view('user/edit');
	}
	public function delete(){
		$this->load->view('user/delete');
	}


}