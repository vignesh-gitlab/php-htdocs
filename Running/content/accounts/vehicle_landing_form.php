<?php
include'../../template/accounts/header.default.php';

$actionpage = 'vehicle_landing_action.php';
$tablename = 'sr_vehicle_landing';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}

if ($orderno_error == false) {
    $Query = "SELECT  order_no,so_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery from sr_vehicle_dispatch where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
    }
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery,landing_date,landing_time from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_branch = $UDB->Record["client_branch"];
        $client_division = $UDB->Record["client_division"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $landing_date = $UDB->Record["landing_date"];
        $landing_time = $UDB->Record["landing_time"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Landing
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="vehicle_landing_grid.php">Vehicle Landing</a></li>
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
                                            Dispatch Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="dispatch_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $dispatch_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Dispatch Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="dispatch_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $dispatch_time; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Expected Date of Delivery
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="expected_dateof_delivery" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $expected_dateof_delivery; ?>">
                                        </td>
                                        <td  class="form_label_split2" colspan="2">
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
                                            Landing Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" readonly="true" name="landing_date" class="form-control pull-right" id="landing_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $landing_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Landing Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" readonly name="landing_time" class="form-control timepicker" value="<?php
                                                    if ($id_error == false) {
                                                        echo $landing_time;
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