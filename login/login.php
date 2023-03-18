<?php
    session_start();
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <a href="index.php">Home</a>
   <form method="POST" action="login.php" autocomplete="off">
   <table>
   <tr><th><h2>Login</h2></th></tr>
   <tr><td>User Name:</td>
   <td><input type="text" name="username" value=""></td></tr>
   <tr><td>Password:</td>
   <td><input type="password" name="password" value=""></td></tr>
   <tr><td><input type="submit" name="submit" value="Submit"></td>
   <td><input type="reset" name="reset" value="Reset"></td></tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $user_password=$_POST["password"];
    #$sql="select * from user_table where email='".$username."' and password='".$user_password."'";
    $sql="SELECT * FROM `user_table` WHERE email='".$username."' and password='".$user_password."'";
    $result=$conn->query($sql);
    if($result->num_rows==1){
        $_SESSION['name']=$username;
        $row=$result->fetch_assoc();
        if($row["user_type"]=="normal"){
            ?>
            <script>
            window.location.href="user_home.php?msg=success";
            </script>
            <?php
        }else if($row["user_type"]=="admin"){
            ?>
            <script>
            window.location.href="admin_home.php";
            </script>
            <?php
        }else{
            echo "Invalid user type";
        }
    }else{
        echo"Invalid User Details";
    }
}
?>