<?php
session_start();
include('db.php');

if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
?>
<html>
<head>
<title>Login Page</title>
</head>
<body>
<form method="POST" action="login.php" autocomplete="off">
<?php 
    if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
    echo "<p>.$msg.</p>";
}
?>
UserName:<input type="text" name="user_name" value="" required><br><br>
Password:<input type="password" name="password" value="" required><br><br>
<input type="submit" name="submit" value="submit">
<input type="reset" name="reset" value="Reset">
<br><br>
<a href="Home.php">Home</a>
</form>
</body>
</html>
<?php 
if(isset($_POST["submit"])){
    $user_name=$_POST["user_name"];
    $password=$_POST["password"];
    $sql="SELECT * FROM `user_table` WHERE email='".$user_name."' and password='".$password."'";
    $result=$conn->query($sql);
    if($result->num_rows==1){
        $_SESSION['name']=$user_name;
        $row=$result->fetch_assoc();
        $user_type=$row["user_type"];
        if($user_type=="admin"){
        header("location:admin_home.php?msg=success");
        }
        else{
            echo"<p>Invalid User</p>";
        }
    }else{
        echo"<p>Enter valid Login details</p>";
    }
}
?>