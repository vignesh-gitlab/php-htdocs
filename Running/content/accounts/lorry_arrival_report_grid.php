<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'lorry_arrival_report_form.php';
$child_form_page = 'vehicle_reporting_form.php';
$vehicle_unloading_page = 'vehicle_unloading_closed_operation_grid.php';
$tablename = 'sr_lorry_arrival_report';
$print_page = 'lorry_arrival_report_print.php';
$return_page = '../accounts/lorry_arrival_report_grid.php';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Arrival Report
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Lorry Arrival Report</li>
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
                                    <td colspan="15">
                                        <a href="<?php echo $vehicle_unloading_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Order No</th>
                                    <th>LAR No</th>
                                    <th>Lorry No</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Reporting Date</th>
                                    <th>Packages Load</th>
                                    <th>Packages Received</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Order No</th>
                                    <th>LAR No</th>
                                    <th>Lorry No</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Reporting Date</th>
                                    <th>Packages Load</th>
                                    <th>Packages Received</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,lar_no,lorry_no,lorry_from,lorry_to,reporting_date,packages_load,packages_received from $tablename where lar_status='Not Yet Released'";
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
                                            <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-print"></i></a>
                                        <!--    <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Update Report"><i class="fa fa-fw fa-plus-circle"></i></a>-->
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["lar_no"] ?></td>
                                        <td><?php echo $UDB->Record["lorry_no"]; ?></td>
                                        <td><?php echo $UDB->Record["lorry_from"]; ?></td>
                                        <td><?php echo $UDB->Record["lorry_to"]; ?></td>
                                        <td><?php echo $UDB->Record["reporting_date"]; ?></td>
                                        <td><?php echo $UDB->Record["packages_load"]; ?></td>
                                        <td><?php echo $UDB->Record["packages_received"]; ?></td>
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