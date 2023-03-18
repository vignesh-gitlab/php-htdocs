<?php
include'../../template/client/header.default.php';

$actionpage = 'vehicle_status_action.php';
$tablename = 'sr_vehicle_status';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}

if ($orderno_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery from sr_vehicle_dispatch where order_no='" . $_REQUEST["order_no"] . "'";
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

    $Query = "SELECT  id,order_no,email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10,mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
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

$order_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $order_error = true;
}

if ($order_error == false) {
    $Query = "SELECT  id,email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10,mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from $tablename where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
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
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Status
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="vehicle_status_grid.php">Vehicle Status</a></li>
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
                                        <td  class="form_label_split2">
                                            Status Date & Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly="true" name="status_date_time" class="form-control pull-right" id="status_date_time" onfocus="pick_date(this.id);" value="<?php
                                            echo date('d-m-Y h:i:s');
                                            ?>">
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
                                            <span class="red">*&nbsp;</span>Vehicle Current Position
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="vehicle_current_position" class="form-control" value="<?php if ($id_error == false) echo $vehicle_current_position; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Remarks
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="remarks" class="form-control" value="<?php if ($id_error == false) echo $remarks; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Delay Reason
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="delay_reason" class="form-control" value="<?php if ($id_error == false) echo $delay_reason; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Expected Delay Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="expected_delay_time" class="form-control pull-right" id="expected_delay_time" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $expected_delay_time;
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
                                            <input type="text" name="email_id1" class="form-control" value="<?php if ($order_error == false) echo $email_id1; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="10">
                                            SMS Alert To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no1" class="form-control" value="<?php if ($order_error == false) echo $mobile_no1; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id2" class="form-control" value="<?php if ($order_error == false) echo $email_id2; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no2" class="form-control" value="<?php if ($order_error == false) echo $mobile_no2; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id3" class="form-control" value="<?php if ($order_error == false) echo $email_id3; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no3" class="form-control" value="<?php if ($order_error == false) echo $mobile_no3; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id4" class="form-control" value="<?php if ($order_error == false) echo $email_id4; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no4" class="form-control" value="<?php if ($order_error == false) echo $mobile_no4; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id5" class="form-control" value="<?php if ($order_error == false) echo $email_id5; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no5" class="form-control" value="<?php if ($order_error == false) echo $mobile_no5; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id6" class="form-control" value="<?php if ($order_error == false) echo $email_id6; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no6" class="form-control" value="<?php if ($order_error == false) echo $mobile_no6; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id7" class="form-control" value="<?php if ($order_error == false) echo $email_id7; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" ame="mobile_no7" class="form-control" value="<?php if ($order_error == false) echo $mobile_no7; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id8" class="form-control" value="<?php if ($order_error == false) echo $email_id8; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no8" class="form-control" value="<?php if ($order_error == false) echo $mobile_no8; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id9" class="form-control" value="<?php if ($order_error == false) echo $email_id9; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no9" class="form-control" value="<?php if ($order_error == false) echo $mobile_no9; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="email_id10" class="form-control" value="<?php if ($order_error == false) echo $email_id10; ?>">
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="mobile_no10" class="form-control" value="<?php if ($order_error == false) echo $mobile_no10; ?>">
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
                        echo'<input type="hidden" name="form_action" value="Insert"/>';
                        ?>
                    </div>
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>