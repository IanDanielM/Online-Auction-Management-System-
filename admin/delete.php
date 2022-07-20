<?php
include '../dbh.inc.php';
$rowl=$_GET['row'];
$query="delete from users where id ='$rowl'";
$data=mysqli_query($conn,$query);
if($data){
    echo "<script>alert('user data deleted')</script>" ;
    
}else{
    echo "<script>alert('user data not deleted')</script>";}

   
?>