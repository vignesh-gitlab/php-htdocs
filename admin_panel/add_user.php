<?php
    session_start();
    if(!$_SESSION["name"]){
        header("location:Home.php?msg=please log in to continue");
    }
?>
<html>
<head>
<title>Add User</title>
</head>
<body>
<form method="POST" action="add_user.php" autocomplete="off">
<table>
<tr>
<td>Name:</td>
<td><input type="text" name="name" value=""></td>
</tr>
<tr>
<td>DOB</td>
<td><input type="date" name="dob" value=""></td>
</tr>
<tr>
<td>Qualification</td>
<td><input type="text" name="qualification" value=""></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" name="address" value=""></td>
</tr>
<tr>
<td>User Name</td>
<td><input type="text" name="user_name" value=""></td>
</tr>
<tr>
<td>Password</td>
<td><input type="text" name="password" value=""></td>
</tr>
<tr>
<td>User Type</td>
<td><input type="text" name="user_type" value=""></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="Submit"></td>
<td><input type="reset" name="reset" value="Reset"></td>
</tr>
</table>
<a href="admin_home.php">Admin Home</a>
</form>
</body>
</html>