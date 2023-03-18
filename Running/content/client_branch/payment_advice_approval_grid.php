<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'payment_advice_form.php';
//$child_form_page = 'vehicle_placement_form.php';
//$action_page = 'money_receipt_action.php';
$tablename = 'sr_payment_advice';
$return_page = '../client_branch/payment_advice_approval_grid.php';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payment Advice Approval
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Payment Advice Approval</li>
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
                                    <th>Action</th>
                                    <th>Client Name</th>
                                    <th>Document No</th>
                                    <th>Cheque No</th>
                                    <th>Cheque Date</th>
                                    <th>Bank</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,client_name,document_no,cheque_no,cheque_date,bank_name,cheque_amount,pa_status from $tablename where pa_status='Approval'";
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
                                                                <a href="<?php echo $action_page; ?>?document_no=<?php echo $UDB->Record["document_no"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["client_name"]; ?></td>
                                        <td><?php echo $UDB->Record["document_no"]; ?></td>
                                        <td><?php echo $UDB->Record["cheque_no"] ?></td>
                                        <td><?php echo $UDB->Record["cheque_date"]; ?></td>
                                        <td><?php echo $UDB->Record["bank_name"]; ?></td>
                                        <td><?php echo $UDB->Record["cheque_amount"]; ?></td>
                                        <td><?php echo $UDB->Record["pa_status"]; ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Client Name</th>
                                    <th>Document No</th>
                                    <th>Cheque No</th>
                                    <th>Cheque Date</th>
                                    <th>Bank</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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