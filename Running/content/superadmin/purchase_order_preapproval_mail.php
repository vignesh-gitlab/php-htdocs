<?php include'../../template/superadmin/header.default.php'; ?>
<?php
$action_page = 'purchase_order_preapproval_send.php';
?>
<aside class="right-side strech">
    <section class="content-header">
        <h1>
            Post Purchase Order Approval
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
            <li class="active">Post Purchase Order Approval</li>
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

                            $subject = "Purchase Order Approval - " . date('d-m-Y');
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

                            $transit_record = implode(",", array_values($_REQUEST['checkbox']));
                            $status_array_count = count($_REQUEST['checkbox']);
                            $condition_start = "id=";
                            $condition_middle = "";
                            $condition_end = " or ";
                            for ($i = 0; $i < $status_array_count; $i++) {
                                if ($i == 0) {
                                    $condition_middle.= $condition_start . $_REQUEST['checkbox'][$i];
                                } else {
                                    $condition_middle.= $condition_end . $condition_start . $_REQUEST['checkbox'][$i];
                                }
                            }



                            /*  if ($mail_category == "Internal Approval") {
                              $comment = $UDB->Record["comment"];
                              } else {
                              $comment = "Dear Sir/Madam, <br><br>Below we have listed your purchase order to approve for your kind concern";
                              }
                             */
                            $message = '<table style="width:100%;">
                            <tr>
                                <td colspan="20">
Dear Sir/Madam, <br><br>Below we have listed your purchase order to approve for your kind concern
                                , <br><br>
                                </td>
                            </tr>
                            <tr style="background:#3c8dbc; color:#FFFFFF; height:30px;">
                                <th style="border-left:1px solid #3c8dbc; border-right:1px solid#FFFFFF; padding-left:5px;">Purchase Order No.</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Purchase Order Date</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Sales Order No.</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Vehicle Type</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Vehicle Required Date</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Client Name</th>
                                <th style="border-right:1px solid#FFFFFF; padding-left:5px;">Vendor Name</th>
                                <th style="border-right:1px solid #3c8dbc; padding-left:5px;">Vendor City</th>
                            </tr>';

                            $row_count = 1;
                            $Query = "SELECT id,po_id,po_no,po_date,so_no,vehicle_type,vehicle_required_date,client_name,contractor_name,contractor_city,grand_total,mail_category,comment,po_status from sr_purchase_order where grand_total>'" . $po_approval_amount . "' and po_status<>'Close' and po_status<>'Approval' and (" . $condition_middle . ") order by abs(po_no)";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $po_no = $UDB->Record["po_no"];
                                $po_date = $UDB->Record["po_date"];
                                $so_no = $UDB->Record["so_no"];
                                $vehicle_type = $UDB->Record["vehicle_type"];
                                $vehicle_required_date = $UDB->Record["vehicle_required_date"];
                                $client_name = $UDB->Record["client_name"];
                                $contractor_name = $UDB->Record["contractor_name"];
                                $contractor_city = $UDB->Record["contractor_city"];
                                $po_status = $UDB->Record["po_status"];
                                $mail_category = $UDB->Record["mail_category"];
                                if ($row_count % 2 == 1) {

                                    $message .= '<tr style="background:#FFFFFF; color:#000000; height:30px;">';
                                } else {
                                    $message .='<tr style="background:#f3f4f5; color:#000000; height:30px;">';
                                }
                                $message .='<td style="border-left:1px solid #3c8dbc; border-right:1px solid#3c8dbc; padding-left:5px;">' . $po_no . '</th>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $po_date . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $so_no . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $vehicle_type . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $vehicle_required_date . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $client_name . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $contractor_name . '</td>
                                    <td style="border-right:1px solid#3c8dbc; padding-left:5px;">' . $contractor_city . '</td>
                                </tr>';
                                $row_count = $row_count + 1;
                            }
                            $message .='<tr>
                                    <td style="border-top:1px solid#3c8dbc;" colspan="20">
                                        <br>Regards<br>
                                        Rhenus Logistics<br><br>
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