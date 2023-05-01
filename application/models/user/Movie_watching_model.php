<?php
declare(strict_types=1);

/**
 * Class Movie_watching_model
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */
class Movie_watching_model extends CI_Model
{
	/**
	 * table movies in sql
	 * @var string $tableMovies
	 */
	private string $tableMovies = 'movies';

	/**
	 * table episodes in sql
	 * @var string $tableEpisodes
	 */
	private string $tableEpisodes = 'episodes';
	private string $tableMovieViewTime = 'movie_view_time';
	private string $tableMovieLikes = 'movie_likes';

	/**
	 * Movie_watching_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get all data Episodes by movie id
	 * @param int $movieId
	 * @return array|array[]|object|object[]
	 */
	public function getDataEpisodes(int $movieId){
		$this->db->where('movieId',$movieId);
		$this->db->order_by('id','ASC');
		return $this->db->get($this->tableEpisodes)->result();
	}

	/**
	 * Get a Episode by movie url and episode url
	 * @param string $movieUrl
	 * @param string $url
	 * @return array|mixed|object|null
	 */
	public function getEpisode(string $movieUrl,string $url){
		$this->db->select('e.id,e.movieId,e.url,e.movieUrl,e.name,m.name as movieName,m.like,m.dislike,e.poster,e.video,e.type,e.createAt,e.updateAt');
		$this->db->from($this->tableEpisodes.' e');
		$this->db->join($this->tableMovies.' m','m.id = e.movieId','LEFT');
		$this->db->where('e.url',$url);
		$this->db->where('e.movieUrl',$movieUrl);
		return $this->db->get()->row();
	}

	/**
	 * update view of movie
	 * @param int $movieId
	 * @param int $epId
	 */
	public function updateViewMovie(int $movieId, int $epId){
		$data = array(
			'movieId' => $movieId,
			'views' => 1
		);

		$this->db->from($this->tableMovieViewTime);
		$this->db->where('movieId', $movieId);
		$this->db->where('date', date('Y-m-d'));
		$count = $this->db->count_all_results();
		echo $count;
		if ($count > 0) {
			$this->db->set('views', 'views+1',FALSE);
			$this->db->where('movieId', $movieId);
			$this->db->where('date', date('Y-m-d'));
			$this->db->update($this->tableMovieViewTime);
		} else {
			$this->db->insert($this->tableMovieViewTime, $data);
		}


		$this->db->set('views', 'views+1',FALSE);
		$this->db->where('id', $epId);
		$this->db->where('movieId', $movieId);
		$this->db->update($this->tableEpisodes);
	}

	/**
	 * update like and dislike of movie
	 * @param int $customerId
	 * @param int $movieId
	 * @param int $status
	 */
	public function likeAndDislike(int $customerId, int $movieId, int $status){
		$data = array(
			'customerId' => $customerId,
			'movieId' => $movieId,
			'status' => $status
		);

		$this->db->from($this->tableMovieLikes);
		$this->db->where('customerId', $customerId);
		$this->db->where('movieId', $movieId);
		$count = $this->db->count_all_results();
		if ($count > 0) {
			$this->db->from($this->tableMovieLikes);
			$this->db->where('customerId', $customerId);
			$this->db->where('movieId', $movieId);
			$this->db->where('status', $status);
			$countDl = $this->db->count_all_results();
			if ($countDl > 0){
				$this->db->where('customerId', $customerId);
				$this->db->where('movieId', $movieId);
				$this->db->delete($this->tableMovieLikes);
			}else{
				$this->db->set('status', $status,FALSE);
				$this->db->where('movieId', $movieId);
				$this->db->where('customerId', $customerId);
				$this->db->update($this->tableMovieLikes);
			}
		} else {
			$this->db->insert($this->tableMovieLikes, $data);
		}

	}

	/**
	 * get status like of movie
	 * @param int $customerId
	 * @param int $movieId
	 * @return array|mixed|object|null
	 */
	public function getStatusLike(int $customerId,int $movieId){
		$this->db->where('customerId',$customerId);
		$this->db->where('movieId', $movieId);
		$this->db->limit(1);
		return $this->db->get($this->tableMovieLikes)->row();
	}
}
