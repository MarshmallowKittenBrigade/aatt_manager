<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.system.php');

class User {

	private $account;
	private $account_key;
	private $db;
	private $aid;

	function __construct(){
		$this->db = new DB();
	}

	function login($account,$key){
    	$this->account_code = $account;
		$this->account_key = md5($key."phoolsalt");

		$query = 'select id from account where account_code="'.$this->account_code.'" AND account_key="'.$this->account_key.'"';
		$result = $this->db->db_query_result($query);
		if($result){
			$this->aid = $result;
			return $result;
        }else{
			return -1;
        }
	}

	function register($user,$pass,$email,$name){
		$password = md5($pass."phoolsalt");
		$sql = "INSERT INTO account(account_code,account_key,name,email,created)VALUES('$user','$password','$name','$email',NOW())";
		$result = $this->db->db_raw($sql);
		if($result>0){
			$this->aid = $this->login($user,$password);
			return true;
		}else{
			return false;
		}
	}

	function getId(){
		return $this->aid;
	}

	function logout(){
		session_destroy();
	}
}
?>
