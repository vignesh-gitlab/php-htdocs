<?php include'../../template/client/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_booking_form.php';
$child_form_page = 'vehicle_placement_form.php';
$tablename = 'sr_vehicle_booking';
$return_page = '../client/vehicle_booking_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Booking
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Operation</li>
            <li class="active">Vehicle Booking</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td colspan="20">
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename . "&condition=" . $excel_condition ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Required Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Number</th>
                                    <th>Driver</th>
                                    <th>Escort</th>
                                    <th>Tracking Device</th>
                                    <th>SMS - Email</th>
                                    <th>Loading - Unloading Charges</th>
                                    <th>Vehicle Category</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Required Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Number</th>
                                    <th>Driver</th>
                                    <th>Escort</th>
                                    <th>Tracking Device</th>
                                    <th>SMS - Email</th>
                                    <th>Loading - Unloading Charges</th>
                                    <th>Vehicle Category</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT  id,order_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_no,driver_type,driver_name,driver_contact_no,escart_option,escart_name,tracking_device,sms_alert,email_alert,loading_charges,unloading_charges,dedicated_market_vehicle,action_user from $tablename where booking_status='Not Yet Placed'  and client_name='" . $Display_Name . "' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <ul class="pull-left" style="list-style-type: none;display:block; margin:0px; padding: 0px;">
                                                <li class="dropdown pull-left">
                                                    <a href="#" data-toggle="dropdown">
                                                        <i class="fa fa-fw fa-trash-o" title="Delete"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="user-footer">
                                                            <div style="text-align:center;">
                                                                <p>Confirm Delete?</p>

                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                <a href="<?php echo $commonvar_userdb_deletepage; ?>?id=<?php echo $UDB->Record["id"] ?>&tablename=<?php echo $tablename ?>&returnpage=<?php echo $return_page ?>" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Place Vehicle"><i class="fa fa-fw fa-plus-circle"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["driver_type"] . " - " . $UDB->Record["driver_name"] . " - " . $UDB->Record["driver_contact_no"] ?></td>
                                        <td><?php echo $UDB->Record["escart_option"] . " - " . $UDB->Record["escart_name"] ?></td>
                                        <td><?php echo $UDB->Record["tracking_device"] ?></td>
                                        <td><?php echo $UDB->Record["sms_alert"] . " - " . $UDB->Record["email_alert"] ?></td>
                                        <td><?php echo $UDB->Record["loading_charges"] . " - " . $UDB->Record["unloading_charges"] ?></td>
                                        <td><?php echo $UDB->Record["dedicated_market_vehicle"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>