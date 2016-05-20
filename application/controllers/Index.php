<?php
class Index extends CI_Controller {



	public function login() {
		$this-> load-> view('header');
		$this-> load-> view('index/login');
		$this-> load-> model('Users_model');

		if($this-> input->post('login')) {
			//認証成功 IDとパスのデータがあったら
			if($this-> Users_model-> auth() === TRUE){
				$this-> load->view('event/index');
			}
			//認証失敗
			else {
				redirect('index/login');
			}


		}

	}

	public function logout() {
		$this-> load-> view('header');
		$this-> load-> view('index/logout');

	}

}