<?php
include 'layout.php';
include 'verifyer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov&display=swap" rel="stylesheet">
</head>
<body>
    <center>
        <div class="grid-container">
    <a href="adduser.php" ><button class="btn-grad grid-item" >Add User</button></a>
    <a href="deleteuser.php"><button class="btn-grad grid-item">Delete User</button></a>
    <a href="delivery.php"><button class="btn-grad grid-item">Delivery</button></a>
    <a href="view_orders.php"><button class="btn-grad grid-item">View Orders</button></a>
    <a href="update_stocks.php"><button class="btn-grad grid-item">Update stocks</button></a>
    <a href="viewusers.php"><button class="btn-grad grid-item">View Users</button></a></div>
    <form method=POST><input type="submit" name=logout id='logout' value="Logout" class="btn-grad"></form>
</center>
</body>
</html>
<?php
if(array_key_exists("logout",$_POST)){logout();}
function logout(){
    header('location:login.php');
session_destroy();
};
?>