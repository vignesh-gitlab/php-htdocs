<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$selfpage = 'consignment_pending_report.php';
$return_page = '../superadmin/consignment_pending_report.php';


$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"]) && $_REQUEST["client_name"] != "Select") {
    $client_name = $_REQUEST["client_name"];
    $client_error = false;
} else {
    $client_name = "";
}

$bill_type_error = true;
if (isset($_REQUEST["bill_type"]) && !empty($_REQUEST["bill_type"]) && $_REQUEST["bill_type"] != "Select") {
    $bill_type = $_REQUEST["bill_type"];
    $bill_type_error = false;
} else {
    $bill_type = "";
}
$branch_error = true;
if (isset($_REQUEST["branch_code"]) && !empty($_REQUEST["branch_code"]) && $_REQUEST["branch_code"] != "Select") {
    $branch_code = $_REQUEST["branch_code"];
    $branch_error = false;
} else {
    $branch_code = "";
}


$from_error = true;
if (isset($_REQUEST["from_date"]) && !empty($_REQUEST["from_date"])) {
    $from_date = $_REQUEST["from_date"];
    $from_date_val = explode("-", $_REQUEST["from_date"]);
    $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
    $from_error = false;
} else {
    $from_date = "";
}

$to_error = true;
if (isset($_REQUEST["to_date"]) && !empty($_REQUEST["to_date"])) {
    $to_date = $_REQUEST["to_date"];
    $to_date_val = explode("-", $_REQUEST["to_date"]);
    $to_search_date = $to_date_val[2] . "-" . $to_date_val[1] . "-" . $to_date_val[0];
    $to_error = false;
} else {
    $from_date = "";
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Consignment Pending</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Consignment Pending</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row no-print">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $selfpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="3">
                                            <select class="chosen-select form-control dropdown_padding" name="branch_code" id="branch_code">
                                                <option>Select</option>
                                                <?php
                                                $Query1 = "select distinct(branch_code) from sr_company order by id";
                                                $DB->query($Query1);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $branch_code == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Consignors Name
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="3">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $client_name == $DB->Record["client_name"]) {
                                                        echo'<option selected>' . $DB->Record["client_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["client_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            From Date
                                        </td>
                                        <td  class="form_content_split2">
                                            <div class="input-group">

                                                <input type="text"readonly name="from_date" class="form-control pull-right" id="from_date" onfocus="pick_date(this.id);" <?php if ($id_error == false) echo'value="' . $from_date . '"'; ?>>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            To Date
                                        </td>
                                        <td  class="form_content_split2">
                                            <div class="input-group">
                                                <input type="text" readonly name="to_date" class="form-control pull-right" id="to_date" onfocus="pick_date(this.id);" <?php if ($id_error == false) echo'value="' . $to_date . '"'; ?>>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Bill Type
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="3">
                                            <select class="chosen-select form-control dropdown_padding" name="bill_type" id="bill_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select bill_type from master_bill_type order by bill_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $bill_type == $DB->Record["bill_type"]) {
                                                        echo'<option selected>' . $DB->Record["bill_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["bill_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <button type="submit" style="width:160px;margin-left: 20px;margin-bottom: 10px; height:25px; line-height:10px;" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-search"></i>&nbsp;Search</button>
                        <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>


                    </div><!-- /.box-body -->

            </div><!-- /.box -->
            </form>
        </div>

        <?php
        if ((($from_error == false && $to_error == false && $client_error == false) || ($from_error == false && $to_error == false && $branch_error == false) || ($from_error == false && $to_error == false && $branch_error == false && $client_error == false)) && $bill_type_error == true) {
            //|| $bill_type_error == false || $branch_error == false || $client_error == false
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                       <!-- <th colspan="6" class="align_center">Consignment Pending for <?php echo $client_name . ' from ' . $from_date . " to " . $to_date; ?></th>-->
                                        <th colspan="6" class="align_center">Consignment Pending</th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</td>
                                        <th style="width:20%">Branch Name</td>
                                        <th style="width:20%">Consignment No.</td>
                                        <th style="width:10%">Date</td>
                                        <th style="width:20%">Consignor's Name</td>
                                        <th style="width:20%">Consignee's</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($client_error == false && $branch_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where (STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND consignor_name='" . $client_name . "' AND to_be_billed_at='" . $branch_code . "') AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($client_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where (STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND consignor_name='" . $client_name . "') AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($branch_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where (STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND to_be_billed_at='" . $branch_code . "') AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else {

                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];

                                        $lorry_chellan_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_chellan_count = 1;
                                        }
                                        if ($lorry_chellan_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $branch_name; ?></td>
                                                <td><?php echo $consignment_note_no; ?></td>
                                                <td><?php echo $consignment_date; ?></td>
                                                <td><?php echo $consignor_name; ?></td>
                                                <td><?php echo $consignee_bank; ?></td>
                                            </tr>



                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if (($from_error == false && $to_error == false && $branch_error == false && $client_error == false && $bill_type_error == false) || ($from_error == false && $to_error == false && $bill_type_error == false && $client_error == false) || ($from_error == false && $to_error == false && $bill_type_error == false && $branch_error == false) || ($client_error == false && $bill_type_error == false && $branch_error == false) || ($from_error == false && $to_error == false && $bill_type_error == false) || ($branch_error == false && $bill_type_error == false) || ($client_error == false && $bill_type_error == false) || ($bill_type_error == false && $client_error == true && $branch_error == true && $from_error == true && $to_error == true)) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="11" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" class="align_left">H.O : Mumbai</th><th colspan="3" class="align_right"><?php echo date('d-m-Y'); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="11" style="padding-left: 100px;padding-top: 10px;">Sub : <?php echo $bill_type; ?> Consignments, pending for Billing</th>
                                    </tr>
                                    <tr>
                                        <th colspan="11" style="padding-left: 50px;padding-top: 10px;text-align: justify;"><p>Appended hereunder are consignments, which are <?php echo '  ' . $bill_type . '  '; ?> at your station. As per our records, no freight bill are prepared so far. Please send us copies of your freight bill, for these consignments at your earliest. If consignments are to be treated TODAY. Please confirm, with topay amount.</p></th>
                                </tr>
                                <tr>
                                    <th colspan="11"  style="padding-left: 50px;padding-top: 10px;">Booked From <?php echo ' ' . $from_date . ' To ' . $to_date; ?></th>
                                </tr>
                                <tr>
                                    <th style="width:6%">Order No.</td>
                                    <th style="width:7%">Branch</td>
                                    <th style="width:8%">Consignment.No.</td>
                                    <th style="width:6%">Date</td>
                                    <th style="width:4%">Pkgs</td>
                                    <th style="width:4%">Weight</td>
                                    <th style="width:16%">Destination</td>
                                    <th style="width:5%">L.R. Frieght</td>
                                    <th style="width:8%">Arr. No. & Date</td>
                                    <th style="width:18%">Consignor Name</td>
                                    <th style="width:18%">Consignee's</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_frieght_charges = 0;
                                    if ($client_error == false && $branch_error == false && $bill_type_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND bill_type='" . $bill_type . "'  AND consignor_name='" . $client_name . "' AND to_be_billed_at='" . $branch_code . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($bill_type_error == false && $branch_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND bill_type='" . $bill_type . "'  AND to_be_billed_at='" . $branch_code . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($bill_type_error == false && $client_error == false && $from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND bill_type='" . $bill_type . "'  AND consignor_name='" . $client_name . "'  AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($bill_type_error == false && $from_error == false && $to_error == false) {

                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND bill_type='" . $bill_type . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($client_error == false && $bill_type_error == false && $branch_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where bill_type='" . $bill_type . "' AND consignor_name='" . $client_name . "'  AND to_be_billed_at='" . $branch_code . "'  AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($branch_error == false && $bill_type_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where bill_type='" . $bill_type . "'  AND to_be_billed_at='" . $branch_code . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($client_error == false && $bill_type_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where bill_type='" . $bill_type . "' AND consignor_name='" . $client_name . "'  AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else if ($bill_type_error == false && $client_error == true && $branch_error == true && $from_error == true && $to_error == true) {

                                        $Query = "SELECT order_no,order_date,branch_city,lane_to,consignor_name,consignment_note_no,consignment_date,consignee_bank,total_frieght from sr_bilty where bill_type='" . $bill_type . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];
                                        $lane_to = $UDB->Record["lane_to"];
                                        $total_frieght = $UDB->Record["total_frieght"];
                                        $Query1 = "SELECT sum(packages) as total_packages,sum(weight_actual) as total_weight from sr_bilty_item where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $total_packages = $UDB1->Record["total_packages"];
                                            $total_weight = $UDB1->Record["total_weight"];


                                            $lorry_chellan_count = 0;
                                            $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                            $UDB1->query($Query1);
                                            while ($UDB1->Multicoloums()) {
                                                $lorry_chellan_count = 1;
                                            }
                                            if ($lorry_chellan_count == 0) {
                                                ?>


                                                <tr>
                                                    <td><?php echo $order_no; ?></td>
                                                    <td><?php echo $branch_name; ?></td>
                                                    <td><?php echo $consignment_note_no; ?></td>
                                                    <td><?php echo $consignment_date; ?></td>
                                                    <td><?php echo $total_packages; ?></td>
                                                    <td><?php
                                                        echo $total_weight;
                                                        $total_frieght_charges = $total_frieght_charges + $total_frieght;
                                                        ?></td>
                                                    <td><?php echo $lane_to; ?></td>
                                                    <td><?php echo $total_frieght; ?></td>
                                                    <td><?php
                                                        $Query1 = "SELECT lar_no,lar_date from sr_lorry_arrival_report where order_no='" . $order_no . "'";
                                                        $UDB1->query($Query1);
                                                        while ($UDB1->Multicoloums()) {
                                                            $lar_no = $UDB1->Record["lar_no"];
                                                            $lar_date = $UDB1->Record["lar_date"];
                                                        }
                                                        echo $lar_no . '-' . $lar_date;
                                                        ?></td>
                                                    <td><?php echo $consignor_name; ?></td>
                                                    <td><?php echo $consignee_bank; ?></td>
                                                </tr>



                                                <?php
                                            }
                                            $lar_no = "";
                                            $lar_date = "";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">
                                            Total
                                        </td>
                                        <td colspan="4" style="text-align: left;"><?php echo $total_frieght_charges; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" style="padding-left: 10px;text-align: left;">
                                            <b>Please treat this as most urgent & important.</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" style="text-align: left;height:50px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" style="padding-left: 10px;text-align: left;">
                                            <b>INCHARGE</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" style="padding-left: 10px;text-align: left;">
                                            (Revenue Control Deptt. )
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if ($from_error == false && $to_error == false && $bill_type_error == true && $client_error == true && $branch_error == true) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                       <!-- <th colspan="6" class="align_center">Consignment Pending for <?php echo $client_name . ' from ' . $from_date . " to " . $to_date; ?></th>-->
                                        <th colspan="6" class="align_center">Consignment Pending for Despatch <?php echo ' From ' . $from_date . ' To ' . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</td>
                                        <th style="width:20%">Branch Name</td>
                                        <th style="width:20%">Consignment No.</td>
                                        <th style="width:10%">Date</td>
                                        <th style="width:20%">Consignor's Name</td>
                                        <th style="width:20%">Consignee's</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($from_error == false && $to_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where STR_TO_DATE(consignment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND  bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else {

                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];

                                        $lorry_chellan_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_chellan_count = 1;
                                        }
                                        if ($lorry_chellan_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $branch_name; ?></td>
                                                <td><?php echo $consignment_note_no; ?></td>
                                                <td><?php echo $consignment_date; ?></td>
                                                <td><?php echo $consignor_name; ?></td>
                                                <td><?php echo $consignee_bank; ?></td>
                                            </tr>



                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if ($from_error == true && $to_error == true && $bill_type_error == true && $client_error == true && $branch_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                       <!-- <th colspan="6" class="align_center">Consignment Pending for <?php echo $client_name . ' from ' . $from_date . " to " . $to_date; ?></th>-->
                                        <th colspan="6" class="align_center">Consignment Pending for Despatch <?php echo ' From ' . $from_date . ' To ' . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</td>
                                        <th style="width:20%">Branch Name</td>
                                        <th style="width:20%">Consignment No.</td>
                                        <th style="width:10%">Date</td>
                                        <th style="width:20%">Consignor's Name</td>
                                        <th style="width:20%">Consignee's</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($branch_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where to_be_billed_at='" . $branch_code . "' AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else {

                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];

                                        $lorry_chellan_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_chellan_count = 1;
                                        }
                                        if ($lorry_chellan_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $branch_name; ?></td>
                                                <td><?php echo $consignment_note_no; ?></td>
                                                <td><?php echo $consignment_date; ?></td>
                                                <td><?php echo $consignor_name; ?></td>
                                                <td><?php echo $consignee_bank; ?></td>
                                            </tr>



                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if ($from_error == true && $to_error == true && $bill_type_error == true && $client_error == false && $branch_error == true) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                       <!-- <th colspan="6" class="align_center">Consignment Pending for <?php echo $client_name . ' from ' . $from_date . " to " . $to_date; ?></th>-->
                                        <th colspan="6" class="align_center">Consignment Pending for Despatch <?php echo ' From ' . $from_date . ' To ' . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</td>
                                        <th style="width:20%">Branch Name</td>
                                        <th style="width:20%">Consignment No.</td>
                                        <th style="width:10%">Date</td>
                                        <th style="width:20%">Consignor's Name</td>
                                        <th style="width:20%">Consignee's</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($client_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where consignor_name='" . $client_name . "' AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else {

                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];

                                        $lorry_chellan_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_chellan_count = 1;
                                        }
                                        if ($lorry_chellan_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $branch_name; ?></td>
                                                <td><?php echo $consignment_note_no; ?></td>
                                                <td><?php echo $consignment_date; ?></td>
                                                <td><?php echo $consignor_name; ?></td>
                                                <td><?php echo $consignee_bank; ?></td>
                                            </tr>



                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else if ($from_error == true && $to_error == true && $bill_type_error == true && $client_error == false && $branch_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                       <!-- <th colspan="6" class="align_center">Consignment Pending for <?php echo $client_name . ' from ' . $from_date . " to " . $to_date; ?></th>-->
                                        <th colspan="6" class="align_center">Consignment Pending for Despatch <?php echo ' From ' . $from_date . ' To ' . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</td>
                                        <th style="width:20%">Branch Name</td>
                                        <th style="width:20%">Consignment No.</td>
                                        <th style="width:10%">Date</td>
                                        <th style="width:20%">Consignor's Name</td>
                                        <th style="width:20%">Consignee's</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($client_error == false) {
                                        $Query = "SELECT order_no,order_date,branch_city,consignor_name,consignment_note_no,consignment_date,consignee_bank from sr_bilty where consignor_name='" . $client_name . "' AND to_be_billed_at='" . $branch_code . "' AND bilty_status='Not Yet Released'  order by abs(consignment_note_no)";
                                    } else {

                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $branch_name = $UDB->Record["branch_city"];
                                        $consignor_name = $UDB->Record["consignor_name"];
                                        $consignment_note_no = $UDB->Record["consignment_note_no"];
                                        $consignment_date = $UDB->Record["consignment_date"];
                                        $consignee_bank = $UDB->Record["consignee_bank"];

                                        $lorry_chellan_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_chellan where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_chellan_count = 1;
                                        }
                                        if ($lorry_chellan_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $branch_name; ?></td>
                                                <td><?php echo $consignment_note_no; ?></td>
                                                <td><?php echo $consignment_date; ?></td>
                                                <td><?php echo $consignor_name; ?></td>
                                                <td><?php echo $consignee_bank; ?></td>
                                            </tr>



                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row no-print" style="margin-bottom:-350px;">
            <div class="col-xs-12" style="margin-bottom:20px;">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>