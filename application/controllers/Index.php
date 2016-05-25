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

		$data['TITLE'] = ucfirst('ログイン | EventManager');
		$data['contentPath'] = 'index/login';

		$this-> form_validation->set_rules('login_id', 'ログインID', 'required');
		$this-> form_validation->set_rules('password', 'パスワード', 'required');
		//バリデーションNG → 戻る
		if(! $this-> form_validation-> run()) {
			$this->load->view('templates/default',$data);
		}
		else{
			//postされたら
			if($this->input->post('login_submit')) {
				//データ取得
				$id = $this-> Users_model-> login($this->input->post('login_id'),$this->input->post('password'));
				//認証成功
				if(isset($id)){
					redirect('event/index/today');
				}
				//認証失敗
				else{
					$data['auth_error'] = "ログインIDまたはパスワードが正しくありません。";
					$this->load->view('templates/default',$data);
				}
			}
		}
	}

	public function logout() {
		$data['TITLE'] = ucfirst('ログアウト完了 | EventManager');
		$data['contentPath'] = 'index/logout';
		$this->Users_model->logout();
		$this->load->view('templates/default', $data);
	}

}

