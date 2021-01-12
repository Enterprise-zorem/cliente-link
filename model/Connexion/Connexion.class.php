<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "links");
class Connexion extends Mysqli
{
	private $host;
	private $user;
	private $pass;
	private $db;


	public function __construct()
	{
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->db = DB_NAME;

		parent::__construct($this->host, $this->user, $this->pass, $this->db);
	}

	public function setCharset()
	{
		$this->mysql_set_charset("utf8");
	}
}