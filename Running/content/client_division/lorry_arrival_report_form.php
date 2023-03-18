<?php
include'../../template/client_division/header.default.php';

$actionpage = 'lorry_arrival_report_action.php';
$tablename = 'sr_lorry_arrival_report';

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
    $Query = "SELECT  id,order_no,order_date,so_no,so_date,vehicle_type from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $party_name_received = $UDB->Record["vehicle_type"];
    }
    $Query = "SELECT orgin,destination,vehicle_no,unloading_date from sr_vehicle_unloading where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $lorry_from = $UDB->Record["orgin"];
        $lorry_to = $UDB->Record["destination"];
        $lorry_no = $UDB->Record["vehicle_no"];
        $unloading_date = $UDB->Record["unloading_date"];
    }
    $Query = "SELECT lorry_chellan_no,branch_code,total_packages from sr_lorry_chellan where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $chellan_no = $UDB->Record["lorry_chellan_no"];
        $branch_code = $UDB->Record["branch_code"];
        $packages_load = $UDB->Record["total_packages"];
    }
    $Query = "SELECT vehicle_release_date,no_of_pack from sr_vehicle_reporting where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $reporting_date = $UDB->Record["vehicle_release_date"];
        $packages_received = $UDB->Record["no_of_pack"];
    }
    $Query = "SELECT dispatch_date from sr_vehicle_dispatch where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $dispatched_on = $UDB->Record["dispatch_date"];
    }
    $Query = "SELECT consignment_note_no,consignment_date from sr_bilty where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $consignment_received = $UDB->Record["consignment_note_no"];
        $consignment_loss = $UDB->Record["consignment_date"];
    }
}
if ($id_error == false) {
    $Query = "SELECT  id,order_no,order_date,so_no,so_date,lar_no,branch,stationary_no,lorry_no,lar_date,lorry_from,dispatched_on,lorry_to,reporting_date,chellan_no,unloading_date,packages_load,packages_received,weight_received,weight_loaded,weight_loss,short_received,short_loss,damage_received,damage_loss,remarks_received,remarks_loss,consignment_received,consignment_loss,party_name_received,party_name_loss from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $lar_no = $UDB->Record["lar_no"];
        $branch_code = $UDB->Record["branch"];
        $stationary_no = $UDB->Record["stationary_no"];
        $lorry_no = $UDB->Record["lorry_no"];
        $lar_date = $UDB->Record["lar_date"];
        $lorry_from = $UDB->Record["lorry_from"];
        $dispatched_on = $UDB->Record["dispatched_on"];
        $lorry_to = $UDB->Record["lorry_to"];
        $reporting_date = $UDB->Record["reporting_date"];
        $chellan_no = $UDB->Record["chellan_no"];
        $unloading_date = $UDB->Record["unloading_date"];
        $packages_load = $UDB->Record["packages_load"];
        $packages_received = $UDB->Record["packages_received"];
        $weight_loaded = $UDB->Record["weight_loaded"];
        $weight_received = $UDB->Record["weight_received"];
        $weight_loss = $UDB->Record["weight_loss"];
        $short_received = $UDB->Record["short_received"];
        $short_loss = $UDB->Record["short_loss"];
        $damage_received = $UDB->Record["damage_received"];
        $damage_loss = $UDB->Record["damage_loss"];
        $remarks_received = $UDB->Record["remarks_received"];
        $remarks_loss = $UDB->Record["remarks_loss"];
        $consignment_received = $UDB->Record["consignment_received"];
        $consignment_loss = $UDB->Record["consignment_loss"];
        $party_name_received = $UDB->Record["party_name_received"];
        $party_name_loss = $UDB->Record["party_name_loss"];
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
                        alert("Data Full Add new data to Stationary Master");
                    }
                } else if (myarray.length == 0)
                {
                    document.form.stationary_no.value = "";
                    alert("Select a Branch Code with Data in Stationary Master");
                }
            }
        }
        var book_type = "Arraival Report";
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
        var book_type = "Arraival Report";
        var branch_code = document.form.branch_code.value;
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code + "&book_type=" + book_type;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function calculate_loss()
    {
        var loaded = document.form.weight_loaded.value;
        var received = document.form.weight_received.value;
        var loss = Number(loaded) - Number(received);
        document.form.weight_loss.value = loss;
    }

</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Arrival Report
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="lorry_arrival_report_grid.php">Lorry Arrival Report</a></li>
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
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp</span>LAR Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="lar_no" id="lar_no" class="form-control" value="<?php if ($id_error == false) echo $lar_no; ?>">
                                        </td>
                                      <!--  <td class="form_content_split2" align="center">
                                        <?php
                                        $Query = "SELECT max(cast(lar_id as unsigned))as max_id from $tablename";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            $max_id = $UDB->Record["max_id"];
                                        }
                                        $new_max_id = $max_id + 1;
                                        $new_max_orderno = $commonvar_lar_no_prefix . $new_max_id;
                                        ?>
                                            <input type="text" name="lar_no" readonly class="form-control" value="<?php
                                        if ($id_error == false) {
                                            echo $lar_no;
                                        } else {
                                            echo $new_max_orderno;
                                        }
                                        ?>">
                                        </td>-->
                                        <td  class="form_label_split2">
                                            Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="lar_date" class="form-control pull-right" id="lar_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $lar_date;
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
                                            Dispatched On
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="dispatched_on" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $dispatched_on; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_to" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_to; ?>">
                                        </td>

                                        <td  class="form_label_split2">
                                            Reporting Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="reporting_date" class="form-control pull-right" id="reporting_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false || $orderno_error == false) {
                                                    echo $reporting_date;
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
                                            Chellan No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="chellan_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $chellan_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Unloading Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="unloading_date" class="form-control pull-right" id="unloading_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false || $orderno_error == false) {
                                                    echo $unloading_date;
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
                                            Packages Load
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="packages_load" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $packages_load; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Packages Received
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="packages_received" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $packages_received; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Lorry Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="lorry_no" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $lorry_no; ?>">
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
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
                                        <td  class="form_label_multiple" style="text-align: center;width:30%;">
                                            Loss
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple" style="text-align: center;width:40%;">
                                            Weight
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="weight_loaded" id="weight_loaded" style="text-align: center; width:50%; float:left;" class="form-control" value="<?php if ($id_error == false) echo $weight_loaded; ?>" placeholder="Loaded" onblur="calculate_loss();">
                                            <input type="text" name="weight_received" id="weight_received" style="text-align: center;  width:50%; float:right;" class="form-control" value="<?php if ($id_error == false) echo $weight_received; ?>" placeholder="Received" onblur="calculate_loss();">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="weight_loss" id="weight_loss" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $weight_loss; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_multiple">
                                            Short / Excess
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="short_received" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $short_received; ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="short_loss" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $short_loss; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_multiple">
                                            Damage
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="damage_received" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $damage_received; ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="damage_loss" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $damage_loss; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_multiple">
                                            Other Remarks
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="remarks_received" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $remarks_received; ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="remarks_loss" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $remarks_loss; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_multiple">
                                            Consignment Number & Date
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="consignment_received" placeholder="Consignment Number" style="text-align: center;" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignment_received; ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="consignment_loss" placeholder="Consignment Date" style="text-align: center;" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $consignment_loss; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label_multiple">
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_multiple"  colspan="2">
                                            <input type="text" name="party_name_received" style="text-align: center;" class="form-control" value="<?php if ($id_error == false || $orderno_error == false) echo $party_name_received; ?>">
                                        </td>
                                        <!--
                                        <td class="form_content_multiple">
                                            <input type="text" name="party_name_loss" style="text-align: center;" class="form-control" value="<?php if ($id_error == false) echo $party_name_loss; ?>">
                                        </td>
                                        -->
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