<?php
class Index extends CI_Controller {

	public function login() {

		$this-> load-> model('Users_model');
		//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
			if($this-> session-> userdata('user') === TRUE){
				redirect('event/index');
			}
		}
		//postされたら
		if($this-> input-> post('login')) {
			//データ取得
			$login_id = $this-> load-> post('login_id');
			$login_pass = $this-> load-> post('login_pass');
			//認証成功 ログインIDとpassのデータがあったら
			if($this-> Users_model-> auth() === TRUE){
				//ユーザIDと名前取得
				$data['name'] = $this-> Users_model->  get_row();

				//セッションにidとauth登録
				redirect('event/index');
			}
			//認証失敗
			else {
				redirect('index/login');
			}
		}
		//postがなかったら（初期表示）
		else{
			$this-> load-> view('header');
			$this-> load-> view('index/login');
		}

	}

	public function logout() {
		//セッション削除

		$this-> load-> view('header');
		$this-> load-> view('index/logout');

	}

}