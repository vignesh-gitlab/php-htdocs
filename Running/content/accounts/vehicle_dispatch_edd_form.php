<?php
include'../../template/accounts/header.default.php';

$actionpage = 'vehicle_dispatch_edd_action.php';
$tablename = 'sr_vehicle_dispatch';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}

if ($orderno_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time from sr_vehicle_loading_end where order_no='" . $_REQUEST["order_no"] . "'";
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
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
    }
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,dispatch_date,dispatch_time,no_of_pack,weight,lr_no,lr_date,consignee_name,invoice_no,btn,delivery_note,expected_dateof_delivery from $tablename where id='" . $_REQUEST["id"] . "'";
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
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $no_of_pack = $UDB->Record["no_of_pack"];
        $weight = $UDB->Record["weight"];
        $lr_no = $UDB->Record["lr_no"];
        $lr_date = $UDB->Record["lr_date"];
        $consignee_name = $UDB->Record["consignee_name"];
        $invoice_no = $UDB->Record["invoice_no"];
        $btn = $UDB->Record["btn"];
        $delivery_note = $UDB->Record["delivery_note"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Dispatch
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="vehicle_dispatch_edd_grid.php">Vehicle Dispatch</a></li>
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
                                            Vehicle Placement Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="placement_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $placement_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Placement Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="placement_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $placement_time; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Orgin
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
                                            Loading Start Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="loading_start_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $loading_start_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Loading Start Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="loading_start_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $loading_start_time; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Loading End Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="loading_end_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $loading_end_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Loading Start Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="loading_end_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $loading_end_time; ?>">
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
                                            Dispatch Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="dispatch_date" class="form-control pull-right" id="dispatch_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $dispatch_date;
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
                                            Dispatch Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="bootstrap-timepicker">
                                                <div class="input-group">
                                                    <input type="text" readonly name="dispatch_time" class="form-control timepicker" value="<?php
                                                    if ($id_error == false) {
                                                        echo $dispatch_time;
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
                                            No of Pack
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="no_of_pack" class="form-control" value="<?php if ($id_error == false) echo $no_of_pack; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Weight
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="weight" class="form-control" value="<?php if ($id_error == false) echo $weight; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>LR Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="lr_no" class="form-control" value="<?php if ($id_error == false) echo $lr_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            LR Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="lr_date" class="form-control pull-right" id="lr_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $lr_date;
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
                                            Consignee Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="consignee_name" class="form-control" value="<?php if ($id_error == false) echo $consignee_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Invoice Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="invoice_no" class="form-control" value="<?php if ($id_error == false) echo $invoice_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            BTN
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="btn" class="form-control" value="<?php if ($id_error == false) echo $btn; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Delivery Note Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="delivery_note" class="form-control" value="<?php if ($id_error == false) echo $delivery_note; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Expected Date of Delivery
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="expected_dateof_delivery" class="form-control pull-right" id="expected_dateof_delivery" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $expected_dateof_delivery;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php if ($id_error == true) { ?>
                            <div class="box-body table-responsive">
                                <div class="form_tablebox">
                                    <table cellspacing="0">
                                        <tr>
                                            <td  class="form_label_split2">
                                                LR Copy Upload
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <input type="file" name="lr_copy" class="form-control">
                                            </td>
                                            <td  class="form_label_split2">
                                                Invoice Copy Upload
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <input type="file" name="invoice_copy" class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
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