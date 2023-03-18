<?php
include'../../template/superadmin/header.default.php';

$actionpage = "../../functions/excel_export/excel_export_performance_report_date.php";
$actionpage1 = "dashboard.php";

$client_name = $_REQUEST['client_name'];
$from_date = $_REQUEST['from_date1'];
$to_date = $_REQUEST['to_date1'];

if (isset($_REQUEST["from_date1"])) {
    if ($client_name == 'A Schulman Plastics India Pvt.Ltd.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_schulman_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'AXALTA COATING SYSTEMS INDIA PVT. LTD.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_axalta_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Bayer Crop Science') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_bayer_crop_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Bayer Material Science Private Limited') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_bayer_material_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Camphor & Allied Products Ltd.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_camphor_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'E.I.DuPont India Private Limited') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_dupont_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Jindal Drugs Limited') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_jindal_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Narang Danone Access Pvt.Ltd.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_narang_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'PIRAMAL ENTERPRISES LIMITED') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_piramal_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Solae Company India Pvt Ltd.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_solae_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    } else if ($client_name == 'Huntsman International (India) Pvt. Ltd.') {
        $redirect_page = "../../functions/excel_export/excel_export_shipment_huntsman_date.php?from_date=" . $from_date . "&to_date=" . $to_date;
        header("Location: $redirect_page");
    }
}
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php
        if ($systemexpire_amcexpire_status == True) {
            ?>
            <!--
    <div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>
        <b style="font-size:16px">Your AMC Contract has Closed</b><br><br>
        <span style="line-height:20px; color:#000000;">
            Your <b>AMC Contract</b> has expired on <b><?php echo AMCEND ?></b>. Renew your contract to get cost free service from <a href="<?php echo COMPANYURL ?>" target="_blank"><b><?php echo COMPANYNAME ?></b></a> with one year validity.<br>
            To contact your system administrator please <a href="mailto:<?php echo COMPANYMAIL ?>?Subject=AMC Renewal Request" target="_top"><b>Click here</b></a> or send mail to <?php echo COMPANYMAIL ?>.
        </span>
    </center>
    </div>
            -->
            <?php
        }
        ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <center><h4>PERFORMANCE REPORT (COMMON)</h4></center>
                                    <div class="form_tablebox">
                                        <table cellspacing="0">
                                            <tr>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    From Date
                                                </td>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    To Date
                                                </td>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    Client Name
                                                </td>
                                                <td style="text-align:center;" rowspan=2"  class="form_label_split2">
                                                    <button type="submit" onsubmit="this.style.display = 'none';
                                                            clear_but.style.display = 'none';
                                                            submit_loader.style.display = 'block';
                                                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-share-square-o"></i>&nbsp;Export</button>
                                                    <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  style="width:25%;" class="form_content_split2" align="center">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" readonly="true" name="from_date" class="form-control pull-right" id="from_date" onfocus="pick_date(this.id);">
                                                    </div>
                                                </td>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" readonly="true" name="to_date" class="form-control pull-right" id="to_date" onfocus="pick_date(this.id);">
                                                    </div>
                                                </td>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="client_name">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select distinct(client_name) from sr_client where company_type='Head Office' order by client_name";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            echo'<option>' . $DB->Record["client_name"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage1; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <center><h4>PERFORMANCE REPORT (CLIENT FORMAT)</h4></center>
                                    <div class="form_tablebox">
                                        <table cellspacing="0">
                                            <tr>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    From Date
                                                </td>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    To Date
                                                </td>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    Client Name
                                                </td>
                                                <td style="text-align:center;" rowspan=2"  class="form_label_split2">
                                                    <button type="submit" onsubmit="this.style.display = 'none';
                                                            clear_but.style.display = 'none';
                                                            submit_loader.style.display = 'block';
                                                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-share-square-o"></i>&nbsp;Export</button>
                                                    <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  style="width:25%;" class="form_content_split2" align="center">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" readonly="true" name="from_date1" class="form-control pull-right" id="from_date1" onfocus="pick_date(this.id);">
                                                    </div>
                                                </td>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" readonly="true" name="to_date1" class="form-control pull-right" id="to_date1" onfocus="pick_date(this.id);">
                                                    </div>
                                                </td>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="client_name">
                                                        <option>Select</option>
                                                        <option>A Schulman Plastics India Pvt.Ltd.</option>
                                                        <option>AXALTA COATING SYSTEMS INDIA PVT. LTD.</option>
                                                        <option>Bayer Crop Science</option>
                                                        <option>Bayer Material Science Private Limited</option>
                                                        <option>Camphor & Allied Products Ltd.</option>
                                                        <option>E.I.DuPont India Private Limited</option>
                                                        <option>Jindal Drugs Limited</option>
                                                        <option>Narang Danone Access Pvt.Ltd.</option>
                                                        <option>PIRAMAL ENTERPRISES LIMITED</option>
                                                        <option>Solae Company India Pvt Ltd.</option>
                                                        <option>Huntsman International (India) Pvt. Ltd.</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


        <div class="row">
            <div class="col-lg-3 col-xs-6">

                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as order_count from sr_customer_order where order_status='Not Yet Booked' ";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $order_count = $UDB->Record["order_count"];
                            }
                            echo $order_count;
                            ?>
                        </h3>
                        <p>
                            Pending Orders
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <a href="customer_order_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">

                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as dispatch_count from  sr_vehicle_placement where placement_status='Not Yet Released'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $dispatch_count = $UDB->Record["dispatch_count"];
                            }
                            echo $dispatch_count;
                            ?>
                        </h3>
                        <p>
                            Dispatch Pendings
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <a href="vehicle_placement_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">

                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  expected_dateof_delivery from  sr_vehicle_dispatch where dispatch_status='Not Yet Reached'";
                            $UDB->query($Query);
                            $status_count = 0;
                            while ($UDB->Multicoloums()) {
                                $now = time(); // or your date as well
                                $your_date = strtotime($UDB->Record["expected_dateof_delivery"]);
                                $datediff = $now - $your_date;
                                $diff = floor($datediff / (60 * 60 * 24));
                                if ($diff > 0) {
                                    $status_count = $status_count + 1;
                                }
                            }
                            echo $status_count;
                            ?>
                        </h3>
                        <p>
                            Delay Movements
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell"></i>
                    </div>
                    <a href="vehicle_dispatch_edd_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">

                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as delivery_count from  sr_vehicle_dispatch where dispatch_status='Not Yet Reached'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $delivery_count = $UDB->Record["delivery_count"];
                            }
                            echo $delivery_count;
                            ?>
                        </h3>
                        <p>
                            Delivery Pendings
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa  fa-clock-o"></i>
                    </div>
                    <a href="vehicle_dispatch_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div style="height:15px;clear:both;"></div>

        <!--Start -->
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Pending Orders</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Dispatch Pending</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Transit Status</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Transit Delay</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Delivery Pending</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Client</th>
                                            <th>Order Date & Time</th>
                                            <th>Required Date & Time</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT  id,order_no,client_name,client_division,client_branch,order_date,order_time,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,primary_secondary from  sr_customer_order where order_status='Not Yet Booked'";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                                <td><?php echo $UDB->Record["order_date"] . " " . $UDB->Record["order_time"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"]; ?></td>
                                                <td><?php echo $UDB->Record["orgin"]; ?></td>
                                                <td><?php echo $UDB->Record["destination"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_type"]; ?></td>
                                                <td><?php echo $UDB->Record["primary_secondary"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Client</th>
                                            <th>Order Date & Time</th>
                                            <th>Required Date & Time</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Category</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Required Date & Time</th>
                                            <th>Placed Date & Time</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//$Query = "SELECT  id,order_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,placement_date,placement_time,orgin,destination,vehicle_type,vehicle_no from  sr_vehicle_placement where placement_status='Not Yet Released'";
                                        $Query = "SELECT  t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.vehicle_required_date,t1.vehicle_required_time,t1.placement_date,t1.placement_time,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t2.order_no from sr_vehicle_placement t1,sr_vehicle_dispatch t2 where t1.placement_status='Not Yet Released' and t1.order_no=t2.order_no";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["lr_no"] ?></td>
                                                <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                                <td><?php echo $UDB->Record["vehicle_required_date"] . " " . $UDB->Record["vehicle_required_time"]; ?></td>
                                                <td><?php echo $UDB->Record["placement_date"] . " " . $UDB->Record["placement_time"]; ?></td>
                                                <td><?php echo $UDB->Record["orgin"]; ?></td>
                                                <td><?php echo $UDB->Record["destination"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_type"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_no"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Required Date & Time</th>
                                            <th>Placed Date & Time</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Number</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="box-body table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatched On</th>
                                            <th>EDD</th>
                                            <th>Status Date</th>
                                            <th>Vehicle At</th>
                                            <th>Remarks</th>
                                            <th>Exp Delay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//$Query = "SELECT  id,order_no,client_name,client_division,client_branch,dispatch_date,dispatch_time,orgin,destination,vehicle_type,vehicle_no,expected_dateof_delivery,status_date_time,vehicle_current_position,delay_reason,expected_delay_time from  sr_vehicle_status where vehicle_status='Status Updated'";
                                        $Query = "select t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.dispatch_date,t1.dispatch_time,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.expected_dateof_delivery,t1.status_date_time,t1.vehicle_current_position,t1.remarks,t1.expected_delay_time,t2.lr_no from  sr_vehicle_status t1,sr_vehicle_dispatch t2 where t1.vehicle_status='Status Updated' and t1.order_no=t2.order_no and t1.delay_reason=''";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["lr_no"] ?></td>
                                                <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                                <td><?php echo $UDB->Record["orgin"]; ?></td>
                                                <td><?php echo $UDB->Record["destination"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"]; ?></td>
                                                <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"]; ?></td>
                                                <td><?php echo $UDB->Record["expected_dateof_delivery"]; ?></td>

                                                <td><?php echo $UDB->Record["status_date_time"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_current_position"]; ?></td>
                                                <td><?php echo $UDB->Record["remarks"]; ?></td>
                                                <td><?php echo $UDB->Record["expected_delay_time"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatched On</th>
                                            <th>EDD</th>
                                            <th>Status Date</th>
                                            <th>Vehicle At</th>
                                            <th>Remarks</th>
                                            <th>Exp Delay</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4">
                            <div class="box-body table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatched On</th>
                                            <th>EDD</th>
                                            <th>Status Date</th>
                                            <th>Vehicle At</th>
                                            <th>Delay Reason</th>
                                            <th>Exp Delay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//$Query = "SELECT  id,order_no,client_name,client_division,client_branch,dispatch_date,dispatch_time,orgin,destination,vehicle_type,vehicle_no,expected_dateof_delivery,status_date_time,vehicle_current_position,delay_reason,expected_delay_time from  sr_vehicle_status where vehicle_status='Status Updated'";
                                        $Query = "select t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.dispatch_date,t1.dispatch_time,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.expected_dateof_delivery,t1.status_date_time,t1.vehicle_current_position,t1.delay_reason,t1.expected_delay_time,t2.lr_no from  sr_vehicle_status t1,sr_vehicle_dispatch t2 where t1.vehicle_status='Status Updated' and t1.order_no=t2.order_no and t1.delay_reason<>''";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["lr_no"] ?></td>
                                                <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                                <td><?php echo $UDB->Record["orgin"]; ?></td>
                                                <td><?php echo $UDB->Record["destination"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"]; ?></td>
                                                <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"]; ?></td>
                                                <td><?php echo $UDB->Record["expected_dateof_delivery"]; ?></td>

                                                <td><?php echo $UDB->Record["status_date_time"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_current_position"]; ?></td>
                                                <td><?php echo $UDB->Record["delay_reason"]; ?></td>
                                                <td><?php echo $UDB->Record["expected_delay_time"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client Name</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatched On</th>
                                            <th>EDD</th>
                                            <th>Status Date</th>
                                            <th>Vehicle At</th>
                                            <th>Delay Reason</th>
                                            <th>Exp Delay</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_5">
                            <div class="box-body table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatch Date & Time</th>
                                            <th>EDD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//$Query = "SELECT  id,order_no,client_name,placement_date,placement_time,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery from  sr_vehicle_dispatch where dispatch_status='Not Yet Reached'";
                                        $Query = "SELECT  t1.id,t1.order_no,t1.client_name,t1.placement_date,t1.placement_time,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.dispatch_date,t1.dispatch_time,t1.expected_dateof_delivery,t2.lr_no from  sr_vehicle_dispatch t1,sr_vehicle_dispatch t2 where t1.dispatch_status='Not Yet Reached' and t1.order_no=t2.order_no";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["lr_no"] ?></td>
                                                <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                                <td><?php echo $UDB->Record["orgin"]; ?></td>
                                                <td><?php echo $UDB->Record["destination"]; ?></td>
                                                <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"]; ?></td>
                                                <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"]; ?></td>
                                                <td><?php echo $UDB->Record["expected_dateof_delivery"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>LR Number</th>
                                            <th>Client</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Vehicle Details</th>
                                            <th>Dispatch Date & Time</th>
                                            <th>EDD</th>
                                        <tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
        </div> <!-- /.row -->
        <!-- End -->

    </section>
</aside>

<?php include'../../template/common/footer.default.php'; ?>