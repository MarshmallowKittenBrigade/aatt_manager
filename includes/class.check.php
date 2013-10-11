<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.connection.php");

 class Check{
	private $status;
	private $device;
	private $item;
	private $trigger;
	private $action;
	private $db;

	function __construct($data){
		if(!$data['DEVICE'] || !$data['CHECKS']){
			return false;
		}
		$this->db			= new DB();
		$this->device		= $data['DEVICE'];
		$this->checks		= $data['CHECKS'];
	}

	function save(){
		foreach($this->checks as $endpoint => $attribute){
			$sql = "SELECT * FROM state WHERE atribute_id='".$attribute."'";
			$state[$endpoint][$attribute] = $this->db->db_query_result($sql);
		}
		$response['STATUS'] = 'SUCCESS';
		$response['RESPONSE'] = $state;
		return $state;
	}

 }

?>
