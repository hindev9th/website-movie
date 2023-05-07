<?php
declare(strict_types=1);

/**
 * Class Category_model
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */
class Category_model extends CI_Model
{
	private string $tableMovies = 'movies';
	private string $tableEpisodes = 'episodes';

	public function __construct()
	{
		parent::__construct();
	}

	public function search(string $value)
	{
		$this->db->select("m.*,(SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) as reviewCount");
		$this->db->from('movies m');
		$this->db->join('movie_reviews rv', 'm.id = rv.movieId', 'left');
		$this->db->like('m.name', $value);

		$this->db->group_by('m.id');
		$this->db->limit(18);
		return $this->db->get($this->tableMovies)->result();
	}

	public function getMovies(string $genre)
	{
		$this->db->select("m.*,(SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) as reviewCount");
		$this->db->from('movies m');
		$this->db->join('movie_reviews rv', 'm.id = rv.movieId', 'left');
		$this->db->like('m.genre', $genre);
		$this->db->group_by('m.id');
		$this->db->limit(18);
		return $this->db->get($this->tableMovies)->result();
	}

	public function getCountAllRow()
	{
		return $this->db->count_all($this->tableMovies);
	}

	public function getCountRowfilter(string $value, string $filter){
		$filter = explode(',',$filter);

		$this->db->like('name', $value);
		foreach ($filter as $item) {
			$this->db->like('genre', $item);
		}

		return $this->db->count_all_results($this->tableMovies);
	}

	public function filterMovies(string $value, string $filter, string $order, int $index){
		$maxLimit = 18;
		$minLimit = $index > 1 ?  ($index - 1) * $maxLimit : 0;
		$filter = explode(',',$filter);

		$this->db->select("m.*,(SELECT COUNT(*) FROM movie_reviews rv WHERE rv.movieId = m.id) as reviewCount, ep.createAt as newEpTime");
		$this->db->from('movies m');
		$this->db->join('movie_reviews rv', 'm.id = rv.movieId', 'left');
		$this->db->join('(SELECT movieId, MAX(createAt) AS latest_createAt FROM episodes GROUP BY movieId) latest_ep', 'm.id = latest_ep.movieId', 'left');
		$this->db->join($this->tableEpisodes . ' ep', 'latest_ep.movieId = ep.movieId AND latest_ep.latest_createAt = ep.createAt', 'left');
		$this->db->like('m.name', $value);

		foreach ($filter as $item) {
			$this->db->like('m.genre', $item);
		}

		if (!empty($order)) {
			if ($order === 'movies') {
				$this->db->order_by('m.createAt', 'DESC');
			} elseif ($order === 'update') {
				$this->db->order_by('newEpTime', 'DESC');
			} else {
				$this->db->order_by('m.name', $order);
			}
		}
		$this->db->group_by('m.id');
		$this->db->limit($maxLimit,$minLimit);
		return $this->db->get()->result();
	}


}
