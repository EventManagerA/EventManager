<?php
class Index extends CI_Controller {

	public function login() {

		$this-> load-> model('Users_model');
		$this-> load-> helper('form');
		$this-> load-> library('form_validation');

		//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
			if($this-> session-> userdata('user') === TRUE){
				redirect('event/index');
			}
		}
		//postされたら
		if($this-> input-> post('login')) {
			echo "aa";
			//データ取得
			$login_id = $this-> input-> post('login_id');
			$login_pass = $this-> input-> post('login_pass');
			//認証成功 ログインIDとpassのデータがあったら
			if($this-> Users_model-> get_row_by_id($login_id) === TRUE){
				//ユーザIDと名前取得
				$data['user'] = $this-> Users_model->  get_row_by_id($login_id);

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
// 			$this-> load-> view('header');
			$this-> load-> view('index/login');
		}

	}

	public function logout() {
		//セッション削除

		$this-> load-> view('header');
		$this-> load-> view('index/logout');

	}

}