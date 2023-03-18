<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'frieght_bill_form.php';
//$child_form_page = 'vehicle_placement_form.php';
$action_page = 'frieght_bill_action.php';
$tablename = 'sr_frieght_bill';
$return_page = '../client_division/frieght_bill_approval_grid.php';
$outstanding_page = 'outstanding_child_form.php';
$view_page = 'payments_grid.php';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Frieght Bill Approval
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Frieght Bill Approval</li>
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
                                    <th>Bill No</th>
                                    <th>Bill Date</th>
                                    <th>Branch</th>
                                    <th>Client Name</th>
                                    <th>Service Tax Payable By</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,branch,client_name,division_name,service_tax_payable_by,bill_no,bill_date,frieght_status from $tablename where frieght_status='Approval'  and client_name='" . $Display_Name . "' and (division_name='" . $_SESSION["division"] . "' or division_name='" . $_SESSION["division1"] . "' or division_name='" . $_SESSION["division2"] . "')";
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
                                                                <a href="<?php echo $action_page; ?>?bill_no=<?php echo $UDB->Record["bill_no"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $view_page . "?invoice_no=" . $UDB->Record["bill_no"]; ?>&type=Frieght" title="View Payments"><i class="fa fa-fw fa-indent"></i></a>
                                            <a href="<?php echo $outstanding_page . "?invoice_no=" . $UDB->Record["bill_no"]; ?>&type=Frieght" title="Make Payment"><i class="fa fa-fw fa-plus"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["bill_no"]; ?></td>
                                        <td><?php echo $UDB->Record["bill_date"]; ?></td>
                                        <td><?php echo $UDB->Record["branch"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"]; ?></td>
                                        <td><?php echo $UDB->Record["service_tax_payable_by"]; ?></td>
                                        <td><?php echo $UDB->Record["frieght_status"]; ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Bill No</th>
                                    <th>Bill Date</th>
                                    <th>Branch</th>
                                    <th>Client Name</th>
                                    <th>Service Tax Payable By</th>
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