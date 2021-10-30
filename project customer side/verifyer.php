    <?php
    include 'config.php';
    session_start();
    $uname=$_SESSION['uname'];
    $pass=$_SESSION['password'];
    $sql="SELECT * FROM customers WHERE  password='$pass' AND  phone_number='$uname'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1){}
    else{
        header('location:login.php');
    }
    ?>