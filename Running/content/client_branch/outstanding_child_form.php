<?php
include'../../template/client_branch/header.default.php';

$actionpage = 'outstanding_child_action.php';
$tablename = 'sr_payments';

$id_error = false;
if ((!isset($_REQUEST["invoice_no"])) || (empty($_REQUEST["invoice_no"]))) {
    $id_error = true;
}
if ($id_error == false) {
    if ($_REQUEST["type"] == "Frieght") {
        $Query = "SELECT id,client_name,division_name,branch_name,total_pending_amount,total_amount_received,total from sr_frieght_bill where bill_no='" . $_REQUEST["invoice_no"] . "'";
    } else if ($_REQUEST["type"] == "Service") {
        $Query = "SELECT id,project_name,balance_amount,grand_total,bill_amount,amount_received,pending_amount from sr_service_invoice  where si_number='" . $_REQUEST["invoice_no"] . "'";
        $print_page = 'service_invoice_print.php';
    } else if ($_REQUEST["type"] == "AMC") {
        $Query = "SELECT id,project_name,grand_total,amount_received,pending_amount from sr_amc where amc_no='" . $_REQUEST["invoice_no"] . "'";
        $print_page = 'amc_print.php';
    }
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $grand_total = $UDB->Record["total"];
        /* $bill_amount = $UDB->Record["bill_amount"];
          $balance_amount = $UDB->Record["balance_amount"]; */
        $amount_received = $UDB->Record["total_amount_received"];
        $pending_amount = $UDB->Record["total_pending_amount"];
    }
}
/* $Query = "SELECT id,advance_amount from sr_client where client_name='" . $client_name . "' and division_name='" . $division_name . "' and branch_name='" . $branch_name . "' ";
  $DB->query($Query);
  while ($DB->Multicoloums()) {
  $advance_amount = $DB->Record["advance_amount"];
  }
  $Query = "SELECT id,count(invoice_no) as invoice_count from $tablename where invoice_no='" . $_REQUEST["invoice_no"] . "'";
  $UDB->query($Query);
  while ($UDB->Multicoloums()) {
  $invoice_count = $UDB->Record["invoice_count"];
  }
  if ($invoice_count == 0) {
  $amount_received = $advance_amount + $amount_received;
  $pending_amount = $pending_amount - $amount_received;
  } */
?>
<script type="text/javascript">
    function calculate_pending()
    {
        var pending_amount = document.getElementById('pending_amount').value;
        var amount_paid = document.getElementById('amount_paid').value;
        if (Number(amount_paid) > Number(pending_amount))
        {
            alert("Paid Amount Greater than Pending Amount");
            document.form.amount_paid.value = "0.00";
        }
    }

</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Outstanding - Bill
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="frieght_bill_approval_grid.php">Outstanding</a></li>
            <li class="active">Bill Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            Invoice Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="invoice_type" readonly="" class="form-control" value="<?php echo $_REQUEST["type"] ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Invoice Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="invoice_no" readonly="" class="form-control" value="<?php echo $_REQUEST["invoice_no"] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Grand Total
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" name="grand_total" readonly="" class="form-control" value="<?php echo $grand_total; ?>">
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Amount Received
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" name="amount_received" readonly="" class="form-control" value="<?php echo $amount_received; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Pending Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <?php
                                                $Query = "SELECT id,count(invoice_no) as invoice_count from $tablename where invoice_no='" . $_REQUEST["invoice_no"] . "'";
                                                $UDB->query($Query);
                                                while ($UDB->Multicoloums()) {
                                                    $invoice_count = $UDB->Record["invoice_count"];
                                                }
                                                ?>
                                                <input type="text" id="pending_amount" name="pending_amount" readonly="" class="form-control" value="<?php
                                                if ($invoice_count == 0) {
                                                    echo $pending_amount = $pending_amount;
                                                } else {
                                                    echo $pending_amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Client name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_name" readonly class="form-control" value="<?php echo $client_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Division Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="division_name" readonly class="form-control" value="<?php echo $division_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="branch_name" readonly class="form-control" value="<?php echo $branch_name; ?>">
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
                                            Payment Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="payment_date" class="form-control pull-right" id="payment_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $po_date;
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
                                            Amount Paid
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" id="amount_paid" name="amount_paid" autofocus onblur="calculate_pending()" class="form-control" value="0.00" onclick='javascript: this.value = ""'>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Payment Mode
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="payment_mode">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select payment_mode from master_payment_mode order by payment_mode";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $payment_mode == $DB->Record["payment_mode"]) {
                                                        echo'<option selected>' . $DB->Record["payment_mode"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["payment_mode"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Payment Description
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="payment_description" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Received From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="received_from" class="form-control">
                                        </td>
                                        <td  class="form_label_split2">
                                            Received By
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="received_by" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" onsubmit="this.style.display = 'none';
                                    clear_but.style.display = 'none';
                                    submit_loader.style.display = 'block';
                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                            <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
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

                    </div><!-- /.box-body -->
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>