<?php
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
// 		$this->output->enable_profiler(TRUE);
		$this->load->model('users_model');
		$this->load->model('login_log_model');

	}

	public function login() {

		$data['TITLE'] = ucfirst('ログイン | EventManager');
		$data['contentPath'] = 'index/login';

		//バリデーションNG → 戻る
		if(! $this-> form_validation-> run('login')) {
			return $this->load->view('templates/default',$data);
		}

		//postされたら
		if(!$this->input->post('login_submit')) {
			return $this->load->view('templates/default',$data);
		}

		//データ取得
		if (!$user_data = $this->users_model->login($this->input->post('login_id'),$this->input->post('password'))) {
			$data['auth_error'] = "ログインIDまたはパスワードが正しくありません。";
			return $this->load->view('templates/default',$data);
		};
		//認証成功

		$this->session->set_flashdata('event', $user_data->get_rowset_new_event_to_string());

		try {
			$user_data_array['user_id'] =$user_data->get_id();
			$this->login_log_model->insert($user_data_array);
		} catch (Exception $e) {
		}

		redirect('event/index/today');
	}

	public function logout() {
		$data['TITLE'] = ucfirst('ログアウト完了 | EventManager');
		$data['contentPath'] = 'index/logout';
		$this->users_model->logout();
		$this->load->view('templates/default', $data);
	}

}

