<?php
declare(strict_types=1);

/**
 * Class Category_controller
 * @property Home_model $home_model
 * @property Category_model $category_model
 * @property CI_Input $input
 */
class Category_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/home_model');
		$this->load->model('user/category_model');
	}

	public function index(){
		$filter = $this->input->get('genre') ?? '';

		$config['title'] = 'Genres';
		$config['select'] = 2;

		$query['data'] = $this->category_model->getMovies($filter);
		$query['countAll'] = $this->category_model->getCountRowfilter('',$filter);
		$query['current_page'] = 1;
		$query['filter'] = $filter;

		$query['top_day'] = $this->home_model->getTopViewDate();
		$query['top_week'] = $this->home_model->getTopViewWeek();
		$query['top_month'] = $this->home_model->getTopViewMonth();
		$query['top_year'] = $this->home_model->getTopViewYears();
		$query['comments'] = $this->home_model->getNewComments();

		$this->load->view('include/header',$config);
		$this->load->view('user/category',$query);
		$this->load->view('include/footer');

	}

	public function search(){
		$config['title'] = 'Genres';
		$config['select'] = 2;
		$value = $this->input->get('search');

		$query['data'] = $this->category_model->search($value);
		$query['countAll'] = $this->category_model->getCountRowfilter($value,'');
		$query['search'] = $value;
		$query['current_page'] = 1;

		$query['top_day'] = $this->home_model->getTopViewDate();
		$query['top_week'] = $this->home_model->getTopViewWeek();
		$query['top_month'] = $this->home_model->getTopViewMonth();
		$query['top_year'] = $this->home_model->getTopViewYears();
		$query['comments'] = $this->home_model->getNewComments();

		$this->load->view('include/header',$config);
		$this->load->view('user/category',$query);
		$this->load->view('include/footer');
	}

	public function filterMovies(){
		$value = $this->input->get('search') ?? '';
		$filter = $this->input->get('filter') ?? '';
		$order = $this->input->get('order') ?? '';
		$index = $this->input->get('index') ?? 1;

		$query['data'] = $this->category_model->filterMovies($value,$filter,$order,intval($index));
		$query['countAll'] = $this->category_model->getCountRowfilter($value,$filter);
		$query['search'] = $value;
		$query['current_page'] = $index;

		echo json_encode($query);
	}
}
