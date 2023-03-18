<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_placement_form.php';
$child_form_page = 'vehicle_loading_start_form.php';
$child_form_page1 = 'bilty_form.php';
$tablename = 'sr_vehicle_placement';
$return_page = '../accounts/vehicle_placement_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "placement_status='Released' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Placement - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Vehicle Placement - Closed</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
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
                                    <th>Vehicle</th>
                                    <th>Driver Type</th>
                                    <th>Escort</th>
                                    <th>Tracking Device</th>
                                    <th>Placement Date & Time</th>
                                    <th>Ontime Placement</th>
                                    <th>Late Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_no,driver_type,escart_option,tracking_device,placement_date,placement_time,ontime_placement,late_reporting_remarks,action_user from $tablename where placement_status='Released' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo $child_form_page1 . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Add Bilty"><i class="fa fa-fw fa-plus-circle"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["driver_type"] ?></td>
                                        <td><?php echo $UDB->Record["escart_type"] ?></td>
                                        <td><?php echo $UDB->Record["tracking_device"] ?></td>
                                        <td><?php echo $UDB->Record["placement_date"] . " " . $UDB->Record["placement_time"] ?></td>
                                        <td><?php echo $UDB->Record["ontime_placement"] ?></td>
                                        <td><?php echo $UDB->Record["late_reporting_remarks"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Required Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle</th>
                                    <th>Driver Type</th>
                                    <th>Escort</th>
                                    <th>Tracking Device</th>
                                    <th>Placement Date & Time</th>
                                    <th>Ontime Placement</th>
                                    <th>Late Reason</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>