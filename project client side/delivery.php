<?php
include 'layout.php';
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
<th>Confirmation</th>
</tr>
<?php
$sql="SELECT * from order_data order by  order_id desc";
$fetch=mysqli_query($conn,$sql);
while($records=mysqli_fetch_array($fetch))
{
    $order_id=$records['order_id'];
    $delivered=$records['delivered'];
    $paid=$records['Paid'];
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
    <?php
    if($records["delivered"]==1 and $records['Paid']==1){
        echo "<td id='cofirmed'><center>Confirmed</center></td>";
    }
    else if ($records["delivered"]==0 or $records['Paid']==0){
        echo "<td><form method=POST><input type='submit' value='Confirm' id='$order_id' name=$order_id class='btn-grad' ></form></td>";}
    if (array_key_exists($order_id,$_POST)){
        $sql="update order_data set delivered=true,Paid=true where order_id='$order_id'";
        $retrival=mysqli_query($conn,$sql);
            send_mail();
    }
    ?>
</tr>
<?php
}

function send_mail(){
    global $conn;
    global $records;
    $customer=$records['phone_number'];
    $sql="select * from customers where phone_number='$customer' ";
    $fetch=mysqli_query($conn,$sql);
    $retrival=mysqli_fetch_array($fetch);
    if (! $retrival){
      die("problem fetching data:");
    }
    $to=$retrival["email_id"];
    $subject = "{$records['customer_name']} Regarding your recent order Delivery from KaveriKirana";
    $body="Dear customer,Your order has been Delivered order id:'{$records['order_id']}'";
    $body.="Thank you for shopping";
    $headers="From: clashofshah007@gmail.com";
    mail($to,$subject,$body,$headers);
}
?>
</body>
</html>