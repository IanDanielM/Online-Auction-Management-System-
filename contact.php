<?php
session_start();
include('dbh.inc.php');
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];
    $query="insert into contact (name,email,text) values ('$name','$email','$text')";
    mysqli_query($conn,$query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="main.css">
</head>
<body style="background-color: var(--clr-primary-5);">
    <section class="contact">
        <div class="content">
            <h2 style="color: var(--clr-green-dark);">Contact Us</h2>
            <h3>Incase of any issue or problem</h3>
        </div>
        <div class="container">
           
            </div>
            <div class="contactForm">
                <form method="POST">
                    <h2>Send Message</h2>
                    <div class="inputBox">
                        <input type="text" name="name" required="required">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="email" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea name="text" id="" required="required"></textarea>
                        <span>Type your Message...</span>
                    </div>
                    <br>
                    <button class="btn" type="submit">SUBMIT</button>
                   
                </form>
            </div>
        </div>
    </section>
</body>
</html>