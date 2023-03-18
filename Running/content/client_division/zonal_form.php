<?php
include'../../template/client_division/header.default.php';

$actionpage = 'zonal_action.php';
$tablename = 'sr_company';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,branch_id,branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,fax_no,email_id,website_id,tin_no,cst_no from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $branch_id = $DB->Record["branch_id"];
        $branch_code = $DB->Record["branch_code"];
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
            Zonal Branch
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="zonal_grid.php">Zonal Branch</a></li>
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
                                            <?php
                                            $Query = "SELECT max(cast(branch_id as unsigned))as max_id from $tablename";
                                            $DB->query($Query);
                                            while ($DB->Multicoloums()) {
                                                $max_id = $DB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_branch_code = $commonvar_branch_code_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="branch_code" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $branch_code;
                                            } else {
                                                echo $new_max_branch_code;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="company_name" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $company_name;
                                            else
                                                echo $company_name;
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
                                            Branch Caption
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="company_caption" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $company_caption;
                                            else
                                                echo $company_caption;
                                            ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line 2">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="telephone_no" class="form-control" value="<?php if ($id_error == false) echo $telephone_no; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="city" class="form-control" value="<?php if ($id_error == false) echo $city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="pincode" class="form-control" value="<?php if ($id_error == false) echo $pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="mobile_no" class="form-control" value="<?php if ($id_error == false) echo $mobile_no; ?>">
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
                                            Fax Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="fax_no" class="form-control" value="<?php if ($id_error == false) echo $fax_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Website URL
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="website_id" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $website_id;
                                            else
                                                echo $website_id;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            TIN Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="tin_no" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $tin_no;
                                            else
                                                echo $tin_no;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            CST Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="cst_no" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $cst_no;
                                            else
                                                echo $cst_no;
                                            ?>">
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
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