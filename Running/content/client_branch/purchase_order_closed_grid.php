<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'purchase_order_form.php';
$action_page = 'purchase_order_action.php';
//$print_page = 'purchase_order_print.php';
$purchase_invoice_page = 'purchase_invoice_form.php';
$tablename = 'sr_purchase_order';
$return_page = '../client_branch/purchase_order_closed_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Order - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History</li>
            <li class="active">Purchase Order - Closed</li>
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
                                    <th>PO. Number</th>
                                    <th>PO. Date</th>
                                    <th>SO. No</th>
                                    <th>Vehicle Type</th>
                                    <th>Client Name</th>
                                    <th>Contractor Name</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                            <th class="no-print">Action</th>
                            <th class="no-print">PO. Number</th>
                            <th class="no-print">PO. Date</th>
                            <th class="no-print">SO. No</th>
                            <th class="no-print">Vehicle Type</th>
                            <th class="no-print">Client Name</th>
                            <th class="no-print">Contractor Name</th>
                            <th class="no-print">City</th>
                            <th class="no-print">Status</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,po_id,po_no,po_date,so_no,vehicle_type,client_name,contractor_name,contractor_city,po_status from $tablename where po_status='Close' order by abs(po_no)";
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
                                        <td><?php echo $UDB->Record["po_no"] ?></td>
                                        <td><?php echo $UDB->Record["po_date"] ?></td>
                                        <td><?php echo $UDB->Record["so_no"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["contractor_name"] ?></td>
                                        <td><?php echo $UDB->Record["contractor_city"] ?></td>
                                        <td><?php echo $UDB->Record["po_status"] ?></td>
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