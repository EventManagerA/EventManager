<?php
$config = array(
		'event' => array(
				array(
						'field' => 'title',
						'label' => 'タイトル',
						'rules' => 'required'
				),
				array(
						'field' => 'start',
						'label' => '開始時間',
						'rules' => 'required'
				),
				array(
						'field' => 'end',
						'label' => '終了時間',
						'rules' => ''
				),
				array(
						'field' => 'place',
						'label' => '場所',
						'rules' => 'required'
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
				array(
						'field' => 'fall',
						'label' => '秋',
						'rules' => 'required'
				),
				array(
						'field' => 'winter',
						'label' => '冬',
						'rules' => 'required'
				)
		),
		'user' => array(
				array(
						'field' => 'name',
						'label' => '氏名',
						'rules' => 'required|max_length[50]'
				),
				array(
						'field' => 'login_id',
						'label' => 'ログインID',
						'rules' => 'required|min_length[3]|max_length[50]'
				),
				array(
						'field' => 'password',//postのname属性に合わせる
						'label' => 'パスワード',
						'rules' => 'required|min_length[6]|max_length[255]'
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
						'rules' => 'required|max_length[50]'
				),
				array(
						'field' => 'login_id',
						'label' => 'ログインID',
						'rules' => 'required|min_length[3]|max_length[50]'
				),
				array(
						'field' => 'password',//postのname属性に合わせる
						'label' => 'パスワード',
						'rules' => ''
				),
				array(
						'field' => 'group',//postのname属性に合わせる
						'label' => '所属グループ',
						'rules' => 'required'
				),
		),
		'add_event' => array(
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
);