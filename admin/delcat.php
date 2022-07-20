<?php
include '../dbh.inc.php';
$rowz=$_GET['rowz'];
$query="delete from categories where cat_id ='$rowz'";
$data=mysqli_query($conn,$query);
if($data){
    echo "<script>alert('deleted')</script>" ;
}else{
    echo "<script>alert(' data not deleted')</script>";}

?>


<?php


?>