<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include '../dbh.inc.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

function delete_user(){
    extract($_POST);
    $delete = $this->db->query("delete from users where id = ".$id);
    if($delete)
        return 1;
}



}
?>