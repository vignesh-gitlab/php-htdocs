<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_reporting_form.php';
$tablename = 'sr_vehicle_reporting';
$return_page = '../accounts/vehicle_unloading_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "reporting_status='Finalized' order by order_no";
$pod_copy_path = "../../files/POD Copy/";
$fileupload_form = "vehicle_reporting_upload_form.php";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Reporting - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Vehicle Reporting - Closed</li>
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
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Vehicle Details</th>
                                    <th>Landing Date & Time</th>
                                    <th>Unloading Date & Time</th>
                                    <th>Reporting Date & Time</th>
                                    <th>POD Copy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,landing_date,landing_time,unloading_date,unloading_time,vehicle_release_date,vehicle_release_time,action_user,pod_name from $tablename where reporting_status='Finalized' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["landing_date"] . " " . $UDB->Record["landing_time"] ?></td>
                                        <td><?php echo $UDB->Record["unloading_date"] . " " . $UDB->Record["unloading_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_release_date"] . " " . $UDB->Record["vehicle_release_time"] ?></td>
                                        <td align="center">
                                            <?php
                                            if (isset($UDB->Record["pod_name"]) && !empty($UDB->Record["pod_name"])) {
                                                ?>
                                                <a href="
                                                <?php echo $pod_copy_path . $UDB->Record["pod_name"] ?>
                                                   ">
                                                    <i class="fa fa-fw fa-download"></i>
                                                </a>
                                                <?php
                                            } else {
                                                echo '<a href="' . $fileupload_form . '?order_no=' . $UDB->Record["order_no"] . '"><i class="fa fa-fw fa-arrows-h"></i></a>';
                                            }
                                            ?>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Vehicle Details</th>
                                    <th>Landing Date & Time</th>
                                    <th>Unloading Date & Time</th>
                                    <th>Reporting Date & Time</th>
                                    <th>POD Copy</th>
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