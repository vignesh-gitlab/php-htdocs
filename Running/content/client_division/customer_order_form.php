<?php
include'../../template/client_division/header.default.php';

$actionpage = 'customer_order_action.php';
$tablename = 'sr_customer_order';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
$so_error = false;
if ((!isset($_REQUEST["so_no"])) || (empty($_REQUEST["so_no"]))) {
    $so_error = true;
}

if ($so_error == false) {
    $so_no = $_REQUEST["so_no"];
    $Query = "SELECT  id,so_no,so_date,client_name,division_name,branch_name,vehicle_type,vehicle_required_date from sr_sales_order where so_no='" . $_REQUEST["so_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["division_name"];
        $client_branch = $UDB->Record["branch_name"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
    }
}
if ($id_error == false) {
    $Query = "SELECT  id,order_id,order_no,client_name,client_division,client_branch,so_no,so_date,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,pickup_address_line1,pickup_address_line2,pickup_city,pickup_pincode,vehicle_type,vehicle_ownership_type,vehicle_owner,primary_secondary,escort_type,description,email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10,mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_id = $UDB->Record["order_id"];
        $order_no = $UDB->Record["order_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $order_date = $UDB->Record["order_date"];
        $order_time = $UDB->Record["order_time"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $pickup_address_line1 = $UDB->Record["pickup_address_line1"];
        $pickup_address_line2 = $UDB->Record["pickup_address_line2"];
        $pickup_city = $UDB->Record["pickup_city"];
        $pickup_pincode = $UDB->Record["pickup_pincode"];
        $vehicle_ownership_type = $UDB->Record["vehicle_ownership_type"];
        $vehicle_owner = $UDB->Record["vehicle_owner"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $primary_secondary = $UDB->Record["primary_secondary"];
        $escort_type = $UDB->Record["escort_type"];
        $description = $UDB->Record["description"];
        $email_id1 = $UDB->Record["email_id1"];
        $email_id2 = $UDB->Record["email_id2"];
        $email_id3 = $UDB->Record["email_id3"];
        $email_id4 = $UDB->Record["email_id4"];
        $email_id5 = $UDB->Record["email_id5"];
        $email_id6 = $UDB->Record["email_id6"];
        $email_id7 = $UDB->Record["email_id7"];
        $email_id8 = $UDB->Record["email_id8"];
        $email_id9 = $UDB->Record["email_id9"];
        $email_id10 = $UDB->Record["email_id10"];
        $mobile_no1 = $UDB->Record["mobile_no1"];
        $mobile_no2 = $UDB->Record["mobile_no2"];
        $mobile_no3 = $UDB->Record["mobile_no3"];
        $mobile_no4 = $UDB->Record["mobile_no4"];
        $mobile_no5 = $UDB->Record["mobile_no5"];
        $mobile_no6 = $UDB->Record["mobile_no6"];
        $mobile_no7 = $UDB->Record["mobile_no7"];
        $mobile_no8 = $UDB->Record["mobile_no8"];
        $mobile_no9 = $UDB->Record["mobile_no9"];
        $mobile_no10 = $UDB->Record["mobile_no10"];
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

                for (j = document.form.client_division.options.length - 1; j >= 0; j--)
                {
                    document.form.client_division.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.client_division.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.client_division.options.add(optn);
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

                for (j = document.form.client_branch.options.length - 1; j >= 0; j--)
                {
                    document.form.client_branch.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.client_branch.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.client_branch.options.add(optn);
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
    function AjaxFunction_client_location(client_location)
    {
        if (client_location == "Others")
        {
            for (j = document.form.customer_location.options.length - 1; j >= 0; j--)
            {
                document.form.customer_location.remove(j);
            }
            var optn = document.createElement("OPTION");
            optn.text = "Select";
            optn.value = "Select";
            document.form.customer_location.options.add(optn);

            document.form.destination.value = "";
            document.getElementById("customer_location_text").readOnly = false;
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
                    for (j = document.form.customer_location.options.length - 1; j >= 0; j--)
                    {
                        document.form.customer_location.remove(j);
                    }

                    document.form.destination.value = "";

                    if (myarray.length > 0)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.form.customer_location.options.add(optn);
                        for (i = 0; i < myarray.length; i++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[i];
                            optn.value = myarray[i];
                            document.form.customer_location.options.add(optn);
                        }
                    }
                }
            }
            var url = "customer_order_dependent1.php";
            url = url + "?client_location=" + client_location;
            //url=url+"&sid="+Math.random();
            httpxml.onreadystatechange = stateck;
            httpxml.open("GET", url, true);
            httpxml.send(null);
        }
    }

    function AjaxFunction_client_value(client_value)
    {
        document.form.destination.value = client_value;
    }

    function AjaxFunction_client_value_text()
    {
        var client_value = document.getElementById('customer_location_text').value;
        document.form.destination.value = client_value;
    }

</script>

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="customer_order_grid.php">Order</a></li>
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
                                            <?php
                                            $Query = "SELECT max(cast(order_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            ?>
                                            <input type="hidden" name="order_id" class="form-control" value="<?php if ($id_error == true) echo $new_max_id; ?>">
                                            <input type="text" name="order_no" class="form-control" readonly value="<?php
                                            if ($id_error == false)
                                                echo $order_no;
                                            else
                                                echo $commonvar_order_no_prefix . $new_max_id;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_name" id="client_name" onchange="AjaxFunction_display_division_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || ($so_error == false)) && $client_name == $DB->Record["client_name"]) {
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
                                            Client Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_division" id="client_division" onchange="AjaxFunction_display_branch_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(division_name) from sr_client order by division_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $so_error == false) && $client_division == $DB->Record["division_name"]) {
                                                        echo'<option selected>' . $DB->Record["division_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["division_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_branch" id="client_branch">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $so_error == false) && $client_branch == $DB->Record["branch_name"]) {
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
                                            Sales Order No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php if ($id_error == false || $so_error == false) { ?>
                                                <input type="text" readonly name="so_no" class="form-control" value="<?php if ($id_error == false || $so_error == false) echo $so_no; ?>">
                                            <?php } else { ?>
                                                <input type="text" name="so_no" class="form-control" value="<?php if ($id_error == false || $so_error == false) echo $so_no; ?>">
                                            <?php } ?>
                                        </td>
                                        <td  class="form_label_split2">
                                            Sales Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php if ($id_error == false || $so_error == false) { ?>
                                                <input type="text" readonly name="so_date" class="form-control" value="<?php if ($id_error == false || $so_error == false) echo $so_date; ?>">
                                            <?php } else { ?>
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
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="order_date" class="form-control pull-right" id="order_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $order_date;
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
                                            Order Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" readonly name="order_time" class="form-control timepicker" value="<?php
                                                    if ($id_error == false) {
                                                        echo $order_time;
                                                    } else {
                                                        echo date('h:i A');
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div><!-- /.input group -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Required Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="vehicle_required_date" class="form-control pull-right" id="vehicle_required_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false || $so_error == false) {
                                                    echo $vehicle_required_date;
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
                                            Vehicle Required Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" readonly name="vehicle_required_time" class="form-control timepicker" value="<?php
                                                    if ($id_error == false) {
                                                        echo $vehicle_required_time;
                                                    } else {
                                                        echo date('h:i A');
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div><!-- /.input group -->
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
                                        <td  class="form_label_split2">
                                            Client Location Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" id="customer_location_type" name="customer_location_type" onchange="AjaxFunction_client_location(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select customer_location from  master_customer_location order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    echo'<option>' . $DB->Record["customer_location"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Location
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" id="customer_location" name="customer_location" onchange="AjaxFunction_client_value(this.value)">
                                                <option>Select</option>
                                            </select>
                                            <input type="text" id="customer_location_text" onblur="AjaxFunction_client_value_text();" name="customer_location_text" class="form-control" readonly="true">
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
                                            <span class="red">*&nbsp;</span>Origin
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="orgin" class="form-control" value="<?php if ($id_error == false) echo $orgin; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Destination
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required readonly="true" id="destination" name="destination" class="form-control" value="<?php if ($id_error == false) echo $destination; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2" rowspan="3">
                                            <span class="red">*&nbsp;</span>Pickup Address
                                        </td>
                                        <td class="form_content_split2" align="center" rowspan="3">
                                            <input type="text" required name="pickup_address_line1" class="form-control" value="<?php if ($id_error == false) echo $pickup_address_line1; ?>" placeholder="Address Line 1">
                                            <input type="text" required name="pickup_address_line2" class="form-control" value="<?php if ($id_error == false) echo $pickup_address_line2; ?>" placeholder="Address Line 2">
                                            <input type="text" required name="pickup_city" class="form-control" value="<?php if ($id_error == false) echo $pickup_city; ?>" placeholder="City" style="float:left; width:70%;">
                                            <input type="text" name="pickup_pincode" class="form-control" value="<?php if ($id_error == false) echo $pickup_pincode; ?>" placeholder="Pincode" style="float:left; width:30%;">
                                        </td>
                                        <td  class="form_label_split2">
                                            Remarks
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <textarea class="form-control" name="description" style="height:80px;"><?php if ($id_error == false) echo $description; ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--
                                                <div class="box-body table-responsive">
                                                    <div class="form_tablebox">
                                                        <table cellspacing="0">
                                                            <tr>
                                                                <td  class="form_label_split2">
                                                                    Client Location Type
                                                                </td>
                                                                <td class="form_content_split2" align="center">
                                                                    <select class="form-control dropdown_padding" id="customer_location_type" name="customer_location_type" onchange="AjaxFunction_client_location(this.value)">
                                                                        <option>Select</option>
                        <?php
                        $Query = "select customer_location from  master_customer_location order by id";
                        $DB->query($Query);

                        while ($DB->Multicoloums()) {
                            echo'<option>' . $DB->Record["customer_location"] . '</option>';
                        }
                        ?>
                                                                    </select>
                                                                </td>
                                                                <td  class="form_label_split2">
                                                                    Client Location
                                                                </td>
                                                                <td class="form_content_split2" align="center">
                                                                    <select class="form-control dropdown_padding" id="customer_location" name="customer_location" onchange="AjaxFunction_client_value(this.value)">
                                                                        <option>Select</option>
                                                                    </select>
                                                                    <input type="text" id="customer_location_text" onblur="AjaxFunction_client_value_text();" name="customer_location_text" class="form-control" readonly="true">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                        -->
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vehicle_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select vehicle_type from sr_vehicle_type order by vehicle_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $so_error == false) && $vehicle_type == $DB->Record["vehicle_type"]) {
                                                        echo'<option selected>' . $DB->Record["vehicle_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vehicle_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Ownership Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vehicle_ownership_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select ownership from master_ownership order by ownership";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $vehicle_ownership_type == $DB->Record["ownership"]) {
                                                        echo'<option selected>' . $DB->Record["ownership"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["ownership"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Owner
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vehicle_owner">
                                                <option>Select</option>
                                                <?php
                                                if ($vehicle_owner == "Western Arya") {
                                                    echo"<option selected>Western Arya</option>";
                                                } else {
                                                    echo"<option>Western Arya</option>";
                                                }
                                                $Query = "select vendor_name from sr_vendor order by vendor_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $vehicle_owner == $DB->Record["vendor_name"]) {
                                                        echo'<option selected>' . $DB->Record["vendor_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vendor_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Primary / Secondary
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="primary_secondary">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select primary_status from sr_primary_status order by primary_status";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $primary_secondary == $DB->Record["primary_status"]) {
                                                        echo'<option selected>' . $DB->Record["primary_status"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["primary_status"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Escort Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="escort_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select escort_type from sr_escort_type order by escort_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $escort_type == $DB->Record["escort_type"]) {
                                                        echo'<option selected>' . $DB->Record["escort_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["escort_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="form_label_split2" colspan="2">
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2" rowspan="10">
                                            Email Alert To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id1" class="form-control" value="<?php if ($id_error == false) echo $email_id1; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="10">
                                            SMS Alert To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no1" class="form-control" value="<?php if ($id_error == false) echo $mobile_no1; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id2" class="form-control" value="<?php if ($id_error == false) echo $email_id2; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no2" class="form-control" value="<?php if ($id_error == false) echo $mobile_no2; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id3" class="form-control" value="<?php if ($id_error == false) echo $email_id3; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no3" class="form-control" value="<?php if ($id_error == false) echo $mobile_no3; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id4" class="form-control" value="<?php if ($id_error == false) echo $email_id4; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no4" class="form-control" value="<?php if ($id_error == false) echo $mobile_no4; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id5" class="form-control" value="<?php if ($id_error == false) echo $email_id5; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no5" class="form-control" value="<?php if ($id_error == false) echo $mobile_no5; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id6" class="form-control" value="<?php if ($id_error == false) echo $email_id6; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no6" class="form-control" value="<?php if ($id_error == false) echo $mobile_no6; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id7" class="form-control" value="<?php if ($id_error == false) echo $email_id7; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no7" class="form-control" value="<?php if ($id_error == false) echo $mobile_no7; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id8" class="form-control" value="<?php if ($id_error == false) echo $email_id8; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no8" class="form-control" value="<?php if ($id_error == false) echo $mobile_no8; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id9" class="form-control" value="<?php if ($id_error == false) echo $email_id9; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no9" class="form-control" value="<?php if ($id_error == false) echo $mobile_no9; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id10" class="form-control" value="<?php if ($id_error == false) echo $email_id10; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no10" class="form-control" value="<?php if ($id_error == false) echo $mobile_no10; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <script type="text/javascript">

                    </script>
                    <div class="box-footer">
                        <button type="submit" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
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
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>