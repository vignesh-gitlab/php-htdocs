<?php
include'../../template/client_division/header.default.php';

$actionpage = 'vehicle_reporting_upload_action.php';
$tablename = 'sr_vehicle_reporting';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}

if ($orderno_error == false) {
    $Query = "SELECT  order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery,landing_date,landing_time,unloading_date,unloading_time from sr_vehicle_unloading where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
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
        $landing_date = $UDB->Record["landing_date"];
        $landing_time = $UDB->Record["landing_time"];
        $unloading_date = $UDB->Record["unloading_date"];
        $unloading_time = $UDB->Record["unloading_time"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Reporting
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Landing & Reporting</li>
            <li><a href="vehicle_reporting_grid.php">Vehicle Reporting</a></li>
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
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            POD Upload
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="file" name="pod_upload" class="form-control" style="padding:0px;">
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