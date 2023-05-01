<?php
declare(strict_types=1);

/**
 * Class MovieController
 * @property  movie_model $movie_model
 */
class Movie_detail_controller extends CI_Controller
{
	/**
	 * MovieController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("user/movie_model");
	}

	/**
	 * @param string $url
	 */
	public function index(string $url = ''){
		$query['data'] = $this->movie_model->getMovieDetail($url);
		$query['episode'] = $this->movie_model->getFirstEpisode(intval($query['data']->id));
		$query['recommend'] = $this->movie_model->getMovieRecommend(intval($query['data']->id));
		$query['comments'] = $this->movie_model->getMovieReviews(intval($query['data']->id),1);
		$config['title'] = $query['data']->name;

		$this->load->view("include/header",$config);
		$this->load->view("user/movie_detail",$query);
		$this->load->view("include/footer");
	}

	/**
	 * get list data review of movie
	 * @param int $id
	 * @param int $index
	 */
	public function data_review(int $id, int $index){
		$query['comments'] = $this->movie_model->getMovieReviews($id,$index);
		$this->load->view("user/template/movie_comment",$query);
	}

	/**
	 * user i
	 */
	public function review(){
		if ($this->movie_model->review()){
			echo 'Comment is success!';
		}else{
			echo 'Comment is error!';
		}
	}

}
