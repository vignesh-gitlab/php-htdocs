<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'sales_order_form.php';
$action_page = 'sales_order_action.php';
$download_location = '../../files/uploads/sales_order/';
//$print_page = 'sales_order_print.php';
$purchase_order_page = 'purchase_order_form.php';
$sales_invoice_page = 'sales_invoice_form.php';
$customer_order_page = 'customer_order_form.php';
$tablename = 'sr_sales_order';
$return_page = '../superadmin/sales_order_approval_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Order Approval
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
            <li class="active">Sales Order Approval</li>
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
                                    <th>Active Since</th>
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
                            <th class="no-print">Active Since</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,so_id,so_no,so_date,quotation_ref_no,vehicle_type,vehicle_required_date,client_name,city,so_status from $tablename where so_status='Approval' and so_status<>'Close' order by abs(so_no)";
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
                                                                <a href="<?php echo $action_page; ?>?so_no=<?php echo $UDB->Record["so_no"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                      <!--      <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a> -->
                                            <a href="<?php echo $purchase_order_page . "?so_no=" . $UDB->Record["so_no"]; ?>" title="Add Purchase Order"><i class="fa fa-fw fa-plus"></i></a>
                                            <a href="<?php echo $customer_order_page . "?so_no=" . $UDB->Record["so_no"]; ?>" title="Add Order"><i class="fa fa-fw fa-plus"></i></a>
                                          <!--  <a href="<?php echo $sales_invoice_page . "?so_no=" . $UDB->Record["so_no"]; ?>" title="Add Sales Invoice"><i class="fa fa-fw fa-plus"></i></a>-->
                                        </td>
                                        <td><?php echo $UDB->Record["so_no"] ?></td>
                                        <td><?php echo $UDB->Record["so_date"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_ref_no"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_required_date"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["city"] ?></td>
                                        <td><?php echo $UDB->Record["so_status"] ?></td>
                                        <td>
                                            <?php
                                            $date1 = date_create(date("Y-m-d", strtotime($UDB->Record["so_date"])));
                                            $date2 = date_create(date('Y-m-d'));
                                            $diff = $date1->diff($date2)->format("%R%a");
                                            $diff1 = $date1->diff($date2)->format("%a");
                                            if ($diff > 0) {
                                                if ($diff <= 7) {
                                                    echo '<small class="badge pull-left bg-green">' . $diff1 . ' Days</small>';
                                                } else if ($diff > 7 && $diff <= 15) {
                                                    echo '<small class="badge pull-left bg-blue">' . $diff1 . ' Days</small>';
                                                } else if ($diff > 15 and $diff <= 30) {
                                                    echo '<small class="badge pull-left bg-yellow">' . $diff1 . ' Days</small>';
                                                } else if ($diff > 30) {
                                                    echo '<small class="badge pull-left bg-red">' . $diff1 . ' Days</small>';
                                                }
                                            }
                                            ?>
                                        </td>
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