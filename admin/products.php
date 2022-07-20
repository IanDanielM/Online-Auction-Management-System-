<?php
include('includes/header.php');
include('includes/navbar.php');
include('../dbh.inc.php');

?>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Products</b>
						
				
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Img</th>
									<th class="">Category</th>
									<th class="">Product</th>
									<th class="">Other Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php
                            $query="select * from products inner join  categories on  products.prod_category=categories.cat_id inner join users on products.user_id=users.user_id";
      $query_run=mysqli_query($conn,$query);
      $i=1;
if(mysqli_num_rows($query_run)>0){
    while($row=mysqli_fetch_assoc($query_run)){


        ?>
     
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <div class="row justify-content-center">
										 	<img src="<?php echo '../seller/products/'.$row['prod_img'] ?>" width="50px" alt="">
										 </div>
									</td>
									<td>
										 <p> <b><?php echo ucwords($row['cat_title']) ?></b></p>
									</td>
									<td class="">
										 <p>Name: <b><?php echo ucwords($row['prod_name']) ?></b></p>
									</td>
									<td>
									<p>product seller: <b><?php echo ucwords($row['f_name']) ?></b></p>
										 <p><small>Regular Price: <b><?php echo number_format($row['minimum_price'],2) ?></b></small></p>
										 <p><small>End Date/Time: <b><?php echo date("M d,Y h:i A",strtotime($row['session_date'])) ?></b></small></p>
										
    
									</td>
									<td class="text-center">
									<button class="btn btn-sm btn-outline-danger"><a href="proddel.php?rowp=<?php echo $row['prod_id'] ?>">delete</a></button>
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
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>