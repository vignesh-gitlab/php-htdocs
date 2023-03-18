<?php
include'../../template/client_branch/header.default.php';

//$actionpage = 'sales_order_action.php';
$tablename = 'sr_sales_order';
$tablename1 = 'sr_sales_order_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

$wono_error = false;
if ((!isset($_REQUEST["quotation_no"])) || (empty($_REQUEST["quotation_no"]))) {
    $wono_error = true;
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

    function AjaxFunction_display_lane(vehicle_type)
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
                    var length = document.getElementById("lane_id" + i).options.length;
                    for (j = (length - 1); j >= 0; j--)
                    {
                        document.getElementById("lane_id" + i).options[j] = null;
                    }
                }

                if (myarray.length > 0)
                {
                    for (i = 1; i <= 25; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.getElementById("lane_id" + i).options.add(optn);
                        for (j = 0; j < myarray.length; j++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[j];
                            optn.value = myarray[j];
                            document.getElementById("lane_id" + i).options.add(optn);
                        }
                    }
                }
            }
        }
        var url = "quotation_dependent2.php";
        //var vehicle_type = encodeURIComponent(vehicle_type);
        url = url + "?vehicle_type=" + vehicle_type;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function AjaxFunction_display_lane_detail(lane_id, line_id)
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
                    document.getElementById('lane_from' + line_id).value = myarray[0];
                    document.getElementById('lane_to' + line_id).value = myarray[1];
                    document.getElementById('line_total' + line_id).value = myarray[2];
                    document.getElementById('ex_total' + line_id).value = myarray[2];

                }
            }
            calculate_sub_total();
        }
        var url = "quotation_dependent3.php";
        // var product_name = encodeURIComponent(product_name);
        url = url + "?lane_id=" + lane_id;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function calculate_sub_total()
    {
        //var unit_total = document.getElementById('line_total' + line_id).value;
        var sub_total = 0;
        for (i = 1; i <= 25; i++)
        {
            sub_total = Number(sub_total) + (Number(document.getElementById('line_total' + i).value));
        }
        var sub_total_charges = Number(sub_total).toFixed(2);
        document.getElementById('sub_total').value = sub_total_charges;
        document.getElementById('grand_total').value = sub_total_charges;
    }
    function calculate_tax()
    {
        var tax_rate = document.getElementById('tax_rate').value;
        var tax_type = document.getElementById('tax_type').value;
        var sub_total = document.getElementById('sub_total').value;
        var total_tax = 0;
        var grand_total = 0;
        var sub_total = 0;
        for (i = 1; i <= 25; i++)
        {
            sub_total = Number(sub_total) + (Number(document.getElementById('line_total' + i).value));
        }
        if (tax_rate != "NA")
        {
            if (tax_type == "Ex")
            {
                total_tax = ((Number(sub_total) * Number(tax_rate)) / 100);
            }
            if (tax_type == "In")
            {
                //tax_amount = (Number(tax_rate) / 100) * Number(amount);
                total_tax = (Number(sub_total) - (Number(sub_total) * 100) / (Number(tax_rate) + 100));
            }
        }
        if (tax_type == "Ex")
        {
            //line_amount = (Number(sub_total));
            // total_tax = ((Number(sub_total) * Number(tax_rate)) / 100);
            sub_total = (Number(sub_total));
            grand_total = (Number(sub_total) + Number(total_tax));
        }
        if (tax_type == "In")
        {
            //line_amount = (Number(amount) - Number(tax_amount));
            //  line_amount = (Number(sub_total) * 100) / (Number(tax_rate) + 100);
            grand_total = (Number(sub_total));
            sub_total = (Number(sub_total) - Number(total_tax));
        }
        var sub_total_charges = Number(sub_total).toFixed(2);
        var line_tax_charges = Number(total_tax).toFixed(2);
        var total_amount_charges = Number(grand_total).toFixed(2);
        document.getElementById('sub_total').value = sub_total_charges;
        document.getElementById('total_tax').value = line_tax_charges;
        document.getElementById('grand_total').value = total_amount_charges;
    }
    function calculate_discount()
    {
        var sub_total = document.getElementById('sub_total').value;
        var total_tax = document.getElementById('total_tax').value;
        var discount_percentage = document.getElementById('discount_percentage').value;
        var discount_amount = 0;
        if (discount_percentage != "NA")
        {
            discount_amount = ((Number(sub_total) + Number(total_tax)) * Number(discount_percentage)) / 100;
            discount_amount = Number(discount_amount).toFixed(2);
            document.getElementById('discount').value = discount_amount;
        }
        var discount = document.getElementById('discount').value;
        var grand_total = (Number(sub_total) + Number(total_tax)) - Number(discount);
        var grand_total_charges = Number(grand_total).toFixed(2);
        document.getElementById('grand_total').value = grand_total_charges;
    }
    function AjaxFunction_display_terms(terms_list)
    {
        if (terms_list == "New Terms")
        {
            document.form.terms_and_condition.readOnly = false;
            document.form.terms_and_condition.value = "";
        } else
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
                        document.form.terms_and_condition.readOnly = true;
                        document.form.terms_and_condition.value = myarray[0];
                    }
                }
            }
            var url = "sales_invoice_dependent2.php";
            url = url + "?terms_list=" + terms_list;
            //url=url+"&sid="+Math.random();
            httpxml.onreadystatechange = stateck;
            httpxml.open("GET", url, true);
            httpxml.send(null);
        }
    }


</script>
<?php
if ($wono_error == false) {
    $Query = "SELECT quotation_no,quotation_date,vehicle_type,vehicle_required_date,client_name,division_name,branch_name,address_line1,address_line2,city,pincode,contact_no,terms_and_condition,sub_total,total_tax,discount, grand_total from sr_quotation where quotation_no='" . $_REQUEST["quotation_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $quotation_no = $UDB->Record["quotation_no"];
        $quotation_date = $UDB->Record["quotation_date"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $address_line1 = $UDB->Record["address_line1"];
        $address_line2 = $UDB->Record["address_line2"];
        $city = $UDB->Record["city"];
        $pincode = $UDB->Record["pincode"];
        $contact_no = $UDB->Record["contact_no"];
        $terms_and_condition = $UDB->Record["terms_and_condition"];
        $sub_total = $UDB->Record["sub_total"];
        $total_tax = $UDB->Record["total_tax"];
        $discount = $UDB->Record["discount"];
        $grand_total = $UDB->Record["grand_total"];
    }

    $edit_product_count = 0;
    $Query = "SELECT  lane_id,lane_from,lane_to,unit_price,ex_total,tax_rate,tax_type,tax_total,amount from sr_quotation_item where quotation_no='" . $quotation_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $lane_id_array[] = $UDB->Record["lane_id"];
        $lane_from_array[] = $UDB->Record["lane_from"];
        $lane_to_array[] = $UDB->Record["lane_to"];
        $quantity_array[] = $UDB->Record["quantity"];
        $unit_price_array[] = $UDB->Record["unit_price"];
        $ex_total_array[] = $UDB->Record["ex_total"];
        $tax_rate_array[] = $UDB->Record["tax_rate"];
        $tax_type_array[] = $UDB->Record["tax_type"];
        $tax_total_array[] = $UDB->Record["tax_total"];
        $amount_array[] = $UDB->Record["amount"];
    }
}

if ($id_error == false) {
    $Query = "SELECT so_id,so_no,so_date,quotation_ref_no,quotation_date,description,vehicle_type,vehicle_required_date,so_copy,client_name,division_name,branch_name,address_line1,address_line2,city,pincode,contact_no,terms_and_condition,sub_total,total_tax,discount,grand_total from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $so_id = $UDB->Record["so_id"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $quotation_ref_no = $UDB->Record["quotation_ref_no"];
        $quotation_date = $UDB->Record["quotation_date"];
        $description = $UDB->Record["description"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $so_copy = $UDB->Record["so_copy"];
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $address_line1 = $UDB->Record["address_line1"];
        $address_line2 = $UDB->Record["address_line2"];
        $city = $UDB->Record["city"];
        $pincode = $UDB->Record["pincode"];
        $contact_no = $UDB->Record["contact_no"];
        $terms_and_condition = $UDB->Record["terms_and_condition"];
        $sub_total = $UDB->Record["sub_total"];
        $total_tax = $UDB->Record["total_tax"];
        $discount = $UDB->Record["discount"];
        $grand_total = $UDB->Record["grand_total"];
    }

    $edit_product_count = 0;
    $Query = "SELECT  id,lane_id,lane_from,lane_to,unit_price,ex_total,tax_rate,tax_type,tax_total,amount from $tablename1 where so_no='" . $so_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $lane_id_array[] = $UDB->Record["lane_id"];
        $lane_from_array[] = $UDB->Record["lane_from"];
        $lane_to_array[] = $UDB->Record["lane_to"];
        $quantity_array[] = $UDB->Record["quantity"];
        $unit_price_array[] = $UDB->Record["unit_price"];
        $ex_total_array[] = $UDB->Record["ex_total"];
        $tax_rate_array[] = $UDB->Record["tax_rate"];
        $tax_type_array[] = $UDB->Record["tax_type"];
        $tax_total_array[] = $UDB->Record["tax_total"];
        $amount_array[] = $UDB->Record["amount"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Order</li>
            <li><a href = "sales_order_grid.php">Sales Order</a></li>
            <li class = "active">Entry</li>
        </ol>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class = "row">
            <div class = "col-xs-12">
                <form role = "form" name = "form" id = "form1" method = "post" onsubmit = "return checkForm(this);" action = "<?php echo $actionpage; ?>" enctype = "multipart/form-data" autocomplete = "<?php echo AUTOCOMPLETE ?>">
                    <div class = "box">
                        <div class = "box-body table-responsive">
                            <div class = "form_tablebox">
                                <table cellspacing = "0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Sales Order Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(so_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_so_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" readonly name="so_no" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $so_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                                   <?php
                                                   if ($form_error == false) {
                                                       ?>
                                                <input type="hidden" name="so_id" class="form-control" value="<?php echo $quotation_id; ?>">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class = "form_label_split2" rowspan = "4">
                                            Reference / Description
                                        </td>
                                        <td class = "form_content_split2" rowspan = "4" align = "center">
                                            <textarea name = "so_reference" style = "height:98px;" autofocus class = "form-control"><?php
                                                if ($id_error == false)
                                                    echo
                                                    $description;
                                                ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Sales Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="so_date" class="form-control pull-right" id="so_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $so_date;
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
                                        <td class = "form_label_split2">
                                            Quotation Ref. Number
                                        </td>
                                        <td class = "form_label_split2">
                                            <input type = "text" readonly name = "quotation_ref_no" class = "form-control" value = "<?php if (($id_error == false ) || ( $wono_error == false )) echo $quotation_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Quotation Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type = "text" readonly name = "quotation_date" class = "form-control" value = "<?php if (($id_error == false ) || ( $wono_error == false )) echo $quotation_date; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Required Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type = "text" readonly name = "vehicle_required_date" class = "form-control" value = "<?php if (($id_error == false ) || ( $wono_error == false )) echo $vehicle_required_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vehicle_type" id="vehicle_type" onchange="AjaxFunction_display_lane(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(vehicle_type) from sr_vehicle_type order by vehicle_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ((($id_error == false) || ( $wono_error == false )) && $vehicle_type == $DB->Record["vehicle_type"]) {
                                                        echo'<option selected>' . $DB->Record["vehicle_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vehicle_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2" rowspan="7">
                                            Client Name & Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_division_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ((($id_error == false) || ( $wono_error == false )) && $client_name == $DB->Record["client_name"]) {
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
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="division_name" id="division_name" onchange="AjaxFunction_display_branch_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(division_name) from sr_client order by division_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ((($id_error == false) || ( $wono_error == false )) && $division_name == $DB->Record["division_name"]) {
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
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_name" id="branch_name" onchange="AjaxFunction_display_client_details(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ((($id_error == false) || ( $wono_error == false )) && $branch_name == $DB->Record["branch_name"]) {
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
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line1" readonly name="address_line1" class="form-control" placeholder="Address Line 1" value="<?php if (($id_error == false) || ( $wono_error == false )) echo $address_line1; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="address_line2" readonly name="address_line2" class="form-control" placeholder="Address Line 2" value="<?php if (($id_error == false) || ( $wono_error == false )) echo $address_line2; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <input type="text" id="city" name="city" readonly class="form-control" placeholder="City" style="float:left; width:70%;" value="<?php if (($id_error == false) || ( $wono_error == false )) echo $city; ?>">
                                            <input type="text" id="pincode" name="pincode" readonly class="form-control" placeholder="Pincode" style="float:left; width:30%;" value="<?php if (($id_error == false) || ( $wono_error == false )) echo $pincode; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="contact_number" readonly name="contact_number" class="form-control" placeholder="Contact Number" value="<?php if (($id_error == false) || ( $wono_error == false )) echo $contact_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:23%;">
                                            Lane ID
                                        </td>
                                        <td  class="form_label_multiple" style="width:30%;">
                                            From
                                        </td>
                                        <td  class="form_label_multiple" style="width:31%;">
                                            To
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Price
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" name="lane_id<?php echo $i; ?>" id="lane_id<?php echo $i; ?>" onchange="AjaxFunction_display_lane_detail(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                    <?php
                                                    $Query = "select distinct(lane_id) from sr_lane";
                                                    $DB->query($Query);

                                                    while ($DB->Multicoloums()) {
                                                        if ($id_error == false && $lane_id_array[$i - 1] == $DB->Record["lane_id"]) {
                                                            echo'<option selected>' . $DB->Record["lane_id"] . '</option>';
                                                        } else {
                                                            echo'<option>' . $DB->Record["lane_id"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" readonly name="lane_from<?php echo $i; ?>" id="lane_from<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false) echo $lane_from_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" readonly name="lane_to<?php echo $i; ?>" id="lane_to<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false) echo $lane_to_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right; float:left;" id="line_total<?php echo $i; ?>"  name="line_total<?php echo $i; ?>" onblur="calculate_sub_total()" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $unit_price_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                                <input type="hidden" name="ex_total<?php echo $i; ?>" id="ex_total<?php echo $i; ?>"  value="<?php
                                                if (($id_error == false ) || ( $wono_error == false )) {
                                                    echo $ex_total_array[$i - 1];
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
                                        <td colspan="2" class="form_label_multiple">Terms & Condition</td>
                                        <td colspan="1" class="form_label_multiple_right">Subtotal</td>
                                        <td class="form_content_multiple"><input type="text" style="text-align:right;" readonly id="sub_total" name="sub_total" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $sub_total;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="3" class="form_content_multiple">
                                            <select class="form-control dropdown_padding" id="terms_list" name="terms_list" onchange="AjaxFunction_display_terms(this.value)">
                                                <option>Select</option>
                                                <option>New Terms</option>
                                                <?php
                                                /*
                                                  $Query = "select term_name from master_terms_condition order by term_name";
                                                  $DB->query($Query);

                                                  while ($DB->Multicoloums()) {
                                                  if ($id_error == false && $terms_condition == $DB->Record["term_name"]) {
                                                  echo'<option selected>' . $DB->Record["term_name"] . '</option>';
                                                  } else {
                                                  echo'<option>' . $DB->Record["term_name"] . '</option>';
                                                  }
                                                  }
                                                 */
                                                ?>
                                            </select>
                                            <textarea id="terms_and_condition" style="height:56px;" readonly name="terms_and_condition" class="form-control"><?php if ($id_error == false) echo $terms_and_condition; ?></textarea>
                                        </td>
                                        <td colspan="1" class="form_label_multiple_right">(+)  Tax</td>
                                        <td colspan="1" class="form_content_multiple">
                                            <select class="form-control dropdown_padding" style="width:32%; float:left;" onchange="calculate_tax()" id="tax_rate" name="tax_rate">
                                                <option>NA</option>
                                                <?php
                                                $Query = "select tax_rate from sr_tax_rate order by tax_rate";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $tax_rate_array[$i - 1] == $DB->Record["tax_rate"]) {
                                                        echo'<option selected>' . $DB->Record["tax_rate"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["tax_rate"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <select class="form-control dropdown_padding" style="width:27%;  float:left;" onchange="calculate_tax()" id="tax_type" name="tax_type">
                                                <?php
                                                $Query = "select tax_type from master_tax_type order by tax_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $tax_type_array[$i - 1] == $DB->Record["tax_type"]) {
                                                        echo'<option selected>' . $DB->Record["tax_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["tax_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="text" style="text-align:right;width:41%;" readonly id="total_tax" name="total_tax" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $total_tax;
                                            } else {
                                                echo"0.00";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="form_label_multiple_right">(-) Discount</td>
                                        <td colspan="1" class="form_content_multiple">
                                            <div style="float:left; width:40%;">
                                                <div class="input-group">
                                                    <input type="text" onblur="calculate_discount()" id="discount_percentage" name="discount_percentage" class="form-control" value="<?php
                                                    if ($id_error == false) {
                                                        echo $discount_percentage;
                                                    } else {
                                                        echo"NA";
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <b>%</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="float:right; width:60%;">
                                                <input type="text" style="text-align:right;" onblur="calculate_discount()" id="discount" name="discount" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $discount;
                                                } else {
                                                    echo"0.00";
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="form_label_multiple_right">Grand Total</td>
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
                        <div class="box-footer">
                            <button type="submit" onsubmit="this.style.display = 'none';
                                    clear_but.style.display = 'none';
                                    submit_loader.style.display = 'block';
                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                            <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
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
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>