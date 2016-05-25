<?php
class User extends CI_Controller {

	const NUM_PER_PAGE = 5;
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);

		$this->load->model('users_model');
		$this->load->model('groups_model');
		$this->load->library('form_validation');
	}


	public function index($page = '')
	{
		//var_dump($data['userlist']);
		$data['TITLE'] = 'ユーザ一覧 | EventManager';
		$data['contentPath'] = 'user/index';

		if($this->input->post('add')){
			redirect('user/add');
		}
		//-------------------
	/*	$config['base_url'] = base_url('group/index');
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
		//-------------------
/*		$config['base_url'] = base_url('user/index');
		$config['total_rows'] = '10';
		$config['per_page'] = self::NUM_PER_PAGE;
		$this->pagination->initialize($config);
*/
		$data['userList']=$this->users_model->get_rowset_desc();

		$this->load->view('templates/default', $data);
		//$this->load->view('user/index',$data);
	}

	public function detail()
	{
		$data['TITLE'] = 'ユーザ詳細 | EventManager';
		$data['contentPath'] = 'user/detail';
		/*------要確認-----------*/
		$data['userList'] = $this->users_model->get_row_by_id($this->uri->segment(3));
		/*----------------------*/
		//$this->load->view('user/detail');
		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		//indexボタンが押された場合は「一覧画面」へ戻る
		if($this->input->post('cancel')){
			redirect('user/index');
		}
		//editボタンが押された場合は「編集画面」へ移動
		if($this->input->post('edit')){
			redirect('user/edit/'.$this->uri->segment(3));

		}
		//deleteボタンが押された場合は「削除モーダルダイアログ」表示
		if($this->input->post('delete')){
			//redirect('user/delete');
		}


		$data['contentPath'] = 'user/delete_done';
		$this->load->view('templates/default',$data);
	}

	public function add()
	{
		//var_dump($_POST["add"]);
		$data['TITLE'] = 'ユーザ登録 | EventManager';

		$data['contentPath'] = 'user/add';
		var_dump($data);
		//var_dump($_POST);

		$data['groupList'] = $this->groups_model->get_list_for_userform();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);

		}
		//キャンセルボタンが押された場合は一覧画面へ
		if ($this->input->post('cancel')) {
			redirect('user/index');
		}

		//バリデーションルールの設定
		$this->form_validation->set_rules('name','氏名','required|max_length[50]');
		$this->form_validation->set_rules('login_id','ログインID','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password','パスワード','required|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('group','所属グループ','required');


		if ($this->form_validation->run('user')) {

			try {        //バリデーションがOKなら、登録
				$user_data['name'] = $this->input->post('name');
				$user_data['login_id'] = $this->input->post('login_id');
				$user_data['login_pass'] = $this->input->post('password');
				$user_data['group_id'] = $this->input->post('group');
						//DBに挿入する
				$this->users_model->insert($user_data);
			//	var_dump($_POST);
				$data['contentPath'] = 'user/add_done';
				return $this->load->view('templates/default',$data);
			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
		}else{
			$this->load->view('user/add');
		}
	}

	public function edit($id)
	{
		$data['TITLE'] = 'ユーザ編集 | EventManager';
		//$data['requestPost'] = $this->input->post();
		$data['contentPath'] = 'user/edit';
		/*----要確認---*/
		//$data['groupList'] = $this->groups_model->get_list_for_userform();
		$data['groupList'] = $this->groups_model->get_list_for_userform();
		$data['users'] = $this->users_model->get_row_by_id($this->uri->segment(3));
	/*	if($users == null)
		{//indexに戻ってしまう。
			redirect('user/index');
		}*/
		/*----------*/
		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		if ($this->input->post('cancel')) {
			redirect('user/detail');
		}

		//view/detailで選んだユーザ情報を取る
		//$users = $this->users_model->get_row_by_id($id);
		//$data['users'] = $users;
//---------------
		//バリデーションルールの設定
		$this->form_validation->set_rules('name','氏名','required|max_length[50]');
		$this->form_validation->set_rules('login_id','ログインID','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('password','パスワード');
		$this->form_validation->set_rules('group','所属グループ','required');


		if ($this->form_validation->run('user'))
		{

			try {        //バリデーションがOKなら、登録
				$user_data['name'] = $this->input->post('name');
				$user_data['login_id'] = $this->input->post('login_id');
				$user_data['login_pass'] = $this->input->post('password');
				$user_data['group_id'] = $this->input->post('group');


// 				// データベースのお知らせを更新する
// 				$news->id = $id;
// 				$news->post_date = $this->input->post('post_date');
// 				$news->message = $this->input->post('message');
// 				$this->news_model->update($news);



				//DBに更新する
				$this->users_model->update($this->uri->segment(3),$user_data);
				//$this->users_model->insert($user_data);
				//	var_dump($_POST);
				$data['contentPath'] = 'user/edit_done';
				return $this->load->view('templates/default',$data);
			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
		}else{
			$this->load->view('user/edit');
		}
//-----------
	}

/*
	public function edit_done()
	{
		$this->load->view('user/edit_done');
	}
*/

	public function delete()
	{
		$data['TITLE'] = 'ユーザ削除 | EventManager';
	//	$data['CSS'] = 'admin/admin';

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

			$this->session->set_flashdata('delete','ユーザの削除が完了しました。');
		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'Admin/news/'.__FUNCTION__.'_done';
		$this->load->view('template/default',$data);
		//$this->load->view('user/delete');
	}

/*
	public function delete_done()
	{
		$this->load->view('user/delete_done');
	}
*/
}