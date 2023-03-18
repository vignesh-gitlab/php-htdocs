<?php
include'../../template/client/header.default.php';

$actionpage = 'bank_to_bank_action.php';
$tablename = 'sr_bank_to_bank';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $order_error = true;
}
$payment_error = false;
if ((!isset($_REQUEST["payment_no"])) || (empty($_REQUEST["payment_no"]))) {
    $payment_error = true;
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>

<?php
if ($payment_error == false) {
    $Query = "SELECT id,payment_no,order_no,branch_code,branch_name,amount from sr_payment_request where payment_no='" . $_REQUEST["payment_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $payment_no = $UDB->Record["payment_no"];
        $order_no = $UDB->Record["order_no"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_name = $UDB->Record["branch_name"];
        $amount = $UDB->Record["amount"];
    }
    $Query = "SELECT branch_code,bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code from sr_branch_bank where branch_code='" . $branch_code . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $branch_code = $DB->Record["branch_code"];
        $bank_name = $DB->Record["bank_name"];
        $bank_branch = $DB->Record["bank_branch"];
        $ac_no = $DB->Record["ac_no"];
        $ac_name = $DB->Record["ac_name"];
        $account_type = $DB->Record["ac_type"];
        $ifsc_code = $DB->Record["ifsc_code"];
    }
}

if ($id_error == false) {
    $Query = "SELECT id,hd_code,hd_name,hd_bank_name,hd_bank_branch,hd_ac_no,payment_no,branch_code,branch_name,bank_name,bank_branch,ac_no,amount,description,payment_mode  from $tablename where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $hd_code = $UDB->Record["hd_code"];
        $hd_name = $UDB->Record["hd_name"];
        $hd_bank_name = $UDB->Record["hd_bank_name"];
        $hd_bank_branch = $UDB->Record["hd_bank_branch"];
        $hd_ac_no = $UDB->Record["hd_ac_no"];
        $payment_no = $UDB->Record["payment_no"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_name = $UDB->Record["branch_name"];
        $bank_name = $UDB->Record["bank_name"];
        $bank_branch = $UDB->Record["bank_branch"];
        $ac_no = $UDB->Record["ac_no"];
        $amount = $UDB->Record["amount"];
        $description = $UDB->Record["description"];
        $payment_mode = $UDB->Record["payment_mode"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_bank1(branch_code)
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

                for (j = document.form.hd_bank_name.options.length - 1; j >= 0; j--)
                {
                    document.form.hd_bank_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    document.form.hd_name.value = myarray[0];
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.hd_bank_name.options.add(optn);
                    for (i = 1; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.hd_bank_name.options.add(optn);
                    }
                }
            }
        }
        var url = "bank_to_bank_dependent1.php"
        var client_list = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }

    function AjaxFunction_display_bankname(bank_name)
    {
        var branch_code = document.getElementById("hd_code").value;
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
                    document.form.hd_bank_branch.value = myarray[0];
                    document.form.hd_ac_no.value = myarray[1];
                    document.form.hd_ac_bal.value = myarray[2];
                }
            }
        }
        var url = "bank_to_bank_dependent3.php"
        url = url + "?branch_code=" + branch_code + "&bank_name=" + bank_name;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }

    function AjaxFunction_display_bank2(payment_no)
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
                    document.form.branch_code.value = myarray[0];
                    document.form.branch_name.value = myarray[1];
                    document.form.bank_name.value = myarray[4];
                    document.form.bank_branch.value = myarray[5];
                    document.form.amount.value = myarray[6];
                    document.form.description.value = myarray[3];
                    document.form.ac_no.value = myarray[2];
                }
            }
        }
        var url = "bank_to_bank_dependent2.php"
        url = url + "?payment_no=" + payment_no;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
</script>
<aside class="right-side  strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank - To - Bank Transfer
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="bank_to_bank_grid.php">Bank - To - Bank Transfer</a></li>
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
                                            From Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="hd_code" id="hd_code" onchange="AjaxFunction_display_bank1(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select branch_code from sr_company order by branch_code";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $hd_code == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            From Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="hd_name" id="hd_name" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            From Account Bank Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="hd_bank_name" id="hd_bank_name" onchange="AjaxFunction_display_bankname(this.value)">
                                                <option>Select</option>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            From Account Bank Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="hd_bank_branch" id="hd_bank_branch" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_bank_branch; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            From Account A/C Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="hd_ac_no" id="hd_ac_no" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_ac_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            From Account Current Balance
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text"  name="hd_ac_bal" id="hd_ac_bal" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_ac_bal; ?>">
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
                                            Payment Request No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="payment_no" onchange="AjaxFunction_display_bank2(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select payment_no from sr_payment_request order by payment_no";
                                                $UDB->query($Query);

                                                while ($UDB->Multicoloums()) {
                                                    if (($id_error == false || $payment_error == false) && $payment_no == $UDB->Record["payment_no"]) {
                                                        echo'<option selected>' . $UDB->Record["payment_no"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $UDB->Record["payment_no"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text"  name="branch_code" id="branch_code" readonly class="form-control" value="<?php if ($id_error == false || $payment_error == false) echo $branch_code; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text"  name="branch_name" id="branch_name" readonly class="form-control" value="<?php if ($id_error == false || $payment_error == false) echo $branch_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bank Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text"  name="bank_name" readonly id="bank_name" class="form-control" value="<?php if ($id_error == false || $payment_error == false) echo $bank_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Bank Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bank_branch" readonly id="bank_branch" class="form-control" value="<?php if ($id_error == false || $payment_error == false) echo $bank_branch; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Account Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text"  name="ac_no" id="ac_no" readonly class="form-control" value="<?php if ($id_error == false || $payment_error == false) echo $ac_no; ?>">
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
                                                <input type="text" name="amount" id="amount" class="form-control pull-right" value="<?php
                                                if ($id_error == false || $payment_error == false) {
                                                    echo $amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                        <td  class="form_label_split2" rowspan="2">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center" rowspan="2">
                                            <textarea name="description" id="description" style="height:56px;" class="form-control"><?php if ($id_error == false) echo $description; ?></textarea>
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
                                                    if ($id_error == false && $payment_mode == $DB->Record["payment_mode"]) {
                                                        echo'<option selected>' . $DB->Record["payment_mode"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["payment_mode"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

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