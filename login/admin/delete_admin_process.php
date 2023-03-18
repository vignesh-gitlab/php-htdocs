<?php
    include('../db.php');
    $sql="delete from user_table where id='".$_GET["id"]."'";
    $delete=$conn->query($sql);
    if($delete){
        ?>
        <script>
            alert("Successfully Deleted");
            window.location.href="view_admin_users.php?success";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("No Deleted");
            window.location.href="view_admin_users.php?failed";
        </script>
        <?php
    }
?>