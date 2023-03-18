<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'client_division_action.php';
$tablename = 'sr_client';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,client_name,division_name,address_line1,address_line2,city,pincode,telephone_no,mobile_no,fax_no,email_id,tin_no,contact_person_name1,telephone_no1,mobile_no1,email_id1,contact_person_name2,telephone_no2,mobile_no2,email_id2,contact_person_name3,telephone_no3,mobile_no3,email_id3,cst_no from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $client_name = $DB->Record["client_name"];
        $division_name = $DB->Record["division_name"];
        $address_line1 = $DB->Record["address_line1"];
        $address_line2 = $DB->Record["address_line2"];
        $city = $DB->Record["city"];
        $pincode = $DB->Record["pincode"];
        $telephone_no = $DB->Record["telephone_no"];
        $mobile_no = $DB->Record["mobile_no"];
        $fax_no = $DB->Record["fax_no"];
        $email_id = $DB->Record["email_id"];
        $tin_no = $DB->Record["tin_no"];
        $cst_no = $DB->Record["cst_no"];
        $contact_person_name1 = $DB->Record["contact_person_name1"];
        $telephone_no1 = $DB->Record["telephone_no1"];
        $mobile_no1 = $DB->Record["mobile_no1"];
        $email_id1 = $DB->Record["email_id1"];
        $contact_person_name2 = $DB->Record["contact_person_name2"];
        $telephone_no2 = $DB->Record["telephone_no2"];
        $mobile_no2 = $DB->Record["mobile_no2"];
        $email_id2 = $DB->Record["email_id2"];
        $contact_person_name3 = $DB->Record["contact_person_name3"];
        $telephone_no3 = $DB->Record["telephone_no3"];
        $mobile_no3 = $DB->Record["mobile_no3"];
        $email_id3 = $DB->Record["email_id3"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client Division
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="client_division_grid.php">Client Division</a></li>
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
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client where company_type='Head Office' order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $client_name == $DB->Record["client_name"]) {
                                                        echo'<option selected>' . $DB->Record["client_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["client_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Division Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="division_name" class="form-control" value="<?php if ($id_error == false) echo $division_name; ?>">
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
                                            <span class="red">*&nbsp;</span>Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="telephone_no" class="form-control" value="<?php if ($id_error == false) echo $telephone_no; ?>">
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
                                            <input type="text" required name="mobile_no" class="form-control" value="<?php if ($id_error == false) echo $mobile_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="city" class="form-control" value="<?php if ($id_error == false) echo $city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="pincode" class="form-control" value="<?php if ($id_error == false) echo $pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
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
                                            <span class="red">*&nbsp;</span>Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="email_id" class="form-control" value="<?php if ($id_error == false) echo $email_id; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            TIN Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="tin_no" class="form-control" value="<?php if ($id_error == false) echo $tin_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            CST Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="cst_no" class="form-control" value="<?php if ($id_error == false) echo $cst_no; ?>">
                                        </td>
                                        <td  class="form_label_split2" colspan="2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Contact Person
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="contact_person_name1" class="form-control" value="<?php if ($id_error == false) echo $contact_person_name1; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="telephone_no1" class="form-control" value="<?php if ($id_error == false) echo $telephone_no1; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no1" class="form-control" value="<?php if ($id_error == false) echo $mobile_no1; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id1" class="form-control" value="<?php if ($id_error == false) echo $email_id1; ?>">
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
                                            Contact Person
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="contact_person_name2" class="form-control" value="<?php if ($id_error == false) echo $contact_person_name2; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="telephone_no2" class="form-control" value="<?php if ($id_error == false) echo $telephone_no2; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no2" class="form-control" value="<?php if ($id_error == false) echo $mobile_no2; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id2" class="form-control" value="<?php if ($id_error == false) echo $email_id2; ?>">
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
                                            Contact Person
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="contact_person_name3" class="form-control" value="<?php if ($id_error == false) echo $contact_person_name3; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Telephone Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="telephone_no3" class="form-control" value="<?php if ($id_error == false) echo $telephone_no3; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Mobile Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no3" class="form-control" value="<?php if ($id_error == false) echo $mobile_no3; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id3" class="form-control" value="<?php if ($id_error == false) echo $email_id3; ?>">
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