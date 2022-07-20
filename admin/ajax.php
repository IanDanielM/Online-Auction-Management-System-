<?php
include ('../dbh.inc.php');
if(isset($_POST['delete_btn'])){
    $id=$_POST['delete_id'];
    $query="delete * from users where id=".$id;
    $query_run=mysqli_query($conn,$query);
    if($query_run){
    
      
      echo "<script>alert('user data deleted')</script>" ;
    }
    else{
        echo "<script>alert('user data not deleted')</script>";
     
    }
}
?>
