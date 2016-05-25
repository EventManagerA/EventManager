<?php
class User extends CI_Controller {

	const NUM_PER_PAGE = 5;
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);

		$this->load->model('users_model');
		$this->load->model('groups_model');
		$this->load->model('events_model');
		$this->load->library('form_validation');


		$logged_in_user = $this->load->get_var('logged_in_user');

		var_dump($logged_in_user);
	/*	if($logged_in_user === $this->users_model->get_row_by_id()){
			redirect('event/index');
		}*/
	///--------------------------------------------------------//
	}


	public function index($page = '')
	{
		//var_dump($data['userlist']);
		$data['TITLE'] = 'ユーザ一覧 | EventManager';
		$data['contentPath'] = 'user/index';

		if($this->input->post('add')){
			redirect('user/add');
		}

// 		//データの取得
// 		if(!is_numeric($page)){
// 			$page=1;
// 		}

//		$users = $this->users_model->get_rowset_desc();

		//-------------------
		$this->load->library('pagination');
		$config = $this->load->get_var('pagenation');
		$config['base_url'] = base_url('user/index');
	//	$config['total_rows'] = $this->users_model->total_count();
		$config['total_rows'] = count($this->users_model->get_rowset_desc());
		$config['per_page'] = self::NUM_PER_PAGE;
		$this->pagination->initialize($config);


	/*
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
	*/

		//----------------------------------------------------------------

		$data['userList']=$this->users_model->get_rowset_desc($this->uri->segment(3),self::NUM_PER_PAGE );

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
		//deleteボタンが押された場合は「deleteメソッドへ」
		if($this->input->post('delete')){
			redirect('user/delete/'.$this->uri->segment(3));
		}


	}

	public function add()
	{
		//var_dump($_POST["add"]);
		$data['TITLE'] = 'ユーザ登録 | EventManager';

		$data['contentPath'] = 'user/add';
	//	var_dump($data);
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
// 		$this->form_validation->set_rules('name','氏名','required|max_length[50]');
// 		$this->form_validation->set_rules('login_id','ログインID','required|min_length[3]|max_length[50]');
// 		$this->form_validation->set_rules('password','パスワード','required|min_length[6]|max_length[255]');
// 		$this->form_validation->set_rules('group','所属グループ','required');


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
			//$this->load->view('user/add');
			$data['contentPath'] = 'user/add';
			return $this->load->view('templates/default',$data);
		}
	}

	public function edit($id)
	{
		$data['TITLE'] = 'ユーザ編集 | EventManager';

		$data['contentPath'] = 'user/edit';

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
			redirect('user/detail/'.$this->uri->segment(3));
		}

		//view/detailで選んだユーザ情報を取る
		//$users = $this->users_model->get_row_by_id($id);
		//$data['users'] = $users;
//---------------
		//バリデーションルールの設定
// 		$this->form_validation->set_rules('name','氏名','required|max_length[50]');
// 		$this->form_validation->set_rules('login_id','ログインID','required|min_length[3]|max_length[50]');
// 		$this->form_validation->set_rules('password','パスワード');
// 		$this->form_validation->set_rules('group','所属グループ','required');


		if ($this->form_validation->run('user_edit'))
		{

			try {        //バリデーションがOKなら、編集登録
				$user_data['name'] = $this->input->post('name');
				$user_data['login_id'] = $this->input->post('login_id');
				if($_POST['password']){//パスワードが空欄の場合は更新しない
					$user_data['login_pass'] = $this->input->post('password');
				}
				$user_data['group_id'] = $this->input->post('group');


				//DBに更新する
				$this->users_model->update($this->uri->segment(3),$user_data);

				//	var_dump($_POST);
				//idをedit_doneに持っていく
				$data['user'] = $this->users_model->get_row_by_id($this->uri->segment(3));
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

	public function delete($id)
	{
		$data['TITLE'] = 'ユーザ削除 | EventManager';


		//if ($this->input->post('delete')) {

			try {

				$this->users_model->delete($this->uri->segment(3));

				$data['contentPath'] = 'user/delete_done';
				$this->load->view('templates/default',$data);

			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
	//	}

	}

}