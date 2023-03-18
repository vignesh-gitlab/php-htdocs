<?php
$actionpage = "signin_action.php";
ob_start();
session_start();
session_unset();
include'../../template/common/common_variable.php';
include'../../template/common/header.config.php';
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
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;">
        <!-- Automatic element centering using js -->
        <div class="center"> 
            <div class="businesssuite_logo" style="text-align:center; margin:150px 0px 20px 0px;">
                <a href="#"><img src="../../theme/img/srbusiness_suite_logo.png"/></a>
            </div>           
            <!-- START LOCK SCREEN ITEM -->
            <div style="width:520px; margin:auto;">
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <center>
                        <b style="font-size:16px">Your Registration has Expired</b><br><br>
                        <span style="line-height:20px; color:#000000;">
                            Your <b><?php echo validate(ACTIVATIONMODE) ?></b> registration has expired on <b><?php echo validate(ACTIVATIONEND) ?></b>. Due to that reason your account has blocked temporarily.
                            Activate your account by purchasing <b>PREMIUM ACTIVATION KEY</b> to get uninterrupted lifetime access. Additionally get 3 Months free AMC Contract with Premium Membership.Contact your system administrator for further progress.<br><br>
                            To contact <a href="<?php echo validate(COMPANYURL) ?>" target="_blank"><b><?php echo validate(COMPANYNAME) ?></b></a> please <a href="mailto:<?php echo validate(COMPANYMAIL) ?>?Subject=Premium Account Activation Request" target="_top"><b>Click here</b></a> or send mail to <?php echo validate(COMPANYMAIL) ?>.
                        </span>
                    </center>
                </div>
            </div>

            <div class="headline text-center" id="time">
                <!-- Time auto generated by js -->
            </div><!-- /.headline -->     
        </div><!-- /.center -->

        <!-- jQuery 2.0.2 -->
        <script language="JavaScript" src="../../theme/js/jquery202.min.js" type="text/JavaScript"></script>
        <!-- Bootstrap -->
        <script src="../../theme/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>