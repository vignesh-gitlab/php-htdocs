<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_dispatch_form.php';
$status_form_page = 'vehicle_status_form.php';
$child_form_page = 'vehicle_landing_form.php';
$tablename = 'sr_vehicle_dispatch';
$return_page = '../operation/vehicle_dispatch_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "dispatch_status='Not Yet Reached' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Dispatch
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Operation</li>
            <li class="active">Vehicle Dispatch</li>
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
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Shipment Details</th>
                                    <th>LR Details</th>
                                    <th>Invoice Details</th>
                                    <th>EDD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,no_of_pack,weight,lr_no,lr_date,consignee_name,invoice_no,expected_dateof_delivery,action_user from $tablename where dispatch_status='Not Yet Reached' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {

                                    $now = time(); // or your date as well
                                    $your_date = strtotime($UDB->Record["expected_dateof_delivery"]);
                                    $datediff = $now - $your_date;
                                    $diff = floor($datediff / (60 * 60 * 24));
                                    if ($diff <= 0) {
                                        if ($diff == 0) {
                                            echo '<tr class="font_blue">';
                                        } else {
                                            echo'<tr>';
                                        }
                                        ?>
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
                                        <a href="<?php echo $status_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Vehcile Status Update"><i class="fa fa-fw fa-clock-o"></i></a>
                                        <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Vehicle Landing"><i class="fa fa-fw fa-plus-circle"></i></a>
                                    </td>
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
                                    <?php
                                }
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
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>Shipment Details</th>
                                    <th>LR Details</th>
                                    <th>Invoice Details</th>
                                    <th>EDD</th>
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