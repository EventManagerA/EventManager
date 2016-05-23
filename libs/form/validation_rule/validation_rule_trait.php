<?php

trait ValidationRuleTrait {

	public function _date_check($str)
	{
		if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $str)) {
			$this->form_validation->set_message('_date_check','正しい日付を入力してください。');
			return false;
		}
		return true;
	}
}