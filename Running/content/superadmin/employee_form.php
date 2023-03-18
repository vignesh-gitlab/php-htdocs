<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'employee_action.php';
$tablename = 'sr_employee';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,employee_id,employee_no,employee_name,branch_code,branch_name,address_line1,address_line2,city,pincode,telephone_number,mobile_number,email_id,bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $employee_id = $DB->Record["employee_id"];
        $employee_no = $DB->Record["employee_no"];
        $employee_name = $DB->Record["employee_name"];
        $branch_code = $DB->Record["branch_code"];
        $branch_name = $DB->Record["branch_name"];
        $address_line1 = $DB->Record["address_line1"];
        $address_line2 = $DB->Record["address_line2"];
        $city = $DB->Record["city"];
        $pincode = $DB->Record["pincode"];
        $telephone_number = $DB->Record["telephone_number"];
        $mobile_number = $DB->Record["mobile_number"];
        $email_id = $DB->Record["email_id"];
        $bank_name = $DB->Record["bank_name"];
        $bank_branch = $DB->Record["bank_branch"];
        $ac_no = $DB->Record["ac_no"];
        $ac_name = $DB->Record["ac_name"];
        $account_type = $DB->Record["ac_type"];
        $ifsc_code = $DB->Record["ifsc_code"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_bank(branch_code)
    {
        //var client_list = encodeURIComponent(client_list);
        var httpxml;
        try
        {
            // Firefox, Opera 8.0+, Safari
            httpxml = new XMLHttpRequest();
        } catch (e)
        {
            // Internet Explorer
            try
            {
                httpxml = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e)
            {
                try
                {
                    httpxml = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e)
                {
                    alert("Your browser does not support AJAX!");
                    return false;
                }
            }
        }
        function stateck()
        {

            if (httpxml.readyState == 4)
            {
                var myarray = eval(httpxml.responseText);

                if (myarray.length > 0)
                {
                    document.form.branch_name.value = myarray[0];
                }
            }
        }
        var url = "employee_dependent1.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employee
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="employee_grid.php">Employee</a></li>
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
                                            Employee No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(employee_id as unsigned))as max_id from $tablename";
                                            $DB->query($Query);
                                            while ($DB->Multicoloums()) {
                                                $max_id = $DB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_employee_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="employee_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $employee_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Employee Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="employee_name" class="form-control" value="<?php if ($id_error == false) echo $employee_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_code" id="branch_code" onchange="AjaxFunction_display_bank(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_company order by branch_code";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $branch_code == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Name & City
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="branch_name" id="branch_name" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $branch_name;
                                            ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line1" class="form-control" value="<?php if ($id_error == false) echo $address_line1; ?>" placeholder="Address Line 1">
                                        </td>
                                        <td  class="form_label_split2">
                                            Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="telephone_number" class="form-control" value="<?php if ($id_error == false) echo $telephone_number; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line 2">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="mobile_number" class="form-control" value="<?php if ($id_error == false) echo $mobile_number; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="city" class="form-control" value="<?php if ($id_error == false) echo $city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="pincode" class="form-control" value="<?php if ($id_error == false) echo $pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="email_id" class="form-control" value="<?php if ($id_error == false) echo $email_id; ?>">
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
                                        <td class="form_content_split2">
                                            <select class="chosen-select form-control dropdown_padding" name="bank_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(bank_name) from master_bank_name order by bank_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $bank_name == $DB->Record["bank_name"]) {
                                                        echo'<option selected>' . $DB->Record["bank_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["bank_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
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
                                        <td class="form_content_split2">
                                            <select class="chosen-select form-control dropdown_padding" name="account_type">
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