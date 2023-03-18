<?php
include'../../template/accounts/header.default.php';

$actionpage = 'lane_action.php';
$tablename = 'sr_lane';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
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
    $Query = "SELECT id,lane_id,vehicle_type,lane_from,lane_to,total_km_one_way,total_km_trip,lane_category,lane_category_name,rate,duration from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $lane_id = $DB->Record["lane_id"];
        $vehicle_type = $DB->Record["vehicle_type"];
        $lane_from = $DB->Record["lane_from"];
        $lane_to = $DB->Record["lane_to"];
        $total_km_one_way = $DB->Record["total_km_one_way"];
        $total_km_trip = $DB->Record["total_km_trip"];
        $lane_category = $DB->Record["lane_category"];
        $lane_category_name = $DB->Record["lane_category_name"];
        $rate = $DB->Record["rate"];
        $duration = $DB->Record["duration"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lane
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="lane_grid.php">Lane</a></li>
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
                                            <span class="red">*&nbsp;</span>Lane ID
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="lane_id" id="lane_id" class="form-control" onblur="AjaxFunction_validate_lane_id(this.value)" value="<?php if ($id_error == false) echo $lane_id; ?>">
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
                                                    if ($id_error == false && $vehicle_type == $DB->Record["vehicle_type"]) {
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
                                            <input type="text" required name="lane_from" class="form-control" value="<?php if ($id_error == false) echo $lane_from; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="lane_to" class="form-control" value="<?php if ($id_error == false) echo $lane_to; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Total KM One-Way(approx)
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="total_km_one_way" class="form-control" value="<?php if ($id_error == false) echo $total_km_one_way; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Total KM Trip(approx)
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="total_km_trip" class="form-control" value="<?php if ($id_error == false) echo $total_km_trip; ?>">
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
                                                    if ($id_error == false && $lane_category == $DB->Record["lane_category"]) {
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
                                                <input type="text" name="rate" class="form-control" value="<?php if ($id_error == false) echo $rate; ?>">
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
                                                    if ($id_error == false && $duration == $DB->Record["duration"]) {
                                                        echo'<option selected>' . $DB->Record["duration"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["duration"] . '</option>';
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
                        <div class="button_box">
                            <button type="submit" id="submit_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
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