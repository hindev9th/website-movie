<?php
declare(strict_types=1);
/**
 * Class AccountController
 * @property Account_model $account_model
 * @property CI_Session $session
 */
class Account_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/account_model');
	}

	/**
	 * info account
	 */
	public function index(){
		$config['title'] = 'Account';
		$this->load->view('include/header',$config);
		$this->load->view('include/footer');
	}

	/**
	 * only show view Login
	 */
	public function login_template(){
		$config['title'] = 'Login';
		$this->load->view('include/header',$config);
		$this->load->view('user/login');
		$this->load->view('include/footer');
	}

	/**
	 * only show view Register
	 */
	public function register_template(){
		$config['title'] = 'Register';
		$this->load->view('include/header',$config);
		$this->load->view('user/register');
		$this->load->view('include/footer');
	}

	/**
	 * handle login
	 */
	public function login(){
		$customer = $this->account_model->login();
		$data = array(
			'id' => $customer->id,
			'name' => $customer->name,
			'image' => $customer->image,
			'email' => $customer->email,
		);
		if ($customer != null){
			$this->session->set_userdata('customer',$data);
			echo '200';
		}else{
			echo 'Incorrect account or password information.';
		}
	}

	/**
	 * handle register
	 */
	public function register(){
		$customer = $this->account_model->register();
		if ($customer != null){
			$data = array(
				'id' => $customer->id,
				'name' => $customer->name,
				'image' => $customer->image,
				'email' => $customer->email,
			);
			$this->session->set_userdata('customer',$data);
			echo '200';
		}else{
			echo 'Email exists';
		}
	}

	/**
	 * logout account (remove session account)
	 */
	public function logout(){
		$this->session->unset_userdata('customer');
	}

	public function addFollow(){
		$this->account_model->addFollow();
	}
}
