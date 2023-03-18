<?php include'../../template/client_branch/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'quotation_form.php';
$action_page = 'quotation_action.php';
$so_page = 'sales_order_form.php';
$wo_page = 'work_order_form.php';
//$print_page = 'quotation_print.php';
$tablename = 'sr_quotation';
$return_page = '../client_branch/quotation_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quotation Revisions
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
            <li class="active"><a href="quotation_grid.php">Quotation</a></li>
            <li class="active">Quotation Revisions</li>
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
                                    <th>Active Since</th>
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
                            <th class="no-print">Active Since</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,quotation_id,quotation_no,quotation_date,vehicle_type,client_name,division_name,branch_name,city,sub_total,total_tax,grand_total,quotation_status from $tablename where quotation_id='" . $_REQUEST["quotation_id"] . "' order by id desc";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    $quotation_status = $UDB->Record["quotation_status"];
                                    $Query1 = "SELECT count(quotation_id) as quotation_count from $tablename where quotation_id='" . $UDB->Record["quotation_id"] . "'";
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
                                                                <a href="<?php echo $action_page; ?>?quotation_no=<?php echo $UDB->Record["quotation_no"] ?>&form_action=Childdelete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                           <!-- <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a>-->
                                            <?php
                                            if ($quotation_status != "Approval") {
                                                ?>
                                                <a href="<?php echo $form_page . "?quotation_no=" . $UDB->Record["quotation_no"] . "&approval=Approve" . "&id=" . $UDB->Record["id"]; ?>" title="Approve"><i class="fa fa-fw fa-check"></i></a>
                                                    <?php
                                                }
                                                ?>

                                                        <!--            <a href="<?php echo $so_page . "?quotation_no=" . $UDB->Record["quotation_no"]; ?>" title="Sales Order"><i class="fa fa-fw fa-plus"></i></a> -->
                                        </td>
                                        <td><?php echo $UDB->Record["quotation_no"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_date"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["division_name"] ?></td>
                                        <td><?php echo $UDB->Record["branch_name"] ?></td>
                                        <td><?php echo $UDB->Record["city"] ?></td>
                                        <td><?php echo $UDB->Record["quotation_status"] ?></td>
                                        <td>
                                            <?php
                                            $date1 = date_create(date("Y-m-d", strtotime($UDB->Record["quotation_date"])));
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