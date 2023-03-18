<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'user_approval_action.php';
$tablename = 'sr_user_approval';


$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
$userid_error = false;
if ((!isset($_REQUEST["userid"])) || (empty($_REQUEST["userid"]))) {
    $userid_error = true;
}
$username_error = false;
if ((!isset($_REQUEST["username"])) || (empty($_REQUEST["username"]))) {
    $username_error = true;
}

if ($userid_error == false) {
    $Query = "SELECT id,usertype,username from sr_user where id= '" . $_REQUEST["userid"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $usertype = $DB->Record["usertype"];
        $username = $DB->Record["username"];
    }
}
if ($username_error == false) {
    $Query1 = "SELECT id,usertype,username,po_approval_amount,fr_approval_amount,mr_approval_amount,pa_approval_amount,cr_approval_amount,pr_approval_amount from $tablename where username= '" . $_REQUEST["username"] . "'";
    $DB1->query($Query1);
    while ($DB1->Multicoloums()) {
        //$menu_name_array[] = $DB1->Record["menu_name"];
        $po_approval_amount = $DB1->Record["po_approval_amount"];
        $fr_approval_amount = $DB1->Record["fr_approval_amount"];
        $mr_approval_amount = $DB1->Record["mr_approval_amount"];
        $pa_approval_amount = $DB1->Record["pa_approval_amount"];
        $cr_approval_amount = $DB1->Record["cr_approval_amount"];
        $pr_approval_amount = $DB1->Record["pr_approval_amount"];
    }
}

/* if ($id_error == false) {
  $Query = "SELECT id,usertype,display_name,username,password from $tablename where id='" . $_REQUEST["id"] . "'";
  $DB->query($Query);
  while ($DB->Multicoloums()) {
  $usertype = $DB->Record["usertype"];
  $display_name = $DB->Record["display_name"];
  $username = $DB->Record["username"];
  $password = $DB->Record["password"];
  }
  } */
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Approval
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="user_creation_grid.php">System User</a></li>
            <li class="active">User Approval</li>
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
                                        <td class="form_content_split2" align="left">
                                            <input type="text" readonly name="usertype" class="form-control" value="<?php if ($id_error == false || $userid_error == false) echo $usertype; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            UserName
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" readonly name="username" class="form-control" value="<?php if ($id_error == false || $userid_error == false) echo $username; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Purchase Order Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="po_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $po_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Frieght Bill Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="fr_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $fr_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Money Receipt Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="mr_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $mr_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Payment Advice Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="pa_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $pa_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Cash Receipt Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="cr_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $cr_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Payment Request Approval
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="pr_approval_amount">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(user_approval_amount) from master_user_approval_amount order by user_approval_amount";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $username_error == false) && $pr_approval_amount == $DB->Record["user_approval_amount"]) {
                                                        echo'<option selected>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["user_approval_amount"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
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