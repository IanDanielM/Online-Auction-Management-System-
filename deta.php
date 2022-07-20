<?php
include('dbh.inc.php');
?>
 <div class="proddetail" id="details">
     <h3>Product Details</h3>
<?php
session_start();
if(isset($_GET['prod_id'])){
    $qry=$conn->query("select * from products where prod_id=".$_GET['prod_id']);
    foreach($qry->fetch_array() as $k => $val){
        $$k=$val;
    }
    $cat_qry=$conn->query("select * from categories where prod_id=$cat_id");
    $category=$cat_qry->num_rows>0?$cat_qry->fetch_array()['cat_title']:'';

}
?>
<div class="viewdeta">   
<div class="pa1">
<img src="./seller/products/<?php echo $prod_image ?>" alt=" height="200px">
</div>
<div class="pa2">
<p style="color:var(--clr-grey-1); border-bottom:1px solid black;"><span style="color:var(--clr-green-dark)">Product Name:</span><?php echo $prod_name ?> </p>
<p style="color:var(--clr-grey-1); border-bottom:1px solid black;"><span style="color:var(--clr-green-dark)">Product Category:</span><?php echo $category ?> $prod_category</p>
<p style="color:var(--clr-grey-1); border-bottom:1px solid black;"> <span style="color:var(--clr-green-dark)">Product Seller:</span> $prod_seller</p>
<p style="color:var(--clr-grey-1); border-bottom:1px solid black;"><span style="color:var(--clr-green-dark)"> Product Price:</span><?php echo number_format($minimum_price,2) ?>  </p>
  <div class="time">
  <span>Auction session Info: </span>
  <p id="demo"></p>
  <p>Session Date: <em><?php echo date("m d,Y h:i A",strtotime($session_date)) ?></em>  </p>
  </div>
  <button class="btn">Partcipate</button>
  </div>
  </div>
  "