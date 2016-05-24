<<?php
$data['TITLE'] = ucfirst('EventManager');
$data['contentPath'] = 'controller/method';
class Group extends CI_Controller {

public function index(){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/index';




	$this->load->model('groups_model');
	$data['group_rowset']=$this->groups_model->get_rowset();

    $this->load->view('templates/default',$data);

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
		redirect('group/delete/'.$this->uri->segment(3));
	}

	$this->load->view('templates/default',$data);
}
public function add(){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/add';
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

		//$this->load->view('group/add_done');

		$data['contentPath'] = 'group/add_done';
		$this->load->view('templates/default',$data);
	}


}


public function edit($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/edit';
	$this->load->model('groups_model');
	if ($this->input->post('cancel') != null)
	{
		redirect('group/index');
	}

	//$this->load->view('templates/default',$data);
	$group = $this->groups_model->get_row_by_id($id);
	if ($group == null)
	{
		redirect('group/index');
		//$this->load->view('templates/default',$data);
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
        //redirect('group/edit_done');
		$data['contentPath'] = 'group/edit_done';
		$this->load->view('templates/default',$data);
	}

}

public function delete($id){
	$data['TITLE'] = ucfirst('EventManager');
	$data['contentPath'] = 'group/delete';
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
		//redirect('group/delete_done');
 		$data['contentPath'] = 'group/delete_done';
 		//$this->load->view('templates/default',$data);
	}
	$this->load->view('templates/default',$data);

	}

}