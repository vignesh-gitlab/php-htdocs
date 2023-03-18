<?php
include'../../template/client/header.default.php';

$actionpage = 'frieght_bill_action.php';
$tablename = 'sr_frieght_bill';
$tablename1 = 'sr_frieght_bill_item';

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
    $Query = "SELECT id,branch_code,branch,stationary_no,client_name,division_name,branch_name,service_tax_payable_by,party_address_line1,party_address_line2,party_city,party_pincode,bill_no,bill_date,pan_no,total from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $branch_code = $UDB->Record["branch_code"];
        $branch = $UDB->Record["branch"];
        $stationary_no = $UDB->Record["stationary_no"];
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $service_tax_payable_by = $UDB->Record["service_tax_payable_by"];
        $party_address_line1 = $UDB->Record["party_address_line1"];
        $party_address_line2 = $UDB->Record["party_address_line2"];
        $party_city = $UDB->Record["party_city"];
        $party_pincode = $UDB->Record["party_pincode"];
        $bill_no = $UDB->Record["bill_no"];
        $bill_date = $UDB->Record["bill_date"];
        $pan_no = $UDB->Record["pan_no"];
        $total = $UDB->Record["total"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,bill_date_item,no_item,particular,from_to,weight,rate,rate_type,sub_total from $tablename1 where bill_no='" . $bill_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $bill_date_item_array[] = $UDB->Record["bill_date_item"];
        $no_item_array[] = $UDB->Record["no_item"];
        $particular_array[] = $UDB->Record["particular"];
        $from_to_array[] = $UDB->Record["from_to"];
        $weight_array[] = $UDB->Record["weight"];
        $rate_array[] = $UDB->Record["rate"];
        $rate_type_array[] = $UDB->Record["rate_type"];
        $sub_total_array[] = $UDB->Record["sub_total"];
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
        display_bilty_no(client_name);
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
                    document.form.party_address_line1.value = myarray[0];
                    document.form.party_address_line2.value = myarray[1];
                    document.form.party_city.value = myarray[2];
                    document.form.party_pincode.value = myarray[3];
                    //document.form.contact_number.value = myarray[4];
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
    function display_bilty_no(client_name)
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
                for (i = 1; i <= 15; i++)
                {
                    var length = document.getElementById("no_item" + i).options.length;
                    for (j = (length - 1); j >= 0; j--)
                    {
                        document.getElementById("no_item" + i).options[j] = null;
                    }
                }

                if (myarray.length > 0)
                {
                    for (i = 1; i <= 15; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.getElementById("no_item" + i).options.add(optn);
                        for (j = 0; j < myarray.length; j++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[j];
                            optn.value = myarray[j];
                            document.getElementById("no_item" + i).options.add(optn);
                        }
                    }
                }
            }
        }
        var branch_code = document.form.branch_code.value;
        var url = "frieght_bill_dependent2.php";
        url = url + "?client_name=" + client_name + "&branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_from_to(no_item, line_id)
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
                    document.getElementById('from_to' + line_id).value = myarray[0];
                }
            }
        }
        var url = "frieght_bill_dependent3.php"
        url = url + "?no_item=" + no_item;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

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
                    document.form.branch.value = myarray[0];
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
        var book_type = "Frieght Bill";
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
                    alert("No Records Found in Stationary Master");
                }
            }
        }
        var url = "bilty_branch_code_dependent2.php"
        var book_type = "Frieght Bill";
        var branch_code = document.form.branch_code.value;
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function calculate_amount(line_id)
    {
        var sub_total = 0;
        var weight = 0;
        var rate_type = document.getElementById('rate_type' + line_id).value
        sub_total = Number(document.getElementById('rate' + line_id).value);
        weight = Number(document.getElementById('weight' + line_id).value);
        if (rate_type == "Flexible")
        {
            sub_total = Number(sub_total) * Number(weight);
        }
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
    /* function calculate_amount(line_id)
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
     }*/
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Frieght Bill
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="frieght_bill_grid.php">Frieght Bill</a></li>
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
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_code" id="branch_code" onchange="AjaxFunction_display_branch(this.value)">
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
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class=" form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_division_name(this.value)">
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
                                            <span class="red">*&nbsp</span>Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="branch" id="branch" autofocus class="form-control" value="<?php if ($id_error == false) echo $branch; ?>">
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
                                            <span class="red">*&nbsp;</span>Stationary Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="stationary_no" id="stationary_no"  class="form-control" onblur="check_bilty_no()" value="<?php if ($id_error == false) echo $stationary_no; ?>">
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
                                        <td  class="form_label_split2" rowspan="3">
                                            Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="party_address_line1" id="party_address_line1" class="form-control" value="<?php if ($id_error == false) echo $party_address_line1; ?>" placeholder="Address Line1">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">* &nbsp;</span>Bill Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="bill_no" id="bill_no" class="form-control" value="<?php if ($id_error == false) echo $bill_no; ?>">
                                        </td>

                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="party_address_line2" id="party_address_line2" class="form-control" value="<?php if ($id_error == false) echo $party_address_line2; ?>" placeholder="Address Line2">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Bill Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="bill_date" class="form-control pull-right" id="bill_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $bill_date;
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
                                            <input type="text" name="party_city" id="party_city" class="form-control" value="<?php if ($id_error == false) echo $party_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="party_pincode" id="party_pincode" class="form-control" value="<?php if ($id_error == false) echo $party_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" colspan="2"></td>
                                        <td  class="form_label_split2">
                                            PAN No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="pan_no" class="form-control" value="<?php if ($id_error == false) echo $pan_no; ?>">
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Date
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Number
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Particular
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            From - To
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Weight
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Rate
                                        </td>
                                        <td  class="form_label_multiple" style="width:15%;">
                                            Rate Type
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Subtotal
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="bill_date_item<?php echo $i; ?>" class="form-control pull-right" id="bill_date_item<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false) {
                                                        echo $bill_date_item_array[$i - 1];
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
                                                <select class="form-control dropdown_padding" name="no_item<?php echo $i; ?>" id="no_item<?php echo $i; ?>"  onchange="AjaxFunction_display_from_to(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                    <?php
                                                    if ($id_error == false && $no_item_array[$i - 1] != NULL) {
                                                        echo'<option selected>' . $no_item_array[$i - 1] . '</option>';
                                                    } else {
                                                        echo'<option>' . $no_item_array[$i - 1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="particular<?php echo $i; ?>"  name="particular<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $particular_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="from_to<?php echo $i; ?>" id="from_to<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false) echo $from_to_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:center;" onblur="calculate_amount(<?php echo $i; ?>)" id="weight<?php echo $i; ?>"  name="weight<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $weight_array[$i - 1];
                                                } else {
                                                    echo"0";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="rate<?php echo $i; ?>"  name="rate<?php echo $i; ?>" onblur="calculate_amount(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false) {
                                                    echo $rate_array[$i - 1];
                                                } else {
                                                    echo"0.00";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple" align="center">
                                                <select class="form-control dropdown_padding" onchange="calculate_amount(<?php echo $i; ?>)" id="rate_type<?php echo $i; ?>" name="rate_type<?php echo $i; ?>">

                                                    <?php
                                                    $Query = "select rate_type from master_rate_type order by rate_type";
                                                    $DB->query($Query);

                                                    while ($DB->Multicoloums()) {
                                                        if ($id_error == false && $rate_type_array[$i - 1] == $DB->Record["rate_type"]) {
                                                            echo'<option selected>' . $DB->Record["rate_type"] . '</option>';
                                                        } else {
                                                            echo'<option>' . $DB->Record["rate_type"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="sub_total<?php echo $i; ?>" readonly  name="sub_total<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $sub_total_array[$i - 1];
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="7" class="form_label_multiple_right">Total</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total" readonly name="total" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total
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