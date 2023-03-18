<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user"></i>
        <?php
        $Query = "SELECT display_name,user_img from sr_user where username='" . $_SESSION['username'] . "'";
        $DB->query($Query);

        while ($DB->Multicoloums()) {
            $Display_Name = $DB->Record["display_name"];
            $User_Image = $DB->Record["user_img"];
        }
        ?>
        <span><?php echo ucfirst($Display_Name) ?><i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <?php
            if ($User_Image != NULL) {
                ?>
                <img src="../../files/uploads/user_img/<?php echo $User_Image; ?>" class="img-circle" alt="User Image" />
                <?php
            } else {
                ?>
                <img src="../../theme/img/admin_photo.png" class="img-circle" alt="User Image" />
                <?php
            }
            ?>
            <p>
                <?php echo strtoupper($_SESSION['username']) ?>
                <small><?php echo $_SESSION['usertype'] . "<br>"; ?></small>
                <small>Member since <?php echo $_SESSION['registered_at'] ?></small>
            </p>
        </li>
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="change_password.php" class="btn btn-default btn-flat"><i class="fa  fa-refresh"></i>&nbsp;Change Password</a>
            </div>
            <div class="pull-right">
                <a href="../common/signin.php" class="btn btn-default btn-flat"><i class="fa  fa-sign-out"></i>&nbsp;Sign out</a>
            </div>
        </li>
    </ul>
</li>
</ul>
</div>
