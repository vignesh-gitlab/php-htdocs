<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_unloading_form.php';
$child_form_page = 'vehicle_reporting_form.php';
$child_form_page1 = 'lorry_arrival_report_form.php';
$tablename = 'sr_vehicle_unloading';
$return_page = '../client_branch/vehicle_unloading_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "unloading_status='Reported' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Unloading - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Vehicle Unloading - Closed</li>
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
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Vehicle Details</th>
                                    <th>Landing Date & Time</th>
                                    <th>Unloading Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,landing_date,landing_time,unloading_date,unloading_time,action_user from $tablename where unloading_status='Reported'  and client_name='" . $Display_Name . "' and (client_branch='" . $_SESSION["branch"] . "' or client_branch='" . $_SESSION["branch1"] . "' or client_branch='" . $_SESSION["branch2"] . "') order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo $child_form_page1 . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Lorry Arrival Report"><i class="fa fa-fw fa-plus-circle"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["landing_date"] . " " . $UDB->Record["landing_time"] ?></td>
                                        <td><?php echo $UDB->Record["unloading_date"] . " " . $UDB->Record["unloading_time"] ?></td>
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
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Vehicle Details</th>
                                    <th>Landing Date & Time</th>
                                    <th>Unloading Date & Time</th>
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