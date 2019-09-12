<?php 

class Database {
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db = "pkl_satpolpp";
	public $conn;

	function __construct() {
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
	} 
}