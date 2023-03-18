<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$actionpage = 'bill_despatch_advice_action.php';
$tablename = 'sr_bill_despatch_advice';
$tablename1 = 'sr_bill_despatch_advice_item';
$selfpage = 'bill_despatch_advice_report.php';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
if ($id_error == false) {
    $Query = "SELECT id,da_id,da_no,da_date,client_name,branch_code,branch_name,bank_name,ac_no,total from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $da_id = $UDB->Record["da_id"];
        $da_no = $UDB->Record["da_no"];
        $da_date = $UDB->Record["da_date"];
        $client_name = $UDB->Record["client_name"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_name = $UDB->Record["branch_name"];
        $bank_name = $UDB->Record["bank_name"];
        $ac_no = $UDB->Record["ac_no"];
        $total = $UDB->Record["total"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,da_no,client_name,bill_no,bill_date,bill_amount,sub_date from $tablename1 where da_no='" . $da_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $da_no_array[] = $UDB->Record["da_no"];
        $client_name_array[] = $UDB->Record["client_name"];
        $bill_no_array[] = $UDB->Record["bill_no"];
        $bill_date_array[] = $UDB->Record["bill_date"];
        $bill_amount_array[] = $UDB->Record["bill_amount"];
        $sub_date_array[] = $UDB->Record["sub_date"];
    }
}
/* $client_error = true;
  if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"]) && $_REQUEST["client_name"] != "Select") {
  $client_name = $_REQUEST["client_name"];
  $branch_code = $_REQUEST["branch_code"];
  $branch_name = $_REQUEST["branch_name"];
  $bank_name = $_REQUEST["hd_bank_name"];
  $ac_no = $_REQUEST["hd_ac_no"];
  $da_no = $_REQUEST["da_no"];
  $da_date = $_REQUEST["da_date"];
  $client_error = false;
  } else {
  $client_name = "";
  }
  $bank_error = true;
  if (isset($_REQUEST["hd_bank_name"]) && !empty($_REQUEST["hd_bank_name"]) && $_REQUEST["hd_bank_name"] != "Select") {
  $bank_name = $_REQUEST["hd_bank_name"];
  $bank_error = false;
  } */
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Bills / Documents Despatch Advice</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Bills / Documents Despatch Advice</li>
            <li class="active">Print</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row no-print">
            <div class="col-xs-12" style="margin-bottom:20px;">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="4" class="align_center">BILLS / DOCUMENTS DESPATCH ADVICE</th>
                                    </tr>
                                    <tr class="align_center">
                                        <?php
                                        $Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,fax_no,website_id,tin_no,cst_no from sr_company where branch_code='WA-BR-100'";
                                        $DB->query($Query);

                                        while ($DB->Multicoloums()) {
                                            $company_name = $DB->Record["company_name"];
                                            $company_caption = $DB->Record["company_caption"];
                                            $address_line1 = $DB->Record["address_line1"];
                                            $address_line2 = $DB->Record["address_line2"];
                                            $city = $DB->Record["city"];
                                            $pincode = $DB->Record["pincode"];
                                            $telephone_no = $DB->Record["telephone_no"];
                                            $mobile_no = $DB->Record["mobile_no"];
                                        }
                                        ?>
                                        <td colspan="4" class="align_center" style="padding-top: 10px;"><?php echo strtoupper('<b>' . $company_name . ' ' . $company_caption . '</b><br>' . $address_line1 . ',' . $address_line2 . ',' . $city . '-' . $pincode . '<br>' . "Phone :" . $telephone_no . ',' . $mobile_no); ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">
                                            S.NO :
                                        </td>
                                        <td style="text-align: left;">
                                            <?php echo $da_no; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            Date
                                        </td>
                                        <td style="width:20%;text-align: left;">
                                            <?php echo date('d-m-Y'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">
                                            M/S :
                                        </td>
                                        <td colspan="3" style="text-align: left;">
                                            <?php echo $client_name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-left: 50px;text-align: left;">
                                            Dear Sirs,
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-left: 50px;text-align: left;">
                                            <p>Please find attached below invoices raised by Western Arya Pvt. Ltd. towards transportation of our materials.<br>
                                                Please make payment for the said invoices to <?php echo ' - ' . $branch_name . ' , ' . $bank_name . ',' . ' A/C No. ' . $ac_no . '.'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style = "padding-left: 50px;width:20%">Bill No.</th>
                                        <th style = "width:20%">Bill Date</th>
                                        <th colspan="2" style = "width:40%">Bill Amount</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($id_error == false) {
                                        $total_bill_amount = 0;
                                        $Query = "SELECT sub_date from sr_bill_despatch_advice_item where da_no='" . $da_no . "'";

                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            $sub_date_array[] = $UDB->Record["sub_date"];
                                            //$bill_count = $UDB->Record["bill_count"];
                                        }
                                        ?>
                                        <?php
                                        if ($sub_date_array[$i - 1] == NULL) {
                                            $Query = "SELECT bill_no,bill_date,bill_amount,sub_date from sr_bill_despatch_advice_item where client_name='" . $da_no . "'";

                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {

                                                $bill_no_array[] = $UDB->Record["bill_no"];
                                                $bill_date_array[] = $UDB->Record["bill_date"];
                                                $bill_amount_array[] = $UDB->Record["bill_date"];
                                                $sub_date_array[] = $UDB->Record["sub_date"];
                                                //$bill_count = $UDB->Record["bill_count"];
                                            }
                                            $Query1 = "SELECT count(bill_no) as bill_count from sr_bill_despatch_advice_item where da_no='" . $da_no . "'";
                                            $UDB1->query($Query1);
                                            while ($UDB1->Multicoloums()) {
                                                $bill_count = $UDB1->Record["bill_count"];
                                            }
                                            ?>
                                            <?php
                                            for ($i = 1; $i <= $bill_count; $i++) {
                                                $product_count = $i;
                                                /*  $Query1 = "SELECT sub_date from sr_bill_despatch_advice_item where bill_no='" . $bill_no_array[$i - 1] . "' and client_name='" . $client_name . "'";
                                                  $UDB1->query($Query1);
                                                  while ($UDB1->Multicoloums()) {
                                                  $sub_date = $UDB1->Record["sub_date"];
                                                  } */
                                                ?>

                                                <tr>
                                                    <td>
                                                        <input type="text" name="bill_no<?php echo $i; ?>" id="bill_no<?php echo $i; ?>" readonly class="form-control" value="<?php echo $bill_no_array[$i - 1]; ?>"></td>
                                                    <td>  <input type="text" name="bill_date<?php echo $i; ?>" id="bill_date<?php echo $i; ?>" readonly class="form-control" value="<?php echo $bill_date_array[$i - 1]; ?>"></td>
                                                    <td colspan="2">
                                                        <input type="text" name="total<?php echo $i; ?>" id="total<?php echo $i; ?>" readonly class="form-control" value="<?php echo $bill_amount_array[$i - 1]; ?>"></td>
                                            <input type="hidden" name="da_no" id="da_no" readonly class="form-control" value="<?php echo $da_no; ?>">
                                            <input type="hidden" name="da_date" id="da_date" readonly class="form-control" value="<?php echo $da_date; ?>">
                                            <input type="hidden" name="client_name" id="client_name" readonly class="form-control" value="<?php echo $client_name; ?>">
                                            <input type="hidden" name="branch_code" id="branch_code" readonly class="form-control" value="<?php echo $branch_code; ?>">
                                            <input type="hidden" name="branch_name" id="branch_name" readonly class="form-control" value="<?php echo $branch_name; ?>">
                                            <input type="hidden" name="bank_name" id="bank_name" readonly class="form-control" value="<?php echo $bank_name; ?>">
                                            <input type="hidden" name="ac_no" id="ac_no" readonly class="form-control" value="<?php echo $ac_no; ?>">
                                            </tr>

                                            <?php
                                            $total_bill_amount = $total_bill_amount + $total_array[$i - 1];
                                            ?>
                                            <?php
                                        }
                                    } else if ($bill_no_array[$i - 1] != NULL) {
                                        $Query = "SELECT bill_no,bill_date,total,sub_date from sr_frieght_bill where client_name='" . $client_name . "' and sub_date!=''";

                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {

                                            $bill_no_array[] = $UDB->Record["bill_no"];
                                            $bill_date_array[] = $UDB->Record["bill_date"];
                                            $total_array[] = $UDB->Record["total"];
                                            $sub_date_array[] = $UDB->Record["sub_date"];
                                            //$bill_count = $UDB->Record["bill_count"];
                                        }
                                        $Query1 = "SELECT count(bill_no) as bill_count from sr_frieght_bill where client_name='" . $client_name . "'  and sub_date!=''";
                                        $UDB1->query($Query1);
                                        while ($UDB1->Multicoloums()) {
                                            $bill_count = $UDB1->Record["bill_count"];
                                        }
                                        ?>
                                        <?php
                                        for ($i = 1; $i <= $bill_count; $i++) {
                                            $product_count = $i;
                                            ?>

                                            <tr>
                                                <td>
                                                    <input type="text" name="bill_no<?php echo $i; ?>" id="bill_no<?php echo $i; ?>" readonly class="form-control" value="<?php echo $bill_no_array[$i - 1]; ?>"></td>
                                                <td>  <input type="text" name="bill_date<?php echo $i; ?>" id="bill_date<?php echo $i; ?>" readonly class="form-control" value="<?php echo $bill_date_array[$i - 1] . 'sdfsd'; ?>"></td>
                                                <td colspan="2">
                                                    <input type="text" name="total<?php echo $i; ?>" id="total<?php echo $i; ?>" readonly class="form-control" value="<?php echo $total_array[$i - 1]; ?>"></td>
                                            <input type="hidden" name="da_no" id="da_no" readonly class="form-control" value="<?php echo $da_no; ?>">
                                            <input type="hidden" name="da_date" id="da_date" readonly class="form-control" value="<?php echo $da_date; ?>">
                                            <input type="hidden" name="client_name" id="client_name" readonly class="form-control" value="<?php echo $client_name; ?>">
                                            <input type="hidden" name="branch_code" id="branch_code" readonly class="form-control" value="<?php echo $branch_code; ?>">
                                            <input type="hidden" name="branch_name" id="branch_name" readonly class="form-control" value="<?php echo $branch_name; ?>">
                                            <input type="hidden" name="bank_name" id="bank_name" readonly class="form-control" value="<?php echo $bank_name; ?>">
                                            <input type="hidden" name="ac_no" id="ac_no" readonly class="form-control" value="<?php echo $ac_no; ?>">
                                            </tr>

                                            <?php
                                            $total_bill_amount = $total_bill_amount + $total_array[$i - 1];
                                            ?>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <tr>

                                    <td colspan="2" style="text-align: right;">
                                        Grand Total
                                    </td>
                                    <td colspan="2" style="text-align: left;">
                                        <?php echo $total; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div style="height:70px;"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="padding-left: 50px;">
                                        # Note :-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 50px;">
                                        1) Please sign the duplicate copy of this and return.
                                    </td>
                                </tr>
                            </table>
                            <div style="height:50px;"></div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="padding-left: 50px;text-align: left;">
                                        Authorised Signatory
                                    </td>
                                    <td style="padding-right: 50px;text-align: right;">
                                        Authorised Signatory
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>

        </form>
        </div>
        </div>
        <div class="row no-print" style="margin-bottom:-350px;padding-top:10px;padding-left: 10px;">
            <div class="col-xs-12" style="margin-bottom:20px;">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>