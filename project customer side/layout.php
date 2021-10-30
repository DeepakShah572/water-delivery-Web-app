<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body >
    <div id='navbar'>
    <a href="home.php">
    <img id='logo' src="assets/Kaveri Kirana-logos_blackmini.png" >
    </a>
   <a href="Account.php">
   <img id='account' src="assets/acc.png" >
   </a>
</div>
</body>
</html>
<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'location:login.php' );

    }
?>