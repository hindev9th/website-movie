<?php
declare(strict_types=1);
/**
 * Class Account_model
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */
class Account_model extends CI_Model
{
	/**
	 * table customer in database
	 * @var string $table
	 */
	private string $table = 'customers';
	private string $tableFollow = 'customer_follow';
	private string $tableHistory = 'customer_history';
	private string $tableMovies = 'movies';

	/**
	 * Account_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * get info user
	 * @param int $id
	 * @return array|mixed|object|null
	 */
	public function account(int $id){
		$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
	}

	/**
	 * login user
	 * @return array|mixed|object|null
	 */
	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		return $this->db->get($this->table)->row();
	}

	/**
	 * register new user
	 * @return array|mixed|object|null
	 */
	public function register()
	{
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$password = $this->input->post('password');

		$data = array(
			'email' => $email,
			'name' => $name,
			'password' => md5($password),
		);

		if (!$this->exist($email)) {
			$this->db->insert($this->table, $data);
			if ($this->db->affected_rows() > 0) {
				$insertId = $this->db->insert_id();
				return $this->db->get_where($this->table, array('id' => $insertId))->row();
			}
		}
		return null;
	}

	/**
	 * check user exist
	 * @param string $email
	 * @return bool
	 */
	public function exist(string $email)
	{
		$this->db->where('email', $email);
		return $this->db->get($this->table)->row() != null;
	}

	/**
	 * get data follow
	 * @param int $customerId
	 * @return array|array[]|object|object[]
	 */
	public function getFollow(int $customerId){
		$this->db->select('fl.id,mv.url,mv.name,mv.views,mv.image');
		$this->db->from($this->tableFollow.' as fl');
		$this->db->join($this->tableMovies.' as mv','mv.id = fl.movieId','left');
		$this->db->where('fl.customerId',$customerId);
		return $this->db->get()->result();
	}

	/**
	 * add a movie follow for user
	 * @return string
	 */
	public function addFollow(){
		$customerId = intval($this->input->get('customerId'));
		$movieId = intval($this->input->get('movieId'));
		if ($customerId != null && $movieId != null){
			$data = array(
				'customerId' => $customerId,
				'movieId' => $movieId,
			);
			if (!$this->existFollow($customerId,$movieId)){
				$this->db->insert($this->tableFollow,$data);
				if($this->db->affected_rows() > 0){
					return 'Follow is success';
				}else{
					return 'Follow is fault';
				}
			}else{
				return 'Follow is success';
			}
		}

		return 'Follow is fault';
	}

	public function existFollow(int $customerId,int $movieId)
	{
		$this->db->where('customerId', $customerId);
		$this->db->where('movieId', $movieId);
		return $this->db->get($this->tableFollow)->result() != null;
	}

}
