<?php
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
// 		$this->output->enable_profiler(TRUE);
		$this->load->model('Users_model');
// 		echo $this->users_model::;
	}

	public function login() {

		$data['TITLE'] = ucfirst('ログイン');
		$data['contentPath'] = 'index/login';

		//ログイン済みだったらイベントへ
		if($this-> session-> userdata('auth') === TRUE){
			redirect('event/index/today');
		}

		$this-> form_validation->set_rules('login_id', 'ログインID', 'required');
		$this-> form_validation->set_rules('password', 'パスワード', 'required');
		//バリデーションNG → 戻る
		if(! $this-> form_validation-> run()) {
			$data['login_id'] = $this->input->post('login_id');
			$this->load->view('templates/default',$data);
		}
		//postされたら
		if($this->input->post('login_submit')) {
			//データ取得
			$data['login_id'] = $this->input->post('login_id');
			$password = $this->input->post('password');
			//認証成功（ログインIDとpassのデータがあったら→id取得）
			$id = $this-> Users_model-> login($data['login_id'],$password);
			if(isset($id)){
				redirect('event/index/today');
			}
			else{
				$data['login_id'] = $this->input->post('login_id');
				$data['auth_error'] = "ログインIDまたはパスワードが正しくありません。";
				$this->load->view('templates/default',$data);
			}
		}
	}

	public function logout() {
		$data['TITLE'] = ucfirst('ログアウト完了');
		$data['contentPath'] = 'index/logout';
		$this->Users_model->logout();
		$this->load->view('templates/default', $data);
	}

}

