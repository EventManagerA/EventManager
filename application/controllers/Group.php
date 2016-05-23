<?php
$data['TITLE'] = ucfirst('EventManager');
$data['contentPath'] = 'controller/method';
class Group extends CI_Controller {

public function index(){
	//$data['TITLE'] = ucfirst('EventManager');
	//$data['contentPath'] = 'controller/method';
	$this->load->model('groups_model');
	$data['group']=$this->groups_model->get_rowset();
    $this->load->view('group/index',$data);
}

public function detail($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'controller/method';

	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');
	}
	$data['group'] = $group;


	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('group/edit/default',$data);
	}
	else
	{

		$group->id = $id;
		$group->name = $this->input->post('name');
	}

	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

	if ($this->input->post('edit') != null)
	{
		redirect('group/edit');
	}

	if ($this->input->post('index') != null)
	{
		redirect('group/index');
	}


}
public function add(){
	//$data['TITLE'] = ucfirst('EventManager');
	//$data['contentPath'] = 'controller/method';
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

		redirect('group/add_done');
	}

}

public function edit($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'controller/method';

	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}


	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');
	}
	$data['group'] = $group;


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
		redirect('group/delete_done');
	}


	$group = $this->groups_model->find_by_id($id);
	if ($news == null)
	{
		redirect('group/index');
	}
	$data['group'] = $group;

	$this->load->view('group/delete', $data);

}
}