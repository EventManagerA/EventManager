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

		//ログインユーザーが参加しているイベントリストを抽出
		$logged_in_user = $this->load->get_var('logged_in_user');
		$data['join_event_id_list'] = $logged_in_user->get_event_id_list_by_user_id();

		if ($this->input->post('add')) {
			redirect('event/add');
		}

		if ($this->uri->segment(3) == 'today') {
			$data['eventRowset'] = $this->events_model->get_rowset_desc_today($this->uri->segment(4),self::NUM_PER_PAGE);
		//$data['newsRowset'] = $this->news_model->get_rowset_desc($page,self::NUM_PER_PAGE);
		}else{
			$data['eventRowset'] = $this->events_model->get_rowset_desc($this->uri->segment(3),self::NUM_PER_PAGE);
		}


 		$config['base_url'] = base_url('event/index');
		$config['total_rows'] = count($this->events_model->get_rowset_desc());
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

		$this->load->view('templates/default',$data);
	}

	public function detail()
	{
		$data['TITLE'] = 'イベント詳細 | EventManager';

		$data['contentPath'] = 'event/detail';

		$data['event_row'] = $this->events_model->get_row_by_id($this->uri->segment(3));

		$data['joined_user_rowset'] = $data['event_row']->get_joined_user_rowset();

		//ログインユーザーが参加しているイベントリストを抽出
		$logged_in_user = $this->load->get_var('logged_in_user');
		$data['join_event_id_list'] = $logged_in_user->get_event_id_list_by_user_id();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		if ($this->input->post('cancel')) {
			redirect('event/index');
		}

		if ($this->input->post('join')) {
			//登録処理
			try {
				$event_data['title']  = $this->input->post('title');
				$event_data['start']  = $this->input->post('start');
				$event_data['end']  = $this->input->post('end');
				$event_data['place']  = $this->input->post('place');
				$event_data['group_id']  = $this->input->post('group');
				$event_data['detail']  = $this->input->post('detail');
				$event_data['registered_by']  = $logged_in_user->get_id();

				$this->events_model->insert($event_data);
			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
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

		$logged_in_user = $this->load->get_var('logged_in_user');

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

		//登録処理
		try {
			$event_data['title']  = $this->input->post('title');
			$event_data['start']  = $this->input->post('start');
			$event_data['end']  = $this->input->post('end');
			$event_data['place']  = $this->input->post('place');
			$event_data['group_id']  = $this->input->post('group');
			$event_data['detail']  = $this->input->post('detail');
			$event_data['registered_by']  = $logged_in_user->get_id();

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