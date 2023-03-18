<?php
include'../../template/accounts/header.default.php';

$actionpage = 'money_receipt_action.php';
$tablename = 'sr_money_receipt';
$tablename1 = 'sr_money_receipt_item';

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
    $Query = "SELECT id,order_no,so_no,mr_type,client_name,branch,bmr_no,bmr_date,ac_code,cheque_no,bank_name,mr_date,bill_frt_total,bill_oct_total,received_frt_total,received_oct_total,rem_total,tds_amount,claim_amount,excess_billing,hamali,advance,against_referrence,others,non_account,mr_status from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $mr_type = $UDB->Record["mr_type"];
        $client_name = $UDB->Record["client_name"];
        $branch = $UDB->Record["branch"];
        $bmr_no = $UDB->Record["bmr_no"];
        $bmr_date = $UDB->Record["bmr_date"];
        $ac_code = $UDB->Record["ac_code"];
        $cheque_no = $UDB->Record["cheque_no"];
        $bank_name = $UDB->Record["bank_name"];
        $mr_date = $UDB->Record["mr_date"];
        $bill_frt_total = $UDB->Record["bill_frt_total"];
        $bill_oct_total = $UDB->Record["bill_oct_total"];
        $bill_date = $UDB->Record["bill_date"];
        $received_frt_total = $UDB->Record["received_frt_total"];
        $received_oct_total = $UDB->Record["received_oct_total"];
        $rem_total = $UDB->Record["rem_total"];
        $tds_amount = $UDB->Record["tds_amount"];
        $claim_amount = $UDB->Record["claim_amount"];
        $excess_billing = $UDB->Record["excess_billing"];
        $hamali = $UDB->Record["hamali"];
        $advance = $UDB->Record["advance"];
        $against_referrence = $UDB->Record["against_referrence"];
        $others = $UDB->Record["others"];
        $non_account = $UDB->Record["non_account"];
        $mr_status = $UDB->Record["mr_status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,bill_no,bill_date,bill_frt,bill_oct,received_frt,received_oct,rem from $tablename1 where order_no='" . $bmr_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $bill_no_array[] = $UDB->Record["bill_no"];
        $bill_date_array[] = $UDB->Record["bill_date"];
        $bill_frt_array[] = $UDB->Record["bill_frt"];
        $bill_oct_array[] = $UDB->Record["bill_oct"];
        $received_frt_array[] = $UDB->Record["received_frt"];
        $received_oct_array[] = $UDB->Record["received_oct"];
        $rem_array[] = $UDB->Record["rem"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_order(mr_type)
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

                for (j = document.form.order_no.options.length - 1; j >= 0; j--)
                {
                    document.form.order_no.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.order_no.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.order_no.options.add(optn);
                    }
                }
            }
        }
        /*if (mr_type == "Advance") {
         document.getElementById('order_no').style.visibility = 'hidden';
         for (i = 1; i <= 25; i++) {
         document.getElementById('adv_bill_no' + i).style.visibility = 'visible';
         document.getElementById('bill_no' + i).style.visibility = 'hidden';
         }
         } else {
         document.getElementById('order_no').style.visibility = 'visible';
         for (i = 1; i <= 25; i++) {
         document.getElementById('adv_bill_no' + i).style.visibility = 'hidden';
         document.getElementById('bill_no' + i).style.visibility = 'visible';
         }
         }*/
        //document.getElementById('order_no').disabled = false;
        var client_name = document.form.client_name.value;
        var url = "money_receipt_dependent1.php";
        url = url + "?client_name=" + client_name + "&mr_type=" + mr_type;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_bill(order_no)
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
                for (i = 1; i <= 25; i++)
                {
                    var length = document.getElementById("bill_no" + i).options.length;
                    for (j = (length - 1); j >= 0; j--)
                    {
                        document.getElementById("bill_no" + i).options[j] = null;
                        document.getElementById("bill_date" + i).value = null;
                        document.getElementById("bill_frt" + i).value = null;
                        document.getElementById("bill_oct" + i).value = null;
                        document.getElementById("received_frt" + i).value = null;
                        document.getElementById("received_oct" + i).value = null;
                        document.getElementById("rem" + i).value = null;
                    }
                }

                if (myarray.length > 0)
                {
                    for (i = 1; i <= 25; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.getElementById("bill_no" + i).options.add(optn);
                        for (j = 0; j < myarray.length; j++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[j];
                            optn.value = myarray[j];
                            document.getElementById("bill_no" + i).options.add(optn);
                        }
                    }
                }
            }
        }
        var mr_type = document.form.mr_type.value;
        var url = "money_receipt_dependent2.php";
        url = url + "?order_no=" + order_no + "&mr_type=" + mr_type;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function AjaxFunction_display_order_detail(bill_no, line_id)
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
                //var myarray = decodeURIComponent(myarray);
                //alert(myarray);
                //var product_name = decodeURIComponent(product_name);
                /*var length = document.getElementById("product_name" + line_id).options.length;
                 for (j = (length - 1); j >= 0; j--)
                 {
                 document.getElementById("product_name" + line_id).options[j] = null;
                 }
                 */
                if (myarray.length > 0)
                {
                    document.getElementById('bill_date' + line_id).value = myarray[0];
                    document.getElementById('bill_frt' + line_id).value = myarray[1];
                }
            }
        }
        var url = "money_receipt_dependent3.php";
        // var product_name = encodeURIComponent(product_name);
        url = url + "?bill_no=" + bill_no;
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
    function calculate_bill_frt(line_id)
    {
        var bill_frt_total = 0;
        for (i = 1; i <= 25; i++)
        {
            var bill_frt_total = Number(bill_frt_total) + Number(document.getElementById('bill_frt' + i).value);
        }

        var bill_frt_total_charges = Number(bill_frt_total).toFixed(2);
        document.getElementById('bill_frt_total').value = bill_frt_total_charges;
    }
    function calculate_bill_oct(line_id)
    {
        var bill_oct_total = 0;
        for (i = 1; i <= 25; i++)
        {
            var bill_oct_total = Number(bill_oct_total) + Number(document.getElementById('bill_oct' + i).value);
        }

        var bill_oct_total_charges = Number(bill_oct_total).toFixed(2);
        document.getElementById('bill_oct_total').value = bill_oct_total_charges;
    }
    function calculate_received_frt(line_id)
    {
        var received_frt_total = 0;
        for (i = 1; i <= 25; i++)
        {
            var received_frt_total = Number(received_frt_total) + Number(document.getElementById('received_frt' + i).value);
        }

        var received_frt_total_charges = Number(received_frt_total).toFixed(2);
        document.getElementById('received_frt_total').value = received_frt_total_charges;
        calculate_bill_frt(line_id);
        calculate_rem(line_id);
    }
    function calculate_received_oct(line_id)
    {
        var received_oct_total = 0;
        for (i = 1; i <= 25; i++)
        {
            var received_oct_total = Number(received_oct_total) + Number(document.getElementById('received_oct' + i).value);
        }

        var received_oct_total_charges = Number(received_oct_total).toFixed(2);
        document.getElementById('received_oct_total').value = received_oct_total_charges;
    }
    function calculate_claim_amount(line_id)
    {
        var received_frt_total = 0;
        received_frt_total = document.getElementById('received_frt_total').value;
        var tds_amount = 0;
        tds_amount = Number(received_frt_total) * 0.02;
        tds_amount_charges = Number(tds_amount).toFixed(2);
        document.getElementById('tds_amount').value = tds_amount_charges;
        var claim_amount = 0;
        claim_amount = Number(received_frt_total) - Number(tds_amount);
        claim_amount_charges = Number(claim_amount).toFixed(2);
        document.getElementById('claim_amount').value = claim_amount_charges;
    }
    function calculate_rem(line_id)
    {
        var bill_frt = document.getElementById('bill_frt' + line_id).value;
        var bill_oct = document.getElementById('bill_oct' + line_id).value
        var bill_amount = 0;
        bill_amount = Number(bill_frt) + Number(bill_oct);
        var received_frt = document.getElementById('received_frt' + line_id).value;
        var received_oct = document.getElementById('received_oct' + line_id).value
        var received_amount = 0;
        received_amount = Number(received_frt) + Number(received_oct);
        if (bill_amount > received_amount)
        {
            var rem = 0;
            rem = Number(bill_amount) - Number(received_amount);
        } else
        {
            rem = 0;
        }
        var rem_charges = Number(rem).toFixed(2);
        document.getElementById('rem' + line_id).value = rem_charges;
        var line_rem = 0;
        for (i = 1; i <= 25; i++)
        {
            var line_rem = Number(line_rem) + Number(document.getElementById('rem' + i).value);
        }

        var rem_total_charges = Number(line_rem).toFixed(2);
        document.getElementById('rem_total').value = rem_total_charges;
        calculate_received_oct(line_id);
        calculate_claim_amount(line_id);
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Money Receipt
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="money_receipt_grid.php">Money Receipt</a></li>
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
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name">
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
                                        <td  class="form_label_split2">
                                            B.M.R No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Money Receipt Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="mr_type" id="mr_type" onchange="AjaxFunction_display_order(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(mr_type) from master_money_receipt_type order by mr_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $mr_type == $DB->Record["mr_type"]) {
                                                        echo'<option selected>' . $DB->Record["mr_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["mr_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            B.M.R Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="bmr_date" class="form-control pull-right" id="bmr_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $bmr_date;
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
                                            Order No / Fre.Bill No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="order_no" id="order_no" onchange="AjaxFunction_display_bill(this.value)">
                                                <option>Select</option>
                                                <?php
                                                if ($id_error == false) {
                                                    echo'<option selected>' . $order_no . '</option>';
                                                } else {
                                                    echo'<option>' . $order_no . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            A/C Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="ac_code" class="form-control" value="<?php if ($id_error == false) echo $ac_code; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp</span>Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="branch" autofocus class="form-control" value="<?php if ($id_error == false) echo $branch; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bank
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
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Cash / Cheque No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="cheque_no" class="form-control" value="<?php if ($id_error == false) echo $cheque_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Money Receipt Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="mr_date" class="form-control pull-right" id="mr_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $mr_date;
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
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" colspan="2">
                                        </td>
                                        <td  class="form_label_multiple" colspan="2">
                                            BILL AMOUNT
                                        </td>
                                        <td  class="form_label_multiple" colspan="2">
                                            RECEIVED AMOUNT
                                        </td>
                                        <td  class="form_label_multiple">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            Bill No
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            Date
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            FRT
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            OCT / OTHRS
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            FRT
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            OCT / SCH
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            REM
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <select class=" form-control dropdown_padding" name="bill_no<?php echo $i; ?>" id="bill_no<?php echo $i; ?>"  onchange="AjaxFunction_display_order_detail(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                    <?php
                                                    if ($id_error == false && $bill_no_array[$i - 1] != NULL) {
                                                        echo'<option selected>' . $bill_no_array[$i - 1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <!--
                                            <input type="text" id="adv_bill_no<?php echo $i; ?>"  name="adv_bill_no<?php echo $i; ?>" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $bill_no_array[$i - 1];
                                            ?>">
                                            <td class="form_content_multiple">
                                                <input type="text" id="bill_no<?php echo $i; ?>"  name="bill_no<?php echo $i; ?>" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $bill_no_array[$i - 1];
                                            ?>">-->
                                            </td>
                                            <td class="form_content_multiple">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="bill_date<?php echo $i; ?>" id="bill_date<?php echo $i; ?>" class="form-control pull-right" id="bill_date<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
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
                                                <input type="text" id="bill_frt<?php echo $i; ?>"  name="bill_frt<?php echo $i; ?>" onblur="calculate_bill_frt(<?php echo $i; ?>)" class="form-control" style="text-align:right;" value="<?php
                                                if ($id_error == false)
                                                    echo $bill_frt_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="bill_oct<?php echo $i; ?>" id="bill_oct<?php echo $i; ?>" onblur="calculate_bill_oct(<?php echo $i; ?>)" class="form-control" style="text-align:right;" value="<?php if ($id_error == false) echo $bill_oct_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="received_frt<?php echo $i; ?>"  name="received_frt<?php echo $i; ?>" onblur="calculate_received_frt(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $received_frt_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="received_oct<?php echo $i; ?>"  name="received_oct<?php echo $i; ?>" onblur="calculate_rem(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $received_oct_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="rem<?php echo $i; ?>"  name="rem<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $rem_array[$i - 1];
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2" class="form_label_multiple_right">Total</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="bill_frt_total" readonly name="bill_frt_total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $bill_frt_total;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="bill_oct_total" readonly name="bill_oct_total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $bill_oct_total;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="received_frt_total" readonly name="received_frt_total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $received_frt_total;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="received_oct_total" readonly name="received_oct_total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $received_oct_total;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="rem_total" readonly name="rem_total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $rem_total;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="form_label_multiple_right">TDS Amount</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="tds_amount" readonly name="tds_amount" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $tds_amount;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="form_label_multiple_right">Claim Amount</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="claim_amount" readonly name="claim_amount" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $claim_amount;
                                            ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td class="form_label_split2">Excess Billing</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="excess_billing" name="excess_billing" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $excess_billing;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">Hamali</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="hamali" name="hamali" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $hamali;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_split2">Advance</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="advance" name="advance" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $advance;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">Others</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="others" name="others" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $others;
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">Against Referrence</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="against_referrence" name="against_referrence" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $against_referrence;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">On Account</td>
                                        <td class="form_content_split2">
                                            <input type="text" style="text-align:right;" id="non_account" name="non_account" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $non_account;
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