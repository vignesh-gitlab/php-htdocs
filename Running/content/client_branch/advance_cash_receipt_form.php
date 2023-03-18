<?php
include'../../template/client_branch/header.default.php';

$actionpage = 'advance_cash_receipt_action.php';
$tablename = 'sr_advance_cash_receipt';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>

<?php
if ($id_error == false) {
    $Query = "SELECT  id,receipt_no,receipt_date,client_name,division_name,branch_name,received_from,description,amount,mode_of_payment,payment_description from $tablename where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $receipt_no = $UDB->Record["receipt_no"];
        $receipt_date = $UDB->Record["receipt_date"];
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $received_from = $UDB->Record["received_from"];
        $description = $UDB->Record["description"];
        $amount = $UDB->Record["amount"];
        $mode_of_payment = $UDB->Record["mode_of_payment"];
        $payment_description = $UDB->Record["payment_description"];
    }
}
?>
<script type="text/javascript">

    function AjaxFunction_display_division_name(client_name)
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

                for (j = document.form.division_name.options.length - 1; j >= 0; j--)
                {
                    document.form.division_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.division_name.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.division_name.options.add(optn);
                    }
                }
            }
        }
        var url = "sales_order_dependent1.php";
        url = url + "?client_name=" + client_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_branch_name(division_name)
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

                for (j = document.form.branch_name.options.length - 1; j >= 0; j--)
                {
                    document.form.branch_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.branch_name.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.branch_name.options.add(optn);
                    }
                }
            }
        }
        var client_name = document.form.client_name.value;
        var url = "sales_order_dependent2.php";
        url = url + "?client_name=" + client_name + "&division_name=" + division_name;
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
        }
        else
        {
            //document.form.product_brand.readOnly = true;
            document.form.project_name.disabled = true;
            document.form.project_name.value = "";
        }
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advance Cash Receipt
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="advance_cash_receipt_grid.php">Advance Cash Receipt</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            Receipt Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(receipt_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_advance_receipt_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="receipt_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $receipt_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Receipt Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="receipt_date" class="form-control pull-right" id="purchaseorder_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $receipt_date;
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
                                            Received From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="received_from" autofocus class="form-control pull-right" value="<?php
                                            if ($id_error == false) {
                                                echo $received_from;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class="  form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_division_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
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
                                        <td  class="form_label_split2">
                                            Division Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="division_name" id="division_name" onchange="AjaxFunction_display_branch_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(division_name) from sr_client order by division_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $division_name == $DB->Record["division_name"]) {
                                                        echo'<option selected>' . $DB->Record["division_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["division_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
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
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_name" id="branch_name" onchange="AjaxFunction_display_client_details(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $branch_name == $DB->Record["branch_name"]) {
                                                        echo'<option selected>' . $DB->Record["branch_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <textarea name="description" style="height:91px;" class="form-control"><?php if ($id_error == false) echo $description; ?></textarea>
                                        </td>
                                        <td  class="form_label_split2">
                                            Payment Reference
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <textarea name="payment_description" style="height:91px;" class="form-control"><?php if ($id_error == false) echo $payment_description; ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" onsubmit="this.style.display = 'none';
                                    clear_but.style.display = 'none';
                                    submit_loader.style.display = 'block';
                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                            <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
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
                    </div><!-- /.box-body -->

            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>