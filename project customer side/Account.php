<?php
include "verifyer.php";
include "layout.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov&display=swap" rel="stylesheet">
    <link href="css/table.css" rel='stylesheet'>
</head>
</head>
<body >
    <?php

// need to addd customer query
$sql="SELECT *FROM PRODUCTS where product='20 ltr bisleri water can'";
$retrival=mysqli_query($conn,$sql);
if (! $retrival){
    die("problem fetching data:");
}
$data=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
$uname=$_SESSION['uname'];
$password=$_SESSION['password'];
$sql="SELECT *FROM customers where phone_number='$uname' and password='$password'";
$retrival=mysqli_query($conn,$sql);
if (! $retrival){
    die("problem fetching data:");
}
$cdata=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
    $cname=$cdata['customer_name'];
    ?>
</body>
</html>
<form method="POST"  name="logout_form">
<input type="submit" value="Logout" name="logout" id="logout" class="btn-grad">
</form>
<?php
echo "
<center>
<h2>$cname</h2>
<h2>Your Orders</h2>
<table id='order_table'>
<tr>
<th>Order no.</th>
<th>Order date</th>
<th>Order time</th>
<th>Amount</th>
<th>Product</th>
<th>Quantity</th>
<th>Delivered</th>
<th>Paid</th>
<th>Address</th>
</tr>";
$uname=$_SESSION['uname'];
$sql="SELECT * from order_data where phone_number='$uname' order by order_id desc";
$fetch=mysqli_query($conn,$sql);
while($records=mysqli_fetch_array($fetch))
{
    ?>
    <tr>
    <td><?php echo $records['order_id'];?></td>
    <td><?php echo $records['order_date'];?></td>
    <td><?php echo $records['order_time'];?></td>
    <td><?php echo $records['amount'];?></td>
    <td><?php echo $records['product'];?></td>
    <td><?php echo $records['quantity'];?></td>
    <td><?php echo $records['delivered'];?></td>
    <td><?php echo $records['Paid'];?></td>
    <td><?php echo $records['address'];?></td>
</tr>

<?php
}
if(array_key_exists("logout",$_POST)){logout();}
function logout(){
session_destroy();
error_reporting(0);
header('location:home.php');

};

$conn->close();

?>
</table></center>