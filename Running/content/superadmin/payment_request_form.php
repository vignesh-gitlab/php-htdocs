<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'payment_request_action.php';
$tablename = 'sr_payment_request';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["payment_no"])) || (empty($_REQUEST["payment_no"]))) {
    $order_error = true;
}


$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>

<?php
if ($id_error == false) {
    $Query = "SELECT id,payment_id,payment_no,order_no,branch_code,branch_name,description,po_number,po_amount,payment_type,amount,payment_description,pr_status from $tablename where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $payment_id = $UDB->Record["payment_id"];
        $payment_no = $UDB->Record["payment_no"];
        $order_no = $UDB->Record["order_no"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_name = $UDB->Record["branch_name"];
        $description = $UDB->Record["description"];
        $po_number = $UDB->Record["po_number"];
        $po_amount = $UDB->Record["po_amount"];
        $payment_type = $UDB->Record["payment_type"];
        $amount = $UDB->Record["amount"];
        $payment_description = $UDB->Record["payment_description"];
        $pr_status = $UDB->Record["pr_status"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_po_amount(po_no)
    {
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
                    document.form.po_amount.value = myarray[0];
                    //document.form.contact_number.value = myarray[4];
                }
            }
        }
        var url = "payment_request_dependent1.php";
        url = url + "?po_no=" + po_no;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
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
            Payment Request
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="payment_request_grid.php">Payment Request</a></li>
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
                                            Payment Request No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(payment_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_payment_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="payment_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $payment_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_code">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select branch_code from sr_company  where company_type='Branch Office' order by branch_code";
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
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select company_name,city from sr_company where company_type='Branch Office' order by company_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $branch_name == $DB->Record["company_name"] . '-' . $DB->Record["city"]) {
                                                        echo'<option selected>' . $DB->Record["company_name"] . '-' . $DB->Record["city"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["company_name"] . '-' . $DB->Record["city"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            PO Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" onchange="AjaxFunction_display_po_amount(this.value)" id="po_number" name="po_number">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select po_no from sr_purchase_order order by po_no";
                                                $UDB->query($Query);

                                                while ($UDB->Multicoloums()) {
                                                    if ($id_error == false && $po_number == $UDB->Record["po_no"]) {
                                                        echo'<option selected>' . $UDB->Record["po_no"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $UDB->Record["po_no"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon" >
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" name="amount" class="form-control pull-right" value="<?php
                                                if ($id_error == false) {
                                                    echo $amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            PO Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon" >
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" id="po_amount" name="po_amount" class="form-control pull-right" value="<?php
                                                if ($id_error == false) {
                                                    echo $po_amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                   <!--     <td  class="form_label_split2">
                                            Payment Mode
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="payment_mode">
                                                <option>Select</option>
                                        <?php
                                        $Query = "select payment_mode from master_payment_mode order by payment_mode";
                                        $DB->query($Query);

                                        while ($DB->Multicoloums()) {
                                            if ($id_error == false && $mode_of_payment == $DB->Record["payment_mode"]) {
                                                echo'<option selected>' . $DB->Record["payment_mode"] . '</option>';
                                            } else {
                                                echo'<option>' . $DB->Record["payment_mode"] . '</option>';
                                            }
                                        }
                                        ?>
                                            </select>
                                        </td>-->
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Payment Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" id="payment_type" name="payment_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select payment_type from master_payment_type order by payment_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $payment_type == $DB->Record["payment_type"]) {
                                                        echo'<option selected>' . $DB->Record["payment_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["payment_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2" colspan="2">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Payment Reference
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <textarea name="payment_description" style="height:56px;" class="form-control"><?php if ($id_error == false) echo $payment_description; ?></textarea>
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