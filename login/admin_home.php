<?php
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
    <title>Admin Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="style.css">
    <script src='main.js'></script>
</head>
<body>
    <h3 align="right"><a href="logout.php">Log Out <?php echo $_SESSION['name'];?></a>
    <h2 align="center">Welcome to Admin HomePage</h2>
    <ul>
        <li><a href="admin/add_admin_user.php">Add Admin User</a></li>
        <li><a href="admin/view_admin_users.php">View Admin Users</a></li>
        <li><a href="admin/view_all_users.php">View All Users</a></li>
    </ul>
</body>
</html>



