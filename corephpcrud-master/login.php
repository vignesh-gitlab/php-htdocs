<?php
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <form method="POST" action="login.php" autocomplete="off">
    <h2>Login</h2><br/>
    <label>User Name</label>
    <input type="text" name="username" value=""><br/><br/>
    <label>Password</label>
    <input type="password" name="password" value=""<br/><br/>
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
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
       header("location: user_home.php");
    }else{
        echo"Invalid User Details";
    }
}
?>
