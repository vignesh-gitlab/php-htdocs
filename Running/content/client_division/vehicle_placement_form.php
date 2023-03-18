<?php
include'../../template/client_division/header.default.php';

$actionpage = 'vehicle_placement_action.php';
$tablename = 'sr_vehicle_placement';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}

if ($orderno_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_no,driver_type,escart_option,tracking_device,loading_charges,unloading_charges,dedicated_market_vehicle from sr_vehicle_booking where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $driver_type = $UDB->Record["driver_type"];
        $escart_option = $UDB->Record["escart_option"];
        $tracking_device = $UDB->Record["tracking_device"];
        $loading_charges = $UDB->Record["loading_charges"];
        $unloading_charges = $UDB->Record["unloading_charges"];
        $dedicated_market_vehicle = $UDB->Record["dedicated_market_vehicle"];
    }
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_no,driver_type,escart_option,tracking_device,loading_charges,unloading_charges,dedicated_market_vehicle,placement_date,placement_time,ontime_placement,late_reporting_remarks from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $driver_type = $UDB->Record["driver_type"];
        $escart_option = $UDB->Record["escart_option"];
        $tracking_device = $UDB->Record["tracking_device"];
        $loading_charges = $UDB->Record["loading_charges"];
        $unloading_charges = $UDB->Record["unloading_charges"];
        $dedicated_market_vehicle = $UDB->Record["dedicated_market_vehicle"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $ontime_placement = $UDB->Record["ontime_placement"];
        $late_reporting_remarks = $UDB->Record["late_reporting_remarks"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Placement
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="vehicle_placement_grid.php">Vehicle Placement</a></li>
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
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_name" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Client Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_division" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_division; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_branch" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_branch; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Required Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_required_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_required_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Required Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_required_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_required_time; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Origin
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="orgin" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $orgin; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Destination
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="destination" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $destination; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_type" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_type; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Driver Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="driver_type" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $driver_type; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Escort Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="escart_option" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $escart_option; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Tracking Device
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="tracking_device" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $tracking_device; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Loading Charges
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="loading_charges" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $loading_charges; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Unloading Charges
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="unloading_charges" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $unloading_charges; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Category
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="dedicated_market_vehicle" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $dedicated_market_vehicle; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            SO Ref. NO.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_no; ?>">
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
                                        <td  class="form_label_split2">
                                            Placement Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="placement_date" class="form-control pull-right" id="order_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $placement_date;
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
                                            Placement Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" readonly name="placement_time" class="form-control timepicker" value="<?php
                                                    if ($id_error == false) {
                                                        echo $placement_time;
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
                                            Ontime Placement
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="ontime_placement">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $ontime_placement == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Late Reporting Remark (If Late)
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="late_reporting_remarks" class="form-control" value="<?php if ($id_error == false) echo $late_reporting_remarks; ?>">
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