<?php
include 'config.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Sign up</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Volkhov&display=swap" rel="stylesheet">
</head>

<body>
<img src="assets/Kaveri Kirana-logos.jpeg" class="animated fadeIn" id='logo'>
<div>
    <form action method="POST" autocomplete="off">
        <p>Username
        <input type="text" name="username" id="username" placeholder="your ph-no "/><br><br>
        Password:
        <input type="password" name="password"/><br><br>
        <input type="submit" value="Login" name="login"/>
        <?php
        if($_POST){
            $uname=$_POST["username"];// edit this part of code add your own users credentials
            $pass=$_POST["password"];// so that while entering credentials not any common user will be able to login in or create a new table for admin in data base and connect this page with that table to gain access.
            $sql="SELECT * FROM customers WHERE  password='$pass' AND  phone_number='$uname'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1){
                session_start();
                $_SESSION['uname']=$uname;
                $_SESSION['password']=$pass;
                header("location:home.php");
        
            }
            else{
                echo"<h3 id='Incorrect'>Incorret credentials</h3>";
            }
        }
        $conn->close();
        ?></p>
    </form>
</div>
</body>

</html>
