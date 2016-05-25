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
		'login' => array(
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