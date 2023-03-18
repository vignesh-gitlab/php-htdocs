<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'purchase_order_form.php';
$action_page = 'purchase_order_action.php';
//$print_page = 'purchase_order_print.php';
$purchase_invoice_page = 'purchase_invoice_form.php';
$tablename = 'sr_purchase_order';
$return_page = '../operation/purchase_order_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
            <li class="active">Purchase Order</li>
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
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
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
                                    <th>Active Since</th>
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
                            <th class="no-print">Active Since</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query1 = "SELECT id,username,po_approval_amount from sr_user_approval where username='" . $_SESSION["username"] . "'";
                                $DB->query($Query1);
                                while ($DB->Multicoloums()) {
                                    $po_approval_amount = $DB->Record["po_approval_amount"];
                                }
                                $Query = "SELECT id,po_id,po_no,po_date,so_no,vehicle_type,client_name,contractor_name,contractor_city,grand_total,po_status from $tablename where grand_total<=" . $po_approval_amount . " and po_status<>'Close'  and po_status<>'Approval' order by abs(po_no)";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    $po_status = $UDB->Record["po_status"];
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
                                                                <a href="<?php echo $action_page; ?>?po_no=<?php echo $UDB->Record["po_no"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <?php
                                            if ($po_status != "Approval") {
                                                ?>
                                                <a href="<?php echo $form_page . "?po_no=" . $UDB->Record["po_no"] . "&approval=Approve" . "&id=" . $UDB->Record["id"]; ?>" title="Approve"><i class="fa fa-fw fa-check"></i></a>
                                                    <?php
                                                }
                                                ?>
    <!--    <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a> -->
    <!--  <a href="<?php echo $purchase_invoice_page . "?po_no=" . $UDB->Record["po_no"]; ?>" title="Add Purchase Invoice"><i class="fa fa-fw fa-plus"></i></a>-->
                                        </td>
                                        <td><?php echo $UDB->Record["po_no"] ?></td>
                                        <td><?php echo $UDB->Record["po_date"] ?></td>
                                        <td><?php echo $UDB->Record["so_no"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["contractor_name"] ?></td>
                                        <td><?php echo $UDB->Record["contractor_city"] ?></td>
                                        <td><?php echo $UDB->Record["po_status"] ?></td>
                                        <td>
                                            <?php
                                            $date1 = date_create(date("Y-m-d", strtotime($UDB->Record["po_date"])));
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