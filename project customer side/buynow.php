<?php
include "layout.php";
include "verifyer.php";

$sql="SELECT *FROM PRODUCTS where product='20 ltr bisleri water can'";
$retrival=mysqli_query($conn,$sql);
if (! $retrival){
    die("problem fetching data:");
}
$uname=$_SESSION['uname'];
$data=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
$_SESSION['data']=$data;
$sql="SELECT Customer_address FROM customers WHERE phone_number='uname'";
$retrival=mysqli_query($conn,$sql);
if (! $retrival){
    die("problem fetching data:");
}
$maddress=mysqli_fetch_array($retrival,MYSQLI_ASSOC);
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
    <img id='product_image' src="assets/20ltr can.jpg" height="400px" >
    <?php
    echo
    "<form method=POST onsubmit='return validateForm()' name='buy_form'>
    <div>
    <h1>{$data['Product']}</h1>
    <p id='lpincode' for='quantity' >Select quantity :
    <input type=number id='quantity' name=quantity max=15 min=1></p></div>
    
    <div>
    <h3>Address:</h3>
    <textarea type='text' name='address' id='address' maxlength='200' ></textarea></div>
    <input type=submit name=proceed value='Proceed to checkout' id='proceed' class='btn-grad'>
    </form>"
    ;
    $quantity=$_POST['quantity']?? "default / fallback value";
    $_SESSION['quantity']=$quantity;
    if(array_key_exists("proceed",$_POST)){
            header("location:checkout.php");
        }
    ?>
    <script type="text/javascript">
document.getElementById('quantity').value = 1;

function validateForm() {
  var x = document.forms['buy_form']['address'].value;
  if (x == "") {
    alert("Address must be filled out");
    return false;
  }
}
</script>
<?php

$maddress=$_POST['address']?? "default / fallback value";
$sql="UPDATE customers SET Customer_address='$maddress' WHERE phone_number='$uname'";
if (mysqli_query($conn, $sql)) {
    echo " ";
  } else {
    echo " " . mysqli_error($conn);
  }
$_SESSION['maddress']=$maddress;
$conn->close();
?>
</body>
</html>