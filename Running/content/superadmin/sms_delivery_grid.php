<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'sms_delivery_form.php';
$tablename = 'sr_sms_delivery';
$return_page = '../superadmin/mail_delivery_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SMS Delivery
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">SMS Delivery</li>
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
                                <?php
                                $ch = curl_init('http://www.smsintegra.com/smsweb/desktop_sms/chk_credit.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD);
                                //$Rec_Data = curl_exec($ch);
                                //$sms_count_split = explode("-",$Rec_Data);
                                ?>
                                <tr>
                                    <td colspan="10"><b><?php curl_exec($ch); ?> SMS</b></th>
                                </tr>
                                <?php
                                curl_close($ch);
                                ?>
                                <tr>
                                    <th>Action</th>
                                    <th>Send Time</th>
                                    <th>Send To</th>
                                    <th>Message</th>
                                    <th>SMS Count</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Send Time</th>
                                    <th>Send To</th>
                                    <th>Message</th>
                                    <th>SMS Count</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,sent_time,sent_to,sms_count,message from $tablename where sent_to<>'' order by id desc";
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
                                        <td><?php echo $UDB->Record["sent_time"] ?></td>
                                        <td><?php echo str_replace(",", "<br>", $UDB->Record["sent_to"]) ?></td>
                                        <td><?php echo $UDB->Record["message"] ?></td>
                                        <td><?php echo $UDB->Record["sms_count"] ?></td>
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