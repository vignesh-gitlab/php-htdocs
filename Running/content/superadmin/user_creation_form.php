<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'user_creation_action.php';
$tablename = 'sr_user';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,usertype,display_name,username,password from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $usertype = $DB->Record["usertype"];
        $display_name = $DB->Record["display_name"];
        $username = $DB->Record["username"];
        $password = $DB->Record["password"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            System User
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="user_creation_grid.php">System User</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">

                    <div class="box">
                        <div id="ajaxloader" class="overlay">
                            <div class="loader_block">
                                <img src="../../theme/img/ajax-loader1.gif" class="loader_img"/>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            User Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(user_id)as max_id from $tablename";
                                            $DB->query($Query);
                                            while ($DB->Multicoloums()) {
                                                $max_id = $DB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            ?>
                                            <input type="hidden" name="user_id" class="form-control" value="<?php if ($id_error == true) echo $new_max_id; ?>">
                                            <select class="form-control dropdown_padding" name="usertype">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select usertype from master_usertype order by usertype";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($DB->Record["usertype"] != "Super Administrator") {
                                                        if ($DB->Record["usertype"] != "Client Admin") {
                                                            if ($DB->Record["usertype"] != "Client Division") {
                                                                if ($DB->Record["usertype"] != "Client Branch") {
                                                                    if ($id_error == false && $usertype == $DB->Record["usertype"]) {
                                                                        echo'<option selected>' . $DB->Record["usertype"] . '</option>';
                                                                    } else {
                                                                        echo'<option>' . $DB->Record["usertype"] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Display Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="display_name" class="form-control" value="<?php if ($id_error == false) echo $display_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span> Login Email
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="username" class="form-control" value="<?php if ($id_error == false) echo $username; ?>" placeholder="username@westernarya.com">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Password
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="password" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $password;
                                            } else {
                                                echo "westernarya";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(city) from sr_company order by city";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $city == $DB->Record["city"]) {
                                                        echo'<option selected>' . $DB->Record["city"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["city"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2" colspan="2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="button_box">
                            <button type="submit" id="submit_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                            <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                            <?php
                            if ($id_error == false) {
                                echo'<input type="hidden" name="form_action" value="Update"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else {
                                echo'<input type="hidden" name="form_action" value="Insert"/>';
                            }
                            ?>
                        </div>
                        <div id="submit_loader">
                            <img src="../../theme/img/submit_loader.gif" style="height:25px;"/>
                        </div>
                    </div>
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>