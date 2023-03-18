<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'contract_form.php';
$tablename = 'sr_contract';
$return_page = '../superadmin/contract_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contract
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Contract</li>
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
                                    <td colspan="15">
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Effective Date</th>
                                    <th>Lane ID</th>
                                    <th>Vehicle Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total KM One Way</th>
                                    <th>Total KM Trip</th>
                                    <th>Rate</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Effective Date</th>
                                    <th>Lane ID</th>
                                    <th>Vehicle Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total KM One Way</th>
                                    <th>Total KM Trip</th>
                                    <th>Rate</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,agreement_no,effective_date,lane_id,vehicle_type,lane_from,lane_to,total_km_one_way,total_km_trip,rate,duration,status from $tablename";
                                $DB->query($Query);
                                while ($DB->Multicoloums()) {
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
                                                                <a href="<?php echo $commonvar_deletepage; ?>?id=<?php echo $DB->Record["id"] ?>&tablename=<?php echo $tablename ?>&returnpage=<?php echo $return_page ?>" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $DB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $form_page . "?id=" . $DB->Record["id"] . "&form_action1=Copy"; ?>" title="Copy"><i class="fa fa-fw fa-copy"></i></a>

                                        </td>
                                        <td><?php echo $DB->Record["effective_date"] ?></td>
                                        <td><?php echo $DB->Record["lane_id"] ?></td>
                                        <td><?php echo $DB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $DB->Record["lane_from"] ?></td>
                                        <td><?php echo $DB->Record["lane_to"] ?></td>
                                        <td><?php echo $DB->Record["total_km_one_way"] ?></td>
                                        <td><?php echo $DB->Record["total_km_trip"] ?></td>
                                        <td><?php echo "Rs." . $DB->Record["rate"] ?></td>
                                        <td><?php echo $DB->Record["duration"] ?></td>
                                        <td><?php echo $DB->Record["status"] ?></td>
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