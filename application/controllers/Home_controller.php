<?php
declare(strict_types=1);

/**
 * Class HomeController
 * @property Home_model $home_model
 */
class Home_controller extends CI_Controller {

	/**
	 * HomeController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/home_model');
	}

	/**
	 * The page home
	 */
	public function index()
	{

		$config['title'] = 'Wibu';
		$config['select'] = 1;

		$query['sidebar'] = $this->home_model->getSidebar();
		$query['new_movies'] = $this->home_model->getNewMovies();
		$query['highlight'] = $this->home_model->getHighlightMovies();
		$query['movies'] = $this->home_model->getMovies();
		$query['live_action'] = $this->home_model->getLiveAction();
		$query['top_day'] = $this->home_model->getTopViewDate();
		$query['top_week'] = $this->home_model->getTopViewWeek();
		$query['top_month'] = $this->home_model->getTopViewMonth();
		$query['top_year'] = $this->home_model->getTopViewYears();
		$query['comments'] = $this->home_model->getNewComments();

		$this->load->view("include/header",$config);
		$this->load->view('index',$query);
		$this->load->view("include/footer");
	}

	/**
	 * Search popup in header
	 * return template result
	 */
	public function searchPopup(){
		$query['data'] = $this->home_model->searchPopup();
		$this->load->view('user/template/search_popup_result',$query);
	}


}
