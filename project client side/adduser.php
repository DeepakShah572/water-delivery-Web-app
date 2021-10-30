<?php
include "layout.php";
include "verifyer.php";
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
<body >
    <form method=POST>
    <p>
        Customer name:
        <input type="text" name=customer_name id='customer_name' required="required"><br>
        Phone Number:
        <input type="number" name=phone_number id='phone_number' maxlength="10"  required="required"><br>
        email id:
        <input type="text" name="email_id" id='email_id' required="required"><br>
        Pincode:
        <input type="number" name="pincode" id='pincode' required="required"><br>
        Password:
        <input type="text" name="password" id='password' required="required"><br>
        <input type="submit" name=submit id="submit" class='btn-grad'>
    </p>
    </form>
</body>
</html>
<?php

if(array_key_exists('submit',$_POST)){
$phone_number=$_POST['phone_number'];
$cname=$_POST['customer_name'];
$email_id=$_POST['email_id'];
$pincode=$_POST['pincode'];
$password=$_POST['password'];
  global $conn;
$sql="INSERT INTO customers (phone_number,customer_name,password,pincode,email_id) values
    ('$phone_number','$cname','$password','$pincode','$email_id')";
$update= mysqli_query($conn,$sql);
if (! $update){
    echo "<h1 id='add_notify'>problem updating data:</h1>";
}
else {
    echo "<h1 id='add_notify'>User added successfully</h1>";
};
};

?>