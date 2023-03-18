<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_form.php';
$action_page = 'vehicle_action.php';
$tablename = 'sr_vehicle';
$return_page = '../accounts/vehicle_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_masterdb.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Vehicle</li>
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
                                    <td colspan="9">
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename; ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Vehicle Type</th>
                                    <th>Ownership Type</th>
                                    <th>Vehicle Owner</th>
                                    <th>Registration Number</th>
                                    <th>Manufacturer</th>
                                    <th>Permit Type</th>
                                    <th>Permit Expires On</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Vehicle Type</th>
                                    <th>Ownership Type</th>
                                    <th>Vehicle Owner</th>
                                    <th>Registration Number</th>
                                    <th>Manufacturer</th>
                                    <th>Permit Type</th>
                                    <th>Permit Expires On</th>
                                    <th>Availability</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,vehicle_type,manufacturer,registration_no,ownership,vendor_name,permit_type,permit_expires_on,availablity from $tablename order by vehicle_type";
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
                                            <ul class="pull-left" style="list-style-type: none;display:block; margin:0px; padding: 0px;">
                                                <li class="dropdown pull-left">
                                                    <a href="#" data-toggle="dropdown">
                                                        <i class="fa fa-fw fa-retweet" title="Reset Availability"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="user-footer">
                                                            <div style="text-align:center;">
                                                                <p>Confirm Availability Reset?</p>

                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                <a href="<?php echo $action_page; ?>?id=<?php echo $DB->Record["id"] ?>&form_action=Reset" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                        <td><?php echo $DB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $DB->Record["ownership"] ?></td>
                                        <td><?php echo $DB->Record["vendor_name"] ?></td>
                                        <td><?php echo $DB->Record["registration_no"] ?></td>
                                        <td><?php echo $DB->Record["manufacturer"] ?></td>
                                        <td><?php echo $DB->Record["permit_type"] ?></td>
                                        <td><?php echo $DB->Record["permit_expires_on"] ?></td>
                                        <td><?php echo $DB->Record["availablity"] ?></td>
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