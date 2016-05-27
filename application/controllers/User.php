<?php
class User extends CI_Controller {
	use ValidationRuleTrait;

	const NUM_PER_PAGE = 5;
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);

		$this->load->model('users_model');
		$this->load->model('groups_model');
		$this->load->model('events_model');

		//--------管理者分岐--------------------------------------//
		$logged_in_user = $this->load->get_var('logged_in_user');
		if(!$logged_in_user->is_admin_user()){

			redirect('event/index');
		}
	    //--------------------------------------------------------//
	}


	public function index($page = '')
	{
		$data['TITLE'] = 'ユーザ一覧 | EventManager';
		$data['contentPath'] = 'user/index';


		if($this->input->post('add')){
			redirect('user/add');
		}

		//----------ページネーション-------------------------------------------
		$config = $this->load->get_var('pagenation');
		$config['base_url'] = base_url('user/index');
		$config['total_rows'] = count($this->users_model->get_rowset_desc());
		$config['per_page'] = self::NUM_PER_PAGE;
		$this->pagination->initialize($config);
		//---------------------------------------------------------------------

		$data['userList']=$this->users_model->get_rowset_desc($this->uri->segment(3),self::NUM_PER_PAGE );

		$this->load->view('templates/default', $data);
	}

	public function detail()
	{
		$data['TITLE'] = 'ユーザ詳細 | EventManager';
		$data['contentPath'] = 'user/detail';

		if(!($data['event_row'] = $this->users_model->get_row_by_id($this->uri->segment(3)))){
			show_404();
		}

		$data['userList'] = $this->users_model->get_row_by_id($this->uri->segment(3));


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
		$data['TITLE'] = 'ユーザ登録 | EventManager';
		$data['contentPath'] = 'user/add';

		$data['groupList'] = $this->groups_model->get_list_for_userform();

		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);

		}
		//キャンセルボタンが押された場合は一覧画面へ
		if ($this->input->post('cancel')) {
			redirect('user/index');
		}

		if (!$this->form_validation->run('user')) {
			return $this->load->view('templates/default',$data);
		}


		try {        //バリデーションがOKなら、登録
			$user_data['name'] = $this->input->post('name');
			$user_data['login_id'] = $this->input->post('login_id');
			$user_data['login_pass'] = $this->input->post('password');
			$user_data['group_id'] = $this->input->post('group');
					//DBに挿入する
			$this->users_model->insert($user_data);

		} catch (PDOException $e) {
			echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
			exit;
		}

		$data['contentPath'] = 'user/add_done';
		return $this->load->view('templates/default',$data);
	}

	public function edit($id)
	{
		$data['TITLE'] = 'ユーザ編集 | EventManager';

		$data['contentPath'] = 'user/edit';

		if(!($data['users'] = $this->users_model->get_row_by_id($this->uri->segment(3)))){
			show_404();
		}
		$data['users'] = $this->users_model->get_row_by_id($this->uri->segment(3));
		$data['groupList'] = $this->groups_model->get_list_for_userform();


		if (!$this->input->post()) {
			return $this->load->view('templates/default',$data);
		}

		if ($this->input->post('cancel')) {
			redirect('user/detail/'.$this->uri->segment(3));
		}


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

				//idをedit_doneに持っていく
				$data['user'] = $this->users_model->get_row_by_id($this->uri->segment(3));
				$data['contentPath'] = 'user/edit_done';
				return $this->load->view('templates/default',$data);
			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
		}else{
			return $this->load->view('templates/default',$data);
		}
	}

	public function delete($id)
	{
		$data['TITLE'] = 'ユーザ削除 | EventManager';

		if(!($data['event_row'] = $this->users_model->get_row_by_id($this->uri->segment(3)))){
			show_404();
		}

			try {

				$this->users_model->delete($this->uri->segment(3));

				$data['contentPath'] = 'user/delete_done';
				$this->load->view('templates/default',$data);

			} catch (PDOException $e) {
				echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'ASCII,JIS,UTF-8,CP51932,SJIS-win');
				exit;
			}
	}

}