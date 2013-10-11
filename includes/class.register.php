<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.connection.php");

 class Register{
	private $db;
	private $aid;

	function __construct($aid){
		$this->aid		= $aid;
		$this->db		= new DB();
	}

	function device($name,$description){
		$sql = "INSERT INTO device (name,description,account_id,created) VALUES('$name','$description','$this->aid',NOW())";
		$this->db->db_raw($sql);
		header( 'Location: https://www.aatt.me/index.php?a=dev' );
	}

	function endpoint($name,$description,$type,$deviceId){
		switch($type){
			case 'collector':
				$collector = 1;
				$controller = 0;
				break;
			case 'controller':
				$collector = 0;
                $controller = 1;
                break;
		}
		$sql = "INSERT INTO endpoint (name,description,collector,controller,enabled,device_id,created) VALUES ('$name','$description','$collector','$controller',1,$deviceId,NOW())";
		$this->db->db_raw($sql);
		header( 'Location: https://www.aatt.me/index.php?a=ep' );
	}

	function attribute($name,$description,$endpoint,$state){
		$sql = "INSERT INTO attribute (name,description,endpoint_id,created) VALUES ('$name','$description','$endpoint',NOW())";
		$this->db->db_raw($sql);
		header( 'Location: https://www.aatt.me/index.php?a=att' );
	}

 }

?>
