<?php
class User extends CI_Controller {



	public function index(){
		$this->load->view('user/index');
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