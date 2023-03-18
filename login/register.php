<?php
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php">Home</a>
    <form method="POST" action="register.php" autocomplete="off">
        <table>
            <tr><th><h2>Registration</h2></th></tr>
            <tr><td>Name:</td>
            <td><input type="text" name="name" value=""></td></tr>
            <tr><td>Email:</td>
            <td><input type="text" name="email" value=""></td></tr>
            <tr><td>Password:</td>
            <td><input type="password" name="password" value=""></td></tr>
            <tr><td>Confirm Password:</td>
            <td><input type="password" name="confirm_password" value=""></td></tr>
            <tr><td><input type="reset" name="register_reset" value="Reset"></td></td>
            <td><input type="submit" name="register_submit" value="Register"></tr>
        </table>
  </form>
</body>
</html>

<?php

    if(isset($_POST["register_submit"])){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $confirm_password=$_POST["confirm_password"];
        if($password==$confirm_password){
            $sql="insert into user_table(name,email,password) values('".$name."','".$email."','".$password."')";
            if($conn->query($sql)==TRUE){
                ?>
                <script>
                    alert("Record Added Successfully");
                    window.location.href="register.php?success";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Record Not Inserter");
                    window.location.href="register.php?failed";
                </script>
                <?php
            }
        }else{
            echo "Password Not Match";
        }
    }
?>