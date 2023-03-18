<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'quotation_form.php';
$action_page = 'quotation_closed_action.php';
$child_grid_page = 'quotation_child_closed_grid.php';
$wo_page = 'work_order_form.php';
$so_page = 'sales_order_form.php';
//$print_page = 'quotation_print.php';
$tablename = 'sr_quotation';
$return_page = '../operation/quotation_closed_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quotation - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History</li>
            <li class="active">Quotation - Closed</li>
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
                                    <th>Quo. Number</th>
                                    <th>Quo. Date</th>
                                    <th>Vehicle Type</th>
                                    <th>Client Name</th>
                                    <th>Division Name</th>
                                    <th>Branch Name</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                            <th class="no-print">Action</th>
                            <th class="no-print">Quo. Number</th>
                            <th class="no-print">Quo. Date</th>
                            <th class="no-print">Vehicle Type</th>
                            <th class="no-print">Client Name</th>
                            <th class="no-print">Division Name</th>
                            <th class="no-print">Branch Name</th>
                            <th class="no-print">City</th>
                            <th class="no-print">Status</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,quotation_id,quotation_no,quotation_date,vehicle_type,client_name,division_name,branch_name,city,quotation_status from $tablename where quotation_no NOT LIKE '%.%' and quotation_status='Close' order by quotation_no desc";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {

                                    $Query1 = "SELECT count(quotation_id) as quotation_count from $tablename where quotation_id='" . $UDB->Record["quotation_id"] . "' and quotation_status='Close'";
                                    $UDB1->query($Query1);
                                    while ($UDB1->Multicoloums()) {
                                        $quotation_count = $UDB1->Record["quotation_count"];
                                    }
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
                                        <td><?php echo $UDB->Record["quotation_no"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_date"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["division_name"] ?></td>
                                        <td><?php echo $UDB->Record["branch_name"] ?></td>
                                        <td><?php echo $UDB->Record["city"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_status"] ?></td>
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