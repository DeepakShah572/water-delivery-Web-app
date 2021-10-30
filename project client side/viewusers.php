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
    <link href="css/table.css" rel='stylesheet'>
</head>
</head>
<body>
<center>
<h2>Your Customers</h2>
<table id="order_table">
<tr>
<th>Customer Name</th>
<th>Phone Number</th>
<th>Address</th>
<th>Pincode</th>
<th>email id</th>
</tr>
<?php
$sql="SELECT * from customers";
$fetch=mysqli_query($conn,$sql);
while($records=mysqli_fetch_array($fetch))
{
    ?>
    <tr>
    <td><?php echo $records['customer_name'];?></td>
    <td><?php echo $records['phone_number'];?></td>
    <td><?php echo $records['Customer_Address'];?></td>
    <td><?php echo $records['pincode'];?></td>
    <td><?php echo $records['email_id'];?></td>
</tr>
<?php
}?>

</table>
</center>
</body>
</html>