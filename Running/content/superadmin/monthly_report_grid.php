<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'bill_form.php';
$action_page = 'bill_action.php';
$print_page = 'bill_print.php';
$selfpage = 'monthly_report_grid.php';
$return_page = '../superadmin/bill_grid.php';
$view_page = 'payments_grid.php';

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
        <h1>Monthly Statement</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Monthly Statement</li>
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
                                        <td  class="form_label_split3">
                                            From Date
                                        </td>
                                        <td  class="form_content_split3">
                                            <div class="input-group">

                                                <input type="text"readonly name="from_date" class="form-control pull-right" id="from_date" onfocus="pick_date(this.id);" <?php if ($id_error == false) echo'value="' . $from_date . '"'; ?>>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split3">
                                            To Date
                                        </td>
                                        <td  class="form_content_split3">
                                            <div class="input-group">
                                                <input type="text" readonly name="to_date" class="form-control pull-right" id="to_date" onfocus="pick_date(this.id);" <?php if ($id_error == false) echo'value="' . $to_date . '"'; ?>>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split3 center_align">
                                            <button type="submit" style="width:100%; height:25px; line-height:10px;" onsubmit="this.style.display = 'none';
                                                    clear_but.style.display = 'none';
                                                    submit_loader.style.display = 'block';
                                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-search"></i>&nbsp;Search</button>
                                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
                            <?php
                            $Query = "SELECT count(si_number)as total_bills,sum(bill_amount)as total_amount from sr_sales_invoice where STR_TO_DATE(si_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(si_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_sales_bills = $UDB->Record["total_bills"];
                                $total_sales_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(si_number)as total_outstanding_bills,sum(pending_amount)as total_outstanding_amount from sr_sales_invoice where STR_TO_DATE(si_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and pending_amount>0  order by abs(si_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_outstanding_sales_bills = $UDB->Record["total_outstanding_bills"];
                                $total_outstanding_sales_amount = $UDB->Record["total_outstanding_amount"];
                            }
                            $Query = "SELECT count(si_number)as total_bills,sum(bill_amount)as total_amount from sr_service_invoice where STR_TO_DATE(si_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(si_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_service_bills = $UDB->Record["total_bills"];
                                $total_service_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(si_number)as total_outstanding_bills,sum(pending_amount)as total_outstanding_amount from sr_service_invoice where STR_TO_DATE(si_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and pending_amount>0  order by abs(si_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_outstanding_service_bills = $UDB->Record["total_outstanding_bills"];
                                $total_outstanding_service_amount = $UDB->Record["total_outstanding_amount"];
                            }
                            $Query = "SELECT count(amc_no)as total_bills,sum(grand_total)as total_amount from sr_amc where STR_TO_DATE(amc_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(amc_no) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_amc_bills = $UDB->Record["total_bills"];
                                $total_amc_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(amc_no)as total_outstanding_bills,sum(pending_amount)as total_outstanding_amount from sr_amc where STR_TO_DATE(amc_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and pending_amount>0  order by abs(amc_no) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_outstanding_amc_bills = $UDB->Record["total_outstanding_bills"];
                                $total_outstanding_amc_amount = $UDB->Record["total_outstanding_amount"];
                            }
                            $Query = "SELECT count(pi_number)as total_bills,sum(grand_total)as total_amount from sr_purchase_invoice where STR_TO_DATE(pi_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(pi_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_purchase_bills = $UDB->Record["total_bills"];
                                $total_purchase_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(pi_number)as total_outstanding_bills,sum(pending_amount)as total_outstanding_amount from sr_purchase_invoice where STR_TO_DATE(pi_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and pending_amount>0  order by abs(pi_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_outstanding_purchase_bills = $UDB->Record["total_outstanding_bills"];
                                $total_outstanding_purchase_amount = $UDB->Record["total_outstanding_amount"];
                            }
                            $Query = "SELECT count(csi_number)as total_bills,sum(grand_total)as total_amount from sr_contract_service_invoice where STR_TO_DATE(csi_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(csi_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_csi_bills = $UDB->Record["total_bills"];
                                $total_csi_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(csi_number)as total_outstanding_bills,sum(pending_amount)as total_outstanding_amount from sr_contract_service_invoice where STR_TO_DATE(csi_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "' and pending_amount>0  order by abs(csi_number) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_outstanding_csi_bills = $UDB->Record["total_outstanding_bills"];
                                $total_outstanding_csi_amount = $UDB->Record["total_outstanding_amount"];
                            }
                            $Query = "SELECT count(receipt_no)as total_bills,sum(amount)as total_amount from sr_cash_receipt where STR_TO_DATE(receipt_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(receipt_no) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_receipts_bills = $UDB->Record["total_bills"];
                                $total_receipts_amount = $UDB->Record["total_amount"];
                            }
                            $Query = "SELECT count(invoice_no)as total_closed_bills,sum(amount_received)as total_closed_amount from sr_payments where STR_TO_DATE(payment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(invoice_no) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_closed_bills = $UDB->Record["total_closed_bills"];
                                $total_closed_amount = $UDB->Record["total_closed_amount"];
                            }
                            $Query = "SELECT count(voucher_no)as total_vouchers,sum(amount)as total_voucher_amount from sr_payment_voucher where STR_TO_DATE(voucher_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(voucher_date) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_voucher = $UDB->Record["total_vouchers"];
                                $total_voucher_amount = $UDB->Record["total_voucher_amount"];
                            }
                            $Query = "SELECT count(invoice_no)as total_vouchers,sum(amount_received)as total_voucher_amount from sr_overdue where STR_TO_DATE(payment_date, '%d-%m-%Y') BETWEEN '" . $from_search_date . "' AND '" . $to_search_date . "'  order by abs(payment_date) desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_overdue = $UDB->Record["total_vouchers"];
                                $total_overdue_amount = $UDB->Record["total_voucher_amount"];
                            }
                            ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="6" class="align_center">Report Period : <?php echo $from_date . " - " . $to_date; ?></th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Invoice Type</td>
                                        <th style="width:20%">Invoice Generated</td>
                                        <th style="width:20%">Total Invoice Amount</td>
                                        <th style="width:20%">Outstanding Invoice</td>
                                        <th style="width:20%">Outstanding Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales Invoice</td>
                                        <td><?php echo $total_sales_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_sales_amount, 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $total_outstanding_sales_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_outstanding_sales_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Service Invoice</td>
                                        <td><?php echo $total_service_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_service_amount, 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $total_outstanding_service_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_outstanding_service_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>AMC Contract</td>
                                        <td><?php echo $total_amc_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_amc_amount, 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $total_outstanding_amc_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_outstanding_amc_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Grand Total</strong></td>
                                        <td><strong><?php echo ($total_sales_bills + $total_service_bills + $total_amc_bills); ?></td>
                                        <td>
                                            <strong><i class="fa fa-fw fa-rupee"></i>
                                                <?php echo number_format((float) ($total_sales_amount + $total_service_amount + $total_amc_amount), 2, '.', ','); ?>
                                            </strong>
                                        </td>
                                        <td><strong><?php echo ($total_outstanding_sales_bills + $total_outstanding_service_bills + $total_outstanding_purchase_bills) ?></strong></td>
                                        <td>
                                            <strong><i class="fa fa-fw fa-rupee"></i>
                                                <?php echo number_format((float) ($total_outstanding_sales_amount + $total_outstanding_service_amount + $total_outstanding_amc_amount), 2, '.', ','); ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Purchase Invoice</td>
                                        <td><?php echo $total_purchase_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_purchase_amount, 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $total_outstanding_purchase_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_outstanding_purchase_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contract Service Invoice</td>
                                        <td><?php echo $total_csi_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_csi_amount, 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $total_outstanding_csi_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_outstanding_csi_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Grand Total</strong></td>
                                        <td><strong><?php echo ($total_purchase_bills + $total_csi_bills); ?></td>
                                        <td>
                                            <strong><i class="fa fa-fw fa-rupee"></i>
                                                <?php echo number_format((float) ($total_purchase_amount + $total_csi_amount), 2, '.', ','); ?>
                                            </strong>
                                        </td>
                                        <td><strong><?php echo ($total_outstanding_purchase_bills + $total_outstanding_csi_bills) ?></strong></td>
                                        <td>
                                            <strong><i class="fa fa-fw fa-rupee"></i>
                                                <?php echo number_format((float) ($total_outstanding_purchase_amount + $total_outstanding_csi_amount), 2, '.', ','); ?>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="height:30px;"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td colspan="3"><strong>Inflow Details</strong></td>
                                    <td colspan="3"><strong>Outflow Details</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:16%"><strong>Title</strong></td>
                                    <td style="width:16%"><strong>Total Count</strong></td>
                                    <td style="width:16%"><strong>Total Amount</strong></td>
                                    <td style="width:16%"><strong>Title</strong></td>
                                    <td style="width:16%"><strong>Total Count</strong></td>
                                    <td style="width:16%"><strong>Total Amount</strong></td>

                                </tr>
                                <tr>
                                    <td>Payments Received</td>
                                    <td><?php echo $total_closed_bills ?></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <?php echo number_format((float) $total_closed_amount, 2, '.', ','); ?>
                                    </td>
                                    <td>Payments Paid</td>
                                    <td><?php echo $total_overdue ?></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <?php echo number_format((float) $total_overdue_amount, 2, '.', ','); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Receipts</td>
                                    <td><?php echo $total_receipts_bills ?></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <?php echo number_format((float) $total_receipts_amount, 2, '.', ','); ?>
                                    </td>
                                    <td>Vouchers</td>
                                    <td><?php echo $total_voucher; ?></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <?php echo number_format((float) $total_voucher_amount, 2, '.', ','); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Total Inflow</strong></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <strong><?php echo number_format((float) ($total_receipts_amount + $total_closed_amount), 2, '.', ','); ?></strong>
                                    </td>
                                    <td colspan="2"><strong>Total Outflow</strong></td>
                                    <td>
                                        <i class="fa fa-fw fa-rupee"></i>
                                        <strong><?php echo number_format((float) ($total_voucher_amount + $total_overdue_amount), 2, '.', ','); ?></strong>
                                    </td>
                                </tr>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
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