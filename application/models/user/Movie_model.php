<?php
declare(strict_types=1);
/**
 * Class MovieModel
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */
class Movie_model extends CI_Model
{
	/**
	 * @var string $table
	 */
	private string $table = 'movies';

	/**
	 * @var string $tableComment
	 */
	private string $tableComment = 'movie_reviews';

	/**
	 * @var string $tableEpisodes
	 */
	private string $tableEpisodes = 'episodes';

	/**
	 * @var string $tableEpisodes
	 */
	private string $tableCustomers = 'customers';

	/**
	 * MovieModel constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * get data a row of table movies by url
	 * @param string $url
	 * @return array|mixed|object|null
	 */
	public function getMovieDetail(string $url){
		$this->db->where('url',$url);
		return $this->db->get($this->table)->row();
	}

	/**
	 * get data a row of table movies by id
	 * @param int $id
	 * @return array|mixed|object|null
	 */
	public function getMovieDetailById(int $id){
		$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
	}



	/**
	 * get list data comment of movie where movieID and pagination
	 * @param int $id
	 * @param int $index
	 * @return array|array[]|object|object[]
	 */
	public function getMovieReviews(int $id,int $index){
		$limit = $index * 10;
		$this->db->select('r.id,c.name,r.comment,c.image,r.createAt');
		$this->db->from($this->tableComment.' r');
		$this->db->join($this->tableCustomers.' c','c.id = r.customerId','left');
		$this->db->where('movieId',$id);
		$this->db->order_by('r.id','DESC');
		$this->db->limit($limit);
		return $this->db->get()->result();
	}

	/**
	 * get a first row in table episodes by movie id
	 * @param int $id
	 * @return array|mixed|object|null
	 */
	public function getFirstEpisode(int $id){
		$this->db->where('movieId',$id);
		$this->db->order_by('createAt','ASC');
		$this->db->limit(1);
		return $this->db->get($this->tableEpisodes)->row();
	}

	/**
	 * insert a comment from user
	 * @return bool
	 */
	public function review(){
		$id = $this->input->post('id');
		$customerId = $this->input->post('customerId');
		$review = $this->input->post('review');

		$data = array(
			'movieId' => $id,
			'customerId' => $customerId,
			'comment' => $review,
		);

		$this->db->insert($this->tableComment,$data);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * @param int $id
	 * @return array|array[]|object|object[]
	 */
	public function getMovieRecommend(int $id){
		$this->db->where('id !=',$id);
		$this->db->order_by('rand()');
		return $this->db->get($this->table)->result();
	}
}
