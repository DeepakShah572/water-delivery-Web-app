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
<body>
    
<center>
<h2>Your Orders</h2>
<table id='order_table'>
<tr>
<th>Customer Name</th>
<th>Order no.</th>
<th>Order date</th>
<th>Order time</th>
<th>Amount</th>
<th>Product</th>
<th>Quantity</th>
<th>Delivered</th>
<th>Paid</th>
<th>Address</th>
</tr>
<?php
$sql="SELECT * from order_data order by  order_id desc";
$fetch=mysqli_query($conn,$sql);
while($records=mysqli_fetch_array($fetch))
{
    ?>
    <tr>
    <td><?php echo $records['customer_name'];?></td>
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
}?>

</table>
</center>
</body>
</html>