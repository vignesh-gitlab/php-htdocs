<?php
include'../../template/accounts/header.default.php';
$actionpage = 'contract_action.php';
$tablename = 'sr_contract';
$tablename1 = 'sr_contract_item';

$client_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $client_error = true;
}
$form_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $form_error = true;
}
$id_error = false;
if ((!isset($_REQUEST["contract_no"])) || (empty($_REQUEST["contract_no"]))) {
    $id_error = true;
}
?>
<script type="text/javascript">
    function AjaxFunction_display_lane_id(line_id)
    {
        var customer_name = document.getElementById("customer_name").value;
        if (line_id == 1)
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
                    for (var line_id = 1; line_id <= 25; line_id++)
                    {
                        var myarray = eval(httpxml.responseText);
                        var length = document.getElementById("lane_id" + line_id).options.length;
                        for (j = (length - 1); j >= 0; j--)
                        {
                            document.getElementById("lane_id" + line_id).remove(j);
                        }

                        if (myarray.length > 0)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = "Select";
                            optn.value = "Select";
                            document.getElementById("lane_id" + line_id).options.add(optn);
                            for (i = 0; i < myarray.length; i++)
                            {
                                var optn = document.createElement("OPTION");
                                optn.text = myarray[i];
                                optn.value = myarray[i];
                                document.getElementById("lane_id" + line_id).options.add(optn);
                            }
                        }
                    }
                }
            }
            var url = "contract_dependent1.php";
            //var vehicle_type = encodeURIComponent(vehicle_type);
            url = url + "?customer_name=" + customer_name;
            //url=url+"&sid="+Math.random();
            httpxml.onreadystatechange = stateck;
            httpxml.open("GET", url, true);
            httpxml.send(null);
        }
    }
    function AjaxFunction_display_lane_details(lane_id, line_id)
    {

        var customer_name = document.getElementById('customer_name').value;
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
                    document.getElementById('departure' + line_id).value = myarray[0];
                    document.getElementById('arrival' + line_id).value = myarray[1];
                    document.getElementById('vehicle_type' + line_id).value = myarray[2];
                    document.getElementById('charges' + line_id).value = myarray[3];
                    document.getElementById('duration' + line_id).value = myarray[4];

                }
            }
        }
        var url = "contract_dependent2.php";
        //var vehicle_type = encodeURIComponent(vehicle_type);
        url = url + "?lane_id=" + lane_id + "&customer_name=" + customer_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_lane_category(lane_category)
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
                for (j = document.form.lane_category_name.options.length - 1; j >= 0; j--)
                {
                    document.form.lane_category_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.lane_category_name.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.lane_category_name.options.add(optn);
                    }
                }
            }
        }
        var url = "lane_dependent1.php";
        //var lane_category = encodeURIComponent(lane_category);
        url = url + "?lane_category=" + lane_category;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_validate_lane_id(lane_id)
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
                    alert(myarray[0]);
                    document.form.lane_id.value = "";
                }
            }
        }
        var url = "lane_dependent2.php";
        url = url + "?lane_id=" + lane_id;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
</script>
<?php
if ($client_error == false) {
    $Query = "SELECT id,client_name from sr_client where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $customer_name = $DB->Record["client_name"];
    }
}
if ($id_error == false) {
    $Query = "SELECT id,contract_no,customer_name,agreement_no,effective_date,expiry_date,outstanding_valid_from,due_day,status from $tablename where contract_no='" . $_REQUEST["contract_no"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $contract_no = $DB->Record["contract_no"];
        $customer_name = $DB->Record["customer_name"];
        $agreement_no = $DB->Record["agreement_no"];
        $effective_date = $DB->Record["effective_date"];
        $expiry_date = $DB->Record["expiry_date"];
        $outstanding_valid_from = $DB->Record["outstanding_valid_from"];
        $due_day = $DB->Record["due_day"];
        $status = $DB->Record["status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT  id,contract_no,effective_date_item,expiry_date_item,lane_id,departure,arrival,vehicle_type,type_of_movement,charge_base,charges,duration,remarks from $tablename1 where contract_no='" . $contract_no . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $contract_no_array[] = $DB->Record["contract_no"];
        $effective_date_item_array[] = $DB->Record["effective_date_item"];
        $expiry_date_item_array[] = $DB->Record["expiry_date_item"];
        $lane_id_array[] = $DB->Record["lane_id"];
        $departure_array[] = $DB->Record["departure"];
        $arrival_array[] = $DB->Record["arrival"];
        $vehicle_type_array[] = $DB->Record["vehicle_type"];
        $type_of_movement_array[] = $DB->Record["type_of_movement"];
        $charge_base_array[] = $DB->Record["charge_base"];
        $charges_array[] = $DB->Record["charges"];
        $duration_array[] = $DB->Record["duration"];
        $product_total_array[] = $DB->Record["remarks"];
        $remarks_array[] = $DB->Record["remarks"];
    }
}
if ($form_error == false) {
    $edit_product_count = 0;
    $Query = "SELECT  id,contract_no,effective_date_item,expiry_date_item,lane_id,departure,arrival,vehicle_type,type_of_movement,charge_base,charges,duration,remarks from $tablename1 where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $contract_no_array[] = $DB->Record["contract_no"];
        $effective_date_item_array[] = $DB->Record["effective_date_item"];
        $expiry_date_item_array[] = $DB->Record["expiry_date_item"];
        $lane_id_array[] = $DB->Record["lane_id"];
        $departure_array[] = $DB->Record["departure"];
        $arrival_array[] = $DB->Record["arrival"];
        $vehicle_type_array[] = $DB->Record["vehicle_type"];
        $type_of_movement_array[] = $DB->Record["type_of_movement"];
        $charge_base_array[] = $DB->Record["charge_base"];
        $charges_array[] = $DB->Record["charges"];
        $duration_array[] = $DB->Record["duration"];
        $product_total_array[] = $DB->Record["remarks"];
        $remarks_array[] = $DB->Record["remarks"];
    }
    $Query = "SELECT id,contract_no,customer_name,agreement_no,effective_date,expiry_date,outstanding_valid_from,due_day,status from $tablename where contract_no='" . $contract_no_array[0] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $contract_no = $DB->Record["contract_no"];
        $customer_name = $DB->Record["customer_name"];
        $agreement_no = $DB->Record["agreement_no"];
        $effective_date = $DB->Record["effective_date"];
        $expiry_date = $DB->Record["expiry_date"];
        $outstanding_valid_from = $DB->Record["outstanding_valid_from"];
        $due_day = $DB->Record["due_day"];
        $status = $DB->Record["status"];
    }
}
/* if ($form_error == false) {
  $Query = "SELECT id,contract_no,customer_name,agreement_no,effective_date,expiry_date,outstanding_valid_from,due_day,status from $tablename where id='" . $_REQUEST["id"] . "'";
  $DB->query($Query);
  while ($DB->Multicoloums()) {
  $contract_no = $DB->Record["contract_no"];
  $customer_name = $DB->Record["customer_name"];
  $agreement_no = $DB->Record["agreement_no"];
  $effective_date = $DB->Record["effective_date"];
  $expiry_date = $DB->Record["expiry_date"];
  $outstanding_valid_from = $DB->Record["outstanding_valid_from"];
  $due_day = $DB->Record["due_day"];
  $status = $DB->Record["status"];
  }
  $edit_product_count = 0;
  $Query = "SELECT  id,contract_no,effective_date_item,expiry_date_item,lane_id,departure,arrival,vehicle_type,type_of_movement,charge_base,charges,duration,remarks from $tablename1 where contract_no='" . $contract_no . "'";
  $DB->query($Query);
  while ($DB->Multicoloums()) {
  $edit_product_count = $edit_product_count + 1;
  $contract_no_array[] = $DB->Record["contract_no"];
  $effective_date_item_array[] = $DB->Record["effective_date_item"];
  $expiry_date_item_array[] = $DB->Record["expiry_date_item"];
  $lane_id_array[] = $DB->Record["lane_id"];
  $departure_array[] = $DB->Record["departure"];
  $arrival_array[] = $DB->Record["arrival"];
  $vehicle_type_array[] = $DB->Record["vehicle_type"];
  $type_of_movement_array[] = $DB->Record["type_of_movement"];
  $charge_base_array[] = $DB->Record["charge_base"];
  $charges_array[] = $DB->Record["charges"];
  $duration_array[] = $DB->Record["duration"];
  $product_total_array[] = $DB->Record["remarks"];
  $remarks_array[] = $DB->Record["remarks"];
  }
  } */
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contract
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="contract_grid.php">Contract</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            Contract No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(contract_no as unsigned))as max_id from $tablename";
                                            $DB->query($Query);
                                            while ($DB->Multicoloums()) {
                                                $max_id = $DB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            ?>
                                            <input type="text" name="contract_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $contract_no;
                                            } else {
                                                echo $new_max_id;
                                            }
                                            ?>">
                                                   <?php
                                                   if ($form_error == false || $form_error == false) {
                                                       ?>
                                                <input type="hidden" name="contract_no" class="form-control" value="<?php echo $contract_no; ?>">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td  class="form_label_split2">
                                            Customer Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="customer_name" id="customer_name" class="form-control"  value="<?php if ($id_error == false || $client_error == false) echo $customer_name; ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Agreement No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="agreement_no" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $agreement_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Effective Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="effective_date" class="form-control pull-right" id="effective_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false || $form_error == false) {
                                                    echo $effective_date;
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
                                            Expiry Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="expiry_date" class="form-control pull-right" id="expiry_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false || $form_error == false) {
                                                    echo $expiry_date;
                                                } else {

                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Outstanding Valid From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="outstanding_valid_from">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(outstanding_valid_from) from master_outstanding_valid_from order by outstanding_valid_from";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $form_error == false) && $outstanding_valid_from == $DB->Record["outstanding_valid_from"]) {
                                                        echo'<option selected>' . $DB->Record["outstanding_valid_from"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["outstanding_valid_from"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Credit/Due Days
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="due_day" id="due_day" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $due_day; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Contract Status
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="status">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select status from master_status order by status";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false || $form_error == false) && $status == $DB->Record["status"]) {
                                                        echo'<option selected>' . $DB->Record["status"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["status"] . '</option>';
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
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Effective Date
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Expiry Date
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Lane ID
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Departure
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Arrival
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Vehicle Type
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Type Of Movement
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Charge Base
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Charges
                                        </td>
                                        <td  class="form_label_multiple" style="width:8%;">
                                            Duration
                                        </td>

                                        <td  class="form_label_multiple" style="width:10%;">
                                            Remark
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_label_multiple" align="center">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="effective_date_item<?php echo $i; ?>" class="form-control pull-right" onblur="AjaxFunction_display_lane_id(<?php echo $i; ?>)"  id="effective_date_item<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false || $form_error == false) {
                                                        echo $effective_date_item_array[$i - 1];
                                                    } else {

                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="form_label_multiple" align="center">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="expiry_date_item<?php echo $i; ?>" class="form-control pull-right" id="expiry_date_item<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false || $form_error == false) {
                                                        echo $expiry_date_item_array[$i - 1];
                                                    } else {

                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="form_label_multiple" align="center">
                                                <select class="form-control dropdown_padding" onchange="AjaxFunction_display_lane_details(this.value, <?php echo $i; ?>)" name="lane_id<?php echo $i; ?>" id="lane_id<?php echo $i; ?>">
                                                    <option>Select</option>
                                                    <?php
                                                    if ($id_error == false || $form_error == false && $lane_id_array[$i - 1] != NULL) {
                                                        echo'<option selected>' . $lane_id_array[$i - 1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  name="departure<?php echo $i; ?>" id="departure<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $departure_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  name="arrival<?php echo $i; ?>" id="arrival<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $arrival_array[$i - 1]; ?>">
                                            </td>

                                            <td class="form_content_multiple">
                                                <input type="text"  name="vehicle_type<?php echo $i; ?>" id="vehicle_type<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $vehicle_type_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <select class="chosen-select form-control dropdown_padding" name="type_of_movement<?php echo $i; ?>" id="type_of_movement<?php echo $i; ?>"  >
                                                    <option>Select</option>
                                                    <?php
                                                    $Query = "select type_of_movement from master_type_of_movement order by type_of_movement";
                                                    $DB->query($Query);

                                                    while ($DB->Multicoloums()) {
                                                        if (($id_error == false || $form_error == false) && $type_of_movement_array[$i - 1] == $DB->Record["type_of_movement"]) {
                                                            echo'<option selected>' . $DB->Record["type_of_movement"] . '</option>';
                                                        } else {
                                                            echo'<option>' . $DB->Record["type_of_movement"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            </td>
                                            <td class="form_content_multiple">
                                                <select class="chosen-select form-control dropdown_padding" name="charge_base<?php echo $i; ?>" id="charge_base<?php echo $i; ?>"  >
                                                    <option>Select</option>
                                                    <?php
                                                    $Query = "select charge_base from master_charge_base order by charge_base";
                                                    $DB->query($Query);

                                                    while ($DB->Multicoloums()) {
                                                        if (($id_error == false || $form_error == false) && $charge_base_array[$i - 1] == $DB->Record["charge_base"]) {
                                                            echo'<option selected>' . $DB->Record["charge_base"] . '</option>';
                                                        } else {
                                                            echo'<option>' . $DB->Record["charge_base"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  name="charges<?php echo $i; ?>" id="charges<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $charges_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  name="duration<?php echo $i; ?>" id="duration<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $duration_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text"  name="remarks<?php echo $i; ?>" id="remarks<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $remarks_array[$i - 1]; ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                        <button type="submit" id="submit_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
                        <?php
                        /* if ($id_error == false) {
                          if ($form_error == false) {
                          echo'<input type="hidden" name="form_action1" value="Duplicate"/>';
                          } else {
                          echo'<input type="hidden" name="form_action" value="Update"/>';
                          echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                          }
                          } else {
                          echo'<input type="hidden" name="form_action" value="Insert"/>';
                          } */

                        if ($id_error == false) {
                            echo'<input type="hidden" name="form_action" value="Update"/>';
                            echo'<input type="hidden" name="contract_no" value="' . $_REQUEST["contract_no"] . '"/>';
                        } else {
                            echo'<input type="hidden" name="form_action" value="Insert"/>';
                        }
                        ?>

                        <div id="submit_loader">
                            <img src="../../theme/img/submit_loader.gif" style="height:25px;"/>
                        </div>
                    </div>
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>