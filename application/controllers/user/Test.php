<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Test extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->view("include/header");
	}

	public function Index(){
		log_message('debug', 'Some variable was correctly set');
		$this->load->view("user/index");
	}

	/**
	 * Override page
	 */
//	public function _remap(){
//		echo "ok";
//	}
}
