<?php include'../../template/client/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
//$view_page = 'closed_shipments_child_grid.php';
$tablename = 'sr_customer_order';
$excel_export_page = '../../functions/excel_export/excel_export_order_status_report.php';
$view_page = 'shipment_status_child_grid.php';

ob_start();
session_start();
$user_database = $_SESSION['user_database'];

if (!mysql_connect(HOSTNAME, USERNAME, PASSWORD))
    die("Can't connect to database");
if (!mysql_select_db($user_database))
    die("Can't select database");
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order Status
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Order Status</li>
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
                                    <td colspan="25">
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename; ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>From - To</th>
                                    <th>Vehicle Type</th>
                                    <th>Created By</th>
                                    <th>Order Status</th>
                                    <th  width="25%">Stage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,action_user from $tablename order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {

                                    $order_no = $UDB->Record["order_no"];
                                    $overall_status = "Order has Taken";
                                    $order_status = "Open";

                                    $Query1 = "select booking_status from sr_vehicle_booking where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query1);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$booking_status = $rows["booking_status"];
                                            //if($booking_status=="Placed")
                                            //{
                                            $overall_status = "Vehicle has Booked";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query2 = "select placement_status from sr_vehicle_placement where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query2);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$placement_status = $rows["placement_status"];
                                            //if($placement_status=="Not Yet Released")
                                            //{
                                            $overall_status = "Vehicle has Placed at Origin";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query3 = "select loading_status from sr_vehicle_loading_start where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query3);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$loading_status = $rows["loading_status"];
                                            //if($loading_status=="Not Yet Loaded")
                                            //{
                                            $overall_status = "Vehicle Loading on Progress";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query4 = "select loading_status from sr_vehicle_loading_end where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query4);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$loading_status = $rows["loading_status"];
                                            //if($loading_status=="Not Yet Dispatched")
                                            //{
                                            $overall_status = "Vehicle Loading has Completed";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query5 = "select dispatch_status from sr_vehicle_dispatch where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query5);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$dispatch_status = $rows["dispatch_status"];
                                            //if($dispatch_status=="Not Yet Reached")
                                            //{
                                            $overall_status = "Vehicle Transit has Started";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query6 = "select landing_status from sr_vehicle_landing where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query6);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$landing_status = $rows["landing_status"];
                                            //if($landing_status=="Not Yet Unloaded")
                                            //{
                                            $overall_status = "Vehicle Unload has Started";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query7 = "select unloading_status from sr_vehicle_unloading where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query7);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            //$unloading_status = $rows["unloading_status"];
                                            //if($unloading_status=="Not Yet Reported")
                                            //{
                                            $overall_status = "Vehicle Unload has Completed";
                                            $order_status = "Open";
                                            //}
                                        }
                                    }

                                    $Query8 = "select reporting_status from sr_vehicle_reporting where order_no='" . $order_no . "'";
                                    $result = mysql_query($Query8);
                                    if (mysql_num_rows($result) > 0) {
                                        while ($rows = mysql_fetch_array($result)) {
                                            $reporting_status = $rows["reporting_status"];
                                            if ($reporting_status == "Finalized") {
                                                $overall_status = "Order has Been Closed";
                                                $order_status = "Close";
                                            } else if ($reporting_status == "Reported") {
                                                $overall_status = "Vehicle has Been Released From Destination";
                                                $order_status = "Open";
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo $view_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="View"><i class="fa fa-fw fa-indent"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . " - " . $UDB->Record["client_division"] . " - " . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"] . " - " . $UDB->Record["destination"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["action_user"]; ?></td>
                                        <td><?php echo $order_status ?></td>
                                        <td><?php echo $overall_status ?></td>
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
                                    <th>From - To</th>
                                    <th>Vehicle Type</th>
                                    <th>Created By</th>
                                    <th>Order Status</th>
                                    <th>Stage</th>
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