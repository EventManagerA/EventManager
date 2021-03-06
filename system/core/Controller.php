<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {
	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}
		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');

		//ログイン済みであればユーザデータの入った変数を作る
		if (isset($_SESSION['auth'])) {
			$this->load->model('users_model');
			$data['logged_in_user'] = $this->users_model->get_row_by_id($_SESSION['id']);

			$this->load->vars($data);

			//本日のイベント一覧へ飛ばす
			if (in_array($this->router->fetch_class(), ['index'], true) && in_array($this->router->fetch_method(), ['login'], true)) {
				redirect('event/index/today');
			}
		}else{
			//ログイン画面へ飛ばす
			if (!(in_array($this->router->fetch_class(), ['index'], true) && in_array($this->router->fetch_method(), ['login'], true))) {
				redirect('index/login');
			}
		}

		//pagenation
		$data['pagenation']['use_page_numbers'] = TRUE;
		$data['pagenation']['prev_link'] = '<<';
		$data['pagenation']['next_link'] = '>>';
		$data['pagenation']['full_tag_open'] = '<ul class="pagination">';
		$data['pagenation']['full_tag_close'] = '</ul>';
		$data['pagenation']['first_link'] = FALSE;
		$data['pagenation']['last_link'] =  FALSE;
		$data['pagenation']['first_tag_open'] = '<li>';
		$data['pagenation']['first_tag_close'] = '</li>';
		$data['pagenation']['next_tag_open'] = '<li>';
		$data['pagenation']['next_tag_close'] = '</li>';
		$data['pagenation']['prev_tag_open'] = '<li>';
		$data['pagenation']['prev_tag_close'] = '</li>';
		$data['pagenation']['cur_tag_open'] = '<li  class="active"><a>';
		$data['pagenation']['cur_tag_close'] = '</a></li>';
		$data['pagenation']['num_tag_open'] = '<li>';
		$data['pagenation']['num_tag_close'] = '</li>';
		$this->load->vars($data);
	}
	// --------------------------------------------------------------------
	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
}