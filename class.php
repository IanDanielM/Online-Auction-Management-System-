<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'dbh.inc.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}
    function get_latest_bid(){
		extract($_POST);
		$get = $this->db->query("select * from bids where product_id = $prod_id order by bid_amount desc limit 1 ");
		$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
		return $bid;
	}
	function save_bid(){
		extract($_POST);
		$data = "";
		$chk = $this->db->query("select * from bids where product_id = $product_id order by bid_amount desc limit 1 ");
		$uid = $chk->num_rows > 0 ? $chk->fetch_array()['user_id'] : 0 ;
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
					$data .= ", user_id='{$_SESSION['user_id']}' ";

		if($uid == $_SESSION['user_id']){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("insert into bids set ".$data);
		}else{
			$save = $this->db->query("update bids set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
}
?>