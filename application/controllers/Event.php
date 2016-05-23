<?php
//require_once 'validationRule.php';


class Event extends CI_Controller {

	const NUM_PER_PAGE = 5;

	public function __construct()
	{

		parent::__construct();
		$this->output->enable_profiler(TRUE);

		//$this->load->model('event_model');
		$this->load->model('users_model');
	}

	public function index($page = '')
	{
		$data['TITLE'] = 'お知らせリスト | GDRIVE管理';
		$data['contentPath'] = 'event/index';

		$userrow = $this->users_model->get_row_by_id(1);
		var_dump($userrow);

		//$data['newsRowset'] = $this->news_model->get_rowset_desc($page,self::NUM_PER_PAGE);

// 		$config['base_url'] = base_url('admin/news/index');
// 		$config['total_rows'] = $this->db->count_all('news');
// 		$config['per_page'] = self::NUM_PER_PAGE;;
// 		$config['use_page_numbers'] = TRUE;
// 		$config['prev_link'] = '前のページ';
// 		$config['next_link'] = '次のページ';
// 		$config['prev_tag_close'] = ' | ';
// 		$config['num_tag_close'] = ' | ';
// 		$config['cur_tag_close'] = '</strong> | ';
// 		$this->pagination->initialize($config);

		$this->load->view('templates/default',$data);
	}

	public function add()
	{
		$data['TITLE'] = 'お知らせ追加 | GDRIVE管理';
		$data['CSS'] = 'admin/admin';

		$data['requestPost'] = $this->input->post();

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__;

		if (!$this->input->post()) {
			return $this->load->view('template/default',$data);;
		}

		if (isset($data['requestPost']['cancel'])) {
			redirect('Admin/news/index');;
		}

		$this->form_validation->set_rules('posted','日付','required|callback__date_check');
		$this->form_validation->set_rules('message','内容','required');

		if (!$this->form_validation->run()) {
			return $this->load->view('template/default',$data);;;
		}

		try {
			$this->news_model->set_posted($data['requestPost']['posted']);
			$this->news_model->set_message($data['requestPost']['message']);
			$this->news_model->insert();
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__.'_done';
		$this->load->view('template/default',$data);
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