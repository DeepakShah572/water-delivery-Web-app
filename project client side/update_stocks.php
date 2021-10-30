<?php
include "layout.php";
include "verifyer.php";
// data representation
$sql="SELECT *FROM PRODUCTS where product='20 ltr bisleri water can'";
$retrival=mysqli_query($conn,$sql);
if (! $retrival){
    die("problem fetching data:");
}
$data=mysqli_fetch_array($retrival,MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method=POST>
    <p>
        Product: <?php echo $data['Product']?><br>
        Price:<?php echo $data['Price']?><br>
        Quantity:<?php echo $data['Stock']?><br>
        Delivery charges:<?php echo $data['delivery_charges']?><br>
        Add More Quantity:
        <input type="number" name=quantity id=quantity><br>
        Price
        <input type="number" name="price" id=price ><br>
        Delivery Charges
        <input type="number" name="delivery_charges" id=delivery_charges><br>
        <input type="submit" name=submit id="submit" class='btn-grad'>
    </p>
    </form>
</body>
</html>
<?php

if(array_key_exists('submit',$_POST)){
    if(array_key_exists('price',$_POST)){
        if ($_POST['price']!=null){
            $price=$_POST['price'];
        }
        else{
            $price=$data['Price'];
        }
    }
    if(array_key_exists('delivery_charges',$_POST)){
        $delivery_charges=$_POST['delivery_charges'];
        if ($_POST['delivery_charges']!=null){
            $delivery_charges=$_POST['delivery_charges'];
        }
        else{
            $delivery_charges=$data['delivery_charges'];
        }
    }
    if(array_key_exists('quantity',$_POST)){
        $tstock=$_POST['quantity']+$data['Stock'];
    }
    else{
        $tstock=$data['Stock'];
    }
    $product=$data['Product'];
    $sql="UPDATE products set Stock='$tstock' ,Price='$price' ,delivery_charges='$delivery_charges' 
    where Product='$product'";
    $upload=mysqli_query($conn,$sql);
    if (! $upload){
        echo "<h1 id='add_notify'>problem updating data:</h1>";
    }
    else {
        echo "<h1 id='add_notify'>Data updated successfully</h1>";
    };
}
?>