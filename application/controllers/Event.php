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
		$data['TITLE'] = 'EventManager | イベント一覧';
		$data['contentPath'] = 'event/index';

		if ($this->input->post('add')) {
			redirect('event/add');;
		}

		if ($this->uri->segment(3) == 'today') {
			$data['eventRowset'] = $this->events_model->get_rowset_desc_today();;
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

	public function add()
	{
		$data['TITLE'] = 'EventManager | イベント登録';

		$data['requestPost'] = $this->input->post();

		$data['contentPath'] = 'event/add';

		$data['groupList'] = $this->groups_model->get_list_for_form();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);;
		}

		if (isset($data['requestPost']['cancel'])) {
			redirect('event/index');;
		}

		if (!$this->form_validation->run('event')) {
			return $this->load->view('templates/default',$data);;;
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
		$data['TITLE'] = 'お知らせ編集 | GDRIVE管理';
		$data['CSS'] = 'admin/admin';

		$data['requestPost'] = $this->input->post();
		$data['requestGet'] = $this->input->get();

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__;

		if (isset($data['requestPost']['cancel'])) {
			redirect('Admin/news/index');;
		}

		if (!$data['newsRow'] = $this->news_model->get_row_by_id($this->uri->segment(4))) {
			redirect('Admin/news/index');;
		}

		if (!$this->input->post()) {
			return $this->load->view('template/default',$data);;
		}

		$this->form_validation->set_rules('posted','日付','required|callback__date_check');
		$this->form_validation->set_rules('message','内容','required');

		if (!$this->form_validation->run()) {
			return $this->load->view('template/default',$data);;;
		}

		try {

			$this->news_model->set_posted($data['requestPost']['posted']);
			$this->news_model->set_message($data['requestPost']['message']);
			$this->news_model->update($this->uri->segment(4));

		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}


		$this->session->set_flashdata('update','更新しました。');

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__.'_done';
		$this->load->view('template/default',$data);
	}

	public function delete()
	{
		$data['TITLE'] = 'お知らせ削除 | GDRIVE管理';
		$data['CSS'] = 'admin/admin';

		$data['requestPost'] = $this->input->post();
		$data['requestGet'] = $this->input->get();

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__;

		if (isset($data['requestPost']['cancel'])) {
			redirect('Admin/news/index');
		}

		if (!$data['newsRow'] = $this->news_model->get_row_by_id($this->uri->segment(4))) {
			redirect('Admin/news/index');
		}

		if (!$this->input->post()) {
			return $this->load->view('template/default',$data);
		}


		try {

			$this->news_model->delete($this->uri->segment(4));

			$this->session->set_flashdata('delete','削除しました。');
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__.'_done';
		$this->load->view('template/default',$data);
	}
}