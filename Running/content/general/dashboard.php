<?php
include'../../template/general/header.default.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Track Your Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        if ($systemexpire_amcexpire_status == True) {
            ?>
            <!--
    <div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>
        <b style="font-size:16px">Your AMC Contract has Closed</b><br><br>
        <span style="line-height:20px; color:#000000;">
            Your <b>AMC Contract</b> has expired on <b><?php echo AMCEND ?></b>. Renew your contract to get cost free service from <a href="<?php echo COMPANYURL ?>" target="_blank"><b><?php echo COMPANYNAME ?></b></a> with one year validity.<br>
            To contact your system administrator please <a href="mailto:<?php echo COMPANYMAIL ?>?Subject=AMC Renewal Request" target="_top"><b>Click here</b></a> or send mail to <?php echo COMPANYMAIL ?>.
        </span>
    </center>
    </div>
            -->
            <?php
        }
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="row no-print">
                    <div class="col-xs-12" style="margin-bottom:20px;">
                        <a href="../../index.php"><div class="btn btn-default"><i class="fa fa-reply"></i> Back</div></a>
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
                    </div>
                </div>

                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="5">
                                        <div style="float:left; width:30%;">
                                            <img src="../../theme/img/logo_left.png"/>
                                        </div>
                                        <div style="float:left; width:40%; text-align:center; font-size:18px; padding-top:10px;">Customer Order Tracking</div>
                                        <div style="float:right; width:30%; text-align:right;">
                                            <img src="../../theme/img/logo_right_print.png"/>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            </tbody>
                        </table>
                        <?php
                        $Query = "SELECT id,order_no,order_date,orgin,destination,order_status from sr_customer_order where order_no='" . $_REQUEST["lr_no"] . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $order_no = $UDB->Record["order_no"];
                            $lr_date = $UDB->Record["order_date"];
                            $orgin = $UDB->Record["orgin"];
                            $destination = $UDB->Record["destination"];
                            $order_status = $UDB->Record["order_status"];
                        }

                        $Query = "SELECT id,vehicle_no,booking_status from sr_vehicle_booking where order_no='" . $order_no . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $vehicle_no = $UDB->Record["vehicle_no"];
                            $booking_status = $UDB->Record["booking_status"];
                        }

                        $Query = "SELECT id,vehicle_no,placement_status from  sr_vehicle_placement where order_no='" . $order_no . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $vehicle_no = $UDB->Record["vehicle_no"];
                            $placement_status = $UDB->Record["placement_status"];
                        }

                        if (strpos(strtoupper($_REQUEST["lr_no"]), 'WA') !== false) {
                            $Query = "SELECT id,order_no,lr_no,lr_date,vehicle_no,orgin,destination,loading_start_date,loading_start_time,dispatch_date,dispatch_time,dispatch_status,expected_dateof_delivery from sr_vehicle_dispatch where order_no='" . $_REQUEST["lr_no"] . "'";
                        } else {
                            $Query = "SELECT id,order_no,lr_no,lr_date,vehicle_no,orgin,destination,loading_start_date,loading_start_time,dispatch_date,dispatch_time,dispatch_status,expected_dateof_delivery from sr_vehicle_dispatch where order_no='" . $_REQUEST["lr_no"] . "'";
                        }
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $order_no = $UDB->Record["order_no"];
                            $lr_no = $UDB->Record["lr_no"];
                            $lr_date = $UDB->Record["lr_date"];
                            $vehicle_no = $UDB->Record["vehicle_no"];
                            $orgin = $UDB->Record["orgin"];
                            $destination = $UDB->Record["destination"];
                            $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
                            $loading_start_date = $UDB->Record["loading_start_date"];
                            $loading_start_time = $UDB->Record["loading_start_time"];
                            $dispatch_date = $UDB->Record["dispatch_date"];
                            $dispatch_time = $UDB->Record["dispatch_time"];
                            $dispatch_status = $UDB->Record["dispatch_status"];
                        }

                        $Query = "SELECT id,loading_status from sr_vehicle_loading_start where order_no='" . $order_no . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $loading_status = $UDB->Record["loading_status"];
                        }

                        $Query = "SELECT id,landing_date,landing_time,landing_status from sr_vehicle_landing where order_no='" . $order_no . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $landing_time = $UDB->Record["landing_time"];
                            $landing_date = $UDB->Record["landing_date"];
                            $landing_status = $UDB->Record["landing_status"];
                        }

                        $Query = "SELECT id,unloading_date,unloading_time,unloading_status from sr_vehicle_unloading where order_no='" . $order_no . "'";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            $unloading_time = $UDB->Record["unloading_time"];
                            $unloading_date = $UDB->Record["unloading_date"];
                            $unloading_status = $UDB->Record["unloading_status"];
                        }

                        $overall_status = "Order Closed";
                        if ($order_status == "Not Yet Booked") {
                            $overall_status = "Vehicle has to be Booked";
                        } else if ($booking_status == "Not Yet Placed") {
                            $overall_status = "Vehicle Has Booked";
                        } else if ($placement_status == "Not Yet Released") {
                            $overall_status = "Vehicle Has Placed";
                        } else if ($loading_status == "Not Yet Loaded") {
                            $overall_status = "Not Yet Transit";
                        } else if ($dispatch_status == "Not Yet Reached") {
                            $overall_status = "Vehicle On Transit";
                        } else if ($landing_status == "Not Yet Unloaded") {
                            $overall_status = "Vehicle Reached the Destination";
                        } else if ($unloading_status == "Not Yet Reported") {
                            $overall_status = "Unloading On Progress";
                        }
                        ?>
                        <table id="example" class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td width="25%"><b>LR Number</b></td>
                                    <td width="25%"><?php echo $lr_no; ?></td>
                                    <td width="25%"><b>Order Number</b></td>
                                    <td width="25%"><?php echo $order_no; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td><?php echo $lr_date; ?></td>
                                    <td><b>Pickup Date</b></td>
                                    <td><?php echo $dispatch_date; ?></td>
                                </tr>
                                <tr>
                                    <td><b>From</b></td>
                                    <td><?php echo $orgin; ?></td>
                                    <td><b>To</b></td>
                                    <td><?php echo $destination; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Vehicle Number</b></td>
                                    <td><?php echo $vehicle_no; ?></td>
                                    <td><b>Exp. Delivery Date</b></td>
                                    <td><?php echo $expected_dateof_delivery; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Current Status</b></td>
                                    <td style="color:#FF0000;" colspan="3"><b><?php echo $overall_status; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="height:40px;"></div>
                        <table id="example" class="table table-bordered table-striped">
                            <tbody>
                                <tr style="text-align:center;font-weight:bold; font-size:13px;">
                                    <td>Status</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Place</td>
                                    <td>Remarks</td>
                                </tr>
                                <tr>
                                    <?php
                                    $new_dispatch_status = "On Progress";
                                    $Query = "SELECT remarks from sr_vehicle_status where order_no='" . $order_no . "' and delay_reason =''";
                                    $UDB->query($Query);
                                    if ($UDB->Multicoloums()) {
                                        $new_dispatch_status = "Completed";
                                    } else if ($dispatch_status == "Reached") {
                                        $new_dispatch_status = "Completed";
                                    }
                                    ?>
                                    <td><b>Vehicle Loading</b></td>
                                    <td><?php echo $dispatch_date; ?></td>
                                    <td><?php echo $dispatch_time; ?></td>
                                    <td><?php echo $orgin; ?></td>
                                    <td>
                                        <?php
                                        echo $new_dispatch_status;
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $Query = "SELECT  status_date_time,vehicle_current_position,delay_reason,expected_delay_time from sr_vehicle_status where order_no='" . $order_no . "' and delay_reason<>''";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    $status_date_time = $UDB->Record["status_date_time"];
                                    $vehicle_current_position = $UDB->Record["vehicle_current_position"];
                                    $delay_reason = $UDB->Record["delay_reason"];
                                    $expected_delay_time = $UDB->Record["expected_delay_time"];

                                    $date_split = explode(" ", $status_date_time);
                                    if ($delay_reason != NULL && isset($delay_reason) && $delay_reason != '') {
                                        echo'<tr>';
                                        echo'<td><b>Vehicle Delay</b></td> ';
                                        echo'<td>' . $date_split[0] . '</td> ';
                                        echo'<td>' . $date_split[1] . '</td>';
                                        echo'<td>' . $vehicle_current_position . '</td>';
                                        echo'<td>' . $delay_reason . '- ETA -' . $expected_delay_time . '</td>';
                                        echo'</tr>';
                                    }
                                }
                                ?>
                                <?php
                                $Query = "SELECT status_date_time,vehicle_current_position,delay_reason,expected_delay_time,remarks from sr_vehicle_status where order_no='" . $order_no . "' and delay_reason =''";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    $status_date_time = $UDB->Record["status_date_time"];
                                    $vehicle_current_position = $UDB->Record["vehicle_current_position"];
                                    $delay_reason = $UDB->Record["delay_reason"];
                                    $remarks = $UDB->Record["remarks"];
                                    $expected_delay_time = $UDB->Record["expected_delay_time"];

                                    $date_split = explode(" ", $status_date_time);
                                    echo'<tr>';
                                    echo'<td><b>Vehicle Transit</b></td> ';
                                    echo'<td>' . $date_split[0] . '</td> ';
                                    echo'<td>' . $date_split[1] . '</td>';
                                    echo'<td>' . $vehicle_current_position . '</td>';
                                    echo'<td>' . $remarks . '</td>';
                                    echo'</tr>';
                                }
                                ?>
                                <tr>
                                    <td><b>Vehicle Arrive</b></td>
                                    <td>
                                        <?php
                                        if ($landing_status == "Not Yet Unloaded") {
                                            echo $expected_delay_time;
                                        } else {
                                            echo $landing_date;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($landing_status == "Not Yet Unloaded") {
                                            echo "-";
                                        } else {
                                            echo $landing_time;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $destination; ?></td>
                                    <td>
                                        <?php
                                        if ($landing_status == "Not Yet Unloaded") {
                                            echo "On Progress";
                                        } else if ($landing_status == "Unloaded") {
                                            echo"Completed";
                                        } else {
                                            echo"To be Start";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Vehicle Unload</b></td>
                                    <td><?php echo $unloading_date; ?></td>
                                    <td><?php echo $unloading_time; ?></td>
                                    <td><?php echo $destination; ?></td>
                                    <td>
                                        <?php
                                        if ($unloadaing_status == "Not Yet Reported") {
                                            echo "On Progress";
                                        } else if ($unloading_status == "Reported") {
                                            echo"Completed";
                                        } else {
                                            echo"To be Start";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <div class="row no-print">
                    <div class="col-xs-12" style="margin-bottom:20px;">
                        <a href="../../index.php"><div class="btn btn-default"><i class="fa fa-reply"></i> Back</div></a>
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- Main content -->
</aside>

<?php include'../../template/common/footer.default.php'; ?>