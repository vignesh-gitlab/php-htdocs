<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$selfpage = 'lorry_chellan_pending_report.php';
$return_page = '../accounts/lorry_chellan_pending_report.php';


$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"])) {
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
        <h1>Lorry Chellan Pending Report</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Lorry Chellan Pending Report</li>
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
        if ($from_error == false && $to_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="7" class="align_center">WESTERN ARYA TRANSPORTS</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="7" class="align_center">Chellans Pending for Arrival Statement <?php echo ' From ' . $from_date . " To " . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Order No.</th>
                                        <th style="width:10%">Lorry Chellan No.</th>
                                        <th style="width:10%">Date</th>
                                        <th style="width:10%">Lorry No.</th>
                                        <th style="width:20%">From</th>
                                        <th style="width:20%">To</th>
                                        <th style="width:20%">Broker Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Query = "SELECT order_no,lorry_chellan_no,lorry_chellan_date,lorry_from,lorry_to,lorry_no,owner_name from sr_lorry_chellan where STR_TO_DATE(lorry_chellan_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and lc_status='Not Yet Released' order by abs(order_no)";
                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $order_no = $UDB->Record["order_no"];
                                        $lorry_chellan_no = $UDB->Record["lorry_chellan_no"];
                                        $lorry_chellan_date = $UDB->Record["lorry_chellan_date"];
                                        $lorry_no = $UDB->Record["lorry_no"];
                                        $lorry_from = $UDB->Record["lorry_from"];
                                        $lorry_to = $UDB->Record["lorry_to"];
                                        $owner_name = $UDB->Record["owner_name"];
                                        $lorry_arrival_report_count = 0;
                                        $Query1 = "SELECT order_no from sr_lorry_arrival_report where order_no='" . $order_no . "'";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $lorry_arrival_report_count = 1;
                                        }
                                        if ($lorry_arrival_report_count == 0) {
                                            ?>


                                            <tr>
                                                <td><?php echo $order_no; ?></td>
                                                <td><?php echo $lorry_chellan_no; ?></td>
                                                <td><?php echo $lorry_chellan_date; ?></td>
                                                <td><?php echo $lorry_no; ?></td>
                                                <td><?php echo $lorry_from; ?></td>
                                                <td><?php echo $lorry_to; ?></td>
                                                <td><?php echo $owner_name; ?></td>
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