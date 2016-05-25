<?php

class Group extends CI_Controller {
	const NUM_PER_PAGE=5;
	public function __construct()
	{

		parent::__construct();
		$this->output->enable_profiler(TRUE);

		$this->load->model('events_model');
		$this->load->model('users_model');
		$this->load->model('groups_model');


	}

public function index($page=''){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/index';
	$logged_in_user;
	if(!isset($logged_in_user)){
		redirect('Event/index');
	}

	$this->load->model('groups_model');
	$data['group_rowset']=$this->groups_model->get_rowset($page,self::NUM_PER_PAGE);

	if ($this->input->post('add')){
		redirect('group/add');
	}

//データの取得
 $this->load->library('pagination');
if(!is_numeric($page)){
	$page=1;
}
$group=$this->groups_model->get_rowset();
//paginationの設定

$config['base_url'] = base_url('group/index');
$config['total_rows'] = $this->groups_model->total_count();
$config['per_page'] = self::NUM_PER_PAGE;
$config['use_page_numbers'] = TRUE;
$config['prev_link'] = '<<';
$config['next_link'] = '>>';
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['first_link'] = FALSE;
$config['last_link'] =  FALSE;
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li  class="active"><a>';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$this->pagination->initialize($config);

$group=$this->groups_model->get_rowset();
$this->load->view('templates/default',$data);
}
public function detail($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/detail';
	if(!isset($logged_in_user)){
		redirect('Event/index');
	}
	$this->load->model('groups_model');
	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');
	}
	$data['group_rowset'] = $group;


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
	if(!isset($logged_in_user)){
		redirect('Event/index');
	}
	$this->load->model('groups_model');

	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

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
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/edit';
	if(!isset($logged_in_user)){
		redirect('Event/index');
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
	if(!isset($logged_in_user)){
		redirect('Event/index');
	}
	if($logged_in_user==FALSE){
		redirect('Event/index');
	}
	$data['TITLE'] = ucfirst('EventManager');
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