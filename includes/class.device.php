<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.connection.php");

 class Device{
	private $db;
	private $aid;

	function __construct($aid){
		$this->aid		= $aid;
		$this->db		= new DB();
	}

	function all(){
		$sql = "SELECT id from device where account_id='$this->aid'";
		return $this->db->db_query_results($sql);
	}

 }

?>
