 <?php
session_start();
include('function.php');
include('dbh.inc.php');

$user_data= check_login($conn);
?>
<script>
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Auction Management</title>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="./fontawesome-free-5.12.0-web/css/all.min.css"> 
</head>
<body>
      <nav>
        <div class="nav-center">
          <!-- nav header -->
          <div class="nav-header">
            <img src="./images/images.jpeg.jfif" class="logo" alt="logo" />
            <button class="nav-toggle">
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <!-- links -->
          <ul class="links">
            <li>
              <a href="index.php">Home<i class="fas fa-home"></i></a>
            </li>
           
            <li>
              <a href="contact.php" > contact us <i class="fas fa-phone"></i></a>
            </li> 
            <li class="login" style="font-size: 1rem;  ">
              <a href="projects.html"> Log in</a>
            </li>
          </ul>
          <!-- social media -->
         <ul class="links">
         <li  style="font-size: 1rem; ">
                 <a href="logout.php">Log Out</a> 
         </li>
          </ul>
        </div>
      </nav>
      <div class="middle">
        <div class="profile">
          <div class="pg">
            <img src="profiles/<?php echo $user_data['user_img'] ?>" alt="" height="150px" width="150px" >
            <p>Hello <?php echo $user_data['f_name'];?> </p>
          </div>
        </div>
        <div class="slider">
            <div class="slide time">
                   <img src="./images/My Post (1).png"   height="200px">  
              </div>
            <div class="slide time">
                   <img src="./images/My Post (2).png"  height="200px" >
            </div>
            <div class="slide time">
                   <img src="./images/My Post (3).png"  height="200px">
            </div>
            <div class="slide time">
                   <img src="./images/My Post (4).png"  height="200px">
            </div>    
        </div>
      </div>
 
        <div style="background-color: var(--clr-primary-4);">
          <nav class="categories"  ">
            <div class="nav-header">
                <h3><a href="index.php">categories</a> </h3>
                </div>
                <ul class="links" id='cat-list'>
                  <?php
                  $get_cats="select * from categories";
                  $run_cats=mysqli_query($conn,$get_cats);
                  while($row_cats=mysqli_fetch_array($run_cats)){
                    $cat_id=$row_cats['cat_id'];
                    $cat_title=$row_cats['cat_title'];
                echo "<li>
                <a href='index.php?cat=$cat_id'>$cat_title</a>
              </li>";
                  }
                  ?>
                </ul>
          </nav>
        </div>

        <div class="proddisplay">
          <div class="productsbox">
        <?php
        if(!isset($_GET['cat'])){
            $get_pro="select * from products where unix_timestamp(session_date) >= ".strtotime(date("Y-m-d H:i"))."  order by RAND() LIMIT 0,6  ";
            $run_pro=mysqli_query($conn,$get_pro);
            while($row_pro=mysqli_fetch_array($run_pro)){
              $prod_id=$row_pro['prod_id'];
              $prod_category=$row_pro['prod_category'];
              $prod_name=$row_pro['prod_name'];
              $minimum_price=$row_pro['minimum_price'];
              $prod_img=$row_pro['prod_img'];
              $session_date=$row_pro['session_date'];
              echo 
            "
              <div class='single-product'>
              <h4 style='text-align:center;'>$prod_name</h4>
              <img id='promage'  src='./seller/products/$prod_img' alt=''  height='120px'>
              <p id='sngpar'><Strong> kshs $minimum_price </strong></p>  
              <p id='sngpar'><Strong>$session_date</strong></p>
              <button type='button' style='font-size:10px; margin-top:0;' class='btn' id='view_prod' onclick='openFormz()';  data-href=''><a href='index.php?prod_id=$prod_id'>view</a> </button>
              
              </div>";
          }
        }
         ?> 
<?php
          if(isset($_GET['cat'])){
            $cat_id=$_GET['cat'];
            $get_cat_pro=" select * from products where prod_category='$cat_id' and unix_timestamp(session_date) >= ".strtotime(date("Y-m-d H:i"))."" ;
            $run_cat_pro=mysqli_query($conn,$get_cat_pro);
            $count_cats=mysqli_num_rows($run_cat_pro);
            if($count_cats==0){
              echo "<h2 style='padding: 20px;'>NO PRODUCTS FOUND IN THIS CATEGORY</h2>";
            }
            while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
              $prod_id=$row_cat_pro['prod_id'];
              $prod_category=$row_cat_pro['prod_category'];
              $prod_name=$row_cat_pro['prod_name'];
              $minimum_price=$row_cat_pro['minimum_price'];
              $prod_img=$row_cat_pro['prod_img'];
              $session_date=$row_cat_pro['session_date'];
              echo "
              <div class='single-product'>
              <h4 style='text-align:center;'>$prod_name</h4>
              <img id='promage'  src='./seller/products/$prod_img' alt=''  height='120px'>
              <p id='sngpar'><Strong>Kshs $minimum_price</strong></p>  
              <p id='sngpar'><Strong>$session_date</strong></p>  
              <button type='button' style='font-size:10px;' class='btn' id='view_prod' onclick='openFormz()';  data-href=''><a href='index.php?cat=$cat_id&prod_id=$prod_id'>view</a> </button>
              </div>";
            }
          }
          ?>
        </div>
        </div>
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
          $run_query_by_pro=mysqli_query($conn,"select * from products where prod_id='$prod_id' ");
          while($row_pro=mysqli_fetch_array($run_query_by_pro)){
              $prod_id=$row_pro['prod_id'];
              $prod_category=$row_cat_pro['cat_title'];
              $prod_name=$row_pro['prod_name'];
              $minimum_price=$row_pro['minimum_price'];
              $prod_img=$row_pro['prod_img'];
              $session_date=$row_pro['session_date'];
              $prod_seller=$row_user_pro['f_name'];
              echo   "<div class='viewdeta'>   
                <div class='pa1'>
                <img src='./seller/products/$prod_img' alt='' height='200px'>
                <h4>time left: <h3 id='demo'></h3></h4>
                </div>
                <div class='pa2'>
                <p style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'>Product Name:</span> $prod_name</p>
                <p style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'>Product Category:</span> $prod_category</p>
                <p style='color:var(--clr-grey-1); border-bottom:1px solid black;'> <span style='color:var(--clr-green-dark)'>Product Seller:</span> $prod_seller</p>
                <p  style='color:var(--clr-grey-1); border-bottom:1px solid black;'><span style='color:var(--clr-green-dark)'> Product Price:</span> $minimum_price</p>
                <p  style='color:var(--clr-grey-1); border-bottom:1px solid black;'><Strong><span style='color:var(--clr-green-dark)'>Highest Bid Price:</span> $minimum_price</strong></p>  
                <div class='time'>
                  <span>Auction session Info: </span>
                  <p>Session Date: <em>$session_date</em></p>
                  </div>
                  <a href='bidroom.php?prod_id=$prod_id' <button name = 'details' class='btn' type = 'submit' value =  $prod_id >Participate</button></a>
                  </div>
                  </div>
                  ";
                  }
                }
                ?>   
        <button style="text-align:center;  position:absolute; margin-top:10px; left:40%; border-color:var(--clr-red-dark);" class="btn" onclick="closeFormz()">Close</button>   
</div>

<!-- edit profile info -->
<div class="info" id="info">
<form action="" method="post">
<input type="text" name="fname">
<br>
<input type="text" name="lname">
<br>
<input type="password" name="password">
<br>
<input type="password" name="cpassword">
 </form>
</div>
<!-- participate -->
<?php

?>
<script>
      function openFormz() {
    document.getElementById('details').style.display = "block";
    
  }
  function closeFormz() {
    document.getElementById('details').style.display = "none";
  }
  function openFormzz() {
    document.getElementById('info').style.display = "block";
  
  }
  function closeFormzz() {
    document.getElementById('info').style.display = "none";
  }
  function openbid() {
    document.getElementById('manage-bid').style.display = "block";
  
  }
  function closebid() {
    document.getElementById('manage-bid').style.display = "none";
  }
</script>

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $session_date ?>").getTime();
// Update the count down every 1 second

var x = setInterval(function() {
// Get today's date and time
var now = new Date().getTime();
// Find the distance between now and the count down date
var distance = countDownDate - now;
// Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<script src="main.js"></script>
<style>
.viewdeta{
  display: grid;
  grid-template-columns: 200px,500px;
  grid-gap: 10px;
}
.bid{
margin-top: 5px;
  background: none;
 border-radius: 4px;
 border-color: var(--clr-red-dark);
}
#manage-bid{
  display: none;
}
</style>
</body>
</html>
