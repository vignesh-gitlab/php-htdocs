<?php
include'../../template/client_branch/header.default.php';

$actionpage = 'escort_action.php';
$tablename = 'sr_escort';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,escart_name,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,escart_type,contractor_name,description from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $escart_name = $DB->Record["escart_name"];
        $address_line1 = $DB->Record["address_line1"];
        $address_line2 = $DB->Record["address_line2"];
        $city = $DB->Record["city"];
        $pincode = $DB->Record["pincode"];
        $telephone_no = $DB->Record["telephone_no"];
        $mobile_no = $DB->Record["mobile_no"];
        $email_id = $DB->Record["email_id"];
        $escart_type = $DB->Record["escart_type"];
        $contractor_name = $DB->Record["contractor_name"];
        $description = $DB->Record["description"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Escort
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="escort_grid.php">Escort</a></li>
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
                                            <span class="red">*&nbsp;</span>Escort Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="escart_name" class="form-control" value="<?php if ($id_error == false) echo $escart_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Escort Type
                                        </td>

                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="escart_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select contract_status from sr_contract_status order by contract_status";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $escart_type == $DB->Record["contract_status"]) {
                                                        echo'<option selected>' . $DB->Record["contract_status"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["contract_status"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line1" class="form-control" value="<?php if ($id_error == false) echo $address_line1; ?>" placeholder="Address Line 1">
                                        </td>
                                        </td>
                                        <td  class="form_label_split2">
                                            Contractor Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="contractor_name" class="form-control" value="<?php if ($id_error == false) echo $contractor_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line 2">
                                        </td>
                                        <td  class="form_label_split2" rowspan="2">
                                            <span class="red">*&nbsp;</span>Mobile Number
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
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no" class="form-control" value="<?php if ($id_error == false) echo $mobile_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="description" class="form-control" value="<?php if ($id_error == false) echo $description; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Email ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id" class="form-control" value="<?php if ($id_error == false) echo $email_id; ?>">
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