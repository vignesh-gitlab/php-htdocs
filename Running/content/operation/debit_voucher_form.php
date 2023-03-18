<?php
include'../../template/operation/header.default.php';

$actionpage = 'money_receipt_action.php';
$tablename = 'sr_money_receipt';
$tablename1 = 'sr_money_receipt_item';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $order_error = true;
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>
<?php
if ($id_error == false) {
    $Query = "SELECT id,order_no,so_no,client_name,branch,bmr_no,bmr_date,ac_code,cheque_no,bank_name,mr_date,bill_frt_total,bill_oct_total,received_frt_total,received_oct_total,rem_total,tds_amount,claim_amount,excess_billing,others,non_account,mr_status from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $branch = $UDB->Record["branch"];
        $bmr_no = $UDB->Record["bmr_no"];
        $bmr_date = $UDB->Record["bmr_date"];
        $ac_code = $UDB->Record["ac_code"];
        $cheque_no = $UDB->Record["cheque_no"];
        $bank_name = $UDB->Record["bank_name"];
        $mr_date = $UDB->Record["mr_date"];
        $bill_frt_total = $UDB->Record["bill_frt_total"];
        $bill_oct_total = $UDB->Record["bill_oct_total"];
        $bill_date = $UDB->Record["bill_date"];
        $received_frt_total = $UDB->Record["received_frt_total"];
        $received_oct_total = $UDB->Record["received_oct_total"];
        $rem_total = $UDB->Record["rem_total"];
        $tds_amount = $UDB->Record["tds_amount"];
        $claim_amount = $UDB->Record["claim_amount"];
        $excess_billing = $UDB->Record["excess_billing"];
        $others = $UDB->Record["others"];
        $non_account = $UDB->Record["non_account"];
        $mr_status = $UDB->Record["mr_status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,bill_no,bill_date,bill_frt,bill_oct,received_frt,received_oct,rem from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $bill_no_array[] = $UDB->Record["bill_no"];
        $bill_date_array[] = $UDB->Record["bill_date"];
        $bill_frt_array[] = $UDB->Record["bill_frt"];
        $bill_oct_array[] = $UDB->Record["bill_oct"];
        $received_frt_array[] = $UDB->Record["received_frt"];
        $received_oct_array[] = $UDB->Record["received_oct"];
        $rem_array[] = $UDB->Record["rem"];
    }
}
?>
<script type="text/javascript">
    function total_charges()
    {
        var total = 0;
        var amount1 = document.getElementById('amount1').value;
        var amount2 = document.getElementById('amount2').value;
        var amount3 = document.getElementById('amount3').value;
        var amount4 = document.getElementById('amount4').value;
        var amount5 = document.getElementById('amount5').value;
        total = Number(amount1) + Number(amount2) + Number(amount3) + Number(amount4) + Number(amount5);
        var total_charges = total.toFixed(2);
        document.getElementById('total_amount').value = total_charges;
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Debit Voucher
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="debit_voucher_grid.php">Debit Voucher</a></li>
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
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="order_no">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select branch_code from sr_company order by branch_code";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $order_no == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Voucher No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Paid To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="bmr_date" class="form-control pull-right" id="bmr_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $bmr_date;
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
                                    <tr>
                                        <td  class="form_label_split2">
                                            Debit Ac
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Passed By
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Prepared By
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Approved By
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" name="bmr_no" class="form-control" value="<?php if ($id_error == false) echo $bmr_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:80%;">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Amount
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <input type="text" name="description1" id="thousand" class="form-control">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="amount<?php echo $i; ?>" id="amount<?php echo $i; ?>" class="form-control" onblur="total_charges()" style="text-align:right;">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="form_content_multiple">
                                            <input type="text" name="description1" id="thousand" class="form-control" onblur="total_charges()" placeholder="Pay Order No">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" name="total_amount" id="total_amount" class="form-control" onblur="total_charges()" style="text-align:right;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <?php
                        if ($order_error != false) {
                            ?>
                            <button type="submit" onsubmit="this.style.display = 'none';
                                    clear_but.style.display = 'none';
                                    submit_loader.style.display = 'block';
                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($order_error == false) {
                                    ?>
                            <button type="submit" onsubmit="this.style.display = 'none';
                                    clear_but.style.display = 'none';
                                    submit_loader.style.display = 'block';
                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Approve</button>
                                    <?php
                                }
                                ?>
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
                        <?php
                        if ($id_error == false && $order_error != false) {
                            echo'<input type="hidden" name="form_action" value="Update"/>';
                            echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                        } else if ($order_error == false) {
                            echo'<input type="hidden" name="approval" value="Approve"/>';
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