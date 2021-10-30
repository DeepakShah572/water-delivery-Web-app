<?php
include "layout.php";
include "verifyer.php";
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
    <link href="https://fonts.googleapis.com/css2?family=Volkhov&display=swap" rel="stylesheet">
</head>
<body>
    <img id='product_image' src="assets/20ltr can.jpg">
    <?php
    echo
    "<h1>{$data['Product']}</h1>
    <h2>Available Quantity:{$data['Stock']}</h2>
    <div id='price_div'>MRP per can: <p id='price'>{$data['Price']}.00</p></div>";
    $data2=$data
    ?>
 <form method=POST>
     <div>
 <p id='lpincode'>Pincode:
    <input type="text" name=pincode id='pincode'>
    
    <input type=submit id=check name=check  value="check" class='btn-grad'/></p></div><br>
    

   
    <?php
    if(array_key_exists('pincode',$_POST)){
        check();
    }
    function check(){
        $pincode=$_POST["pincode"];
        if($pincode!=400612){
            echo "<h3>currently service available at 400612 only</h3>";
        }
        elseif($pincode==400612){
            echo "<h3>Product Available</h3>";
        }
    }?>
    <input type=submit value='add to cart' name=addtocart id=addtocart disabled>
    <input type=submit value='Buy now' name=buynow id='buynow' class='btn-grad' > </form>
    <?php
    if (array_key_exists("addtocart",$_POST)){addtocart();}
        function addtocart(){
        global $data;
        $cart_items=[];
        array_push($cart_items,$data);
        echo "item added to cart";
    }
    if(array_key_exists("buynow",$_POST)){buynow();}
        function buynow(){
            header("location:buynow.php");
        }
        $conn->close();
    ?>
</body>
</html>