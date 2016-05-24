<?php
//require_once 'validationRule.php';


class Event extends CI_Controller {

	const NUM_PER_PAGE = 5;

	public function __construct()
	{

		parent::__construct();
		$this->output->enable_profiler(TRUE);

		$this->load->model('events_model');
		$this->load->model('users_model');
		$this->load->model('groups_model');


	}

	public function index($page = '')
	{
		$data['TITLE'] = 'イベント一覧 | EventManager';
		$data['contentPath'] = 'event/index';

		if ($this->input->post('add')) {
			redirect('event/add');
		}

		if ($this->uri->segment(3) == 'today') {
			$data['eventRowset'] = $this->events_model->get_rowset_desc_today();
		//$data['newsRowset'] = $this->news_model->get_rowset_desc($page,self::NUM_PER_PAGE);
		}else{
			$data['eventRowset'] = $this->events_model->get_rowset_desc();
		}


 		$config['base_url'] = base_url('event/index');
 		$config['total_rows'] = '10';
 		$config['per_page'] = self::NUM_PER_PAGE;;
// 		$config['use_page_numbers'] = TRUE;
// 		$config['prev_link'] = '前のページ';
// 		$config['next_link'] = '次のページ';
// 		$config['prev_tag_close'] = ' | ';
// 		$config['num_tag_close'] = ' | ';
// 		$config['cur_tag_close'] = '</strong> | ';
 		$this->pagination->initialize($config);

		$this->load->view('templates/default',$data);
	}

	public function detail()
	{
		$data['TITLE'] = 'イベント詳細 | EventManager';

		$data['contentPath'] = 'event/detail';

		$data['event_row'] = $this->events_model->get_row_by_id($this->uri->segment(3));

		$data['joined_user_rowset'] = $data['event_row']->get_joined_user_rowset();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		if ($this->input->post('cancel')) {
			redirect('event/index');
		}

		if ($this->input->post('join')) {
			redirect('event/index');
		}

		if ($this->input->post('defect')) {
			redirect('event/index');
		}

		if ($this->input->post('edit')) {
			redirect('event/edit/'.$this->uri->segment(3));
		}

		if ($this->input->post('delete')) {
			//redirect('event/index');
		}



		$data['contentPath'] = 'event/delete_done';
		$this->load->view('templates/default',$data);
	}

	public function add()
	{
		$data['TITLE'] = 'イベント登録 | EventManager';

		$data['contentPath'] = 'event/add';

		$data['groupList'] = $this->groups_model->get_list_for_form();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		if ($this->input->post('cancel')) {
			redirect('event/index');
		}

		if (!$this->form_validation->run('event')) {
			return $this->load->view('templates/default',$data);
		}

		try {
			$event_data['title']  = $this->input->post('title');
			$event_data['start']  = $this->input->post('start');
			$event_data['end']  = $this->input->post('end');
			$event_data['place']  = $this->input->post('place');
			$event_data['group_id']  = $this->input->post('group');
			$event_data['detail']  = $this->input->post('detail');
			//$event_data['registerd_by']  = $logged_in_user->get_id();

			$this->events_model->insert($event_data);
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'event/add_done';
		$this->load->view('templates/default',$data);
	}

	public function edit()
	{
		$data['TITLE'] = 'イベント編集 | EventManager';

		$data['contentPath'] = 'event/edit';

		$data['groupList'] = $this->groups_model->get_list_for_form();

		$data['event_row'] = $this->events_model->get_row_by_id($this->uri->segment(3));

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);;
		}

		if ($this->input->post('cancel')) {
			redirect('event/index');
		}

		if (!$this->form_validation->run('event')) {
			return $this->load->view('templates/default',$data);
		}

		//データの更新処理
		try {
			$event_data['title']  = $this->input->post('title');
			$event_data['start']  = $this->input->post('start');
			$event_data['end']  = $this->input->post('end');
			$event_data['place']  = $this->input->post('place');
			$event_data['group_id']  = $this->input->post('group');
			$event_data['detail']  = $this->input->post('detail');

			$this->events_model->update($this->uri->segment(3),$event_data);
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'event/edit_done';
		$this->load->view('templates/default',$data);
	}

	public function delete()
	{
		$data['TITLE'] = 'イベント削除 | EventManager';

		try {

			$this->events_model->delete($this->uri->segment(3));

			//$this->session->set_flashdata('delete','削除しました。');
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = '/event/delete_done';
		$this->load->view('templates/default',$data);
	}
}