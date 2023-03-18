<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'customer_order_form.php';
$child_form_page = 'vehicle_booking_form.php';
$tablename = 'sr_customer_order';
$return_page = '../client_division/customer_order_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "order_status='Booked' or order_status='Delivered'";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Order - Closed</li>
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
                                    <td colspan="9">
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename . "&condition=" . $excel_condition ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Order Date & Time</th>
                                    <th>Required Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Type</th>
                                    <th>Ownership</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_ownership_type,vehicle_owner,primary_secondary,action_user from $tablename where (order_status='Booked' or order_status='Delivered')  and client_name='" . $Display_Name . "' and (client_division='" . $_SESSION["division"] . "' or client_division='" . $_SESSION["division1"] . "' or client_division='" . $_SESSION["division2"] . "') order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["order_date"] . " " . $UDB->Record["order_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_ownership_type"] . " " . $UDB->Record["vehicle_owner"] . " - " . $UDB->Record["primary_secondary"]; ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Order Date & Time</th>
                                    <th>Required Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Type</th>
                                    <th>Ownership</th>
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