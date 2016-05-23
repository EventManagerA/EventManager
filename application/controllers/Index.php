<?php
class Index extends CI_Controller {

	public function login() {
		$data['TITLE'] = ucfirst('ログイン');
		$data['contentPath'] = 'index/login';

		$this-> load-> model('Users_model');
		$this-> load-> helper('form');
		$this-> load-> library('form_validation');

		//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
// 			if($this-> session-> userdata('user') === TRUE){
				redirect('event/index');
// 			}
		}
		//postされたら
		$login = $this-> input-> post('login');
		echo $login;
		if(isset($login)) {
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
						'auth' => TRUE
				));
				redirect('event/index');
			}
			//認証失敗
			else {
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

		$this->load->view('templates/default', $data);

// 		$this-> load-> view('header');
// 		$this-> load-> view('index/logout');
	}

}
