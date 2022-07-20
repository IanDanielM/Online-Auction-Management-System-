<?php
include '../dbh.inc.php';
$rowp=$_GET['rowp'];
$query="delete from products where prod_id ='$rowp'";
$data=mysqli_query($conn,$query);
if($data){
   
    echo "<script>window.open('products.php','_self')</script>";
}
else{
    
    echo "<script>window.open('products.php','_self')</script>";
}

?>