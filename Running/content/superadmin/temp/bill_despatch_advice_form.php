<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'bill_despatch_advice_action.php';
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
    function AjaxFunction_display_client_details(branch_name)
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
                    document.form.address_line1.value = myarray[0];
                    document.form.address_line2.value = myarray[1];
                    document.form.city.value = myarray[2];
                    document.form.pincode.value = myarray[3];
                    document.form.contact_number.value = myarray[4];
                }
            }
        }
        var client_name = document.form.client_name.value;
        var division_name = document.form.division_name.value;
        var url = "sales_order_dependent3.php";
        url = url + "?client_name=" + client_name + "&division_name=" + division_name + "&branch_name=" + branch_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }


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
                    document.form.hd_ac_no.value = myarray[0];
                    document.form.hd_bank_branch.value = myarray[1];
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
    function calculate_total(line_id)
    {

        //var bill_amount = document.getElementById('bill_amount' + line_id).value;
        var sub_total = 0;
        //var grand_total = document.getElementById('grand_total').value;
        for (i = 1; i <= 5; i++)
        {
            sub_total = Number(sub_total) + (Number(document.getElementById('bill_amount' + line_id).value));

        }
        var grand_total_charges = Number(sub_total).toFixed(2);
        document.getElementById('grand_total').value = grand_total_charges;

    }


</script>
<aside class="right-side  strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bill Despatch Advice
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="bank_to_bank_grid.php">Bill Despatch Advice</a></li>
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
                                            Despatch Advice No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            //$Query = "SELECT max(cast(receipt_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_despatch_advice_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="despatch_advice_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $despatch_advice_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_division_name(this.value)">
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
                                            Despatch Advice Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="despatch_advice_date" class="form-control pull-right" id="despatch_advice_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $despatch_advice_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
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
                                            Branch Code
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
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="hd_name" id="hd_name" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_name; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line1" readonly name="address_line1" class="form-control" placeholder="Address Line 1" value="<?php if ($id_error == false) echo $address_line1; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Account Bank Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="hd_bank_name" id="hd_bank_name" onchange="AjaxFunction_display_bankname(this.value)">
                                                <option>Select</option>
                                            </select>
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line2" readonly name="address_line2" class="form-control" placeholder="Address Line 2" value="<?php if ($id_error == false) echo $address_line2; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Account Bank Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="hd_bank_branch" id="hd_bank_branch" readonly class="form-control" value="<?php if ($id_error == false) echo $hd_bank_branch; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <input type="text" id="city" name="city" readonly class="form-control" placeholder="City" style="float:left; width:70%;" value="<?php if ($id_error == false) echo $city; ?>">
                                            <input type="text" id="pincode" name="pincode" readonly class="form-control" placeholder="Pincode" style="float:left; width:30%;" value="<?php if ($id_error == false) echo $pincode; ?>">
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
                                            Contact No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="contact_number" readonly name="contact_number" class="form-control" placeholder="Contact Number" value="<?php if ($id_error == false) echo $contact_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:30%;">
                                            Bill No
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Bill Date
                                        </td>
                                        <td  class="form_label_multiple" style="width:30%;">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Amount
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">

                                                <input type="text"  id="bill_no<?php echo $i; ?>"  name="bill_no<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $bill_no_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="bill_date<?php echo $i; ?>" class="form-control pull-right" id="bill_date<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false) {
                                                        echo $bill_date_array[$i - 1];
                                                    } else {
                                                        echo date('d-m-Y');
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="form_content_multiple">

                                                <input type="text"  id="description<?php echo $i; ?>"  name="description<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $description_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;" id="bill_amount<?php echo $i; ?>"  name="bill_amount<?php echo $i; ?>" onblur="calculate_total(<?php echo $i; ?>)"  class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $bill_amount_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" class="form_label_multiple_right">Grand Total</td>
                                        <td colspan="1" class="form_content_multiple"><input type="text" style="text-align:right;" readonly id="grand_total" name="grand_total" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $grand_total;
                                            } else {
                                                echo"0.00";
                                            }
                                            ?>"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div><!-- /.box-body -->
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
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>