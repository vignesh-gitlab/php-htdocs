<?php
include'../../template/accounts/header.default.php';

$actionpage = 'change_password_action.php';
$tablename = 'sr_user';
?>

<script type="text/javascript">

    function checkForm(form)
    {
        if (form.new_password.value != form.confirmpassword.value) {
            alert("Error: Password Mismatch!");
            return false;
        } else
        {
            return true;
        }
    }

</script>

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Setting</li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" action="<?php echo $actionpage; ?>" onsubmit="return checkForm(this);" enctype="multipart/form-data" autocomplete="off">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <?php
                            if (isset($_REQUEST["msg"])) {
                                if ($_REQUEST["msg"] == "Please Enter Correct Old Password!") {
                                    echo'<br><div class="alert alert-danger alert-dismissable">';
                                    echo'<i class="fa fa-ban"></i>';
                                    echo'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                    echo'<b>Error! </b>' . $_REQUEST["msg"];
                                    echo'</div>';
                                }
                            }
                            ?>
                            <div class="form_tablebox">
                                <span class="mandatory"><span class="red">*</span> Fields are mandatory</span>
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            User Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username'] ?>" readonly>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Existing Password
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="password" name="password" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>New Password
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="password" name="new_password" class="form-control" pattern="[a-zA-Z0-9]{8,13}" placeholder="8-13 Alpha Numeric Characters" required>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Confirm Password
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="password" name="confirmpassword" class="form-control" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <?php
                        if ($id_error == false) {
                            echo'<input type="hidden" name="form_action" value="Update"/>';
                            echo'<input type="hidden" name="id" value="' . $id . '"/>';
                        } else {
                            echo'<input type="hidden" name="form_action" value="Insert"/>';
                        }
                        ?>
                    </div>
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>