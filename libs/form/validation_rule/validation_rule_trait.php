<?php

trait ValidationRuleTrait {

	public function _date_check($str)
	{
		if (!preg_match('/^(\d{4}-\d{2}-\d{2}[ |　]\d{2}:\d{2}:\d{2}){0,1}$/', $str)) {
			$this->form_validation->set_message('_date_check','正しい日付を入力してください。');
			return false;
		}
		return true;
	}

	public function _id_unique_check($str)
	{
		if($this->users_model->get_row_by_id($str)){
			return false;
		}
		return true;
	}


}