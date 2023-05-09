<?php
declare(strict_types=1);
/**
 * Class Home_model
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */
class Home_model extends CI_Model
{
	/**
	 * @var string $tableMovies
	 */
	private string $tableMovies = 'movies';

	/**
	 * @var string $tableMoviesViewTime
	 */
	private string $tableMoviesViewTime = 'movie_view_time';

	/**
	 * @var string $tableMovieReviews
	 */
	private string $tableMovieReviews = 'movie_reviews';

	/**
	 * @var string $tableEpisodes
	 */
	private string $tableEpisodes = 'episodes';

	/**
	 * @var string $tableCustomers
	 */
	private string $tableCustomers = 'customers';

	/**
	 * @var string $tableGenre
	 */
	private string $tableGenre = 'genres';

	/**
	 * get all genres in db
	 * @return array|array[]|object|object[]
	 */
	public function getGenres(){
		return $this->db->get($this->tableGenre)->result();
	}

	/**
	 * get data top view by current date
	 * @return array|array[]|object|object[]
	 */
	public function getTopViewDate()
	{
		$this->db->select('m.id, m.url, m.name, (SELECT SUM(views) FROM movie_view_time WHERE date(date) = CURRENT_DATE() and movie_view_time.movieId = m.id) as views, m.episodes, m.totalEpisode, m.image, m.imageSidebar');
		$this->db->from($this->tableMoviesViewTime . ' vt');
		$this->db->join($this->tableMovies . ' m', 'm.id = vt.movieId');
		$this->db->where('date(date) = CURRENT_DATE()', NULL, FALSE);
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * get data top view by current week
	 * @return array|array[]|object|object[]
	 */
	public function getTopViewWeek()
	{
		$this->db->select('m.id, m.url, m.name, (SELECT SUM(views) FROM movie_view_time WHERE MONTH(`date`) = MONTH(CURRENT_DATE()) and movie_view_time.movieId = m.id) as views, m.episodes, m.totalEpisode, m.image, m.imageSidebar');
		$this->db->from($this->tableMoviesViewTime . ' vt');
		$this->db->join($this->tableMovies . ' m', 'm.id = vt.movieId', 'left');
		$this->db->where('YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1)', NULL, FALSE);
		$this->db->group_by('m.id');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * get data top view by current month
	 * @return array|array[]|object|object[]
	 */
	public function getTopViewMonth()
	{
		$this->db->select('m.id, m.url, m.name,  (SELECT SUM(views) FROM movie_view_time WHERE MONTH(`date`) = MONTH(CURRENT_DATE()) and movie_view_time.movieId = m.id) as views, m.episodes, m.totalEpisode, m.image, m.imageSidebar');
		$this->db->from($this->tableMoviesViewTime . ' vt');
		$this->db->join($this->tableMovies . ' m', 'm.id = vt.movieId', 'left');
		$this->db->where('MONTH(date) = MONTH(CURRENT_DATE())', NULL, FALSE);
		$this->db->group_by('m.id');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * get data top view by current years
	 * @return array|array[]|object|object[]
	 */
	public function getTopViewYears()
	{
		$this->db->select('m.id, m.url, m.name, (SELECT SUM(views) FROM movie_view_time WHERE MONTH(`date`) = MONTH(CURRENT_DATE()) and movie_view_time.movieId = m.id) as views, m.episodes, m.totalEpisode, m.image, m.imageSidebar');
		$this->db->from($this->tableMoviesViewTime . ' vt');
		$this->db->join($this->tableMovies . ' m', 'm.id = vt.movieId', 'left');
		$this->db->where('YEAR(date) = YEAR(CURRENT_DATE())', NULL, FALSE);
		$this->db->group_by('m.id');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * get data new comment of movie
	 * @return array|array[]|object|object[]
	 */
	public function getNewComments()
	{
		$this->db->select('rv.customerId,u.name,u.image,rv.movieId,m.url,m.name as nameMovie,m.isHighlights,rv.comment,rv.createAt');
		$this->db->from($this->tableMovieReviews . ' rv');
		$this->db->join($this->tableMovies . ' m', 'm.id = rv.movieId', 'left');
		$this->db->join($this->tableCustomers . ' u', 'u.id = rv.customerId', 'left');
		$this->db->order_by('rv.createAt', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	/**
	 * get data new movie
	 * @return array|array[]|object|object[]
	 */
	public function getNewMovies()
	{
		$this->db->select('m.id, m.url, m.name, m.genre, m.episodes, m.totalEpisode, ep.url AS epUrl, (SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) AS reviewCount, m.views, m.image, m.imageSidebar, ep.createAt');
		$this->db->from($this->tableMovies . ' m');
		$this->db->join('(SELECT movieId, MAX(createAt) AS latest_createAt FROM episodes GROUP BY movieId) latest_ep', 'm.id = latest_ep.movieId', 'left');
		$this->db->join($this->tableEpisodes . ' ep', 'latest_ep.movieId = ep.movieId AND latest_ep.latest_createAt = ep.createAt', 'left');
		$this->db->order_by('ep.createAt', 'DESC');
		$this->db->limit(6);

		return $this->db->get()->result();
	}

	/**
	 * get data highlights movie
	 * @return array|array[]|object|object[]
	 */
	public function getHighlightMovies()
	{
		$this->db->select('m.id, m.url, m.name, m.genre, m.episodes, m.totalEpisode, ep.url AS epUrl, (SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) AS reviewCount, m.views,m.image,m.imageSidebar,m.isHighlights, ep.createAt');
		$this->db->from('movies m');
		$this->db->join('episodes ep', 'm.id = ep.movieId', 'left');
		$this->db->where('m.isHighlights', 1);
		$this->db->order_by('ep.createAt', 'DESC');
		$this->db->limit(6);
		return $this->db->get()->result();
	}

	/**
	 * get data movie by genre live Action
	 * @return array|array[]|object|object[]
	 */
	public function getLiveAction()
	{
		$this->db->select('m.id, m.url, m.name, m.genre, m.episodes, m.totalEpisode, ep.url AS epUrl, 
    	(SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) AS reviewCount, 
   		 m.views,m.image,m.imageSidebar,m.isHighlights, ep.createAt');
		$this->db->from('movies m');
		$this->db->join('episodes ep', 'm.id = ep.movieId', 'left');
		$this->db->like('m.genre', 'Live Action');
		$this->db->order_by('ep.createAt', 'DESC');
		$this->db->limit(6);
		return $this->db->get()->result();
	}

	/**
	 * get data movie by genre movie
	 * @return array|array[]|object|object[]
	 */
	public function getMovies()
	{
		$this->db->select('m.id, m.url, m.name, m.genre, m.episodes, m.totalEpisode, ep.url AS epUrl, 
    	(SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) AS reviewCount, 
   		 m.views,m.image,m.imageSidebar,m.isHighlights, ep.createAt');
		$this->db->from('movies m');
		$this->db->join('episodes ep', 'm.id = ep.movieId', 'left');
		$this->db->like('m.genre', 'Movie');
		$this->db->order_by('ep.createAt', 'DESC');
		$this->db->limit(6);
		return $this->db->get()->result();
	}

	/**
	 * get data sidebar
	 * @return array|array[]|object|object[]
	 */
	public function getSidebar(){
		$this->db->where('isSidebar',1);
		return $this->db->get($this->tableMovies)->result();
	}

	/**
	 * handle find name movie
	 * @return array|array[]|object|object[]
	 */
	public function searchPopup(){
		$value = $this->input->get("search");
		$this->db->like('name',$value);
		$this->db->limit(10);
		return $this->db->get($this->tableMovies)->result();
	}
}
