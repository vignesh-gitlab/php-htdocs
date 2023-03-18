<?php
session_start();
if(!isset($_SESSION['name'])){
    header("location:login.php?msg=Please Login to Continue");
}
?>
<html>
<head>
<title>Administrative Home</title>
<style>
    table,td,th{
        border:1px solid #115F05;
        text-align: center;
    }
    td,th{
        padding: 13px;
    }
    th.menu{
        padding: 5px;
        background-color: yellow;
    }
    table{
        border-collapse: collapse;
    }
</style>
</head>
<body>
<h3 align="right"><a href="logout.php">Log Out <?php echo $_SESSION['name'];?></a>
<h2><?php echo "Hi  ".$_SESSION['name'];?>
<table border="0">
    <tr>
        <th class="menu"><a href="add_user.php">Add User</a></th>
        <th class="menu"><a href="view_users.php">View Users</a></th>
    </tr>
</table>
</body>
</html>