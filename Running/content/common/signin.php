<?php
$actionpage = "signin_action.php";
$lr_actionpage = "../general/dashboard.php";

include'../../template/common/common_variable.php';
include'../../template/common/header.config.php';
ob_start();
session_start();
session_unset();
servervalidate();
?>
<script>
    function refreshpage() {
        location.reload();
    }
</script>
<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <title><?php echo validate(PRODUCTNAME); ?></title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="../../theme/img/favicon.png" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <!--
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;">
    -->
    <body>
        <!-- Automatic element centering using js -->
        <div class="center" style="margin-top:75px;">
            <?php
            if (isset($_REQUEST["msg"])) {
                if ($_REQUEST["msg"] == "Username or Password Mismatch") {
                    echo'<div class="lockscreen-name">Invalid Username or Password</div>';
                }
                if ($_REQUEST["msg"] == "Please login to access!") {
                    echo'<div class="lockscreen-name">' . $_REQUEST["msg"] . '</div>';
                }
                if ($_REQUEST["msg"] == "Password Changed Successfully!") {
                    echo'<div class="lockscreen-name">' . $_REQUEST["msg"] . '</div>';
                }
            }
            ?>


            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen credentials (contains the form) -->
                <div class="lockscreen-credentials">
                    <form role="form" name="form2" id="form2" method="post" action="<?php echo $lr_actionpage; ?>" enctype="multipart/form-data" autocomplete="off">
                        <div class="input-group">
                            <input type="text" name="lr_no" required  class="form-control" placeholder="LR Number / Order Number" style="margin-top:10px; margin-bottom:3px;width:200px;" >
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:3px;width:100px;"><i class="fa fa-fw fa-sign-in"></i>&nbsp;Track</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.lockscreen credentials -->
            </div><!-- /.lockscreen-item -->


            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <div class="businesssuite_logo" style="text-align:center; margin:0px 0px 0px 0px; margin-top:10px;">
                    <a href="#"><img src="../../theme/img/srbusiness_suite_logo.png" style="height:50px;"/></a>
                </div>
                <div style="clear:both;"></div>
                <!-- lockscreen credentials (contains the form) -->
                <div class="lockscreen-credentials">
                    <form role="form" name="form" id="form1" method="post" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="off">
                        <div class="input-group">
                            <input type="text" name="username" required class="form-control" placeholder="Username" style="margin-top:10px; margin-bottom:10px;" autofocus />
                            <input type="password" required style="margin-bottom:10px;" name="password" class="form-control border-color" placeholder="Password" />
                            <select class="form-control dropdown_padding" style="border:0px;margin-bottom:10px;" name="branch_code">
                                <option>Select</option>
                                <?php
                                $Query = "select distinct(branch_code) from sr_company order by branch_code";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    if ($id_error == false && $zonal_code == $DB->Record["branch_code"]) {
                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                    } else {
                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <select class="form-control dropdown_padding" style="border:0px;" name="database_name">
                                <option value="A9CH4cItqiDPaYs9PWs5pyzacBR6iWow0ldyQN5KI9c=">2015-2016</option>
                            </select>
                        </div>
                        <div style="clear:both; height:10px;"></div>
                        <button type="submit" class="btn btn-primary" style="width:100%; height:35px;"><i class="fa fa-fw fa-sign-in"></i>&nbsp;Sign in</button>
                        <div style="clear:both; height:2px;"></div>
                    </form>
                </div><!-- /.lockscreen credentials -->
            </div><!-- /.lockscreen-item -->

            <div class="headline text-center" id="time">
                <!-- Time auto generated by js -->
            </div><!-- /.headline -->

        </div><!-- /.center -->

        <!-- jQuery 2.0.2 -->
        <script language="JavaScript" src="../../theme/js/jquery202.min.js" type="text/JavaScript"></script>
        <!-- Bootstrap -->
        <script src="../../theme/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
    $(function() {
        startTime();
        $(".center").center();
        $(window).resize(function() {
            $(".center").center();
        });
    });

    /*  */
    function startTime()
    {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();

        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);

        //Check for PM and AM
        var day_or_night = (h > 11) ? "PM" : "AM";

        //Convert to 12 hours system
        if (h > 12)
            h -= 12;

        //Add time to the headline and update every 500 milliseconds
        $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
        setTimeout(function() {
            startTime()
        }, 500);
    }

    function checkTime(i)
    {
        if (i < 10)
        {
            i = "0" + i;
        }
        return i;
    }

    /* CENTER ELEMENTS IN THE SCREEN */
    jQuery.fn.center = function() {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                $(window).scrollTop()) - 30 + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                $(window).scrollLeft()) + "px");
        return this;
    }
        </script>
    </body>
</html>