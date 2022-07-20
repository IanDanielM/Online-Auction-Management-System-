<?php
include('includes/header.php');
include('includes/navbar.php');
include('../dbh.inc.php');
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $cat_id=$_POST['cat_id'];
    $cat_title=$_POST['cat_title'];
    $query="insert into categories (cat_id,cat_title) values ('$cat_id','$cat_title')";
    mysqli_query($conn,$query);
}
?>
<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-category" method="post">
				<div class="card">
					<div class="card-header">
						    Category Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="cat_id">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="cat_title">
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
							
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
            <table style="color: black;" class="table table-bordered" id="data-table" width="100%" cell-spacing="0">
  <thead>
    <tr>
      <th scope="col">category_id</th>
      <th scope="col">name</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $query="select * from categories";
      $query_run=mysqli_query($conn,$query);
      $i=1;
if(mysqli_num_rows($query_run)>0){
    while($row=mysqli_fetch_assoc($query_run)){
     
        ?>
     
    <tr>
     <td> <?php echo $i++ ?></td>
      <td><?php echo $row['cat_title']; ?></td>
      <td>
        <button class="btn btn-danger"><a href="delcat.php?rowz=<?php echo $row['cat_id'] ?>">delete</a></button>
      </td>
    </tr>
    <?php
    }
}

?>

  </tbody>
</table>

        </div>
</div>