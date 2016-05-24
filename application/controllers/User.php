<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->library('form_validation');
	}


	public function index(){

		$data['userlist']=$this->users_model->get_rowset_desc();

		//var_dump($data['userlist']);
		$this->load->view('user/index',$data);

		if($this->input->post('add')){

			$this->load->view('user/add');

		}
		if($this->input->post('detail')){
			$this->load->view('user/detail');
		}


	}






	public function detail(){

		$this->load->view('user/detail');
	}

	public function add(){
		$this->load->helper('form');
	//	$this->load->view('user/add');

		$this->form_validation->set_rules('name','氏名','required');
		$this->form_validation->set_rules('id','id','required');
		$this->form_validation->set_rules('pass','パス','required');

		if($this->form_validation->run()){
		/*	$users['name']=$this->input->post('name');
			if($this->input->post('name')!=''){
				$users['id']
			}
			*/
		}
		else{
			$data['groups'] = $this->users_model->get_group_name();
			var_dump($data);
			$this->load->view('user/add', $data);

		}

	/*	if($this->input->post('add')!=null){

			$this->load->view('user/add_done');

		}*/
	}


	public function add_done(){
		$this->load->view('user/add_done');
	}

	public function edit(){
		$this->load->view('user/edit');
	}
	public function delete(){
		$this->load->view('user/delete');
	}


}