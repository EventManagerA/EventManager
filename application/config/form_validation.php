<?php
$config = array(
		'event' => array(
				array(
						'field' => 'title',
						'label' => 'タイトル',
						'rules' => 'required|max_length[50]'
				),
				array(
						'field' => 'start',
						'label' => '開始時間',
						'rules' => 'required|callback__date_check'
				),
				array(
						'field' => 'end',
						'label' => '終了時間',
						'rules' => 'callback__date_check'
				),
				array(
						'field' => 'place',
						'label' => '場所',
						'rules' => 'required|max_length[255]'
				),
				array(
						'field' => 'group',
						'label' => '対象グループ',
						'rules' => ''
				),
				array(
						'field' => 'detail',
						'label' => '詳細',
						'rules' => 'max_length[10000]'
				),
		),
		'group' => array(
				array(
						'field' => 'title',
						'label' => 'タイトル',
						'rules' => 'required'
				),
				array(
						'field' => 'summer',
						'label' => '夏',
						'rules' => 'required'
				),
		),
		'user' => array(
				array(
						'field' => 'name',
						'label' => '氏名',
						'rules' => 'required|max_length[50]|regex_match[/^[ぁ-んァ-ヶー一-龠 ]+$/u]'
				),
				array(
						'field' => 'login_id',
						'label' => 'ログインID',
						'rules' => 'required|min_length[4]|max_length[50]|regex_match[/^[a-zA-Z0-9-_]+$/]|callback__id_unique_check'
				),
				array(
						'field' => 'password',//postのname属性に合わせる
						'label' => 'パスワード',
						'rules' => 'required|min_length[6]|max_length[255]|regex_match[/^[a-zA-Z0-9]+$/]'
				),
				array(
						'field' => 'group',//postのname属性に合わせる
						'label' => '所属グループ',
						'rules' => 'required'
				),
		),
		'user_edit' => array(
				array(
						'field' => 'name',
						'label' => '氏名',
						'rules' => 'required|max_length[50]|regex_match[/^[ぁ-んァ-ヶー一-龠 ]+$/u]'
				),
				array(
						'field' => 'login_id',
						'label' => 'ログインID',
						'rules' => 'required|min_length[4]|max_length[50]|regex_match[/^[a-zA-Z0-9-_]+$/]|callback__id_unique_check'
				),
				array(
						'field' => 'password',//postのname属性に合わせる
						'label' => 'パスワード',
						'rules' => 'min_length[6]|max_length[255]|regex_match[/^[a-zA-Z0-9]+$/]'
				),
				array(
						'field' => 'group',//postのname属性に合わせる
						'label' => '所属グループ',
						'rules' => 'required'
				),
		),
		'login' => array(
				array(
						'field' => 'login_id',
						'label' => 'ログインID',
						'rules' => 'required'
				),
				array(
						'field' => 'password',
						'label' => 'パスワード',
						'rules' => 'required'
				),
		),
);