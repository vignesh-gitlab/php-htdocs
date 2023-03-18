<?php include'../../template/superadmin/header.default.php'; ?>
<?php
$action_page = 'vehicle_transit_status_send.php';
?>
<aside class="right-side strech">
    <section class="content-header">
        <h1>
            Combined Vehicle Transit Status
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Operation</li>
            <li class="active">Vehicle Delay Status</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" action="<?php echo $action_page; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <?php
                            //echo implode(",", array_values($_REQUEST['checkbox']));
                            $to = $_REQUEST["mail_id"];
                            $subject = "Combined Vehicle Transit Status - " . date('d-m-Y');
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

                            $transit_record = implode(",", array_values($_REQUEST['checkbox']));
                            $status_array_count = count($_REQUEST['checkbox']);
                            $condition_start = "t1.id=";
                            $condition_middle = "";
                            $condition_end = " or ";
                            for ($i = 0; $i < $status_array_count; $i++) {
                                if ($i == 0) {
                                    $condition_middle.= $condition_start . $_REQUEST['checkbox'][$i];
                                } else {
                                    $condition_middle.= $condition_end . $condition_start . $_REQUEST['checkbox'][$i];
                                }
                            }

                            $message = '<table style="width:100%;">
                            <tr>
                                <td colspan="20">
                                    Dear Client,<br><br>Below we have listed your shipment current vehicle status for your kind concern,<br><br>
                                </td>
                            </tr>
                            <tr style="background:#3c8dbc; color:#FFFFFF; height:30px;">
                                <th style="border-left:1px solid #3c8dbc; border-right:1px solid#FFFFFF; padding-left:5px;">Order Number</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">LR Number</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Origin</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Destination</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Vehicle Details</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Status Date & Time</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Current Location</th>
                                <th style="border-right:1px solid #3c8dbc; padding-left:5px;">Remarks</th>
                            </tr>';

                            $row_count = 1;
                            $Query = "SELECT t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.dispatch_date,t1.dispatch_time,t1.expected_dateof_delivery,t1.status_date_time,t1.vehicle_current_position,t1.remarks,t1.delay_reason,t1.expected_delay_time,t1.action_user,t2.lr_no from sr_vehicle_status t1,sr_vehicle_dispatch t2 where t1.vehicle_status='Status Updated' and t1.order_no=t2.order_no  and t1.delay_reason='' and (" . $condition_middle . ") order by t1.order_no";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $order_no = $UDB->Record["order_no"];
                                $lr_no = $UDB->Record["lr_no"];
                                $orgin = $UDB->Record["orgin"];
                                $destination = $UDB->Record["destination"];
                                $vehicle_type = $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"];
                                $status_date_time = $UDB->Record["status_date_time"];
                                $vehicle_position = $UDB->Record["vehicle_current_position"];
                                $remarks = $UDB->Record["remarks"];

                                if ($row_count % 2 == 1) {

                                    $message .= '<tr style="background:#FFFFFF; color:#000000; height:30px;">';
                                } else {
                                    $message .='<tr style="background:#f3f4f5; color:#000000; height:30px;">';
                                }
                                $message .='<td style="border-left:1px solid #3c8dbc; border-right:1px solid#3c8dbc; padding-left:5px;">' . $order_no . '</th>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $lr_no . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $orgin . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $destination . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $vehicle_type . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $status_date_time . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $vehicle_position . '</td>
                                <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $remarks . '</td>
                            </tr>';
                                $row_count = $row_count + 1;
                            }
                            $message .='<tr>
                                <td style="border-top:1px solid#3c8dbc;" colspan="20">
                                    <br>Regards<br>
                                    Rhenus Logistics<br><br>
                                    To get status of your shipment, Kindly <a href ="http://103.231.9.233:8080/Track%20and%20Trace/content/common/signin.php" target="_blank">Click Here</a>
                                </td>
                            </tr>
                            </table>';

                            echo "<b>To : </b>" . $to . "<br><br>";
                            echo "<b>Subject : </b>" . $subject . "<br><br>";
                            echo $message;
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="mail_id" value="<?php echo $to; ?>"/>
                    <input type="hidden" name="condition" value="<?php echo $condition_middle; ?>"/>
                    <button type="submit" onsubmit="this.style.display = 'none';
                            clear_but.style.display = 'none';
                            submit_loader.style.display = 'block';
                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Send</button>

                </form>
            </div>
        </div>

    </section>
</aside>

<?php include'../../template/common/footer.default.php'; ?>