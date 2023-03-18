<?php
include'../../template/client_division/header.default.php';

$actionpage = 'supervisor_action.php';
$tablename = 'sr_supervisor';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,supervisor_name,address_line1,address_line2,city,pincode,contact_no1,contact_no2,email_id,date_of_join,bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $supervisor_name = $DB->Record["supervisor_name"];
        $address_line1 = $DB->Record["address_line1"];
        $address_line2 = $DB->Record["address_line2"];
        $city = $DB->Record["city"];
        $pincode = $DB->Record["pincode"];
        $contact_no1 = $DB->Record["contact_no1"];
        $contact_no2 = $DB->Record["contact_no2"];
        $email_id = $DB->Record["email_id"];
        $date_of_join = $DB->Record["date_of_join"];
        $bank_name = $DB->Record["bank_name"];
        $bank_branch = $DB->Record["bank_branch"];
        $ac_no = $DB->Record["ac_no"];
        $ac_name = $DB->Record["ac_name"];
        $account_type = $DB->Record["ac_type"];
        $ifsc_code = $DB->Record["ifsc_code"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Supervisor
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="supervisor_grid.php">Supervisor</a></li>
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
                                            <span class="red">*&nbsp;</span>Supervisor Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="supervisor_name" class="form-control" value="<?php if ($id_error == false) echo $supervisor_name; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line1" class="form-control" value="<?php if ($id_error == false) echo $address_line1; ?>" placeholder="Address Line 1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="2">
                                            <span class="red">*&nbsp;</span>Contact Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="contact_no1" class="form-control" value="<?php if ($id_error == false) echo $contact_no1; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line 2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="contact_no2" class="form-control" value="<?php if ($id_error == false) echo $contact_no2; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="city" class="form-control" value="<?php if ($id_error == false) echo $city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="pincode" class="form-control" value="<?php if ($id_error == false) echo $pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="email_id" class="form-control" value="<?php if ($id_error == false) echo $email_id; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Date of Join
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="date_of_join" class="form-control pull-right" id="order_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $date_of_join;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Reference Documents
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="file" name="reference_documents" class="form-control" style="padding:2px;" />
                                        </td>
                                        <td  class="form_label_split2" colspan="2">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Bank Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bank_name" class="form-control" value="<?php if ($id_error == false) echo $bank_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bank Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bank_branch" class="form-control" value="<?php if ($id_error == false) echo $bank_branch; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Account Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="ac_no" class="form-control" value="<?php if ($id_error == false) echo $ac_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Account Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="ac_name" class="form-control" value="<?php if ($id_error == false) echo $ac_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Account Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="account_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select account_type from master_accounttype order by account_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $account_type == $DB->Record["account_type"]) {
                                                        echo'<option selected>' . $DB->Record["account_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["account_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            IFSC Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="ifsc_code" class="form-control" value="<?php if ($id_error == false) echo $ifsc_code; ?>">
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