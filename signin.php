<?php

session_start();

include('dbh.inc.php');
include('function.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
	{
     
        $email = $_POST['email'];
        $password = $_POST['password'];
       

        if(!empty($email)&& !empty($password)){
            $query="select * from users where email='".$email."' AND password='".$password."'  ";
            $result=mysqli_query($conn,$query);
        
            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data=mysqli_fetch_assoc($result);
                    if($user_data["user_type"]=="bidder"){
                       
                        if($user_data['password']===$password){
                        $_SESSION['user_id']=$user_data['user_id'];
                        header("location: index.php");
                    }
                }
                    elseif($user_data["user_type"]=="seller"){
                        if($user_data['password']===$password){
                            $_SESSION['user_id']=$user_data['user_id'];
                            header("location:seller/seller.php");
                        }
                }else{
                    if($user_data['password']===$password){
                        $_SESSION['user_id']=$user_data['user_id'];
                        header("location:admin/index.php");
                }
            }
        } 

            
            
            
       
                
        }
         
           

		    
            
 
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
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="./fontawesome-free-5.12.0-web/css/all.min.css">
</head>
<body style="background-color: var( --clr-grey-8);">
    <div class="signin">
        <H3>login</H3>
        <p id="error"></p>
        <form  method="post">
            <div class="inputbox">

                <input type="email" name="email" placeholder="Enter E-mail address">
                
            </div>
            <div class="inputbox">
                <input type="password" name="password" placeholder="Enter Password">
            
            </div>
            <button  type="submit" value="signin" class="btn" style="color:var(--clr-grey-9)">Sign In</button>
            <div class="submit">
               <p style="color:var(--clr-grey-9)"> Dont have an account?<button type="submit" class="btn" style="margin-left: 10px; color:var(--clr-grey-9);" ><a style="color:var(--clr-grey-9);"  href="register.php">Register</a> </button></p>
            </div>
           
           
            
        </form>
    </div>

</body>
</html>