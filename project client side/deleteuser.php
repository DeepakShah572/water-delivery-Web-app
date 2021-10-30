<?php
include "layout.php";
include "verifyer.php"
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
<form method=POST >
    <p>
        Customer's phone number:
        <input type="number" name=phone_number id='phone_number' required="required"><br>
        email-id:   
        <input type="text" name=email_id id='email_id' required="required"><br>
        <input type="submit" name="submit" id='submit' class="btn-grad" >
    </p>
</form>
</body>
</html>
<?php
if(array_key_exists('submit',$_POST)){
    $email_id=$_POST['email_id'];
$phone_number=$_POST['phone_number'];
    $sql="DELETE FROM customers WHERE email_id='$email_id' AND phone_number='$phone_number' ";
$update= mysqli_query($conn,$sql);
if (! $update){
    die("problem deleting data:");
}
else if($update) {
    echo "<h1>User removed successfully</h1>";
};
}
?>