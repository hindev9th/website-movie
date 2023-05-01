<?php
declare(strict_types=1);

/**
 * Class Movie_controller
 * @property Movie_watching_model $movie_watching_model
 * @property Movie_model $movie_model
 */
class Movie_controller extends CI_Controller
{
	/**
	 * Movie_controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/movie_watching_model');
		$this->load->model('user/movie_model');
	}

	/**
	 * @param string $movieUrl
	 * @param string $epUrl
	 */
	public function index(string $movieUrl, string $epUrl){

		$query['data'] = $this->movie_watching_model->getEpisode($movieUrl,$epUrl);
		$query['episodes'] = $this->movie_watching_model->getDataEpisodes(intval($query['data']->movieId));
		$query['comments'] = $this->movie_model->getMovieReviews(intval($query['data']->movieId),1);
		if ($this->session->has_userdata('customer')){
			$id = $this->session->userdata('customer')['id'];
			$query['like'] = $this->movie_watching_model->getStatusLike(intval($id),intval($query['data']->movieId));
		}
		$config['title'] = $query['data']->movieName;


		$this->load->view('include/header',$config);
		$this->load->view('user/movie',$query);
		$this->load->view('include/footer');
	}

	public function updateViewMovie(int $movieId, int $epId){
		$this->movie_watching_model->updateViewMovie($movieId,$epId);
	}

	public function updateLikeAndDislike(int $customerId, int $movieId, int $status){
		$this->movie_watching_model->likeAndDislike($customerId,$movieId,$status);
		$data = $this->movie_model->getMovieDetailById($movieId);
		echo json_encode($data);
	}
}
