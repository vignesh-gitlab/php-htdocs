<?php
include'../../template/operation/header.default.php';

$actionpage = 'travel_reimbursement_action.php';
$tablename = 'sr_travel_reimbursement';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["travel_reimbursement_no"])) || (empty($_REQUEST["travel_reimbursement_no"]))) {
    $order_error = true;
}
$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>

<?php
if ($id_error == false) {
    $Query = "SELECT id,travel_reimbursement_id,travel_reimbursement_no,employee_no,employee_name,amount,description,invoice_copy,tr_status from $tablename where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $travel_reimbursement_id = $UDB->Record["travel_reimbursement_id"];
        $travel_reimbursement_no = $UDB->Record["travel_reimbursement_no"];
        $employee_no = $UDB->Record["employee_no"];
        $employee_name = $UDB->Record["employee_name"];
        $amount = $UDB->Record["amount"];
        $description = $UDB->Record["description"];
        $invoice_copy = $UDB->Record["invoice_copy"];
        $tr_status = $UDB->Record["tr_status"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_product(payment_category)
    {
        if (payment_category == "To Project")
        {
            //document.form.product_brand.readOnly = false;
            document.form.project_name.disabled = false;
            document.form.project_name.value = "Select";
        } else
        {
            //document.form.product_brand.readOnly = true;
            document.form.project_name.disabled = true;
            document.form.project_name.value = "";
        }
    }
</script>
<aside class="right-side  strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Travel Reimbursement
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="travel_reimbursement_grid.php">Travel Reimbursement</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Travel Reimbursement No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(travel_reimbursement_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_travel_reimbursement_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="travel_reimbursement_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $travel_reimbursement_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Employee No
                                        </td>
                                        <td class="form_content_split2">
                                            <select class="chosen-select form-control dropdown_padding" name="employee_no">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(employee_no) from sr_employee order by employee_no";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $employee_no == $DB->Record["employee_no"]) {
                                                        echo'<option selected>' . $DB->Record["employee_no"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["employee_no"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Employee Name
                                        </td>
                                        <td class="form_content_split2">
                                            <select class="chosen-select form-control dropdown_padding" name="employee_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(employee_name) from sr_employee order by employee_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $employee_name == $DB->Record["employee_name"]) {
                                                        echo'<option selected>' . $DB->Record["employee_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["employee_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center" rowspan="3">
                                            <textarea name="description" style="height:82px;" class="form-control"><?php if ($id_error == false) echo $description; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" name="amount" class="form-control pull-right" value="<?php
                                                if ($id_error == false) {
                                                    echo $amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Invoice Copy
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="file" class="form-control" name="invoice_copy" id="invoice_copy" style="padding:0px;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php
                            if ($order_error != false) {
                                ?>
                                <button type="submit" onsubmit="this.style.display = 'none';
                                        clear_but.style.display = 'none';
                                        submit_loader.style.display = 'block';
                                        ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($order_error == false) {
                                        ?>
                                <button type="submit" onsubmit="this.style.display = 'none';
                                        clear_but.style.display = 'none';
                                        submit_loader.style.display = 'block';
                                        ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Approve</button>
                                        <?php
                                    }
                                    ?>
                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                            <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
                            <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                            <?php
                            if ($id_error == false && $order_error != false) {
                                echo'<input type="hidden" name="form_action" value="Update"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else if ($order_error == false) {
                                echo'<input type="hidden" name="approval" value="Approve"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else {
                                echo'<input type="hidden" name="form_action" value="Insert"/>';
                            }
                            ?>
                        </div>
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>