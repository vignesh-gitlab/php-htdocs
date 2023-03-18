<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'cash_receipt_action.php';
$tablename = 'sr_cash_receipt';
$tablename1 = 'sr_cash_receipt_item';

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
<script type="text/javascript">
    function calculate_amount(line_id)
    {
        var sub_total = 0;
        sub_total = Number(document.getElementById('rate' + line_id).value);
        var sub_total_charges = Number(sub_total).toFixed(2);
        document.getElementById('sub_total' + line_id).value = sub_total_charges;
        var total = 0;
        for (i = 1; i <= 5; i++)
        {
            total = Number(total) + Number(document.getElementById('sub_total' + i).value);
        }
        var total_charges = Number(total).toFixed(2);
        document.getElementById('total').value = total_charges;
    }
    function calculate_total_wages_rs()
    {
        var wages_rs = 0;
        for (i = 1; i <= 25; i++)
        {
            wages_rs = Number(wages_rs) + (Number(document.getElementById('wages_rs' + i).value));

        }
        document.getElementById('total_wages_rs').value = wages_rs.toFixed(2);
        calculate_total();
    }
    function calculate_total_wages_ps()
    {
        var wages_ps = 0;
        for (i = 1; i <= 25; i++)
        {
            wages_ps = Number(wages_ps) + (Number(document.getElementById('wages_ps' + i).value));

        }
        document.getElementById('total_wages_ps').value = wages_ps.toFixed(2);
        calculate_total();
    }
    function calculate_total_lavy_rs()
    {
        var lavy_rs = 0;
        for (i = 1; i <= 25; i++)
        {
            lavy_rs = Number(lavy_rs) + (Number(document.getElementById('lavy_rs' + i).value));

        }
        document.getElementById('total_lavy_rs').value = lavy_rs.toFixed(2);
        calculate_total_lavy();
        calculate_total_rs();
    }
    function calculate_total_lavy_ps()
    {
        var lavy_ps = 0;
        for (i = 1; i <= 25; i++)
        {
            lavy_ps = Number(lavy_ps) + (Number(document.getElementById('lavy_ps' + i).value));

        }
        document.getElementById('total_lavy_ps').value = lavy_ps.toFixed(2);
        calculate_total_lavy();
        calculate_total_ps();
    }
    function calculate_total_rs(line_id)
    {
        for (i = 1; i <= 25; i++)
        {
            var wages_rs = document.getElementById('wages_rs' + i).value;
            var lavy_rs = document.getElementById('lavy_rs' + i).value;
            var total = (Number(wages_rs) + Number(lavy_rs));
            if (total > 0)
            {
                document.getElementById('line_total_rs' + i).value = total.toFixed(2);
            }
        }
        calculate_line_total_rs();
    }
    function calculate_total_ps(line_id)
    {
        for (i = 1; i <= 25; i++)
        {
            var wages_ps = document.getElementById('wages_ps' + i).value;
            var lavy_ps = document.getElementById('lavy_ps' + i).value;
            var total1 = (Number(wages_ps) + Number(lavy_ps));
            if (total1 > 0)
            {
                document.getElementById('line_total_ps' + i).value = total1.toFixed(2);
            }
        }
        calculate_line_total_ps()
    }
    function calculate_line_total_rs()
    {
        var line_total_rs = 0;
        for (i = 1; i <= 25; i++)
        {
            line_total_rs = Number(line_total_rs) + (Number(document.getElementById('line_total_rs' + i).value));

        }
        document.getElementById('total_rs').value = line_total_rs.toFixed(2);
    }
    function calculate_line_total_ps()
    {
        var line_total_ps = 0;
        for (i = 1; i <= 25; i++)
        {
            line_total_ps = Number(line_total_ps) + (Number(document.getElementById('line_total_ps' + i).value));

        }
        document.getElementById('total_ps').value = line_total_ps.toFixed(2);
    }
    function calculate_total()
    {
        var wages_rs = document.getElementById('total_wages_rs').value;

        var wages_ps = document.getElementById('total_wages_ps').value;
        var total_wages = Number(wages_rs) + Number(wages_ps);
        document.getElementById('total_wages').value = total_wages.toFixed(2);
    }
    function calculate_total_lavy()
    {
        var total_lavy_rs = document.getElementById('total_lavy_rs').value;

        var total_lavy_ps = document.getElementById('total_lavy_ps').value;
        var total_lavy = Number(total_lavy_rs) + Number(total_lavy_ps);
        document.getElementById('total_levy').value = total_lavy.toFixed(2);
    }
    function calculate_total_total()
    {
        var total_wages = document.getElementById('total_wages').value;
        var total_levy = document.getElementById('total_levy').value;
        var total_others = document.getElementById('total_others').value;
        var total = Number(total_wages) + Number(total_levy) + Number(total_others);
        document.getElementById('total').value = total.toFixed(2);
    }

</script>
<?php
if ($id_error == false) {
    $Query = "SELECT id,order_no,company_name,regd_no,telephone,tali_no,table_no,period_from,period_to,total_wages_rs,total_wages_ps,total_lavy_rs,total_lavy_ps,total_rs,total_ps,total_wages,total_levy,total_others,total,cheque_no,cheque_date,bank_name,payment_mode,so_no,vehicle_no,vehicle_date,frieght_advance,cr_status from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $company_name = $UDB->Record["company_name"];
        $regd_no = $UDB->Record["regd_no"];
        $telephone = $UDB->Record["telephone"];
        $tali_no = $UDB->Record["tali_no"];
        $table_no = $UDB->Record["table_no"];
        $period_from = $UDB->Record["period_from"];
        $period_to = $UDB->Record["period_to"];
        $total_wages_rs = $UDB->Record["total_wages_rs"];
        $total_wages_ps = $UDB->Record["total_wages_ps"];
        $total_lavy_rs = $UDB->Record["total_lavy_rs"];
        $total_lavy_ps = $UDB->Record["total_lavy_ps"];
        $total_rs = $UDB->Record["total_rs"];
        $total_ps = $UDB->Record["total_ps"];
        $total_wages = $UDB->Record["total_wages"];
        $total_levy = $UDB->Record["total_levy"];
        $total_others = $UDB->Record["total_others"];
        $total = $UDB->Record["total"];
        $cheque_no = $UDB->Record["cheque_no"];
        $cheque_date = $UDB->Record["cheque_date"];
        $bank_name = $UDB->Record["bank_name"];
        $payment_mode = $UDB->Record["payment_mode"];
        $so_no = $UDB->Record["so_no"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $vehicle_date = $UDB->Record["vehicle_date"];
        $frieght_advance = $UDB->Record["frieght_advance"];
        $cr_status = $UDB->Record["cr_status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,receipt_date,wages_rs,wages_ps,lavy_rs,lavy_ps,line_total_rs,line_total_ps from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $receipt_date_array[] = $UDB->Record["receipt_date"];
        $wages_rs_array[] = $UDB->Record["wages_rs"];
        $wages_ps_array[] = $UDB->Record["wages_ps"];
        $lavy_rs_array[] = $UDB->Record["lavy_rs"];
        $lavy_ps_array[] = $UDB->Record["lavy_ps"];
        $line_total_rs_array[] = $UDB->Record["line_total_rs"];
        $line_total_ps_array[] = $UDB->Record["line_total_ps"];
    }
}
$Query = "SELECT so_no from sr_customer_order where order_no='" . $order_no . "'";
$UDB->query($Query);
while ($UDB->Multicoloums()) {
    //  $so_no = $UDB->Record["so_no"];
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cash Receipt
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="cash_receipt_grid.php">Cash Receipt</a></li>
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
                                            Order No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="order_no">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select order_no from sr_customer_order order by order_no";
                                                $UDB->query($Query);

                                                while ($UDB->Multicoloums()) {
                                                    if ($id_error == false && $order_no == $UDB->Record["order_no"]) {
                                                        echo'<option selected>' . $UDB->Record["order_no"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $UDB->Record["order_no"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="company_name" class="form-control" value="<?php if ($id_error == false) echo $company_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Regd. No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="regd_no" autofocus class="form-control" value="<?php if ($id_error == false) echo $regd_no; ?>">
                                        </td>
                                      <!--  <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="client_name" id="client_name">
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
                                        </td>-->
                                        <td  class="form_label_split2">
                                            Telephone
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="telephone" autofocus class="form-control" value="<?php if ($id_error == false) echo $telephone; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Tali No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="tali_no" class="form-control" value="<?php if ($id_error == false) echo $tali_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Table No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="table_no" class="form-control" value="<?php if ($id_error == false) echo $table_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Period
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" style="width:100%; float:left;" name="period_from" class="form-control pull-right" id="period_from" onfocus="pick_date(this.id);" placeholder="Start Date" value="<?php if ($id_error == false) echo $period_from; ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" readonly="true" style="width:100%; float:left;" name="period_to" class="form-control pull-right" id="period_to" onfocus="pick_date(this.id);" placeholder="End Date" value="<?php if ($id_error == false) echo $period_to; ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:10%;" rowspan="3">
                                            Date
                                        </td>
                                        <td  class="form_label_multiple" colspan="4">
                                            Amount Payable By the Employer
                                        </td>
                                        <td  class="form_label_multiple" colspan="2" rowspan="2">
                                            Total
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple" colspan="2">
                                            Wages
                                        </td>
                                        <td  class="form_label_multiple" colspan="2">
                                            Lavy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Rs.
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            P.
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Rs.
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            P.
                                        </td>
                                        <td  class="form_label_multiple" style="width:20%;">
                                            Rs.
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            P.
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="receipt_date<?php echo $i; ?>" class="form-control pull-right" id="receipt_date<?php echo $i; ?>" onfocus="pick_date(this.id);" value="<?php
                                                    if ($id_error == false) {
                                                        echo $receipt_date_array[$i - 1];
                                                    } else {
                                                        echo date('d-m-Y');
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="wages_rs<?php echo $i; ?>" onblur="calculate_total_wages_rs(this.value,<?php echo $i; ?>)" style="text-align:right;" name="wages_rs<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $wages_rs_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="wages_ps<?php echo $i; ?>" style="text-align:right;" onblur="calculate_total_wages_ps(this.value,<?php echo $i; ?>)" name="wages_ps<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $wages_ps_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="lavy_rs<?php echo $i; ?>" id="lavy_rs<?php echo $i; ?>" onblur="calculate_total_lavy_rs(this.value,<?php echo $i; ?>)" style="text-align:right;" class="form-control" value="<?php if ($id_error == false) echo $lavy_rs_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="lavy_ps<?php echo $i; ?>" onblur="calculate_total_lavy_ps(this.value,<?php echo $i; ?>)"  name="lavy_ps<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $lavy_ps_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="line_total_rs<?php echo $i; ?>" onblur="calculate_line_total_rs(this.value,<?php echo $i; ?>)" name="line_total_rs<?php echo $i; ?>" onblur="calculate_amount(<?php echo $i; ?>)" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $line_total_rs_array[$i - 1];
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;"  id="line_total_ps<?php echo $i; ?>" onblur="calculate_line_total_ps(this.value,<?php echo $i; ?>)"  name="line_total_ps<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false)
                                                    echo $line_total_ps_array[$i - 1];
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="form_label_multiple_right">Total</td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_wages_rs" readonly name="total_wages_rs" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_wages_rs;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_wages_ps" readonly name="total_wages_ps" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_wages_ps;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_lavy_rs" readonly name="total_lavy_rs" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_lavy_rs;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_lavy_ps" readonly name="total_lavy_ps" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_lavy_ps;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_rs" readonly name="total_rs" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_rs;
                                            ?>">
                                        </td>
                                        <td class="form_content_multiple">
                                            <input type="text" style="text-align:right;" id="total_ps" readonly name="total_ps" class="form-control" value="<?php
                                            if ($id_error == false)
                                                echo $total_ps;
                                            ?>">
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
                                            Total Wages
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" id="total_wages" name="total_wages" class="form-control" value="<?php if ($id_error == false) echo $total_wages; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Total Levy
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" id="total_levy" name="total_levy" class="form-control" value="<?php if ($id_error == false) echo $total_levy; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Others
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" id="total_others" name="total_others" onblur="calculate_total_total(this.value)" class="form-control" value="<?php if ($id_error == false) echo $total_others; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Total
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" name="total" id="total" class="form-control" value="<?php if ($id_error == false) echo $total; ?>">
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
                                            Cheque No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="cheque_no" class="form-control" value="<?php if ($id_error == false) echo $cheque_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Cheque Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="cheque_date" class="form-control pull-right" id="cheque_date" style="width:100%;" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $cheque_date;
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
                                            Bank
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <select class="form-control dropdown_padding" name="bank_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(bank_name) from master_bank_name order by bank_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $bank_name == $DB->Record["bank_name"]) {
                                                        echo'<option selected>' . $DB->Record["bank_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["bank_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Payment Mode
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <select class="form-control dropdown_padding" name="payment_mode">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(payment_mode) from master_payment_mode order by payment_mode";
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
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            SO Ref. No.
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" name="so_no" class="form-control" value="<?php if ($id_error == false || $order_error == false) echo $so_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_no" class="form-control" value="<?php if ($id_error == false || $order_error == false) echo $vehicle_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="vehicle_date" class="form-control pull-right" id="vehicle_date" style="width:100%;" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $vehicle_date;
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
                                            Frieght Advance
                                        </td>
                                        <td class="form_content_split2" align="center" colspan="3">
                                            <input type="text" name="frieght_advance" class="form-control" value="<?php if ($id_error == false || $order_error == false) echo $frieght_advance; ?>">
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