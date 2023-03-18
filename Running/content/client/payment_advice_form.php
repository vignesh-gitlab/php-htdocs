<?php
include'../../template/client/header.default.php';

$actionpage = 'payment_advice_action.php';
$tablename = 'sr_payment_advice';
$tablename1 = 'sr_payment_advice_item';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $order_error = true;
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>
<?php
if ($id_error == false) {
    $Query = "SELECT id,order_no,client_name,company_name,address_line1,address_line2,client_city,client_pincode,document_no,document_date,cheque_no,cheque_date,branch_code,bank_name,cheque_amount,pan_no,tds_status,total_tds,total,pa_status from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $client_name = $UDB->Record["client_name"];
        $company_name = $UDB->Record["company_name"];
        $address_line1 = $UDB->Record["address_line1"];
        $address_line2 = $UDB->Record["address_line2"];
        $client_city = $UDB->Record["client_city"];
        $client_pincode = $UDB->Record["client_pincode"];
        $document_no = $UDB->Record["document_no"];
        $document_date = $UDB->Record["document_date"];
        $cheque_no = $UDB->Record["cheque_no"];
        $cheque_date = $UDB->Record["cheque_date"];
        $branch_code = $UDB->Record["branch_code"];
        $bank_name = $UDB->Record["bank_name"];
        $cheque_amount = $UDB->Record["cheque_amount"];
        $pan_no = $UDB->Record["pan_no"];
        $tds_status = $UDB->Record["tds_status"];
        $total_tds = $UDB->Record["total_tds"];
        $total = $UDB->Record["total"];
        $pa_status = $UDB->Record["pa_status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,lr_no,challan_no,lr_date,un_ld_date,bal_amt,hamali_paid,hamali_collect,tds_amt,claim_amt,late_delivery,destination,line_total from $tablename1 where order_no='" . $document_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $lr_no_array[] = $UDB->Record["lr_no"];
        $challan_no_array[] = $UDB->Record["challan_no"];
        $lr_date_array[] = $UDB->Record["lr_date"];
        $un_ld_date_array[] = $UDB->Record["un_ld_date"];
        $bal_amt_array[] = $UDB->Record["bal_amt"];
        $hamali_paid_array[] = $UDB->Record["hamali_paid"];
        $hamali_collect_array[] = $UDB->Record["hamali_collect"];
        $tds_amt_array[] = $UDB->Record["tds_amt"];
        $claim_amt_array[] = $UDB->Record["claim_amt"];
        $late_delivery_array[] = $UDB->Record["late_delivery"];
        $destination_array[] = $UDB->Record["destination"];
        $line_total_array[] = $UDB->Record["line_total"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_vendor_details(vendor_name)
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
                    document.form.company_name.value = myarray[0];
                    document.form.address_line1.value = myarray[1];
                    document.form.address_line2.value = myarray[2];
                    document.form.client_city.value = myarray[3];
                    document.form.client_pincode.value = myarray[4];
                    //document.form.contact_number.value = myarray[4];
                }
            }
        }
        // var client_name = document.form.client_name.value;
        // var division_name = document.form.division_name.value;
        var url = "payment_advice_dependent6.php";
        url = url + "?vendor_name=" + vendor_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_branch_name(branch_code)
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

                for (j = document.form.bank_name.options.length - 1; j >= 0; j--)
                {
                    document.form.bank_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.bank_name.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.bank_name.options.add(optn);
                    }
                }
            }
        }
        //var client_name = document.form.client_name.value;
        var url = "payment_advice_dependent5.php";
        url = url + "?branch_code=" + branch_code;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function calculate_amount(line_id)
    {
        var sub_total = 0;
        sub_total = Number(document.getElementById('rate' + line_id).value);
        var sub_total_charges = Number(sub_total).toFixed(2);
        document.getElementById('sub_total' + line_id).value = sub_total_charges;
        var total = 0;
        for (i = 1; i <= 5; i++)
        {
            total = Number(total) + Number(document.getElementById('sub_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total(line_id)
    {
        var sub_total = 0;
        bal_amt = Number(document.getElementById('bal_amt' + line_id).value);
        var bal_amt_charges = Number(bal_amt).toFixed(2);
        document.getElementById('line_total' + line_id).value = bal_amt_charges;
        var total = 0;
        for (i = 1; i <= 25; i++)
        {
            total = Number(total) + Number(document.getElementById('line_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total_paid(line_id)
    {
        var bal_amt = Number(document.getElementById('bal_amt' + line_id).value);
        var hamali_paid = Number(document.getElementById('hamali_paid' + line_id).value);
        var bal_amt_charges = Number(bal_amt) + Number(hamali_paid);
        document.getElementById('line_total' + line_id).value = bal_amt_charges.toFixed(2);
        var total = 0;
        for (i = 1; i <= 25; i++)
        {
            total = Number(total) + Number(document.getElementById('line_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total_collection(line_id)
    {
        var bal_amt = Number(document.getElementById('bal_amt' + line_id).value);
        var hamali_paid = Number(document.getElementById('hamali_paid' + line_id).value);
        var hamali_collect = Number(document.getElementById('hamali_collect' + line_id).value);
        var bal_amt_charges = Number(bal_amt) + Number(hamali_paid) + Number(hamali_collect);
        document.getElementById('line_total' + line_id).value = bal_amt_charges.toFixed(2);
        var total = 0;
        for (i = 1; i <= 25; i++)
        {
            total = Number(total) + Number(document.getElementById('line_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total_claim_amt(line_id)
    {
        var bal_amt = Number(document.getElementById('bal_amt' + line_id).value);
        var hamali_paid = Number(document.getElementById('hamali_paid' + line_id).value);
        var hamali_collect = Number(document.getElementById('hamali_collect' + line_id).value);
        var bal_amt_charges = Number(bal_amt) + Number(hamali_paid) + Number(hamali_collect);
        var claim_amt = Number(document.getElementById('claim_amt' + line_id).value);
        var minus = Number(bal_amt_charges) - Number(claim_amt);
        document.getElementById('line_total' + line_id).value = minus.toFixed(2);
        var total = 0;
        for (i = 1; i <= 25; i++)
        {
            total = Number(total) + Number(document.getElementById('line_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total_late_delivery(line_id)
    {
        var bal_amt = Number(document.getElementById('bal_amt' + line_id).value);
        var hamali_paid = Number(document.getElementById('hamali_paid' + line_id).value);
        var hamali_collect = Number(document.getElementById('hamali_collect' + line_id).value);
        var bal_amt_charges = Number(bal_amt) + Number(hamali_paid) + Number(hamali_collect);
        var claim_amt = Number(document.getElementById('claim_amt' + line_id).value);
        var minus = Number(bal_amt_charges) - Number(claim_amt);
        var late_delivery = Number(document.getElementById('late_delivery' + line_id).value);
        var minus1 = Number(minus) - Number(late_delivery);
        document.getElementById('line_total' + line_id).value = minus1.toFixed(2);
        var total = 0;
        for (i = 1; i <= 25; i++)
        {
            total = Number(total) + Number(document.getElementById('line_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function AjaxFunction_display_tds(tds_status)
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
                    for (i = 1; i <= 25; i++)
                    {
                        document.getElementById('tds_amt' + i).value = myarray[0];
                    }
                }
            }
        }
        var url = "payment_advice_dependent1.php";
        //var vehicle_type = encodeURIComponent(vehicle_type);
        url = url + "?tds_status=" + tds_status;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    /* function calculate_total_tds()
     {
     var tds_amt = 0;
     for (i = 1; i <= 25; i++)
     {
     tds_amt = Number(tds_amt) + (Number(document.getElementById('tds_amt' + i).value));

     }
     document.getElementById('total_tds').value = tds_amt.toFixed(2);
     }*/
    function calculate_total_amount()
    {
        var line_total = 0;
        for (i = 1; i <= 25; i++)
        {
            line_total = Number(line_total) + (Number(document.getElementById('line_total' + i).value));

        }
        var amount = document.getElementById('total').value = line_total.toFixed(2);
        document.getElementById('cheque_amount').value = amount;
    }

</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payment Advice
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="payment_advice_grid.php">Payment Advice</a></li>
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
                                       <!-- <td  class="form_label_split2">
                                            Order No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="order_no">
                                                <option>Select</option>
                                        <?php
                                        $Query = "select order_no from sr_customer_order order by order_no";
                                        $UDB->query($Query);

                                        while ($UDB->Multicoloums()) {
                                            if ($id_error == false && $order_no == $UDB->Record["order_no"]) {
                                                echo'<option selected>' . $UDB->Record["order_no"] . '</option>';
                                            } else {
                                                echo'<option>' . $UDB->Record["order_no"] . '</option>';
                                            }
                                        }
                                        ?>
                                            </select>
                                        </td>-->
                                        <td  class="form_label_split2">
                                            Document No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="document_no" class="form-control" value="<?php if ($id_error == false) echo $document_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Document Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="document_date" class="form-control pull-right" id="document_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $document_date;
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
                                            Vendor Name
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_vendor_details(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(vendor_name) from sr_vendor order by vendor_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $client_name == $DB->Record["vendor_name"]) {
                                                        echo'<option selected>' . $DB->Record["vendor_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vendor_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                      <!--  <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_name" id="client_name">
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
                                        </td>-->
                                        <td  class="form_label_split2">
                                            Cheque No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="cheque_no" class="form-control" value="<?php if ($id_error == false) echo $cheque_no; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Company Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="company_name" name="company_name" autofocus class="form-control" value="<?php if ($id_error == false) echo $company_name; ?>" placeholder="Company Name">
                                        </td>
                                        <td  class="form_label_split2">
                                            Cheque Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="cheque_date" class="form-control pull-right" id="cheque_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $cheque_date;
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
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line1" name="address_line1" class="form-control" value="<?php if ($id_error == false) echo $address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" onchange="AjaxFunction_display_branch_name(this.value)" name="branch_code" id="branch_code">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_branch_bank order by branch_code";
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
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line2" name="address_line2" class="form-control" value="<?php if ($id_error == false) echo $address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bank
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="bank_name">
                                                <option>Select</option>
                                                <?php
                                                if ($id_error == false && $bank_name != NULL) {
                                                    echo'<option selected>' . $bank_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_city" name="client_city" class="form-control" value="<?php if ($id_error == false) echo $client_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" id="client_pincode" name="client_pincode" class="form-control" value="<?php if ($id_error == false) echo $client_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            Cheque Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="cheque_amount" name="cheque_amount" autofocus class="form-control" value="<?php if ($id_error == false) echo $cheque_amount; ?>">
                                        </td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            TDS
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="tds_status" id="tds_status"  onchange="AjaxFunction_display_tds(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(tds_status) from master_tds order by tds_status";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $tds_status == $DB->Record["tds_status"]) {
                                                        echo'<option selected>' . $DB->Record["tds_status"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["tds_status"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            PAN No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="pan_no" autofocus class="form-control" value="<?php if ($id_error == false) echo $pan_no; ?>">
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" colspan="11">
                                            PARTICULARS
                                        </td>
                                        <td  class="form_label_multiple">
                                            AMOUNT
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Lr.No
                                        </td>
                                        <td  class="form_label_multiple">
                                            Challan No
                                        </td>
                                        <td  class="form_label_multiple">
                                            Date
                                        </td>
                                        <td  class="form_label_multiple">
                                            Un.Ld. Dt.
                                        </td>
                                        <td  class="form_label_multiple">
                                            Bal/Adv Amt
                                        </td>
                                        <td  class="form_label_multiple">
                                            Hamali
                                        </td>
                                        <td  class="form_label_multiple">
                                            Hamali
                                        </td>
                                        <td  class="form_label_multiple" colspan="3">
                                            Other Deduction
                                        </td>
                                        <td  class="form_label_multiple">
                                            Destn
                                        </td>
                                        <td  class="form_label_multiple">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Paid/Detn
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Collection
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            TDS Amt
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Claim Amt
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Late Delv
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                        </td>
                                        <td  class="form_label_multiple" style="width:12%;">
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <input type="text" id="lr_no<?php echo $i; ?>"  name="lr_no<?php echo $i; ?>" onblur="calculate_tds(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $lr_no_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="lr_no<?php echo $i; ?>"  name="challan_no<?php echo $i; ?>"  class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $challan_no_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="lr_date<?php echo $i; ?>" class="form-control pull-right" id="lr_date<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false) {
                                                        echo $lr_date_array[$i - 1];
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
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="un_ld_date<?php echo $i; ?>" class="form-control pull-right" id="un_ld_date<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false) {
                                                        echo $un_ld_date_array[$i - 1];
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
                                                <input type="text" name="bal_amt<?php echo $i; ?>" id="bal_amt<?php echo $i; ?>" onblur="calculate_total(<?php echo $i; ?>)" style="text-align:right;" class="form-control" value="<?php if ($id_error == false) echo $bal_amt_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="hamali_paid<?php echo $i; ?>" onblur="calculate_total_paid(<?php echo $i; ?>)"  name="hamali_paid<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $hamali_paid_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="hamali_collect<?php echo $i; ?>" onblur="calculate_total_collection(<?php echo $i; ?>)"  name="hamali_collect<?php echo $i; ?>" onblur="calculate_amount(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $hamali_collect_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="tds_amt<?php echo $i; ?>" onblur="calculate_total_tds(<?php echo $i; ?>)"  name="tds_amt<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $tds_amt_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="claim_amt<?php echo $i; ?>" onblur="calculate_total_claim_amt(<?php echo $i; ?>)"  name="claim_amt<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $claim_amt_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="late_delivery<?php echo $i; ?>" onblur="calculate_total_late_delivery(<?php echo $i; ?>)" name="late_delivery<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $late_delivery_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="destination<?php echo $i; ?>"  name="destination<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $destination_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="line_total<?php echo $i; ?>" onblur="calculate_total_amount(this.value,<?php echo $i; ?>)"  name="line_total<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $line_total_array[$i - 1];
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="7" class="form_label_multiple_right">Total TDS</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_tds" readonly name="total_tds" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_tds;
                                            ?>">
                                        </td>
                                        <td colspan="3" class="form_label_multiple_right">Total</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total" readonly name="total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total;
                                            ?>">
                                        </td>
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
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
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