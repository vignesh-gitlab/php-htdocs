<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'customer_order_form.php';
$child_form_page = 'vehicle_booking_form.php';
$view_page = 'closed_shipments_child_grid.php';
$tablename = 'sr_customer_order';
$return_page = '../client_branch/customer_order_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            On Progress Shipments View
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li><a href="onprogress_shipments_grid.php">On Progress Shipments</a></li>
            <li class="active">View</li>
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
                                    <th>Order Number</th>
                                    <th>Ordered On</th>
                                    <th>Required On</th>
                                    <th>Placed On</th>
                                    <th>Loaded Starts</th>
                                    <th>Loaded Ends</th>
                                    <th>Dispatched On</th>
                                    <th>Landed On</th>
                                    <th>Unloaded Starts</th>
                                    <th>Reported On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT order_no,order_date,order_time,vehicle_required_date,vehicle_required_time from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
                                $UDB->query($Query);
                                if ($UDB->Multicoloums()) {

                                    $Query1 = "SELECT placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time from sr_vehicle_loading_end where order_no='" . $_REQUEST["order_no"] . "'";
                                    $UDB1->query($Query1);
                                    if ($UDB1->Multicoloums()) {
                                        $placement_date = $UDB1->Record["placement_date"];
                                        $placement_time = $UDB1->Record["placement_time"];
                                        $loading_start_date = $UDB1->Record["loading_start_date"];
                                        $loading_start_time = $UDB1->Record["loading_start_time"];
                                        $loading_end_date = $UDB1->Record["loading_end_date"];
                                        $loading_end_time = $UDB1->Record["loading_end_time"];
                                    }

                                    $Query2 = "SELECT dispatch_date,dispatch_time,landing_date,landing_time,unloading_date,unloading_time,vehicle_release_date,vehicle_release_time from sr_vehicle_reporting where order_no='" . $_REQUEST["order_no"] . "'";
                                    $UDB1->query($Query2);
                                    if ($UDB1->Multicoloums()) {
                                        $dispatch_date = $UDB1->Record["dispatch_date"];
                                        $dispatch_time = $UDB1->Record["dispatch_time"];
                                        $landing_date = $UDB1->Record["landing_date"];
                                        $landing_time = $UDB1->Record["landing_time"];
                                        $unloading_date = $UDB1->Record["unloading_date"];
                                        $unloading_time = $UDB1->Record["unloading_time"];
                                        $vehicle_release_date = $UDB1->Record["vehicle_release_date"];
                                        $vehicle_release_time = $UDB1->Record["vehicle_release_time"];
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["order_date"] . " " . $UDB->Record["order_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"] ?></td>
                                        <td><?php echo $placement_date . " " . $placement_time ?></td>
                                        <td><?php echo $loading_start_date . " " . $loading_start_time ?></td>
                                        <td><?php echo $loading_end_date . " " . $loading_end_time ?></td>
                                        <td><?php echo $dispatch_date . " " . $dispatch_time ?></td>
                                        <td><?php echo $landing_date . " " . $landing_time ?></td>
                                        <td><?php echo $unloading_date . " " . $unloading_time ?></td>
                                        <td><?php echo $vehicle_release_date . " " . $vehicle_release_time ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Ordered On</th>
                                    <th>Required On</th>
                                    <th>Placed On</th>
                                    <th>Loaded Starts</th>
                                    <th>Loaded Ends</th>
                                    <th>Dispatched On</th>
                                    <th>Landed On</th>
                                    <th>Unloaded Starts</th>
                                    <th>Reported On</th>
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