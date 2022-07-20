<?php
 session_start();
 include('../dbh.inc.php');
 include('../function.php');
 $user_data= check_login($conn);
 if(isset($_POST['prod_submit'] )){
  $prod_name=$_POST['prod_name'];
  $minimum_price=$_POST['minimum_price'];
  $prod_category=$_POST['prod_category'];
  $session_date=$_POST['session_date'];
  $user_id=$_SESSION['user_id'];
  $prod_img=time(). '_'. $_FILES['prod_img']['name']; 
  $target='products/'.$prod_img;
  move_uploaded_file($_FILES['prod_img']['tmp_name'],$target);
  $insert_product="insert into products(prod_category,user_id,session_date,prod_name,minimum_price,prod_img) values ('$prod_category','$user_id','$session_date','$prod_name','$minimum_price','$prod_img')";
  $insert_pro=mysqli_query($conn,$insert_product);
  if($insert_pro){
  echo "<script>window.alert('product succesfully submitted')</script>";
  echo "<script>window.open('seller.php?insert_product','_self')</script>";
}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Auction Management</title>

    <link rel="stylesheet" href="../main.css">
  
    <link rel="stylesheet" href="../fontawesome-free-5.12.0-web/css/all.min.css">
   
</head>

<body>
   
<nav>
        <div class="nav-center">
          <!-- nav header -->
          <div class="nav-header">
            <img src="../images/images.jpeg.jfif" class="logo" alt="logo" />
            <button class="nav-toggle">
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <!-- links -->
          <ul class="links">
            <li>
              <a href="index.html"><i class="fas fa-home"></i>Home</a>
            </li>
            <li>
              <a href="contact.php"><i class="fas fa-phone"></i> contact us</a>
            </li>
              <li class="login" style="font-size: 1rem;  ">
              <a href="../signin.php"><i class="fas fa-sign-in"></i> Log out</a>
              </li> 
          </ul>
          <!-- social media -->
         <ul class="links"> 
         <li  style="font-size: 1rem; ">
          <a href="../logout.php"><i class="fas fa-sign-out"></i>Log out</a> 
          </li>
          </ul>
        </div>
      </nav>
      <div class="middle">
        <div class="profile">
          <div class="pg">
          <img src="../profiles/<?php echo $user_data['user_img'] ?>" alt="" height="150px" width="150px" >
          <p><strong>Welcome <?php echo $user_data['f_name'];?></strong></p>
          </div>
        </div>
        <div class="slider">
            <div class="slide time">
                
                <img src="../images/pexels-carboxaldehyde-3664547.jpg"   height="200px">
                
              </div>
            
                <div class="slide time">
                    
                    <img src="../images/pexels-karolina-grabowska-5624980.jpg"  height="200px" >
                   
                  </div>
               
                    <div class="slide time">
                       
                        <img src="../images/pexels-karolina-grabowska-5650037.jpg"  height="200px">
                       
                      </div>
                   
                        <div class="slide time">
                         
                            <img src="../images/pexels-tima-miroshnichenko-5662862.jpg"  height="200px">
                          
                          </div>
                          
                         
        </div>
      </div>
        <div style="background-color: var(--clr-primary-4);">
          <nav class="categories"  >
            <div class="nav-header">
                <h3>categories</h3>
                </div>
                <ul class="links">
                  <li>
                    <button  class="btn" style="color: var(--clr-red-dark);" onclick="openForm()"> sell product </button>
                  </li>
                </ul>
              
          </nav>
        </div>
      <div class="prodform" id="popupform">
        <h3>Product Details</h3>
        <form  method="POST" enctype="multipart/form-data"  class="form-container" id="formz">
            <div class="part1">
            
            <img margin-right: 10px; margin-top: 10px;" onclick="triggerClickz()" src="../images/image.jpg"  id="photoz">
            <input type="file" onchange="displayimagez(this)" name="prod_img" value="upload" id="prod_file" >
            </div>
        <div class="part2">
          <div class="row-tab">
            <div class="label-burger">
              <label for="">product Name:</label>
            </div>
          
            <div class="input-burger">
              <input type="text" name="prod_name" placeholder="enter product name" />
            </div>
                                
</div>

            <div class="row-tab">
              <div class="label-burger">
                <label for="">minimum price:</label>
              </div>
              <div class="input-burger">
                <input type="number"name="minimum_price" placeholder="enter minimum price" />
              </div>
              <div class="row-tab">
                <div class="label-select">
                  <label for="">product category:</label>
                </div>
                <div class="select-input">
                  <select style="width: 50%;" name="prod_category" id="mylist">
                    <option >select category</option>
                    <?php $get_cats="select * from categories";
                    $run_cats=mysqli_query($conn,$get_cats);
                    while($row_cats=mysqli_fetch_array($run_cats)){
                      $cat_id=$row_cats['cat_id'];
                      $cat_title=$row_cats['cat_title'];
                      echo "<option value='$cat_id'>$cat_title</option>";} ?>
                    
                  </select>
                  </div>
</div>
</div>
              
              <div class="row-tab">
              <div class="label-burger">
              <label for="">Enter Bid End time</label>
              </div>
              <div class="input-burger">
              <input type="datetime-local" name="session_date" id="">
            </div>
              </div>
           
            <button class="btn" name="prod_submit" type="submit">Submit Product</button>
            <button class="btn"  onclick="closeForm()">CANCEL</button>
       
          </div>
          </form>
        </div>
        <div class="proddisplay">
          <div class="productsbox">
            <?php
            $get_pro="select * from products where unix_timestamp(session_date) >= ".strtotime(date("Y-m-d H:i"))." and user_id={$_SESSION['user_id']}  order by RAND() LIMIT 0,6  ";
            $run_pro=mysqli_query($conn,$get_pro);
            while($row_pro=mysqli_fetch_array($run_pro)){
              $prod_id=$row_pro['prod_id'];
              $prod_category=$row_pro['prod_category'];
              $prod_name=$row_pro['prod_name'];
              $minimum_price=$row_pro['minimum_price'];
              $prod_img=$row_pro['prod_img'];
              $session_date=$row_pro['session_date'];
              echo 
              " <div class='single-product'>
              <h4 style='text-align:center;'>$prod_name</h4>
              <img id='promage' style='width:180px;' src='products/$prod_img' alt='' width='180px' height='120px'>
              <p id='sngpar' class='sng'> <Strong style='color:var(--clr-red-dark') font-size:1.5rem' > $session_date </strong></p>
              <p id='sngpar' style='font-size:1rem'><Strong> Starting Price: kshs $minimum_price </strong></p>
                   
               <a id='detalink' href=''>product details</a>
             
              <br>
             
            </div> ";
            
          }
            ?>
          </div>
        </div>
    </div>
   <style>
.proddisplay{
  max-width: var(--max-width);
  }
.productsbox{
    display: flex;
    align-items: center;
    margin-left: 30px;
  }
  .single-product{
    margin-top: 10px;
    background-color: var(--clr-primary-3);
    margin-left: 30px;
    padding: 10px;
    text-align: center;

  }
  #sngpar{
    margin-bottom:0;
    color:var(--clr-grey-1);
  }
  #detalink{
    margin-right: 20px;
    float: right;
    color: var( --clr-red-light);
  }
  .sng{
 
    font-size: larger;
    text-align: center;
    
  }
  #promage{
    margin-left: 10px;
  }

   </style>
    <script>
    function openForm() {
    document.getElementById('popupform').style.display = "block";
  }
  
  function closeForm() {
    document.getElementById('popupform').style.display = "none";
  }
  </script>
   <script src="../main.js"></script>
</body>
</html>