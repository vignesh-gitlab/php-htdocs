<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'advance_cash_receipt_form.php';
//$child_form_page = 'vehicle_placement_form.php';
$action_page = 'advance_cash_receipt_action.php';
$tablename = 'sr_advance_cash_receipt';
$return_page = '../client_division/advance_cash_receipt_grid.php';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advance Cash Receipt
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active"> Advance Cash Receipt</li>
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
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Receipt No.</th>
                                    <th>Receipt Date</th>
                                    <th>Client Name</th>
                                    <th>Division Name</th>
                                    <th>Branch Name</th>
                                    <th>Received From</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT  id,receipt_no,receipt_date,client_name,division_name,branch_name,received_from,description,amount,mode_of_payment,payment_description from $tablename";
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
                                        </td>
                                        <td><?php echo $UDB->Record["receipt_no"]; ?></td>
                                        <td><?php echo $UDB->Record["receipt_date"]; ?></td>
                                        <td><?php echo $UDB->Record["client_name"]; ?></td>
                                        <td><?php echo $UDB->Record["division_name"]; ?></td>
                                        <td><?php echo $UDB->Record["branch_name"]; ?></td>
                                        <td><?php echo $UDB->Record["received_from"]; ?></td>
                                        <td><?php echo $UDB->Record["description"]; ?></td>
                                        <td><?php echo $UDB->Record["amount"]; ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Receipt No.</th>
                                    <th>Receipt Date</th>
                                    <th>Client Name</th>
                                    <th>Division Name</th>
                                    <th>Branch Name</th>
                                    <th>Received From</th>
                                    <th>Description</th>
                                    <th>Amount</th>
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