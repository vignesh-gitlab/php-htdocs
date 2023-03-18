<?php
include'../../template/client_division/header.default.php';

$actionpage = 'branch_bank_action.php';
$tablename = 'sr_branch_bank';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
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
                    document.form.company_name.value = myarray[0];
                    document.form.company_caption.value = myarray[1];
                    document.form.address_line1.value = myarray[2];
                    document.form.address_line2.value = myarray[3];
                    document.form.city.value = myarray[4];
                    document.form.pincode.value = myarray[5];
                    document.form.telephone_no.value = myarray[6];
                    document.form.mobile_no.value = myarray[7];
                    document.form.fax_no.value = myarray[8];
                    document.form.email_id.value = myarray[9];
                    document.form.website_id.value = myarray[10];
                    document.form.tin_no.value = myarray[11];
                    document.form.cst_no.value = myarray[12];

                    document.form.company_name.readOnly = true;
                    document.form.name.readOnly = true;
                    document.form.address_line1.readOnly = true;
                    document.form.address_line2.readOnly = true;
                    document.form.city.readOnly = true;
                    document.form.pincode.readOnly = true;
                    document.form.telephone_number.readOnly = true;
                    document.form.mobile_number.readOnly = true;
                    document.form.email_id.readOnly = true;
                }
            }
        }
        var url = "branch_bank_dependent1.php"
        var client_list = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
</script>
<?php
if ($id_error == false) {
    $Query = "SELECT  id,branch_code,bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code,minimum_balance,account_balance from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $branch_code = $DB->Record["branch_code"];
        $bank_name = $DB->Record["bank_name"];
        $bank_branch = $DB->Record["bank_branch"];
        $ac_no = $DB->Record["ac_no"];
        $ac_name = $DB->Record["ac_name"];
        $account_type = $DB->Record["ac_type"];
        $ifsc_code = $DB->Record["ifsc_code"];
        $minimum_balance = $DB->Record["minimum_balance"];
        $account_balance = $DB->Record["account_balance"];
    }
    $Query = "SELECT  id,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,fax_no,email_id,website_id,tin_no,cst_no from sr_company where branch_code='" . $branch_code . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $company_name = $DB->Record["company_name"];
        $company_caption = $DB->Record["company_caption"];
        $address_line1 = $DB->Record["address_line1"];
        $address_line2 = $DB->Record["address_line2"];
        $city = $DB->Record["city"];
        $pincode = $DB->Record["pincode"];
        $telephone_no = $DB->Record["telephone_no"];
        $mobile_no = $DB->Record["mobile_no"];
        $fax_no = $DB->Record["fax_no"];
        $email_id = $DB->Record["email_id"];
        $website_id = $DB->Record["website_id"];
        $tin_no = $DB->Record["tin_no"];
        $cst_no = $DB->Record["cst_no"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="branch_bank_grid.php">Bank</a></li>
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
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="company_name" id="company_name" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $company_name;
                                            ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="address_line1" id="address_line1" class="form-control" value="<?php if ($id_error == false) echo $address_line1; ?>" placeholder="Address Line 1">
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Caption
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="company_caption" id="company_caption" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $company_caption;
                                            ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="address_line2" id="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line 2">
                                        </td>
                                        <td  class="form_label_split2">
                                            Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="telephone_no" id="telephone_no" class="form-control" value="<?php if ($id_error == false) echo $telephone_no; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="city" id="city" class="form-control" value="<?php if ($id_error == false) echo $city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" readonly name="pincode" id="pincode" class="form-control" value="<?php if ($id_error == false) echo $pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="mobile_no" id="mobile_no" class="form-control" value="<?php if ($id_error == false) echo $mobile_no; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="email_id" id="email_id" class="form-control" value="<?php if ($id_error == false) echo $email_id; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Fax Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="fax_no" id="fax_no" class="form-control" value="<?php if ($id_error == false) echo $fax_no; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Website URL
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="website_id" id="website_id" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $website_id;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            TIN Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="tin_no" id="tin_no" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $tin_no;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            CST Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="cst_no" id="cst_no" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $cst_no;
                                            ?>">
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
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
                                            <select class="form-control dropdown_padding" name="bank_name">
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
                                            <span class="red">*&nbsp;</span>Account Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="ac_no" class="form-control" value="<?php if ($id_error == false) echo $ac_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Account Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="ac_name" class="form-control" value="<?php if ($id_error == false) echo $ac_name; ?>">
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
                                    <tr>
                                        <td  class="form_label_split2">
                                            Minimum Balance
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="minimum_balance" class="form-control" value="<?php if ($id_error == false) echo $minimum_balance; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Account Balance
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="account_balance" class="form-control" value="<?php if ($id_error == false) echo $account_balance; ?>">
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