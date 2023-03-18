<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'customer_order_form.php';
$child_form_page = 'vehicle_booking_form.php';
$view_page = 'closed_shipments_child_grid.php';
$tablename = 'sr_customer_order';
$return_page = '../accounts/customer_order_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Closed Shipments View
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li><a href="closed_shipments_grid.php">Closed Shipments</a></li>
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
                                $Query = "select t1.order_no,t1.order_date,t1.order_time,t1.vehicle_required_date,t1.vehicle_required_time,t2.placement_date,t2.placement_time,t3.loading_start_date,t3.loading_start_time,t4.loading_end_date,t4.loading_end_date,t5.dispatch_date,t5.dispatch_time,t6.landing_date,t6.landing_time,t7.unloading_date,t7.unloading_time,t8.vehicle_release_date,t8.vehicle_release_time from sr_customer_order t1,sr_vehicle_placement t2,sr_vehicle_loading_start t3,sr_vehicle_loading_end t4,sr_vehicle_dispatch t5,sr_vehicle_landing t6,sr_vehicle_unloading t7,sr_vehicle_reporting t8 where t1.order_no=t2.order_no and t1.order_no=t3.order_no and t1.order_no=t4.order_no and t1.order_no=t5.order_no and t1.order_no=t6.order_no and t1.order_no=t7.order_no and t1.order_no=t8.order_no and t1.order_no='" . $_REQUEST["order_no"] . "'";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["order_date"] . " " . $UDB->Record["order_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"] ?></td>
                                        <td><?php echo $UDB->Record["placement_date"] . " " . $UDB->Record["placement_time"] ?></td>
                                        <td><?php echo $UDB->Record["loading_start_date"] . " " . $UDB->Record["loading_start_date"] ?></td>
                                        <td><?php echo $UDB->Record["loading_end_date"] . " " . $UDB->Record["loading_end_date"] ?></td>
                                        <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"] ?></td>
                                        <td><?php echo $UDB->Record["landing_date"] . " " . $UDB->Record["landing_time"] ?></td>
                                        <td><?php echo $UDB->Record["unloading_date"] . " " . $UDB->Record["unloading_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_release_date"] . " " . $UDB->Record["vehicle_release_time"] ?></td>
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