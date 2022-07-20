<?php
session_start();
include('dbh.inc.php');
include('function.php');


if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_type = $_POST['user_type'];
		$f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword=$_POST['cpassword'];
        $phoneno=$_POST['phoneno'];
        $DOB=$_POST['DOB'];
        $check_mail=mysqli_query($conn,"select * from users where email='$email'");
        $email_count=mysqli_num_rows($check_mail);
        $user_img=time(). '_'. $_FILES['user_img']['name'];
         $target='profiles/' .$user_img;
         $row_register=mysqli_fetch_array($check_mail);
       
            if($email_count>0){
                echo " <script>alert('sorry,this email $email address already exist')</script>";
            }
            elseif($row_register['émail'] != $email && $password==$cpassword){
                $user_id=random_num(3);
                $query = "insert into users (user_id,user_img,user_type,f_name,l_name,email,password,cpassword,phoneno,DOB) values ('$user_id','$user_img','$user_type','$f_name','$l_name','$email','$password','$cpassword','$phoneno','$DOB')";
                move_uploaded_file($_FILES['user_img']['tmp_name'],$target );
                    
                mysqli_query($conn,$query);
                
                header("location:signin.php");
                die;
            }
            
         
        
     }
         else{
          
         }
         
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Auction Management</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="./fontawesome-free-5.12.0-web/css/all.min.css">
</head>
<body>
    <div class="logpage">
        <br>
        <div class="about">
            <h3>Online Auction Systems</h3>
        <hr>
         <i class="fas fa-check" style="padding-left:10px; ">About System</i>
        
        <p>This Online auction management system is a web-based application which helps users to bid or sell items to the highest bidder.Sellers can post any kind of product for auction to the system by submitting products. Bidders and sellers can register to the system and bidders can bid for any product that they find suitable. This system has been designed to be highly-scalable and capable of supporting large numbers of bidders in an active auction. Online Auctioning System has several other names such as e-Auctions, electronic auction etc. The requirement for online auction or online bidding can be more accurately specified by the client. It should be healthy and will be a good practice when it is made more transparent.</p>
        <button class="btn" style="margin-left: 150px;"><a href="contact.php">CONTACT US</a></button>
        <br>
        <i class="fas fa-check" style="padding-left:10px; ">System Developer</i>
        <BLOckquote><strong>IAN DANIEL MATHENGE</strong> </BLOckquote>
        <a href="">view portolio</a>
        </div>
        <div class="logform">
        <form method="POST" enctype="multipart/form-data">
        <h4>create an account</h4>
        <div class="profile-pic-div">
        <img style="margin-left: 10px;" onclick="triggerClick()" src="./images/image.jpg"  id="photo">
        <input type="file" onchange="displayimage(this)" name="user_img" value="upload" id="file" >
</div>
<select name="user_type" id="t-user" > 
    <option value="bidder">bidder</option>
    <option value="seller">seller</option>
</select>
    <div class="names">
        <input type="text" name="f_name" placeholder="first name" required>
        <input type="text" name="l_name" placeholder="last name" required>
    </div>
    <div class="mail">
        <input type="email" name="email" id="" placeholder="Email Address" required>
    </div>
    <div class="pass">
        <input type="password" name="password" id="password1" placeholder="password"  required>

        <span style="font-size:small; padding:0; margin:0;" id="StrengthDisp" class="badge displayBadge">Weak</span>
        <br>
        <input type="password" name="cpassword" id="password2" placeholder=" re-enter password"  required>
       
    </div>
    <div class="num">
        <input type="number" name="phoneno" id="" placeholder="phone Number">
    </div>
    <div class="YOB" style=" padding:10px;">
        <label for="" style="color: white;">Date Of Birth
        </label>
        <input type="date" id="birthday" name="DOB" style="color: white;"> 
    </div>
    <div class="submit">
        <button type="submit" name="save-user" value="signup" class="btn">Create a New Account</button>
    
</div>


        
            </form>
            <div class="sgnin" >
    <p style="color: var(--clr-red-dark);">Already have an account? <a href="signin.php"> <button class="btn" >sign in</button></a></p>
    
</div>
        </div>
    </div>
   
    <script src="main.js"></script>
    
     

     <script>
         let timeout;

// traversing the DOM and getting the input and span using their IDs

let password = document.getElementById('password1')
let strengthBadge = document.getElementById('StrengthDisp')

// The strong and weak password Regex pattern checker

let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})')
let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.{8,}))')

function StrengthChecker(PasswordParameter){
    // We then change the badge's color and text based on the password strength

    if(strongPassword.test(PasswordParameter)) {
        strengthBadge.style.backgroundColor = "green"
        strengthBadge.textContent = 'Strong'
    } else if(mediumPassword.test(PasswordParameter)){
        strengthBadge.style.backgroundColor = 'blue'
        strengthBadge.textContent = 'Medium'
    } else{
        strengthBadge.style.backgroundColor = 'red'
        strengthBadge.textContent = 'Weak'
    }
}

// Adding an input event listener when a user types to the  password input 

password.addEventListener("input", () => {

    //The badge is hidden by default, so we show it

    strengthBadge.style.display= 'block'
    clearTimeout(timeout);

    //We then call the StrengChecker function as a callback then pass the typed password to it

    timeout = setTimeout(() => StrengthChecker(password.value), 500);

    //Incase a user clears the text, the badge is hidden again

    if(password.value.length !== 0){
        strengthBadge.style.display != 'block'
    } else{
        strengthBadge.style.display = 'none'
    }
});
     </script>
    
</body>
</html>