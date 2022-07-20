<?php
ob_start();
$action = $_GET['action'];
include 'class.php';
$crud = new Action();
if($action == "get_latest_bid"){
	$save = $crud->get_latest_bid();
	if($save)
		echo $save;
}
if($action == "save_bid"){
	$save = $crud->save_bid();
	if($save)
		echo $save;
			
} 
ob_end_flush();
?>