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