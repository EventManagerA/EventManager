<?php

class Group extends CI_Controller {
	const NUM_PER_PAGE=5;
	public function __construct()
	{

		parent::__construct();


		$this->load->model('events_model');
		$this->load->model('users_model');
		$this->load->model('groups_model');


	}

public function index($page=''){
	$data['TITLE'] = ucfirst('部署一覧|EventManager');
	$data['contentPath'] = 'group/index';

	$logged_in_user = $this->load->get_var('logged_in_user');
	if(!$logged_in_user->is_admin_user()){

		redirect('event/index');
	}

   var_dump($logged_in_user->type_id);
	$this->load->model('groups_model');
	$data['group_rowset']=$this->groups_model->get_rowset($page,self::NUM_PER_PAGE);

	if ($this->input->post('add')){
		redirect('group/add');
	}


 $this->load->library('pagination');

$group=$this->groups_model->get_rowset();

$config = $this->load->get_var('pagenation');
$config['base_url'] = base_url('group/index');
$config['total_rows'] = $this->groups_model->total_count();
$config['per_page'] = self::NUM_PER_PAGE;



$this->pagination->initialize($config);

$group=$this->groups_model->get_rowset();
$this->load->view('templates/default',$data);
}
public function detail($id){
	$data['TITLE'] = ucfirst('部署詳細EventManager');
	$data['contentPath'] = 'group/detail';
	$logged_in_user = $this->load->get_var('logged_in_user');
	if(!$logged_in_user->is_admin_user()){

		redirect('event/index');
	}
	$this->load->model('groups_model');
	$group_row = $this->groups_model->get_row_by_id($id);


	$data['group_rowset'] = $group_row;

	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);
	}
	if ($this->input->post('index') != null)
	{

		redirect('group/index');
	}

	if ($this->input->post('edit') != null)
	{
		redirect('group/edit/'.$this->uri->segment(3));
	}

	if ($this->input->post('delete') != null)
	{
		redirect('group/delete/'.$this->uri->segment(3));
	}

	$this->load->view('templates/default',$data);
}
public function add(){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/add';

	$logged_in_user = $this->load->get_var('logged_in_user');
	if(!$logged_in_user->is_admin_user()){

		redirect('event/index');
	}
	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);
	}
	$this->load->model('groups_model');



	$this->form_validation->set_rules('name', '部署名', 'required|max_length[100]');

	if ($this->form_validation->run() == FALSE)
	{
		 $this->load->view('templates/default',$data);

	}
	else
	{
		$group['name'] = $this->input->post('name');
		$this->groups_model->insert($group);



		$data['contentPath'] = 'group/add_done';
		$this->load->view('templates/default',$data);
	}


}


public function edit($id){
	$data['TITLE'] = ucfirst('部署編集|EventManager');
	$data['contentPath'] = 'group/edit';
	$logged_in_user = $this->load->get_var('logged_in_user');
	if(!$logged_in_user->is_admin_user()){

		redirect('event/index');
	}
	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);;
	}
	$this->load->model('groups_model');
	if ($this->input->post('cancel') != null)
	{
		redirect('group/detail/'.$this->uri->segment(3));
	}


	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');

	}
	$data['group_rowset'] = $group;


	$this->form_validation->set_rules('name', '部署名', 'required|max_length[100]');
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('templates/default',$data);
	}
	else
	{

		$group->id = $id;
		$group->name = $this->input->post('name');

		$this->groups_model->update($id,$group);

		$data['contentPath'] = 'group/edit_done';
		$this->load->view('templates/default',$data);
	}

}

public function delete(){
	$logged_in_user = $this->load->get_var('logged_in_user');
	if(!$logged_in_user->is_admin_user()){

		redirect('event/index');
	}
	$data['TITLE'] = ucfirst('部署削除|EventManager');
	try {
		$this->groups_model->delete($this->uri->segment(3));

	} catch (PDOException $e) {
		echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
		exit;
	}

	$data['contentPath'] ='group/delete_done';
	$this->load->view('templates/default',$data);
	}
}