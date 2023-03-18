<?php
if ($systemexpire_amcexpire_status == True || $systemexpire_liveexpire_status == True || $systemexpire_demoexpire_status == True) {
    ?>
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope"></i>
            <span class="label label-danger"><?php echo $systemexpire_totalerror_count ?></span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">Messages</li>
            <li>
                <ul class="menu">
                    <?php
                    if ($systemexpire_demoexpire_status == True) {
                        ?>
                        <li>
                            <a href="#">
                                <div class="pull-left">
                                    <img src="../../theme/img/srinfosoft_icon.png" class="img-rounded" alt="Company Image"/>
                                </div>
                                <h4>
                                    Account Activation Pending
                                </h4>
                                <p>Account Expired on <?php echo validate(ACTIVATIONEND); ?></p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if ($systemexpire_liveexpire_status == True) {
                        ?>
                        <li>
                            <a href="#">
                                <div class="pull-left">
                                    <img src="../../theme/img/srinfosoft_icon.png" class="img-rounded" alt="Company Image"/>
                                </div>
                                <h4>
                                    Premium Activation Pending
                                </h4>
                                <p>Account Expired on <?php echo validate(ACTIVATIONEND) ?></p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if ($systemexpire_amcexpire_status == True) {
                        ?>
                        <li>
                            <a href="#">
                                <div class="pull-left">
                                    <img src="../../theme/img/srinfosoft_icon.png" class="img-rounded" alt="Company Image"/>
                                </div>
                                <h4>
                                    AMC Renewal Pending
                                </h4>
                                <p>AMC Expired on <?php echo validate(AMCEND) ?></p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </li>
    <?php
}
?>
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-credit-card"></i>
    </a>
    <ul class="dropdown-menu">
        <li class="header">About <?php echo validate(SYSTEMNAME) ?></li>
        <li style="padding-left:10px;">
            <div>
                <img src="../../theme/img/srinfosoft_icon.png" class="img-rounded" style="float:left; margin-right:5px; border:1px solid #999999;" alt="Company Image"/>
                <h5 style="margin-bottom:0px;">
                    <?php echo validate(SYSTEMNAME) . " " . validate(VERSION) ?>
                </h5>
                Powered by : <?php echo validate(COMPANYNAME) ?><br><?php echo validate(COMPANYMAIL) ?>
            </div>
            <hr style="margin-left:-10px; margin-bottom:5px;margin-top:10px;"></hr>
            <p>
                Registration Date : <?php echo validate(REGISTRATIONDATE); ?><br>
                Activation Mode : <?php echo validate(ACTIVATIONMODE); ?><br>
                Activation Period : <?php echo validate(ACTIVATIONSTART) . " to " . validate(ACTIVATIONEND) ?><br>
                AMC Period : <?php echo validate(AMCSTART) . " to " . validate(AMCEND) ?><br>
                AMC Type : <?php echo validate(AMCTYPE); ?><br>
            </p>
        </li>
    </ul>
</li>