<?php
include('dbh.inc.php');
?>
<div class="proddetail" id="details">
<h3>Product Details</h3>
<?php
if(isset($_GET['prod_id'])){
  $prod_id=$_GET['prod_id'];
  $get_user="select * from users";
  $get_cat="select * from categories";
  $run_cat_pro=mysqli_query($conn,$get_cat);
  $row_cat_pro=mysqli_fetch_array($run_cat_pro);
  $run_user_pro=mysqli_query($conn,$get_user);
  $row_user_pro=mysqli_fetch_array($run_user_pro);
  $run_query_by_pro=mysqli_query($conn,"select * from products where prod_id='$prod_id'");
  while($row_pro=mysqli_fetch_array($run_query_by_pro)){
      $prod_id=$row_pro['prod_id'];
      $prod_category=$row_cat_pro['cat_title'];
      $prod_name=$row_pro['prod_name'];
      $minimum_price=$row_pro['minimum_price'];
      $prod_img=$row_pro['prod_img'];
      $session_date=$row_pro['session_date'];
      $prod_seller=$row_user_pro['f_name'];
      echo
    
"<div class='viewdeta'>   
<div class='pa1'>
<img src='./seller/products/$prod_img' alt='' height='200px'>
</div>
<div class='pa2'>
<p style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'>Product Name:</span> $prod_name</p>
<p style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'>Product Category:</span> $prod_category</p>
<p style='color:var(--clr-grey-1); border-bottom:1px solid black;'> <span style='color:var(--clr-green-dark)'>Product Seller:</span> $prod_seller</p>
<p style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'> Product Price:</span> $minimum_price</p>
  <div class='time'>
  <span>Auction session Info: </span>
  <p id='demo'></p>
  <p>Session Date: <em>$session_date</em>  </p>
  </div>
  <button class='btn'>Partcipate</button>
  </div>
  </div>
  ";
  }
}
?>      
</div>


        