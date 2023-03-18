<?php
include'../../template/accounts/header.default.php';

$actionpage = 'lorry_chellan_action.php';
$tablename = 'sr_lorry_chellan';
$tablename1 = 'sr_lorry_chellan_item';

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
    $Query = "SELECT  id,order_no,order_date,so_no,so_date from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
    }
    $Query1 = "SELECT order_no,order_date,so_no,so_date,lane_from,lane_to,branch_code,stationary_no,branch_city,vehicle_no,delivery_address_line1,delivery_address_line2,delivery_city,delivery_pincode,packing from sr_bilty where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $order_no = $UDB1->Record["order_no"];
        $order_date = $UDB1->Record["order_date"];
        $so_no = $UDB1->Record["so_no"];
        $so_date = $UDB1->Record["so_date"];
        $lorry_from = $UDB1->Record["lane_from"];
        $lorry_to = $UDB1->Record["lane_to"];
        $branch_code = $UDB1->Record["branch_code"];
        $stationary_no = $UDB1->Record["stationary_no"];
        $branch_city = $UDB1->Record["branch_city"];
        $lorry_no = $UDB1->Record["vehicle_no"];
        $destination_address_line1 = $UDB1->Record["delivery_address_line1"];
        $destination_address_line2 = $UDB1->Record["delivery_address_line2"];
        $destination_city = $UDB1->Record["delivery_city"];
        $destination_pincode = $UDB1->Record["delivery_pincode"];
        $total_packages = $UDB1->Record["packing"];
    }
    $Query1 = "SELECT lr_no,lr_date from sr_vehicle_dispatch where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB1->query($Query1);
    while ($UDB1->Multicoloums()) {
        $lorry_chellan_no = $UDB1->Record["lr_no"];
        $lorry_chellan_date = $UDB1->Record["lr_date"];
    }
    $Query = "SELECT model_no,color,chase_no,vendor_name,permit_expires_on,permit_type,manufacturer from sr_vehicle where registration_no='" . $lorry_no . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $lorry_model = $DB->Record["model_no"];
        $lorry_color = $DB->Record["color"];
        $chassis_no = $DB->Record["chase_no"];
        $owner_name = $DB->Record["vendor_name"];
        $permit_valid_upto = $DB->Record["permit_expires_on"];
        $permit_status = $DB->Record["permit_type"];
        $lorry_make = $DB->Record["manufacturer"];
    }
    $Query = "SELECT address_line1,address_line2,city,pincode from sr_vendor where vendor_name='" . $owner_name . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $owner_address_line1 = $DB->Record["address_line1"];
        $owner_address_line2 = $DB->Record["address_line2"];
        $owner_city = $DB->Record["city"];
        $owner_pincode = $DB->Record["pincode"];
    }
}
if ($id_error == false) {
    $Query = "SELECT id,order_no,order_date,so_no,so_date,branch_code,stationary_no,lorry_chellan_no,lorry_chellan_date,lorry_from,lorry_to,lorry_no,branch,chassis_no,engine_no,owner_name,owner_address_line1,owner_address_line2,owner_city,owner_pincode,driver_name,license_no,driver_address_line1,driver_address_line2,driver_city,driver_pincode,lorry_model,lorry_color,lorry_make,permit_status,permit_valid_upto,ongaged_through,delivery_date,destination_address_line1,destination_address_line2,destination_city,destination_pincode,total_packages,rate_per_ton,rate_per_kg,frieght,extra_for,total,advance,less_tds,balance from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $branch_code = $UDB->Record["branch_code"];
        $stationary_no = $UDB->Record["stationary_no"];
        $lorry_chellan_no = $UDB->Record["lorry_chellan_no"];
        $lorry_chellan_date = $UDB->Record["lorry_chellan_date"];
        $lorry_from = $UDB->Record["lorry_from"];
        $lorry_to = $UDB->Record["lorry_to"];
        $lorry_no = $UDB->Record["lorry_no"];
        $branch = $UDB->Record["branch"];
        $chassis_no = $UDB->Record["chassis_no"];
        $engine_no = $UDB->Record["engine_no"];
        $owner_name = $UDB->Record["owner_name"];
        $owner_address_line1 = $UDB->Record["owner_address_line1"];
        $owner_address_line2 = $UDB->Record["owner_address_line2"];
        $owner_city = $UDB->Record["owner_city"];
        $owner_pincode = $UDB->Record["owner_pincode"];
        $driver_name = $UDB->Record["driver_name"];
        $license_no = $UDB->Record["license_no"];
        $driver_address_line1 = $UDB->Record["driver_address_line1"];
        $driver_address_line2 = $UDB->Record["driver_address_line2"];
        $driver_city = $UDB->Record["driver_city"];
        $driver_pincode = $UDB->Record["driver_pincode"];
        $lorry_model = $UDB->Record["lorry_model"];
        $lorry_color = $UDB->Record["lorry_color"];
        $lorry_make = $UDB->Record["lorry_make"];
        $permit_status = $UDB->Record["permit_status"];
        $permit_valid_upto = $UDB->Record["permit_valid_upto"];
        $ongaged_through = $UDB->Record["ongaged_through"];
        $delivery_date = $UDB->Record["delivery_date"];
        $destination_address_line1 = $UDB->Record["destination_address_line1"];
        $destination_address_line2 = $UDB->Record["destination_address_line2"];
        $destination_city = $UDB->Record["destination_city"];
        $destination_pincode = $UDB->Record["destination_pincode"];
        $total_packages = $UDB->Record["total_packages"];
        $rate_per_ton = $UDB->Record["rate_per_ton"];
        $rate_per_kg = $UDB->Record["rate_per_kg"];
        $frieght = $UDB->Record["frieght"];
        $extra_for = $UDB->Record["extra_for"];
        $total = $UDB->Record["total"];
        $advance = $UDB->Record["advance"];
        $less_tds = $UDB->Record["less_tds"];
        $balance = $UDB->Record["balance"];
    }

    $edit_product_count = 0;
    $Query = "SELECT  id,code,consignment_no,no_of_packages,packing,description,weight,destination,to_pay from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $code_name_array[] = $UDB->Record["code"];
        $consignment_no_array[] = $UDB->Record["consignment_no"];
        $no_of_packages_array[] = $UDB->Record["no_of_packages"];
        $packing_array[] = $UDB->Record["packing"];
        $description_array[] = $UDB->Record["description"];
        $weight_array[] = $UDB->Record["weight"];
        $destination_array[] = $UDB->Record["destination"];
        $to_pay_array[] = $UDB->Record["to_pay"];
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
                    //document.form.branch_city.value = myarray[0];
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
                        alert("Data Full Add new data to Stationary Master ");
                    }
                } else if (myarray.length == 0)
                {
                    document.form.stationary_no.value = "";
                    alert("Select a Branch Code with Data in Stationary Master");
                }
            }
        }
        var branch_code = document.form.branch_code.value;
        load_con_code(branch_code);
        var book_type = "Lorry Chellan";
        var url = "bilty_branch_code_dependent3.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function load_con_code(branch_code)
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

                for (i = 1; i <= 10; i++)
                {
                    var max_data = document.getElementById('code' + i).options.length;
                    max_data = max_data - 1;
                    for (j = max_data; j >= 0; j--)
                    {
                        document.getElementById('code' + i).remove(j);
                    }
                }
                if (myarray.length > 0)
                {
                    for (i = 1; i <= 10; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.getElementById('code' + i).options.add(optn);

                        for (j = 0; j < myarray.length; j++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[j];
                            optn.value = myarray[j];
                            document.getElementById('code' + i).options.add(optn);
                        }
                        optn.text = "Other";
                        optn.value = "Other";
                        document.getElementById('code' + i).options.add(optn);
                    }
                }
            }
        }
        var url = "bilty_branch_code_dependent4.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function AjaxFunction_display_consignment_item(con_no, line_id)
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

                var max_data = document.getElementById('consignment_no' + line_id).options.length;
                max_data = max_data - 1;
                for (j = max_data; j >= 0; j--)
                {
                    document.getElementById('consignment_no' + line_id).remove(j);
                }
                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.getElementById('consignment_no' + line_id).options.add(optn);

                    for (j = 0; j < myarray.length; j++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[j];
                        optn.value = myarray[j];
                        document.getElementById('consignment_no' + line_id).options.add(optn);
                    }
                }
            }
        }
        document.getElementById('code_name' + line_id).value = con_no;
        var url = "bilty_branch_code_dependent5.php"
        url = url + "?con_no=" + con_no;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function AjaxFunction_display_consignment(con_des, line_id)
    {
        var code = document.getElementById('code' + line_id).value;
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
                    document.getElementById('description' + line_id).value = myarray[0];
                    document.getElementById('packing' + line_id).value = myarray[1];
                    document.getElementById('no_of_packages' + line_id).value = myarray[2];
                    document.getElementById('weight' + line_id).value = myarray[3];
                    document.getElementById('destination' + line_id).value = myarray[4];
                }
            }
        }
        var url = "bilty_branch_code_dependent6.php"
        url = url + "?code=" + code + "&con_no=" + con_des;
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
                    alert("No Records Found in Stationary Master");
                }
            }
        }
        var url = "bilty_branch_code_dependent2.php"
        var book_type = "Lorry Chellan";
        var branch_code = document.form.branch_code.value;
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function calculate_frieght()
    {
        var rateperton = document.form.rate_per_ton.value;
        var rateperkg = document.form.rate_per_kg.value;
        var frieght = 0;
        frieght = Number(rateperton) * Number(rateperkg);
        frieght_charges = Number(frieght).toFixed(2);
        document.getElementById('frieght').value = frieght_charges;
    }
    function calculate_total()
    {
        var frieght = 0;
        frieght = document.getElementById('frieght').value;
        var extra_for = 0;
        extra_for = document.getElementById('extra_for').value;
        var total = 0;
        total = Number(frieght) + Number(extra_for);
        total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
        var balance = 0;
        var advance = document.getElementById('advance').value;
        var less_tds = document.getElementById('less_tds').value;
        balance = Number(document.getElementById('total').value) - (Number(advance) + Number(less_tds));
        balance_charges = Number(balance).toFixed(2);
        document.getElementById('balance').value = balance_charges;
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Chellan
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="lorry_chellan_grid.php">Lorry Chellan</a></li>
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
                                            SO Ref. NO.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            SO Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_date; ?>">
                                        </td>
                                    </tr>
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
                                                    if (($id_error == false) && $branch_code == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Stationary Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="stationary_no" id="stationary_no"  class="form-control" onblur="check_bilty_no()" value="<?php if ($id_error == false) echo $stationary_no; ?>">
                                        </td>
                                    </tr>
                                    <td  class="form_label_split2">
                                        <span class="red">*&nbsp</span>Lorry Chellan No
                                    </td>
                                    <td class="form_content_split2" align="center">
                                        <input type="text" required name="lorry_chellan_no" id="lorry_chellan_no" class="form-control"  value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_chellan_no; ?>">
                                    </td>
                                    <td  class="form_label_split2">
                                        Date
                                    </td>
                                    <td class="form_content_split2" align="center">
                                        <div class="input-group">
                                            <input type="text" readonly="true" name="lorry_chellan_date" class="form-control pull-right" id="lorry_chellan_date" onfocus="pick_date(this.id);" value="<?php
                                            if ($id_error == false || $orderno_error == false) {
                                                echo $lorry_chellan_date;
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
                                            From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_from" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_from; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_to" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_to; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Lorry Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="branch" class="form-control" value="<?php if ($id_error == false) echo $branch; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Chassis Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="chassis_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $chassis_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Engine Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="engine_no" class="form-control" value="<?php if ($id_error == false) echo $engine_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Owner(Vendor/Contractor)
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="owner_name" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $owner_name; ?>" placeholder="Owner Name">
                                        </td>
                                        <td  class="form_label_split2">
                                            Driver Name
                                        </td>
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="driver_name" class="form-control" value="<?php if ($id_error == false) echo $driver_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="owner_address_line1" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $owner_address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                        <td  class="form_label_split2">
                                            License Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="license_no" class="form-control" value="<?php if ($id_error == false) echo $license_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="owner_address_line2" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $owner_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="driver_address_line1" class="form-control" value="<?php if ($id_error == false) echo $driver_address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="owner_city" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $owner_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="owner_pincode" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $owner_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="driver_address_line2" class="form-control" value="<?php if ($id_error == false) echo $driver_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Model
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_model" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_model; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="driver_city" class="form-control" value="<?php if ($id_error == false) echo $driver_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="driver_pincode" class="form-control" value="<?php if ($id_error == false) echo $driver_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Lorry Color
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_color" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_color; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Make
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_make" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_make; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Permit Status
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="permit_status" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $permit_status; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Permit Valid Upto
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="permit_valid_upto" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $permit_valid_upto; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Ongaged Through
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="ongaged_through" class="form-control" value="<?php if ($id_error == false) echo $ongaged_through; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Destination Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="destination_address_line1" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $destination_address_line1; ?>" placeholder="Address Line1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Delivery Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="delivery_date" class="form-control pull-right" id="delivery_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $delivery_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="destination_address_line2" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $destination_address_line2; ?>" placeholder="Address Line2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Total Packages
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="total_packages" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $total_packages; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="destination_city" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $destination_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="destination_pincode" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $destination_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:14%;">
                                            Con. Code
                                        </td>
                                        <td  class="form_label_multiple" style="width:14%;">
                                            Consignment Data
                                        </td>
                                        <td  class="form_label_multiple" style="width:7%;">
                                            No.of Packages
                                        </td>
                                        <td  class="form_label_multiple" style="width:9%;">
                                            Packing
                                        </td>
                                        <td  class="form_label_multiple" style="width:21%;">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Weight
                                        </td>
                                        <td  class="form_label_multiple" style="width:16%;">
                                            Destination
                                        </td>
                                        <td  class="form_label_multiple" style="width:13%;">
                                            To Pay
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 10; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" name="code<?php echo $i; ?>" id="code<?php echo $i; ?>" style="width:50%;float:left;" onchange="AjaxFunction_display_consignment_item(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>

                                                </select>
                                                <input type="text"  id="code_name<?php echo $i; ?>" name="code_name<?php echo $i; ?>" id="code_name<?php echo $i; ?>" style="width:50%;float:right" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $code_name_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" name="consignment_no<?php echo $i; ?>" id="consignment_no<?php echo $i; ?>" onchange="AjaxFunction_display_consignment(this.value,<?php echo $i; ?>)">

                                                    <option>Select</option>
                                                    <?php
                                                    if (($id_error == false) && $consignment_no_array[$i - 1] != NULL) {
                                                        echo'<option selected>' . $consignment_no_array[$i - 1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  id="no_of_packages<?php echo $i; ?>" name="no_of_packages<?php echo $i; ?>" id="no_of_packages<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $no_of_packages_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="packing<?php echo $i; ?>" name="packing<?php echo $i; ?>" id="packing<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $packing_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="description<?php echo $i; ?>" name="description<?php echo $i; ?>" id="description<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $description_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="weight<?php echo $i; ?>" name="weight<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $weight_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="destination<?php echo $i; ?>"  name="destination<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $destination_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="to_pay<?php echo $i; ?>"  name="to_pay<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $to_pay_array[$i - 1];
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
                                        <td  class="form_label_split2">
                                            Rate Per Ton
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="rate_per_ton" id="rate_per_ton" class="form-control" value="<?php if ($id_error == false) echo $rate_per_ton; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Weight Per Kg
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="rate_per_kg" id="rate_per_kg" onblur="calculate_frieght()" class="form-control" value="<?php if ($id_error == false) echo $rate_per_kg; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Frieght
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="frieght" id="frieght" onblur="calculate_total()" class="form-control" value="<?php if ($id_error == false) echo $frieght; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Extra For
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="extra_for" id="extra_for" onblur="calculate_total()" class="form-control" value="<?php if ($id_error == false) echo $extra_for; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Total
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="total" id="total" onblur="calculate_total()" class="form-control" value="<?php if ($id_error == false) echo $total; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Advance
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="advance" id="advance" onblur="calculate_total()" class="form-control" value="<?php if ($id_error == false) echo $advance; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Less TDS
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="less_tds" id="less_tds" onblur="calculate_total()" class="form-control" value="<?php if ($id_error == false) echo $less_tds; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Balance
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="balance" id="balance" class="form-control" value="<?php if ($id_error == false) echo $balance; ?>">
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