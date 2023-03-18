<?php
include'../../template/client_division/header.default.php';

$actionpage = 'bilty_action.php';
$tablename = 'sr_bilty';
$tablename1 = 'sr_bilty_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}
?>
<?php
if ($orderno_error == false) {
    $Query = "SELECT  id,order_no,order_date,client_name,client_branch,so_no,so_date,orgin,destination,pickup_address_line1,pickup_address_line2,pickup_city,pickup_pincode from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $client_name = $UDB->Record["client_name"];
        $client_branch = $UDB->Record["client_branch"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $po_no = $UDB->Record["so_no"];
        $lane_from = $UDB->Record["orgin"];
        $lane_to = $UDB->Record["destination"];
        $booking_address_line1 = $UDB->Record["pickup_address_line1"];
        $booking_address_line2 = $UDB->Record["pickup_address_line2"];
        $booking_city = $UDB->Record["pickup_city"];
        $booking_pincode = $UDB->Record["pickup_pincode"];
        $booking_company_name = $UDB->Record["client_name"];
    }
    $Query1 = "SELECT  id,client_name,address_line1,address_line2,city,pincode from sr_client where client_name='" . $client_name . "' and branch_name='" . $client_branch . "'";
    $DB->query($Query1);
    while ($DB->Multicoloums()) {
        $consignor_name = $DB->Record["client_name"];
        $consignor_address_line1 = $DB->Record["address_line1"];
        $consignor_address_line2 = $DB->Record["address_line2"];
        $consignor_city = $DB->Record["city"];
        $consignor_pincode = $DB->Record["pincode"];
    }
    $Query1 = "SELECT vehicle_no from sr_vehicle_booking where  order_no='" . $_REQUEST["order_no"] . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $vehicle_no = $UDB1->Record["vehicle_no"];
    }
}
if ($id_error == false) {
    $Query = "SELECT  order_no,order_date,so_no,so_date,branch_code,branch_city,consignor_name,consignor_address_line1,consignor_address_line2,consignor_city,consignor_pincode,po_no,consignor_invoice_no,consignor_tin_no,stationary_no,consignment_note_no,consignment_date,lane_from,lane_to,consignee_account_no,consignee_account_name,consignee_bank,consignee_branch,to_be_billed_at,vehicle_no,container_no,booking_company_name,booking_address_line1,booking_address_line2,booking_city,booking_pincode,delivery_company_name,delivery_address_line1,delivery_address_line2,delivery_city,bill_party,bill_vide_permit_no,delivery_pincode,service_tax_payable_by,packing,private_note,bill_type,total_frieght,hamall,sur_charges,st_charges,risk_charges,checkpost,fov,total,insurance,insurance_company,policy_no,insurance_date,insurance_amount,risk from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_city = $UDB->Record["branch_city"];
        $consignor_name = $UDB->Record["consignor_name"];
        $consignor_address_line1 = $UDB->Record["consignor_address_line1"];
        $consignor_address_line2 = $UDB->Record["consignor_address_line2"];
        $consignor_city = $UDB->Record["consignor_city"];
        $consignor_pincode = $UDB->Record["consignor_pincode"];
        $po_no = $UDB->Record["po_no"];
        $consignor_invoice_no = $UDB->Record["consignor_invoice_no"];
        $consignor_tin_no = $UDB->Record["consignor_tin_no"];
        $stationary_no = $UDB->Record["stationary_no"];
        $consignment_note_no = $UDB->Record["consignment_note_no"];
        $consignment_date = $UDB->Record["consignment_date"];
        $lane_from = $UDB->Record["lane_from"];
        $lane_to = $UDB->Record["lane_to"];
        $consignee_account_no = $UDB->Record["consignee_account_no"];
        $consignee_account_name = $UDB->Record["consignee_account_name"];
        $consignee_bank = $UDB->Record["consignee_bank"];
        $consignee_branch = $UDB->Record["consignee_branch"];
        $to_be_billed_at = $UDB->Record["to_be_billed_at"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $container_no = $UDB->Record["container_no"];
        $booking_company_name = $UDB->Record["booking_company_name"];
        $booking_address_line1 = $UDB->Record["booking_address_line1"];
        $booking_address_line2 = $UDB->Record["booking_address_line2"];
        $booking_city = $UDB->Record["booking_city"];
        $booking_pincode = $UDB->Record["booking_pincode"];
        $delivery_company_name = $UDB->Record["delivery_company_name"];
        $delivery_address_line1 = $UDB->Record["delivery_address_line1"];
        $delivery_address_line2 = $UDB->Record["delivery_address_line2"];
        $delivery_city = $UDB->Record["delivery_city"];
        $delivery_pincode = $UDB->Record["delivery_pincode"];
        $bill_party = $UDB->Record["bill_party"];
        $bill_vide_permit_no = $UDB->Record["bill_vide_permit_no"];
        $service_tax_payable_by = $UDB->Record["service_tax_payable_by"];
        $packing = $UDB->Record["packing"];
        $private_note = $UDB->Record["private_note"];
        $bill_type = $UDB->Record["bill_type"];
        $total_frieght = $UDB->Record["total_frieght"];
        $hamall = $UDB->Record["hamall"];
        $sur_charges = $UDB->Record["sur_charges"];
        $st_charges = $UDB->Record["st_charges"];
        $risk_charges = $UDB->Record["risk_charges"];
        $checkpost = $UDB->Record["checkpost"];
        $fov = $UDB->Record["fov"];
        $total = $UDB->Record["total"];
        $insurance = $UDB->Record["insurance"];
        $insurance_company = $UDB->Record["insurance_company"];
        $policy_no = $UDB->Record["policy_no"];
        $insurance_date = $UDB->Record["insurance_date"];
        $insurance_amount = $UDB->Record["insurance_amount"];
        $risk = $UDB->Record["risk"];
    }

    $edit_product_count = 0;
    $Query = "SELECT id,description,product_category,product_name,packages_unit,packages,weight_actual,weight_charged,frieght_charge from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $description_array[] = $UDB->Record["description"];
        $product_category_array[] = $UDB->Record["product_category"];
        $product_name_array[] = $UDB->Record["product_name"];
        $packages_unit_array[] = $UDB->Record["packages_unit"];
        $packages_array[] = $UDB->Record["packages"];
        $weight_actual_array[] = $UDB->Record["weight_actual"];
        $weight_charged_array[] = $UDB->Record["weight_charged"];
        $frieght_charge_array[] = $UDB->Record["frieght_charge"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_branch(branch_code)
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

                if (myarray.length > 0)
                {
                    document.form.branch_city.value = myarray[0];
                }
                document.form.stationary_no.value = "";
                load_bilty_no();
            }
        }
        var url = "bilty_branch_code_dependent1.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
    function load_bilty_no()
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
                var flag = "";
                if (myarray.length > 0)
                {
                    flag = myarray[1];
                    if (flag == "true")
                    {
                        document.form.stationary_no.value = myarray[0];
                    } else if (flag == "false")
                    {
                        document.form.stationary_no.value = "";
                        alert("Data Full in Bilty Add new data to Stationary Master ");
                    }
                } else if (myarray.length == 0)
                {
                    document.form.stationary_no.value = "";
                    alert("Select a Branch Code with Data in Stationary Master");
                }
            }
        }
        var book_type = "bilty";
        var branch_code = document.form.branch_code.value;
        var url = "bilty_branch_code_dependent3.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function check_bilty_no()
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
                var from_no = "";
                var to_no = "";
                if (myarray.length > 0)
                {
                    from_no = myarray[0];
                    to_no = myarray[1];
                    var stationary_no = document.form.stationary_no.value;
                    if (isNaN(stationary_no))
                    {
                        document.form.stationary_no.value = "";
                        alert("Enter Only Numeric Values");
                    } else
                    {
                        if (Number(stationary_no) < Number(from_no) || Number(stationary_no) > Number(to_no))
                        {
                            document.form.stationary_no.value = "";
                            alert("Enter No between" + from_no + " to " + to_no);
                        }
                    }
                } else
                {
                    document.form.stationary_no.value = "";
                    alert("No Bilty Records Found in Stationary Master");
                }
            }
        }
        var url = "bilty_branch_code_dependent2.php"
        var book_type = "bilty";
        var branch_code = document.form.branch_code.value;
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function calculate_frieght(line_id)
    {
        var total_frieght = 0;
        var frieght_charge = document.getElementById('frieght_charge' + line_id).value;
        for (i = 1; i <= 5; i++) {
            total_frieght = Number(total_frieght) + Number(document.getElementById('frieght_charge' + i).value);
        }
        var total_frieght_charges = Number(total_frieght).toFixed(2);
        document.getElementById('total_frieght').value = total_frieght_charges;
        calculate_total()
    }
    function calculate_total()
    {
        var total_frieght = 0;
        var hamall = 0;
        var sur_charges = 0;
        var st_charges = 0;
        var risk_charges = 0;
        var checkpost = 0;
        var fov = 0;
        total_frieght = Number(document.getElementById('total_frieght').value);
        hamall = Number(document.getElementById('hamall').value);
        sur_charges = Number(document.getElementById('sur_charges').value);
        st_charges = Number(document.getElementById('st_charges').value);
        risk_charges = Number(document.getElementById('risk_charges').value);
        checkpost = Number(document.getElementById('checkpost').value);
        fov = Number(document.getElementById('fov').value);
        var total = 0;
        total = Number(total_frieght) + Number(hamall) + Number(sur_charges) + Number(st_charges) + Number(risk_charges) + Number(checkpost) + Number(fov);

        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bilty
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="bilty_grid.php">Bilty</a></li>
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
                                            Order Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="order_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $order_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="order_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $order_date; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Sales Order Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Sales Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_date; ?>">
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
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_code" id="branch_code"  onchange="AjaxFunction_display_branch(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_company order by branch_code";
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
                                        <td  class="form_label_split2">
                                            City
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="branch_city" id="branch_city" class="form-control" value="<?php if ($id_error == false) echo $branch_city; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2"rowspan="4">
                                            Consignors Name & Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_name" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignor_name; ?>" placeholder="Company Name">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Stationary Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="stationary_no" id="stationary_no"  class="form-control" onblur="check_bilty_no()" value="<?php if ($id_error == false) echo $stationary_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_address_line1" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignor_address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Consignment Note Number & Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="consignment_note_no" id="consignment_note_no" class="form-control"  value="<?php
                                            /* $Query = "SELECT max(cast(consignment_note_no as unsigned))as max_id from $tablename";
                                              $UDB->query($Query);
                                              while ($UDB->Multicoloums()) {
                                              $max_id = $UDB->Record["max_id"];
                                              }
                                              $new_max_id = $max_id + 1;
                                             */
                                            if ($id_error == false) {
                                                echo $consignment_note_no;
                                            } else {
                                                echo $new_max_id;
                                            }
                                            ?>" style="float:left; width:50%;">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="consignment_date" style="float:left; width:100%;" class="form-control pull-right" id="consignment_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $consignment_date;
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
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_address_line2" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignor_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                        <td  class="form_label_split2">
                                            From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="lane_from" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lane_from; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_city" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignor_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="consignor_pincode" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignor_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="lane_to" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lane_to; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            PO Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="po_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $po_no; ?>" placeholder="PO Number">
                                        </td>
                                        <td  class="form_label_split2" rowspan="4">
                                            Consignee Bank Details
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignee_account_no" class="form-control" value="<?php if ($id_error == false) echo $consignee_account_no; ?>" placeholder="Account Number">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Consignor Invoice Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_invoice_no" class="form-control" value="<?php if ($id_error == false) echo $consignor_invoice_no; ?>" placeholder="Invoice Number">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignee_account_name" class="form-control" value="<?php if ($id_error == false) echo $consignee_account_name; ?>" placeholder="Account Name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Consignor CST/VAT/TIN Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignor_tin_no" class="form-control" value="<?php if ($id_error == false) echo $consignor_tin_no; ?>" placeholder="TIN Number">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignee_bank" class="form-control" value="<?php if ($id_error == false) echo $consignee_bank; ?>" placeholder="Bank">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            To be Billed at
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="to_be_billed_at">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_company order by branch_code";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $to_be_billed_at == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignee_branch" class="form-control" value="<?php if ($id_error == false) echo $consignee_branch; ?>" placeholder="Branch">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2"rowspan="4">
                                            Booking Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="booking_company_name" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $booking_company_name; ?>" placeholder="Company Name">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bill Party
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bill_party" class="form-control" value="<?php if ($id_error == false) echo $bill_party; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="booking_address_line1" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $booking_address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bill Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="bill_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select bill_type from master_bill_type order by bill_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $bill_type == $DB->Record["bill_type"]) {
                                                        echo'<option selected>' . $DB->Record["bill_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["bill_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="booking_address_line2" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $booking_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                        <td  class="form_label_split2">
                                            Bill Vide Permit Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bill_vide_permit_no" class="form-control" value="<?php if ($id_error == false) echo $bill_vide_permit_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="booking_city" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $booking_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="booking_pincode" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $booking_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            Service Tax Payable By
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="service_tax_payable_by">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select service_tax_payable_by from master_service_tax_payable_by order by service_tax_payable_by";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $service_tax_payable_by == $DB->Record["service_tax_payable_by"]) {
                                                        echo'<option selected>' . $DB->Record["service_tax_payable_by"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["service_tax_payable_by"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2"rowspan="4">
                                            Delivery Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="delivery_company_name" class="form-control" value="<?php if ($id_error == false) echo $delivery_company_name; ?>" placeholder="Company Name">
                                        </td>
                                        <td  class="form_label_split2">
                                            Packing
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="packing" class="form-control" value="<?php if ($id_error == false) echo $packing; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="delivery_address_line1" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $delivery_address_line1; ?>" placeholder="Address Line1">
                                        <td  class="form_label_split2">
                                            Private Note
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="private_note" class="form-control" value="<?php if ($id_error == false) echo $private_note; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="delivery_address_line2" class="form-control" value="<?php if ($id_error == false) echo $delivery_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="delivery_city" class="form-control" value="<?php if ($id_error == false) echo $delivery_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="delivery_pincode" class="form-control" value="<?php if ($id_error == false) echo $delivery_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            Container Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="container_no" class="form-control" value="<?php if ($id_error == false) echo $container_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:45%;">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple" style="width:17%;">
                                            Packages
                                        </td>
                                        <td  class="form_label_multiple" style="width:12%;">
                                            Weight Actual
                                        </td>
                                        <td  class="form_label_multiple" style="width:16%;">
                                            Weight Charged
                                        </td>
                                        <td  class="form_label_multiple" style="width:12%;">
                                            Frieght Charge
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <input type="text"  id="description<?php echo $i; ?>" name="description<?php echo $i; ?>"  style="text-align: left;" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $description_array[$i - 1];
                                                } else {
                                                    echo "";
                                                }
                                                ?>">
                                                <!--<select class="form-control dropdown_padding" name="product_category<?php echo $i; ?>" id="product_category<?php echo $i; ?>" style="width:30%; float:left;" onchange="AjaxFunction_display_lane_detail(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                <?php
                                                $Query = "select distinct(lane_id) from sr_lane";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $product_category_array[$i - 1] == $DB->Record["lane_id"]) {
                                                        echo'<option selected>' . $DB->Record["lane_id"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["lane_id"] . '</option>';
                                                    }
                                                }
                                                ?>
                                                </select>
                                                <select class="form-control dropdown_padding" name="product_name<?php echo $i; ?>" id="product_name<?php echo $i; ?>" style="width:30%; float:center;" onchange="AjaxFunction_display_lane_detail(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                <?php
                                                $Query = "select distinct(lane_id) from sr_lane";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $product_name_array[$i - 1] == $DB->Record["lane_id"]) {
                                                        echo'<option selected>' . $DB->Record["lane_id"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["lane_id"] . '</option>';
                                                    }
                                                }
                                                ?>
                                                </select>-->

                                            </td>
                                            <td class="form_content_multiple">

                                                <select class="form-control dropdown_padding" style="width:50%; float:right;text-align: right;"   onchange="calculate_total(<?php echo $i; ?>)" id="packages_unit<?php echo $i; ?>" name="packages_unit<?php echo $i; ?>">
                                                    <option>NA</option>
                                                    <?php
                                                    $Query = "select distinct(unit) from master_unit order by unit";
                                                    $DB->query($Query);

                                                    while ($DB->Multicoloums()) {
                                                        if ($id_error == false && $packages_unit_array[$i - 1] == $DB->Record["unit"]) {
                                                            echo'<option selected>' . $DB->Record["unit"] . '</option>';
                                                        } else {
                                                            echo'<option>' . $DB->Record["unit"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="text" style="text-align:right; width:50%;"  id="packages<?php echo $i; ?>"  name="packages<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $packages_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right; float:left;" id="weight_actual<?php echo $i; ?>"  name="weight_actual<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $weight_actual_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="weight_charged<?php echo $i; ?>" id="weight_charged<?php echo $i; ?>" style="text-align:right;" class="form-control" value="<?php if ($id_error == false) echo $weight_charged_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="frieght_charge<?php echo $i; ?>"  name="frieght_charge<?php echo $i; ?>" onblur="calculate_frieght(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $frieght_charge_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple">
                                            Amount
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Total Frieght Charges
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" readonly name="total_frieght" id="total_frieght" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $total_frieght;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Hamali
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="hamall" id="hamall" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $hamall;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Sur.Charges
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="sur_charges" id="sur_charges" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $sur_charges;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            St.Charges
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="st_charges" id="st_charges" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $st_charges;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Risk Charges
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="risk_charges" id="risk_charges" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $risk_charges;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Checkpost
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="checkpost" id="checkpost" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $checkpost;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            F.O.V
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="fov" id="fov" onblur="calculate_total()" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $fov;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Total
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" readonly name="total" id="total" style="text-align: right;" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $total;
                                            } else {
                                                echo "0.00";
                                            }
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
                                        <td  class="form_label_multiple">
                                            Insurance
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <select class="form-control dropdown_padding" name="insurance">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select insurance from master_insurance order by insurance";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $insurance == $DB->Record["insurance"]) {
                                                        echo'<option selected>' . $DB->Record["insurance"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["insurance"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_multiple">
                                            Company
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="insurance_company" class="form-control" value="<?php if ($id_error == false) echo $insurance_company; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple">
                                            Policy No
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="policy_no" class="form-control" value="<?php if ($id_error == false) echo $policy_no; ?>">
                                        </td>
                                        <td  class="form_label_multiple">
                                            Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="insurance_date" class="form-control pull-right" id="insurance_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $insurance_date;
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
                                        <td  class="form_label_multiple">
                                            Amount
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="insurance_amount" class="form-control" value="<?php if ($id_error == false) echo $insurance_amount; ?>">
                                        </td>
                                        <td  class="form_label_multiple">
                                            Risk
                                        </td>
                                        <td class="form_content_multiple" align="center">
                                            <input type="text" name="risk" class="form-control" value="<?php if ($id_error == false) echo $risk; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
                        <?php
                        if ($id_error == false) {
                            echo'<input type="hidden" name="form_action" value="Update"/>';
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