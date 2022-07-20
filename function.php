<?php
function check_login($conn)
{

	if(isset($_SESSION['user_id']))
	{

		$id= $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";
		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: signin.php");
	die;

}
function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}

function getcats(){
	global $conn;
	$get_cats="select * from categories";
	$run_cats=mysqli_query($conn,$get_cats);
	while($row_cats=mysqli_fetch_array($run_cats)){
		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];

	}
}
function getsesh(){
	global $conn;

	
	$get_sesh="select * from session";
	$run_sesh=mysqli_query($conn,$get_sesh);
	while($row_sesh=mysqli_fetch_array($run_sesh)){
		$session_id=$row_sesh['session_id'];
		$session_date=$row_sesh['session_date'];
		$start_time=$row_sesh['start_time'];
		
		$end_time=$row_sesh['end_time'];
}
}