<?php
include "layout.php";
include "verifyer.php";

// for product data retrival
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

//-------------------------------------------------------
$product=$data['Product'];
$quantity=$_SESSION['quantity'];
$price=$data['Price'];
$sprice=$price*$quantity;
$dprice=$data['delivery_charges']*$quantity;
$fprice=$dprice+$sprice;
$address=$_SESSION['maddress'];
$to = $cdata['email_id'];
$_SESSION['cname']=$cdata['customer_name'];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov&display=swap" rel="stylesheet">
</head>
<body>
<?php echo "
<div id='start'>
<table id='checkout_table'>
<tr>
    <th>Product</th>
    <td>{$data['Product']}</td>
    </tr>
<tr>
<th>Quantity</th>
<td>$quantity</td>
    </tr>
<tr>
<th>Price</th>
<td>$sprice</td>
    </tr>
<tr>
<th>Delivery Charges</th>
<td>$dprice</td>
    </tr>
</table></div>
<h2>Total : Rs $fprice</h2>
<form method='POST'  name='checkout_form'>
<h2>Please Select Payment Method</h2>
<input type='radio' id='payment_mod' name=payment_mod value='cod'  checked='checked'>
<p id='radio_btn'>CASH ON DELIVERY</p><br>

<input type='radio' id='payment_mod' name=payment_mod  value='Debit/Credit/ATMCard' disabled>
<p id='radio_btn'>Debit/Credit Card</p><br>

<input type='radio' id='payment_mod' name='payment_mod' value='Net Banking' disabled >
<p id='radio_btn'>Net Banking</p><br>

<input type=submit name=confirm_order id='confirm_order' value='Confirm Order' class='btn-grad'>
</form>
</body>
</html>"
;
//-------------------------mails


function send_mail(){
    global $conn;
    global $cdata;
    global $fprice;
    global $uname;
    global $to;
    $sql="select order_id from order_data where phone_number='$uname' order by order_id desc Limit 1;";
    $retrival=mysqli_query($conn,$sql);
    if (! $retrival){
      die("problem fetching data:");
    }
    $orddata=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
    $subject = "{$cdata['customer_name']} Regarding your recent order from KaveriKirana";
    $body="Dear customer,Your order has been confirmed and it will be delivered to you
    before 8:00pm today your order id:'{$orddata['order_id']}' please keep amount: RS $fprice ready . orders after 8.00 pm will be delivered tommrrow ";
    $body.="Thank you for shopping";
    $headers="From:email@gmail.com";
    
    if(mail($to,$subject,$body,$headers)) {
       echo "Message sent successfully...";
    }else {
       echo "Message could not be sent...";
    }
}
function send_mailself(){
    global $conn;
    global $cdata;
    global $fprice;
    global $uname;
    $to="email@gmail.com";
    $sql="select order_id from order_data where phone_number='$uname' order by order_id desc Limit 1;";
    $retrival=mysqli_query($conn,$sql);
    if (! $retrival){
      die("problem fetching data:");
    }
    $orddata=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
    $subject = "{$cdata['customer_name']} Regarding your recent order from KaveriKirana";
    $body="Dear customer,Your order has been confirmed and it will be delivered to you
    before 8:00pm today your order id:'{$orddata['order_id']}' please keep amount: RS $fprice ready . orders after 8.00 pm will be delivered tommrrow ";
    $body.="Thank you for shopping";
    $headers="From: email@gmail.com";
    
    if(mail($to,$subject,$body,$headers)) {
       echo "Message sent successfully...";
    }else {
       echo "Message could not be sent...";
    }
}

//update order data----------------------------------------------------------
if(array_key_exists('confirm_order',$_POST)){
    $sql="INSERT INTO order_data (phone_number,order_date,order_time,address,amount,
    product,quantity,delivered,customer_name,paid) 
    VALUES ('$uname',CURDATE(),CURTIME(),'$address','$fprice','$product','$quantity',false,'{$cdata['customer_name']}',false)";
    $upload=mysqli_query($conn,$sql);
    if($to!=null){
        send_mail();
        send_mailself();}
        header('location:land.php');
}
$conn->close();
?>
<!--form------------------------------------------------------------------->

