<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$selfpage = 'frieght_bill_outstanding_report.php';
$return_page = '../accounts/frieght_bill_outstanding_report.php';





$from_error = true;
if (isset($_REQUEST["from_date"]) && !empty($_REQUEST["from_date"])) {
    $from_date = $_REQUEST["from_date"];
    $from_date_val = explode("-", $_REQUEST["from_date"]);
    $from_search_date = $from_date_val[2] . "-" . $from_date_val[1] . "-" . $from_date_val[0];
    $from_error = false;
} else {
    $from_date = "";
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Frieght Bill Outstanding Upto</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Frieght Bill Outstanding Upto</li>
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
                                            Select Date
                                        </td>
                                        <td  class="form_content_split2" colspan="3">
                                            <div class="input-group" style="width:100%;">

                                                <input type="text"readonly name="from_date" class="form-control pull-right" id="from_date" onfocus="pick_date(this.id);" <?php if ($id_error == false) echo'value="' . $from_date . '"'; ?>>
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
        if ($from_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="10" class="align_center">WESTERN ARYA TRANSPORTS (P) LTD.</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="10" class="align_center">Branch : All Branch</th>
                                    </tr>
                                    <tr class="align_center">
                                        <th colspan="10" class="align_center">Bill Outstanding of All Party(s) Upto date <?php echo '  ' . $from_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:10%">Bill No.</td>
                                        <th style="width:10%">Party</td>
                                        <th style="width:10%">Bill Amount</td>
                                        <th style="width:10%">Due Amount</td>
                                        <th style="width:10%">Overdue Amount</td>
                                        <th style="width:10%">On A/C Rcvd</td>
                                        <th style="width:10%">Net Outstanding</td>
                                        <th style="width:10%">Person</td>
                                        <th style="width:10%">Cr. Days</td>
                                        <th style="width:10%">UnSub Amt</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_bill_amount = 0;
                                    //$Query1 = "SELECT order_no from sr_lorry_arrival_report where order_no<>'" . $order_no . "'";
                                    $Query = "SELECT bill_no,client_name,total,credit_days from sr_frieght_bill where STR_TO_DATE(bill_date, '%d-%m-%Y') < '" . $from_search_date . "'";

                                    $UDB->query($Query);
                                    while ($UDB->Multicoloums()) {
                                        $bill_no = $UDB->Record["bill_no"];
                                        $client_name = $UDB->Record["client_name"];
                                        $total = $UDB->Record["total"];
                                        $credit_days = $UDB->Record["credit_days"];
                                        ?>


                                        <tr>
                                            <td><?php echo $bill_no; ?></td>
                                            <td><?php echo $client_name; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo $credit_days; ?></td>
                                            <td><?php echo ""; ?></td>
                                        </tr>



                                        <?php
                                        $total_bill_amount = $total_bill_amount + $total;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div style="height:30px;"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width:20%">
                                        Total
                                    </td>
                                    <td style="width:10%"><?php echo $total_bill_amount ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:20%"><?php echo ""; ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
                                    <td style="width:10%"><?php echo ""; ?></td>
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