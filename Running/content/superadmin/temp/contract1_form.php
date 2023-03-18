<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'contract_action.php';
$tablename = 'sr_contract';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
$form_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $form_error = true;
}
?>
<script type="text/javascript">
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
if ($id_error == false) {
    $Query = "SELECT id,agreement_no,effective_date,expiry_date,outstanding_valid_from,lane_id,vehicle_type,lane_from,lane_to,total_km_one_way,total_km_trip,lane_category,lane_category_name,charge_base,type_of_movement,rate,duration,due_day,remarks,status from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $agreement_no = $DB->Record["agreement_no"];
        $effective_date = $DB->Record["effective_date"];
        $expiry_date = $DB->Record["expiry_date"];
        $outstanding_valid_from = $DB->Record["outstanding_valid_from"];
        $lane_id = $DB->Record["lane_id"];
        $vehicle_type = $DB->Record["vehicle_type"];
        $lane_from = $DB->Record["lane_from"];
        $lane_to = $DB->Record["lane_to"];
        $total_km_one_way = $DB->Record["total_km_one_way"];
        $total_km_trip = $DB->Record["total_km_trip"];
        $lane_category = $DB->Record["lane_category"];
        $lane_category_name = $DB->Record["lane_category_name"];
        $charge_base = $DB->Record["charge_base"];
        $type_of_movement = $DB->Record["type_of_movement"];
        $rate = $DB->Record["rate"];
        $duration = $DB->Record["duration"];
        $due_day = $DB->Record["due_day"];
        $remarks = $DB->Record["remarks"];
        $status = $DB->Record["status"];
    }
} if ($form_error == false) {
    $Query = "SELECT id,agreement_no,effective_date,expiry_date,outstanding_valid_from,lane_id,vehicle_type,lane_from,lane_to,total_km_one_way,total_km_trip,lane_category,lane_category_name,charge_base,type_of_movement,rate,duration,due_day,remarks,status from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $agreement_no = $DB->Record["agreement_no"];
        $effective_date = $DB->Record["effective_date"];
        $expiry_date = $DB->Record["expiry_date"];
        $outstanding_valid_from = $DB->Record["outstanding_valid_from"];
        $lane_id = $DB->Record["lane_id"];
        $vehicle_type = $DB->Record["vehicle_type"];
        $lane_from = $DB->Record["lane_from"];
        $lane_to = $DB->Record["lane_to"];
        $total_km_one_way = $DB->Record["total_km_one_way"];
        $total_km_trip = $DB->Record["total_km_trip"];
        $lane_category = $DB->Record["lane_category"];
        $lane_category_name = $DB->Record["lane_category_name"];
        $charge_base = $DB->Record["charge_base"];
        $type_of_movement = $DB->Record["type_of_movement"];
        $rate = $DB->Record["rate"];
        $duration = $DB->Record["duration"];
        $due_day = $DB->Record["due_day"];
        $remarks = $DB->Record["remarks"];
        $status = $DB->Record["status"];
    }
}
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
                                                if ($id_error == false) {
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
                                                if ($id_error == false) {
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

                                    </tr>
                                </table>
                                <div class="box-body table-responsive">
                                    <div class="form_tablebox">
                                        <table cellspacing="0">
                                            <tr>
                                                <td  class="form_label_split2">
                                                    <span class="red">*&nbsp;</span>Lane ID
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" required name="lane_id" id="lane_id" class="form-control" onblur="AjaxFunction_validate_lane_id(this.value)" value="<?php if ($id_error == false || $form_error == false) echo $lane_id; ?>">
                                                </td>
                                                <td  class="form_label_split2">
                                                    Vehicle Type
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="vehicle_type">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select distinct(vehicle_type) from sr_vehicle_type order by vehicle_type";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if (($id_error == false || $form_error == false) && $vehicle_type == $DB->Record["vehicle_type"]) {
                                                                echo'<option selected>' . $DB->Record["vehicle_type"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["vehicle_type"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    <span class="red">*&nbsp;</span>From
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" required name="lane_from" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $lane_from; ?>">
                                                </td>
                                                <td  class="form_label_split2">
                                                    <span class="red">*&nbsp;</span>To
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" required name="lane_to" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $lane_to; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Total KM One-Way(approx)
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" name="total_km_one_way" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $total_km_one_way; ?>">
                                                </td>
                                                <td  class="form_label_split2">
                                                    Total KM Trip(approx)
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" name="total_km_trip" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $total_km_trip; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Lane Category
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="lane_category" id="lane_category" onchange="AjaxFunction_display_lane_category(this.value)">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select lane_category from master_lane_category order by lane_category";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if (($id_error == false || $form_error == false) && $lane_category == $DB->Record["lane_category"]) {
                                                                echo'<option selected>' . $DB->Record["lane_category"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["lane_category"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td  class="form_label_split2">
                                                    Name
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="lane_category_name" id="lane_category_name">
                                                        <option>Select</option>
                                                        <?php
                                                        if ($id_error == false || $form_error == false && $lane_category_name) {
                                                            echo'<option selected>' . $lane_category_name . '</option>';
                                                        } else {
                                                            echo'<option>' . $lane_category_name . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Charge Base
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="charge_base" id="charge_base" >
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select charge_base from master_charge_base order by charge_base";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if ($id_error == false && $charge_base == $DB->Record["charge_base"]) {
                                                                echo'<option selected>' . $DB->Record["charge_base"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["charge_base"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td  class="form_label_split2">
                                                    Type Of Movement
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="type_of_movement" id="type_of_movement" >
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select type_of_movement from master_type_of_movement order by type_of_movement";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if ($id_error == false && $type_of_movement == $DB->Record["type_of_movement"]) {
                                                                echo'<option selected>' . $DB->Record["type_of_movement"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["type_of_movement"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Rate
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-rupee"></i>
                                                        </div>
                                                        <input type="text" name="rate" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $rate; ?>">
                                                    </div>
                                                </td>
                                                <td  class="form_label_split2">
                                                    Duration(approx)
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="duration">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select duration from master_duration order by duration";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if (($id_error == false || $form_error == false) && $duration == $DB->Record["duration"]) {
                                                                echo'<option selected>' . $DB->Record["duration"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["duration"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Due Days
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <input type="text" name="due_day" class="form-control" value="<?php if ($id_error == false || $form_error == false) echo $due_day; ?>">
                                                </td>
                                                <td  class="form_label_split2" rowspan="2">
                                                    Remarks
                                                </td>
                                                <td class="form_content_split2" rowspan="2" align="center">
                                                    <textarea name="remarks" style="height:50px;" class="form-control" autofocus><?php if ($id_error == false || $form_error == false) echo $remarks; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  class="form_label_split2">
                                                    Status
                                                </td>
                                                <td class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="status">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select status from master_status order by status";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if ($id_error == false && $status == $DB->Record["status"]) {
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
                            </div><!-- /.box-body -->
                            <div class="box-footer">

                                <button type="submit" id="submit_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                                <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
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
                                    echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                                } else {
                                    echo'<input type="hidden" name="form_action" value="Insert"/>';
                                }
                                if ($form_error == false) {
                                    echo'<input type="hidden" name="form_action1" value="Copy"/>';
                                    echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
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