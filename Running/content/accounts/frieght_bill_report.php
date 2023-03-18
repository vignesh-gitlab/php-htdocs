<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$selfpage = 'frieght_bill_report.php';
$return_page = '../accounts/frieght_bill_report.php';


$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"]) && $_REQUEST["client_name"] != "Select") {
    $client_name = $_REQUEST["client_name"];
    $client_error = false;
} else {
    $client_name = "";
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
        <h1>Frieght Bill Report</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Frieght Bill Report</li>
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
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="3">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name">
                                                <option>Select</option>
                                                <?php
                                                $Query1 = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query1);

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
        if ($from_error == false && $to_error == false || $client_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="18" class="align_center">WESTERN ARYA TRANSPORTS (P) LTD.</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="18" class="align_center">H.O : Mumbai</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="18" class="align_center">Bill Register <?php echo ' From ' . $from_date . " To " . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:6%">SR.No.</th>
                                        <th style="width:8%">Branch</th>
                                        <th style="width:6%">Bill.No.</th>
                                        <th style="width:6%">Bill.Date</th>
                                        <th style="width:16%">Client Name</th>
                                        <th style="width:5%">Con.No.</th>
                                        <th style="width:7%">Con.Date</th>
                                        <th style="width:10%">Destination</th>
                                        <th style="width:3%">Weight</th>
                                        <th style="width:4%">Rate</th>
                                        <th style="width:10%">SU.No.</th>
                                        <th style="width:10%">From</th>
                                        <th>Fri.Chg.</th>
                                        <th>OCTROI.Chg.</th>
                                        <th>Others.Chgs.</th>
                                        <th>Total.Amt.</th>
                                        <th>Account.Destination</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_frieght = 0;
                                    $total_octroi = 0;
                                    $total_others = 0;
                                    $total_amount_all = 0;
                                    if ($from_error == false && $to_error == false && $client_error == false) {
                                        $Query = "SELECT branch,stationary_no,client_name,bill_no,bill_date,total from sr_frieght_bill where STR_TO_DATE(bill_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND client_name='" . $client_name . "'  order by abs(stationary_no)";
                                    } else if ($from_error == false && $to_error == false) {
                                        $Query = "SELECT branch,stationary_no,client_name,bill_no,bill_date,total from sr_frieght_bill where STR_TO_DATE(bill_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(stationary_no)";
                                    } else if ($client_error == false) {
                                        $Query = "SELECT branch,stationary_no,client_name,bill_no,bill_date from sr_frieght_bill where client_name='" . $client_name . "'  order by abs(stationary_no)";
                                    }
                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $branch = $UDB->Record["branch"];
                                        $stationary_no = $UDB->Record["stationary_no"];
                                        $client_name = $UDB->Record["client_name"];
                                        $bill_no = $UDB->Record["bill_no"];
                                        $bill_date = $UDB->Record["bill_date"];


                                        $Query1 = "SELECT bill_no,bill_date_item,no_item,weight,rate,from_to from sr_frieght_bill_item where bill_no='" . $bill_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $bill_no = $UDB1->Record["bill_no"];
                                            $no_item = $UDB1->Record["no_item"];
                                            $bill_date_item = $UDB1->Record["bill_date_item"];
                                            $weight = $UDB1->Record["weight"];
                                            $rate = $UDB1->Record["rate"];
                                            // $from_to = $UDB1->Record["from_to"];
                                            //$from_date_val = explode("-", $from_to);
                                            //$from = $from_date_val[0];
                                            $Query1 = "SELECT lane_from,lane_to,container_no,sum(total_frieght) as total_frieght_amount,sum(octroi_charges) as total_octroi_charges,sum(hamall) as total_hamall,sum(sur_charges) as total_sur_charges,sum(st_charges) as total_st_charges,sum(risk_charges) as total_risk_charges,sum(checkpost) as total_checkpost,sum(fov) as total_fov,total,bill_party from sr_bilty where stationary_no='" . $no_item . "'";
                                            $UDB1->query($Query1);
                                            while ($UDB1->Multicoloums()) {
                                                $lane_from = $UDB1->Record["lane_from"];
                                                $lane_to = $UDB1->Record["lane_to"];
                                                $container_no = $UDB1->Record["container_no"];
                                                $total_frieght_amount = $UDB1->Record["total_frieght_amount"];
                                                $total_octroi_charges = $UDB1->Record["total_octroi_charges"];
                                                $total_hamall = $UDB1->Record["total_hamall"];
                                                $total_sur_charges = $UDB1->Record["total_sur_charges"];
                                                $total_st_charges = $UDB1->Record["total_st_charges"];
                                                $total_risk_charges = $UDB1->Record["total_risk_charges"];
                                                $total_checkpost = $UDB1->Record["total_checkpost"];
                                                $total_fov = $UDB1->Record["total_fov"];
                                                $total_amount = $UDB1->Record["total"];
                                                $bill_party = $UDB1->Record["bill_party"];
                                                $total_others_amount = $total_hamall + $total_sur_charges + $total_st_charges + $total_risk_charges + $total_checkpost + $total_fov;
                                                ?>


                                                <tr>
                                                    <td><?php echo $stationary_no; ?></td>
                                                    <td><?php echo $branch; ?></td>
                                                    <td><?php echo $bill_no; ?></td>
                                                    <td><?php echo $bill_date; ?></td>
                                                    <td><?php echo $client_name; ?></td>
                                                    <td><?php echo $no_item; ?></td>
                                                    <td><?php echo $bill_date_item; ?></td>
                                                    <td><?php echo $lane_to; ?></td>
                                                    <td><?php echo $weight; ?></td>
                                                    <td><?php echo $rate; ?></td>
                                                    <td><?php echo $container_no; ?></td>
                                                    <td><?php echo $lane_from; ?></td>
                                                    <td><?php echo $total_frieght_amount; ?></td>
                                                    <td><?php echo $total_octroi_charges; ?></td>
                                                    <td><?php echo $total_others_amount; ?></td>
                                                    <td><?php echo $total_amount; ?></td>
                                                    <td><?php echo $bill_party; ?></td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        $total_frieght = $total_frieght + $total_frieght_amount;
                                        $total_octroi = $total_octroi + $total_octroi_charges;
                                        $total_others = $total_others + $total_others_amount;
                                        $total_amount_all = $total_amount_all + $total_amount;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="12" style="text-align: center;">
                                            Total
                                        </td>
                                        <td>
                                            <?php echo $total_frieght; ?>
                                        </td>
                                        <td>
                                            <?php echo $total_octroi; ?>
                                        </td>
                                        <td>
                                            <?php echo $total_others; ?>
                                        </td>
                                        <td>
                                            <?php echo $total_amount_all; ?>
                                        </td>
                                        <td>
                                            <?php echo ""; ?>
                                        </td>
                                    </tr>
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