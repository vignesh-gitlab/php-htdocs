<?php
    include('../db.php');
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php?msg=Please Login to Continue");
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add Admin User</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../style.css">
    <script src='main.js'></script>
</head>
<body>
<a href="../admin_home.php">Admin Home</a>
<h3 align="right"><a href="../logout.php">Log Out <?php echo $_SESSION['name'];?></a>
    <form method="POST" action="add_admin_user.php">
        <table>
            <tr><th><h2>Register New Admin</h2></th></tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value="" required></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirm_password" value="" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="add_admin_submit" value="Submit"></td>
                <td><input type="reset" name="add_admin_reset" value="Reset"></td>
            </tr>
        </table>
    </form>
</body>
</html>


<?php
if(isset($_POST["add_admin_submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirm_password=$_POST["confirm_password"];
    if($password==$confirm_password){
        $sql="insert into user_table(name,email,password,user_type) values('".$name."','".$email."','".$password."','admin')";
        if($conn->query($sql)==TRUE){
            ?>
            <script>
                alert("Admin User Added Successfully");
                window.location.href='../admin_home.php?msg=success';
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Record Not Inserted");
                window.location.href='../admin_home.php?msg=failed';
            </script>
            <?php
        }
    }else{
        echo "Password Does Not Match, Enter Same Password";
    }
}



?>