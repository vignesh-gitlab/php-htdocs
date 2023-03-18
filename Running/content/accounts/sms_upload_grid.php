<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'sms_delivery_form.php';
$tablename = 'sr_sms_upload';
$return_page = '../accounts/sms_upload_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SMS Upload
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">SMS Upload</li>
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
                                    <th>Sender</th>
                                    <th>Date & Time</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,sender,message,delivery_date,delivery_time,message_status from $tablename order by id desc";
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
                                        </td>
                                        <td><?php echo $UDB->Record["sender"] ?></td>
                                        <td><?php echo $UDB->Record["delivery_date"] . " " . $UDB->Record["delivery_time"] ?></td>
                                        <td><?php echo $UDB->Record["message"] ?></td>
                                        <td><?php echo $UDB->Record["message_status"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Sender</th>
                                    <th>Date & Time</th>
                                    <th>Message</th>
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