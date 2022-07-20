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
					<div id="tabz" class="card-header">
						<b>List of Bids</b>
					</div>
					<div class="card-body">
						<table id="customers" style="color: navy;" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">product_Name</th>
									<th class="">bidder</th>
									<th class="">Amount</th>
									<th class="">Status</th>
									<th class=""></th>
								</tr>
							</thead>
							<tbody>
								<?php 
							                       
                         $query="select * from bids inner join products on bids.product_id=products.prod_id inner join users on bids.user_id=users.user_id order by bid_amount desc ";
                             $query_run=mysqli_query($conn,$query);
                             $i=1;
                       if(mysqli_num_rows($query_run)>0){
                           while($row=mysqli_fetch_assoc($query_run)){
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo ucwords($row['prod_name']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo ucwords($row['f_name']) ?></b></p>
									</td>
									<td class="text-right">
										 <p> <b><?php echo number_format($row['bid_amount'],2) ?></b></p>
									</td>
									<td class="text-center">
										<?php if($row['status'] == 1): ?>
										<?php if(strtotime(date('Y-m-d H:i')) < strtotime($row['session_date'])): ?>
										<span class="badge badge-secondary">Bidding Stage</span>
										<?php else: ?>
										<?php if($row['user_id'] == $row['user_id']): ?>
										<span class="badge badge-success">Wins in Bidding</span>
										<?php else: ?>
										<span class="badge badge-secondary">Loose in Bidding</span>
										<?php endif; ?>
										<?php endif; ?>
										<?php elseif($row['status'] == 2): ?>
										<span class="badge badge-primary">Confirmed</span>
										<?php else: ?>
										<span class="badge badge-danger">Canceled</span>
										<?php endif; ?>
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
<script src="main.js"></script>