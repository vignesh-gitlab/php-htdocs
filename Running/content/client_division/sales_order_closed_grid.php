<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'sales_order_form.php';
$action_page = 'sales_order_action.php';
$download_location = '../../files/uploads/sales_order/';
//$print_page = 'sales_order_print.php';
$purchase_order_page = 'purchase_order_form.php';
$sales_invoice_page = 'sales_invoice_form.php';
$tablename = 'sr_sales_order';
$return_page = '../client_division/sales_order_closed_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Order - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History</li>
            <li class="active">Sales Order - Closed</li>
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
                                    <th class="no-print">Action</th>
                                    <th>SO. Number</th>
                                    <th>SO. Date</th>
                                    <th>Quo. No</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Required Date</th>
                                    <th>Client Name</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                            <th class="no-print">Action</th>
                            <th class="no-print">SO. Number</th>
                            <th class="no-print">SO. Date</th>
                            <th class="no-print">Quo. No</th>
                            <th class="no-print">Vehicle Type</th>
                            <th class="no-print">Vehicle Required Date</th>
                            <th class="no-print">Client Name</th>
                            <th class="no-print">City</th>
                            <th class="no-print">Status</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,so_id,so_no,so_date,quotation_ref_no,vehicle_type,vehicle_required_date,client_name,division_name,city,so_status from $tablename where so_status='Close'  and client_name='" . $Display_Name . "' and (division_name='" . $_SESSION["division"] . "' or division_name='" . $_SESSION["division1"] . "' or division_name='" . $_SESSION["division2"] . "') order by abs(so_no)";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td class="no-print">
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
                                        </td>
                                        <td><?php echo $UDB->Record["so_no"] ?></td>
                                        <td><?php echo $UDB->Record["so_date"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_ref_no"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["city"] ?></td>
                                        <td><?php echo $UDB->Record["so_status"] ?></td>
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