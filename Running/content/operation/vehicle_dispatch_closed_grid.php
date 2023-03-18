<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_dispatch_form.php';
$status_form_page = 'vehicle_status_form.php';
$child_form_page = 'vehicle_landing_form.php';
$tablename = 'sr_vehicle_dispatch';
$return_page = '../operation/vehicle_dispatch_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "dispatch_status='Reached' order by order_no";
$lr_copy_path = "../../files/Vehicle Dispatch/LR Copy/";
$invoice_copy_path = "../../files/Vehicle Dispatch/Invoice Copy/";
$fileupload_form = "vehicle_dispatch_upload_form.php";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Dispatch - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Vehicle Dispatch - Closed</li>
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
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Shipment Details</th>
                                    <th>LR Details</th>
                                    <th>Invoice Details</th>
                                    <th>EDD</th>
                                    <th>LR Copy</th>
                                    <th>Invoice Copy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,no_of_pack,weight,lr_no,lr_date,consignee_name,invoice_no,expected_dateof_delivery,action_user,invoice_upload,lr_upload from $tablename where dispatch_status='Reached' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"] ?></td>
                                        <td><?php echo $UDB->Record["no_of_pack"] . " - " . $UDB->Record["weight"] ?></td>
                                        <td><?php echo $UDB->Record["lr_no"] . " - " . $UDB->Record["lr_date"] ?></td>
                                        <td><?php echo $UDB->Record["consignee_name"] . "<br>" . $UDB->Record["invoice_no"] ?></td>
                                        <td><?php echo $UDB->Record["expected_dateof_delivery"] ?></td>
                                        <td align="center">
                                            <?php
                                            if (isset($UDB->Record["lr_upload"]) && !empty($UDB->Record["lr_upload"])) {
                                                ?>
                                                <a href="
                                                <?php echo $lr_copy_path . $UDB->Record["lr_upload"] ?>
                                                   ">
                                                    <i class="fa fa-fw fa-download"></i>
                                                </a>
                                                <?php
                                            } else {
                                                echo '<a href="' . $fileupload_form . '?order_no=' . $UDB->Record["order_no"] . '"><i class="fa fa-fw fa-arrows-h"></i></a>';
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if (isset($UDB->Record["invoice_upload"]) && !empty($UDB->Record["invoice_upload"])) {
                                                ?>
                                                <a href="
                                                <?php echo $invoice_copy_path . $UDB->Record["invoice_upload"] ?>
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
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Shipment Details</th>
                                    <th>LR Details</th>
                                    <th>Invoice Details</th>
                                    <th>EDD</th>
                                    <th>LR Copy</th>
                                    <th>Invoice Copy</th>
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