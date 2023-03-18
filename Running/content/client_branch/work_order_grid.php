<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'work_order_form.php';
$action_page = 'work_order_action.php';
$download_location = '../../files/uploads/work_order/';
$service_invoice_page = 'service_invoice_form.php';
$print_page = 'work_order_print.php';
$tablename = 'sr_work_order';
$return_page = '../client_branch/work_order_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Work Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
            <li class="active">Work Order</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div id="ajaxloader" class="overlay">
                        <div class="loader_block">
                            <img src="../../theme/img/ajax-loader1.gif" class="loader_img"/>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="no-print">Action</th>
                                    <th>WO. Number</th>
                                    <th>WO. Date</th>
                                    <th>Quo. No</th>
                                    <th>Product Group</th>
                                    <th>Client Name</th>
                                    <th>Company Name</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Active Since</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                            <th class="no-print">Action</th>
                            <th class="no-print">WO. Number</th>
                            <th class="no-print">WO. Date</th>
                            <th class="no-print">Quo. No</th>
                            <th class="no-print">Product Group</th>
                            <th class="no-print">Client Name</th>
                            <th class="no-print">Company Name</th>
                            <th class="no-print">City</th>
                            <th class="no-print">Status</th>
                            <th class="no-print">Active Since</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,wo_id,quotation_no,product_group,wo_number,wo_date,client_name,client_company,client_city,wo_status,wo_copy from $tablename where wo_status<>'Close' order by wo_id";
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
                                                                <a href="<?php echo $action_page; ?>?wo_no=<?php echo $UDB->Record["wo_number"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a>
                                            <a href="<?php echo $service_invoice_page . "?wo_no=" . $UDB->Record["wo_number"]; ?>" title="Add Service Invoice"><i class="fa fa-fw fa-plus"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["wo_number"] ?></td>
                                        <td><?php echo $UDB->Record["wo_date"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_no"] ?></td>
                                        <td><?php echo $UDB->Record["product_group"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["client_company"] ?></td>
                                        <td><?php echo $UDB->Record["client_city"] ?></td>
                                        <td><?php echo $UDB->Record["wo_status"] ?></td>
                                        <td>
                                            <?php
                                            $date1 = date_create(date("Y-m-d", strtotime($UDB->Record["wo_date"])));
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