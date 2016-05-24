<?php

class Group extends CI_Controller {

	const NUM_PER_PAGE=5;
public function index(){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/index';
//     if(管理ユーザーなら){
//     	redirect(group/index);
//     }
	$this->load->model('groups_model');
	$data['group_rowset']=$this->groups_model->get_rowset();

	if ($this->input->post('add')){
		redirect('group/add');
	}



//データの取得
 $this->load->library('pagination');
// if(!is_numeric($page)){
// 	$page=1;
// }


//paginationの設定
$config['base_url'] = base_url('group/index');
$config['total_rows'] = 20;
$config['per_page'] = 5;
$config['use_page_numbers'] = TRUE;
$config['prev_link'] = '<<';
$config['next_link'] = '>>';
$config['prev_tag_close'] = ' | ';
$config['num_tag_close'] = ' | ';
$config['cur_tag_close'] = '</strong> | ';
$this->pagination->initialize($config);


$this->load->view('templates/default',$data);
}
public function detail($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/detail';
	//     if(管理ユーザーなら){
	//     	redirect(group/index);
	//     }
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
	//     if(管理ユーザーなら){
	//     	redirect(group/index);
	//     }
	$this->load->model('groups_model');

	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

	$this->form_validation->set_rules('name', '部署名', 'required');

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
	//     if(管理ユーザーなら){
	//     	redirect(group/index);
	//     }
	$this->load->model('groups_model');
	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}


	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');

	}
	$data['group_rowset'] = $group;


	$this->form_validation->set_rules('name', '部署名', 'required');

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

public function delete($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/delete';
	//     if(管理ユーザーなら){
	//     	redirect(group/index);
	//     }
	$this->load->model('groups_model');

	$group= $this->groups_model->get_row_by_id($id);

	$data['group_rowset'] = $group;




	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}


	if ($this->input->post('delete') )
	{
		$this->groups_model->delete($id);

 		$data['contentPath'] = 'group/delete_done';

	}
	$this->load->view('templates/default',$data);

	}

}