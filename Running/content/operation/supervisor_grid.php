<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'supervisor_form.php';
$tablename = 'sr_supervisor';
$return_page = '../superadmin/supervisor_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_masterdb.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Supervisor
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Supervisor</li>
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
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Supervisor Name</th>
                                    <th>Address</th>
                                    <th>Contact Numbers</th>
                                    <th>Email ID</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Supervisor Name</th>
                                    <th>Address</th>
                                    <th>Contact Numbers</th>
                                    <th>Email ID</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,supervisor_name,address_line1,address_line2,city,pincode,contact_no1,contact_no2,email_id from $tablename order by supervisor_name";
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
                                        </td>
                                        <td><?php echo $DB->Record["supervisor_name"] ?></td>
                                        <td>
                                            <?php
                                            echo $DB->Record["address_line1"] . ","
                                            . $DB->Record["address_line2"] . ","
                                            . $DB->Record["city"] . ","
                                            . $DB->Record["pincode"];
                                            ?>
                                        </td>
                                        <td><?php echo $DB->Record["contact_no1"] . "-" . $DB->Record["contact_no2"] ?></td>
                                        <td><?php echo $DB->Record["email_id"] ?></td>
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