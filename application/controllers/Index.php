<?php
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
// 		$this->output->enable_profiler(TRUE);
// 		$this->load->model('events_model');
		$this->load->model('Users_model');
// 		echo $this->users_model::;
	}

	public function login() {
		$data['TITLE'] = ucfirst('ログイン');
		$data['contentPath'] = 'index/login';

	//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
			redirect('event/index');
		}
		$this-> form_validation->set_rules('login_id', 'ログインID', 'required');
		$this-> form_validation->set_rules('login_pass', 'パスワード', 'required');

		if($this-> form_validation-> run()) {
			//postされたら
			if($this->input->post('login_submit')) {
				//データ取得
				$login_id = $this->input->post('login_id');
				$login_pass = $this->input->post('login_pass');
				//認証成功（ログインIDとpassのデータがあったら→id取得）
				$id = $this-> Users_model-> get_row_login($login_id,$login_pass);
				if(isset($id)){
					var_dump($id);
					//セッションにidとauth登録
					//ユーザデータを全て入れるのは親コントローラでやるsession
					$this-> session-> set_userdata(array(
							'id' => $id,
							'auth' => TRUE
					));
					redirect('event/index');
				}
			}
		}else {
			$this->load->view('templates/default',$data);
		}

	}

	public function logout() {
		$data['TITLE'] = ucfirst('ログアウト完了');
		$data['contentPath'] = 'index/logout';

		//セッション削除
		$_SESSION = array();		//セッションの中身を空にした、ファイルは存在している状態
		$params = session_get_cookie_params();
		setcookie(session_name(), "", time()-36000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);		//クライアントのクッキーを削除する
		session_destroy();

		$this->load->view('templates/default', $data);
	}

}

