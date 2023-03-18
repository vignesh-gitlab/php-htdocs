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
    <title>View All Users</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../style.css">
    <script src='main.js'></script>
</head>
<body>
    <a href="../admin_home.php">Admin Home</a><br/><br/>
    <h3 align="right"><a href="../logout.php">Log Out <?php echo $_SESSION['name'];?></a>
    <?php
        include('../db.php');
        $sql="select * from user_table";
        $result=$conn->query($sql);
        if(($result->num_rows)>0){
            echo "<h2 align='center'>List of Users</h2>";
            echo "<table border='1' align='center' width='80%'>"; 
            #echo "<tr><td colspan='6' align='right'><a href='../register.php'>ADD Normal User</a></td></tr>";
            echo "<tr><th>ID</th><th>Name</th><th>User Name</th><th>Password</th><th>User Type</th><th>Action</th></tr>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["password"]."</td><td>".$row["user_type"]."</td>";
                ?>
                <td><a href='delete_user_process.php?id=<?php echo $row["id"];?>'>Delete</a></td></tr>
                <?php
            }
            echo "</table>";
        }
    ?>
</body>
</html>