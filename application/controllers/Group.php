<?php

class Group extends CI_Controller {
	const NUM_PER_PAGE=5;
	public function __construct()
	{

		parent::__construct();



		$this->load->model('events_model');
		$this->load->model('users_model');
		$this->load->model('groups_model');

		$logged_in_user = $this->load->get_var('logged_in_user');
		if(!$logged_in_user->is_admin_user()){

			redirect('event/index');
		}


	}

public function index($page=''){
	$data['TITLE'] = ucfirst('部署一覧 | EventManager');
	$data['contentPath'] = 'group/index';


	$this->load->model('groups_model');
	$data['group_rowset_desc']=$this->groups_model->get_rowset_desc($page,self::NUM_PER_PAGE);

	if ($this->input->post('add')){
		redirect('group/add');
	}


 $this->load->library('pagination');

$group=$this->groups_model->get_rowset_desc();

$config = $this->load->get_var('pagenation');
$config['base_url'] = base_url('group/index');
$config['total_rows'] = $this->groups_model->total_count();
$config['per_page'] = self::NUM_PER_PAGE;



$this->pagination->initialize($config);

$group=$this->groups_model->get_rowset_desc();
$this->load->view('templates/default',$data);
}
public function detail($id){
	$data['TITLE'] = ucfirst('部署詳細 | EventManager');
	$data['contentPath'] = 'group/detail';

	$this->load->model('groups_model');



	$data['group_row'] = $this->groups_model->get_row_by_id($id);

	if(!($data['group_row'] = $this->groups_model->get_row_by_id($this->uri->segment(3)))){
		show_404();
	}
	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);

	}
	if ($this->input->post('cancel') != null)
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
	$data['TITLE'] = ucfirst('部署登録 | EventManager');
	$data['contentPath'] = 'group/add';

	if ($this->input->post('cancel'))
	{
		redirect('group/index');
	}
	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);
	}
	$this->load->model('groups_model');

	if ($this->form_validation->run('group') == FALSE)
	{
		return $this->load->view('templates/default',$data);
	}
		$group['name'] = $this->input->post('name');
		$this->groups_model->insert($group);

		$data['contentPath'] = 'group/add_done';
		$this->load->view('templates/default',$data);
}

public function edit($id){
	$data['TITLE'] = ucfirst('部署編集 | EventManager');
	$data['contentPath'] = 'group/edit';

	$group = $this->groups_model->get_row_by_id($id);
	$data['group_row'] = $group;
	if(!($data['group_row'] = $this->groups_model->get_row_by_id($this->uri->segment(3)))){
		show_404();
	}

	if (!$this->input->post()) {
		return $this->load->view('templates/default',$data);
	}

	if ($this->input->post('cancel') != null)
	{
		redirect('group/detail/'.$this->uri->segment(3));
	}
	if ($group == null)
	{
		redirect('group/index');
	}

	if ($this->form_validation->run('group') == FALSE)
	{
		return $this->load->view('templates/default',$data);
	}

		try{
			$group_data['name'] = $this->input->post('name');
			$this->groups_model->update($id,$group_data);
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
			}

		$data['contentPath'] = 'group/edit_done';
		$this->load->view('templates/default',$data);
}

public function delete(){
	$data['TITLE'] = '部署削除 | EventManager';
	if(!($data['group_row'] = $this->groups_model->get_row_by_id($this->uri->segment(3)))){
		show_404();
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