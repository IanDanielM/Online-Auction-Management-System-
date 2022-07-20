<?php
include('includes/header.php');
include('includes/navbar.php');
include('../dbh.inc.php');

?>


<div class="card-body">


<table style="color: black;" class="table table-bordered" id="data-table" width="100%" cell-spacing="0">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">username</th>
      <th scope="col">Email</th>
      <th scope="col">phone-no</th>
      <th scope="col">user_type</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $query="select * from users";
      $query_run=mysqli_query($conn,$query);
      $i=1;
if(mysqli_num_rows($query_run)>0){
    while($row=mysqli_fetch_assoc($query_run)){
     
        ?>
     
    <tr>
     <td> <?php echo $i++ ?></td>
   
      <td><?php echo $row['f_name']; ?> </td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phoneno']; ?></td>
      <td><?php echo $row['user_type']; ?></td>
      <td>
        <button class="btn btn-danger"><a href="delete.php?row=<?php echo $row['id'] ?>">delete</a></button>
      </td>
    </tr>
    <?php
    }
}

?>

  </tbody>
</table>
