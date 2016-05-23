<?php
class User extends CI_Controller {

/*	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}
*/

	public function index(){
	/*	if($this->input->post('add')!= null){

			$this->load->view('user/add');

		}*/
		//$this->load->model('Test_users_model');
		$this->load->model('Users_model');
		$data['users']=$this->users_model->get_rowset_desc();

		var_dump($data['users']);
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