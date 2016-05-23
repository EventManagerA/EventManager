<?php
$data['TITLE'] = ucfirst('EventManager');
$data['contentPath'] = 'controller/method';
class Group extends CI_Controller {

public function index(){
	//$data['TITLE'] = ucfirst('EventManager');
	//$data['contentPath'] = 'controller/method';




	$this->load->model('groups_model');
	$data['group_rowset']=$this->groups_model->get_rowset();
    $this->load->view('group/index',$data);

   // $this->load->view('group/detail');

}

public function detail($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/detail';
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
		redirect('delete/index');
	}

	$this->load->view('templates/default',$data);
}
public function add(){
	//$data['TITLE'] = ucfirst('EventManager');
	//$data['contentPath'] = 'controller/method';
	$this->load->model('groups_model');
	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

	$this->form_validation->set_rules('name', '部署名', 'required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('group/add');
	}
	else
	{
		$group['name'] = $this->input->post('name');
		$this->groups_model->insert($group);

		$this->load->view('group/add_done');
	}


}


public function edit($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/edit';

	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

	$this->load->view('templates/default',$data);
	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');
	}
	$data['group_rowset'] = $group;


	$this->form_validation->set_rules('name', '部署名', 'required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('group/edit', $data);
	}
	else
	{

		$group->id = $id;
		$group->name = $this->input->post('name');

		$this->groups_model->update($group);

		redirect('group/edit_done');
	}

}

public function delete($id){
	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}


	if ($this->input->post('delete') != null)
	{
		$this->groups_model->delete($id);
		$this->load->view('group/delete_done');
	}


	$group = $this->groups_model->find_by_id($id);
	if ($news == null)
	{
		redirect('group/index');
	}
	$data['group_rowset'] = $group;

	$this->load->view('group/delete', $data);

}
}