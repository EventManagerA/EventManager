<?php
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
// 		$this->load->model('events_model');
// 		$this->load->model('users_model');
// 		echo $this->users_model::;
	}

	public function login() {
		$data['TITLE'] = ucfirst('ログイン');
		$data['contentPath'] = 'index/login';

		$this-> load-> model('Users_model');
		$this-> load-> helper('form');
		$this-> load-> library('form_validation');

		$data['requestPost'] = $this->input->post();
		var_dump($data);

		//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
// 			if($this-> session-> userdata('user') === TRUE){
				redirect('event/index');
// 			}
		}
		//postされたら
		if($this-> input-> post('login_submit') === 'ログイン') {
			echo "aa";
			//データ取得
			$login_id = $this-> input-> post('login_id');
			$login_pass = $this-> input-> post('login_pass');
			//認証成功 ログインIDとpassのデータがあったら
			if($this-> Users_model-> get_row_by_id($login_id) === TRUE){
				//ユーザIDと名前取得
				$data['userdata'] = $this-> Users_model->  get_row_by_id($login_id);
				var_dump($data['usedata']);
				//セッションにidとauth登録
				$this-> session-> set_userdata(array(
						'login_id' => $login_id,
// 						'login_pass' => $login_pass,
						'type_id' => $type_id,
						'auth' => TRUE
				));
				redirect('event/index');
			}
			//認証失敗
			else {
// 				var_dump($_POST);
				redirect('index/login');
			}
		}
		//postがなかったら（初期表示）
		else{
// 			var_dump($_POST);
// 			$this-> load-> view('header');
			$this->load->view('templates/default',$data);
// 			$this-> load-> view('index/login');
		}

	}

	public function logout() {
		$data['TITLE'] = ucfirst('ログアウト完了');
		$data['contentPath'] = 'index/logout';

		//セッション削除
		session_start();
		$_SESSION = array();		//セッションの中身を空にした、ファイルは存在している状態
		$params = session_get_cookie_params();
		setcookie(session_name(), "", time()-36000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);		//クライアントのクッキーを削除する
		session_destroy();

		$this->load->view('templates/default', $data);

// 		$this-> load-> view('header');
// 		$this-> load-> view('index/logout');
	}

}

