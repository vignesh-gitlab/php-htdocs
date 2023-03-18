<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$selfpage = 'frieght_bill_credit_outstanding_report.php';
$return_page = '../superadmin/frieght_bill_credit_outstanding_report.php';


$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"]) && $_REQUEST["client_name"] != "Select") {
    $client_name = $_REQUEST["client_name"];
    $submission_category = $_REQUEST["submission_category"];
    $client_error = false;
} else {
    $client_name = "";
}

$from_error = true;
if (isset($_REQUEST["from_date"]) && !empty($_REQUEST["from_date"])) {
    $submission_category = $_REQUEST["submission_category"];
    $from_date = $_REQUEST["from_date"];
    $from_date_val = explode("-", $_REQUEST["from_date"]);
    $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
    $from_error = false;
} else {
    $from_date = "";
}

$to_error = true;
if (isset($_REQUEST["to_date"]) && !empty($_REQUEST["to_date"])) {
    $submission_category = $_REQUEST["submission_category"];
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
        <h1>Frieght Bill Outstanding Report</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Frieght Bill Outstanding Report</li>
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
                                        <td class="form_content_split2" align="left" colspan="5">
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
                                            Submission Category
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="5">
                                            <select class="chosen-select form-control dropdown_padding" name="submission_category" id="submission_category">
                                                <?php
                                                $Query = "select distinct(submission_category) from master_frieght_bill_submission order by submission_category";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $submission_category == $DB->Record["submission_category"]) {
                                                        echo'<option selected>' . $DB->Record["submission_category"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["submission_category"] . '</option>';
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
                                        <td  class="form_content_split2" colspan="3">
                                            <div class="input-group" style="width:100%;">

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
                                        <th colspan="8" class="align_center">WESTERN ARYA TRANSPORTS (P) LTD.</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="8" class="align_center">Outstanding of Party(s) <?php echo ' From ' . $from_date . ' To ' . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="4" style="text-align:center;">BILL AMOUNT</th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Bill No.</th>
                                        <th style="width:10%">Bill Date</th>
                                        <th style="width:10%">Subm.Date</th>
                                        <th style="width:18%">Client Name</th>
                                        <th style="width:13%">Current</th>
                                        <th style="width:13%">Over 30 Days</th>
                                        <th style="width:13%">Over 60 Days</th>
                                        <th style="width:13%">Over 180 Days</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_bill_amount1 = 0;
                                    $total_bill_amount2 = 0;
                                    $total_bill_amount3 = 0;
                                    $total_bill_amount4 = 0;
                                    if ($from_error == false && $to_error == false && $client_error == false) {
                                        $Query = "SELECT bill_no,bill_date,client_name,total,credit_days,sub_date from sr_frieght_bill where STR_TO_DATE(bill_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' AND client_name='" . $client_name . "'";
                                    } else if ($from_error == false && $to_error == false) {
                                        $Query = "SELECT bill_no,bill_date,client_name,total,credit_days,sub_date from sr_frieght_bill where STR_TO_DATE(bill_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'";
                                    } else if ($client_error == false) {
                                        $Query = "SELECT bill_no,bill_date,client_name,total,credit_days,sub_date from sr_frieght_bill where client_name='" . $client_name . "'";
                                    }

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $bill_no = $UDB->Record["bill_no"];
                                        $bill_date = $UDB->Record["bill_date"];
                                        $client_name = $UDB->Record["client_name"];
                                        $total = $UDB->Record["total"];
                                        $credit_days = $UDB->Record["credit_days"];
                                        $sub_date = $UDB->Record["sub_date"];

                                        $credit_date_value = date('d-m-Y', strtotime($bill_date . '+' . $credit_days . 'days'));

                                        $date1 = date_create(date("Y-m-d", strtotime($UDB->Record["bill_date"])));
                                        $date2 = date_create(date('Y-m-d'));
                                        $diff = $date1->diff($date2)->format("%R%a");
                                        $diff1 = $date1->diff($date2)->format("%a");
                                        /* $Query1 = "SELECT sub_date from sr_bill_despatch_advice_item where bill_no='" . $bill_no . "'";


                                          $UDB1->query($Query1);
                                          while ($UDB1->Multicoloums()) {
                                          $sub_date = $UDB1->Record["sub_date"];
                                          } */
                                        if ($submission_category == "All") {
                                            ?>


                                            <tr>
                                                <td><?php echo $bill_no; ?></td>
                                                <td><?php echo $bill_date; ?></td>
                                                <td><?php echo $sub_date; ?></td>
                                                <td><?php echo $client_name; ?></td>
                                                <td><?php
                                                    if ($diff <= 30) {
                                                        echo $total;
                                                        $total_bill_amount1 = $total_bill_amount1 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 30 && $diff <= 60) {
                                                        echo $total;
                                                        $total_bill_amount2 = $total_bill_amount2 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 60 && $diff <= 180) {
                                                        echo $total;
                                                        $total_bill_amount3 = $total_bill_amount3 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 180) {
                                                        echo $total;
                                                        $total_bill_amount4 = $total_bill_amount4 + $total;
                                                    }
                                                    ?></td>

                                            </tr>
                                            <?php
                                            $sub_date = "";
                                        } else if ($submission_category == "Submitted" && $sub_date != "") {
                                            ?>


                                            <tr>
                                                <td><?php echo $bill_no; ?></td>
                                                <td><?php echo $bill_date; ?></td>
                                                <td><?php echo $sub_date; ?></td>
                                                <td><?php echo $client_name; ?></td>
                                                <td><?php
                                                    if ($diff <= 30) {
                                                        echo $total;
                                                        $total_bill_amount1 = $total_bill_amount1 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 30 && $diff <= 60) {
                                                        echo $total;
                                                        $total_bill_amount2 = $total_bill_amount2 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 60 && $diff <= 180) {
                                                        echo $total;
                                                        $total_bill_amount3 = $total_bill_amount3 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 180) {
                                                        echo $total;
                                                        $total_bill_amount4 = $total_bill_amount4 + $total;
                                                    }
                                                    ?></td>

                                            </tr>
                                            <?php
                                            $sub_date = "";
                                        } else if ($submission_category == "Unsubmitted" && $sub_date == "") {
                                            ?>


                                            <tr>
                                                <td><?php echo $bill_no; ?></td>
                                                <td><?php echo $bill_date; ?></td>
                                                <td><?php echo $sub_date; ?></td>
                                                <td><?php echo $client_name; ?></td>
                                                <td><?php
                                                    if ($diff <= 30) {
                                                        echo $total;
                                                        $total_bill_amount1 = $total_bill_amount1 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 30 && $diff <= 60) {
                                                        echo $total;
                                                        $total_bill_amount2 = $total_bill_amount2 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 60 && $diff <= 180) {
                                                        echo $total;
                                                        $total_bill_amount3 = $total_bill_amount3 + $total;
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if ($diff > 180) {
                                                        echo $total;
                                                        $total_bill_amount4 = $total_bill_amount4 + $total;
                                                    }
                                                    ?></td>

                                            </tr>
                                            <?php
                                            $sub_date = "";
                                        }
                                        ?>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div style="height:30px;"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width:10%">
                                        Total
                                    </td>
                                    <td style="width:10%"><?php echo $total_bill_amount ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:18%"><?php echo ""; ?></td>
                                    <td style="width:13%"><?php echo $total_bill_amount1; ?></td>
                                    <td style="width:13%"><?php echo $total_bill_amount2; ?></td>
                                    <td style="width:13%"><?php echo $total_bill_amount3; ?></td>
                                    <td style="width:13%"><?php echo $total_bill_amount4; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;">
                                        Total Outstanding :
                                    </td>
                                    <td colspan="4" style="text-align: left;padding-left: 1em;"><?php
                                        $total_outstanding = $total_bill_amount1 + $total_bill_amount2 + $total_bill_amount3 + $total_bill_amount4;
                                        echo $total_outstanding;
                                        ?></td>

                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;">
                                        Total Submitted Outstanding :
                                    </td>
                                    <td colspan="4" style="text-align: left;padding-left: 1em;"><?php
                                        echo "";
                                        ?></td>

                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;">
                                        Total On A/C Received :
                                    </td>
                                    <td colspan="4" style="text-align: left;padding-left: 1em;"><?php
                                        echo "";
                                        ?></td>

                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right;">
                                        Net Outstanding :
                                    </td>
                                    <td colspan="4" style="text-align: left;padding-left: 1em;"><?php
                                        echo "";
                                        ?></td>

                                </tr>
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