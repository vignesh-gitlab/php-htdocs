<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'money_receipt_action.php';
$tablename = 'sr_money_receipt';
$tablename1 = 'sr_money_receipt_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,order_no,so_no,mr_type,client_name,branch,bmr_no,bmr_date,ac_code,cheque_no,bank_name,mr_date,bill_frt_total,bill_oct_total,received_frt_total,received_oct_total,rem_total,tds_amount,claim_amount,excess_billing,hamali,advance,against_referrence,others,non_account,mr_status from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $mr_type = $UDB->Record["mr_type"];
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
        $hamali = $UDB->Record["hamali"];
        $advance = $UDB->Record["advance"];
        $against_referrence = $UDB->Record["against_referrence"];
        $others = $UDB->Record["others"];
        $non_account = $UDB->Record["non_account"];
        $mr_status = $UDB->Record["mr_status"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,bill_no,bill_date,bill_frt,bill_oct,received_frt,received_oct,rem from $tablename1 where order_no='" . $bmr_no . "'";
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
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bill Money Receipt
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="money_receipt_grid.php">Bill Money Receipt</a></li>
            <li class="active">Print</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content invoice">
        <div class="row no-print">
            <div class="col-xs-12" style="margin-bottom:20px;">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <table cellspacing="0" style=" width:900px; margin:auto;" rules="all" class="table_print_letterhead">
                        <thead>

                        <td colspan="3" style="height:22px; vertical-align:middle;border-bottom:1px solid #FFF;">
                            <div class="print_label_large align_center">
                                BILL MONEY RECEIPT
                            </div>
                        </td>
                        </thead>
                        <tr>
                            <td rowspan="6" align="left" style="width:50%; padding-left: 20px;border-right:1px solid #FFF;">
                                <?php
                                $Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,tin_no,cst_no from sr_company where branch_code='WA-BR-100'";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    echo '<img src="../../theme/img/logo_left.png"/>';
                                    echo "<br><span class=\"print_caption\">" . $DB->Record["company_caption"] . "</span><br>";
                                    echo"<span class=\"print_content_small\">";
                                    echo $DB->Record["address_line1"] . ' ,' . $DB->Record["address_line2"] . ',' . $DB->Record["city"] . ', ' . $DB->Record["pincode"] . ".<br>";

                                    echo "Tel No : " . $DB->Record["telephone_no"] . ', Mobile No :' . $DB->Record["mobile_no"] . "<br>";
                                    echo "Email : " . $DB->Record["email_id"] . "<br>";
                                }
                                ?>
                            </td>

                            <td rowspan="6" align="right" style="width:50%; padding-bottom: 80px; padding-right: 10px;border-right:1px solid #FFF;">
                                <?php
                                $Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,tin_no,cst_no from sr_company where branch_code='WA-BR-100'";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    echo '<img src="../../theme/img/logo_right_print.png"/>';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>

                    <table cellspacing="0" style=" margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;">
                                Branch
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;">
                                :<?php echo $branch; ?>
                            </td>
                            <td class="print_label" style=" border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;">
                                B.M.R. No.
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                :<?php echo $bmr_no; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" colspan="2" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;">
                                Received With Thanks From
                            </td>

                            <td class="print_label" style=" border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;">
                                B.M.R. Date
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                :<?php echo $bmr_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content" colspan="3" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;padding-left: 5em;">
                                <?php echo $client_name; ?>
                            </td>


                            <td class="print_content" style="border-bottom:1px solid #FFF;">

                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" colspan="2" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;">

                            </td>

                            <td class="print_label" style=" border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;">
                                A/C Code
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                :<?php echo $ac_code; ?>
                            </td>
                        </tr>
                    </table>
                    <div style="margin-top:1em;">
                        <div>
                            <table cellspacing="0" style=" margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;">
                                        Cheque No.
                                    </td>
                                    <td class="print_content" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;">
                                        :<?php echo $cheque_no; ?>
                                    </td>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-top:1px solid #FFF;">
                                        Bank
                                    </td>
                                    <td class="print_content" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;">
                                        :<?php echo $bank_name; ?>
                                    </td>
                                    <td class="print_label" style=" border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;">
                                        Date
                                    </td>
                                    <td class="print_content" style="border-bottom:1px solid #FFF;">
                                        :<?php echo $mr_date; ?>
                                    </td>
                                </tr>
                            </table>
                            <div style="margin-top:1em;">
                                <div>
                                    <table cellspacing="0" style="border:1px solid #000000; padding-top: 10em; margin-top:120px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                                        <tr>
                                            <td  class="print_label align_center"  style="border-bottom:1px solid #FFF;">

                                            </td>
                                            <td   class="print_label align_center"  style="border-bottom:1px solid #FFF;">

                                            </td>
                                            <td colspan="2"  class="print_label align_center" >
                                                Bill Amount
                                            </td>
                                            <td colspan="2"  class="print_label align_center" >
                                                Received Amount
                                            </td>

                                            <td   class="print_label align_center"  style="border-bottom:1px solid #FFF;">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="print_label align_center" style="width:15%;">
                                                Bill No.
                                            </td>
                                            <td   class="print_label align_center" style="width:10%;">
                                                Date
                                            </td>
                                            <td   class="print_label align_center" style="width:10%;">
                                                FRT
                                            </td>
                                            <td class="print_label align_center" style="width:8%;">
                                                OCT/Others
                                            </td>
                                            <td  class="print_label align_center" style="width:10%;">
                                                FRT
                                            </td>
                                            <td   class="print_label align_center" style="width:8%;">
                                                OCT/Sch
                                            </td>
                                            <td   class="print_label align_center" style="width:9%;">
                                                Rem
                                            </td>
                                        </tr>
                                        <?php
                                        $loop_end_value = 0;
                                        $serial_no = 1;
                                        if ($edit_product_count <= 10) {
                                            $loop_end_value = 9;
                                        } else if ($edit_product_count > 10 && $edit_product_count <= 26) {
                                            $loop_end_value = 25;
                                        }
                                        for ($i = 1; $i <= $loop_end_value; $i++) {
                                            $product_count = $i;

                                            if ($rem_array[$i - 1] >= 0) {
                                                ?>
                                                <tr style="">
                                                    <td align="center" style="border-bottom:1px solid #FFF;height:35px;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $bill_no_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $bill_date_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $bill_frt_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $bill_oct_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $received_frt_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $received_oct_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                                        <?php
                                                        if ($id_error == false) {
                                                            echo $rem_array[$i - 1];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                if ($i == 10) {
                                                    ?>
                                                    <tr style="height:90px;"><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

                                                    <tr><td colspan="8" style="text-align:right; padding-right:10px; border-left:1px solid #FFF; border-right:1px solid #FFF;">Page 1 of 2<div style="height:35px;"></div></td></tr>

                                                    <tr>
                                                        <td  class="print_label align_center" style=line-height:35px;">
                                                            Bill No.
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            Date
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            FRT
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            OCT/Others
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            FRT
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            OCT/Sch
                                                        </td>
                                                        <td  class="print_label align_center">
                                                            Rem
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td style="height:35px; border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                    <td style="border-bottom:1px solid #FFF;"></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="print_label" style="text-align: right;">Total</td>
                                            <td class="print_label" style="text-align: right;"><?php echo $bill_frt_total; ?></td>
                                            <td class="print_label" style="text-align: right;"><?php echo $bill_oct_total; ?></td>
                                            <td class="print_label" style="text-align: right;"><?php echo $received_frt_total; ?></td>
                                            <td class="print_label"style="text-align: right;"><?php echo $received_oct_total; ?></td>
                                            <td class="print_label"style="text-align: right;"><?php echo $rem_total; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">Check Subject to Realisation</td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">TDS Amt:</td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;"><?php echo $tds_amount; ?></td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">Claim Amt:</td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;"><?php echo $claim_amount; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">Rs.      <?php echo $claim_amount; ?></td>
                                            <td colspan="4" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;text-align: right;">FOR WESTERNARYA TRANSPORTS</td>

                                        </tr>
                                        <tr>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">On Adj:</td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;text-align: right;"><?php echo ""; ?></td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">On A/C :</td>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;text-align: right;"><?php echo ""; ?><?php echo ""; ?></td>
                                            <td colspan="3" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;"><?php echo ""; ?><?php echo ""; ?></td>

                                        </tr>
                                        <tr>
                                            <td class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">Rupees :</td>
                                            <td colspan="6" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;">  Rupees <?php echo number_to_words($claim_amount); ?> Only.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;height:70px;">Computer Incharge</td>
                                            <td colspan="2" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;height:30px;">Bill Incharge</td>
                                            <td colspan="3" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;height:30px;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="print_label" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;text-align: center">SERIAL NO :<?php echo ""; ?></td>
                                    </table>


                                    <div style="width:900px; margin:auto;">
                                        <div class="row no-print" style="margin-bottom:-350px;">
                                            <div class="col-xs-12" style="margin-bottom:20px;">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                </form>
                            </div>
                        </div>
                        </section><!-- /.content -->
                        </aside><!-- /.right-side -->

                        <?php include'../../template/common/footer.default.php'; ?>