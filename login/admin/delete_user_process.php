<?php
    include('../db.php');
    $sql="delete from user_table where id='".$_GET["id"]."'";
    $delete_process=$conn->query($sql);
    if($delete_process){
        ?>
        <script>
            alert("Successfully Deleted");
            window.location.href="view_all_users.php?success";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Not Deleted");
            window.location.href="view_all_users.php?failed";
        </script>
        <?php
    }
?>