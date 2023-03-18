<?php 
session_start();
if(isset($_SESSION['name']))
{
    echo "Hi".$_SESSION['name'];
}
?>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>
<h2 align="center">Admin Panel</h2>
<p id="error"></p>
<h3 align="right"><a href="login.php">Login</a></h3>
<a href="Home.php">Home</a>
<a href="Users.php">Users</a>

</body>
</html>