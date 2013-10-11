<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.connection.php");

 class Endpoint{
	private $db;
	private $aid;

	function __construct($aid){
		$this->aid		= $aid;
		$this->db		= new DB();
	}

	function all(){
		$sql = "SELECT ep.id from endpoint ep join device d on (ep.device_id=d.id) where account_id='$this->aid'";
		return $this->db->db_query_results($sql);
	}

	function controllers(){
        $sql = "SELECT ep.id from endpoint ep join device d on (ep.device_id=d.id) where account_id='$this->aid' and controller=1";
        return $this->db->db_query_results($sql);
    }

 }

?>
