<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$user_form_page = 'user_creation_form.php';
$client_form_page = 'user_creation_client_form.php';
$tablename = 'sr_user';
$return_page = '../superadmin/user_creation_grid.php';
$user_menu_page = 'user_menu_form.php';
$user_approval_page = 'user_approval_form.php';
?>

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            System User
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">System User</li>
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
                                        <a href="<?php echo $user_form_page; ?>" title="Add New User"><i class="fa fa-fw fa-plus"></i>&nbsp;New User</a>
                                        <a href="<?php echo $client_form_page; ?>" title="Add New Client User"><i class="fa fa-fw fa-plus"></i>&nbsp; New Client User</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>User Type</th>
                                    <th>Client Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Division</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>User Type</th>
                                    <th>Client Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Division</th>
                                    <th>Branch</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,usertype,display_name,username,password,division,branch,division1,branch1,division2,branch2 from $tablename order by usertype";
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
                                            <a href="<?php echo $user_menu_page . "?usertype=" . $DB->Record["usertype"]; ?>&userid=<?php echo $DB->Record["id"]; ?>&username=<?php echo $DB->Record["username"]; ?>" title="Add Menu"><i class="fa fa-fw fa-plus"></i></a>
                                            <a href="<?php echo $user_approval_page . "?usertype=" . $DB->Record["usertype"]; ?>&userid=<?php echo $DB->Record["id"]; ?>&username=<?php echo $DB->Record["username"]; ?>" title="Add Approval"><i class="fa fa-fw fa-plus"></i></a>
                                        </td>
                                        <td><?php echo $DB->Record["usertype"] ?></td>
                                        <td><?php echo $DB->Record["display_name"] ?></td>
                                        <td><?php echo $DB->Record["username"] ?></td>
                                        <td>
                                            <i class="fa fa fa-asterisk" title="<?php echo $DB->Record["password"] ?>"></i>
                                            <i class="fa fa fa-asterisk" title="<?php echo $DB->Record["password"] ?>"></i>
                                            <i class="fa fa fa-asterisk" title="<?php echo $DB->Record["password"] ?>"></i>
                                            <i class="fa fa fa-asterisk" title="<?php echo $DB->Record["password"] ?>"></i>
                                            <i class="fa fa fa-asterisk" title="<?php echo $DB->Record["password"] ?>"></i>
                                        </td>
                                        <td><?php echo $DB->Record["division"] . ",<br>" . $DB->Record["division1"] . ",<br>" . $DB->Record["division2"] ?></td>
                                        <td><?php echo $DB->Record["branch"] . ",<br>" . $DB->Record["branch1"] . ",<br>" . $DB->Record["branch2"] ?></td>
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