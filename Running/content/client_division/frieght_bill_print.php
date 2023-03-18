<?php
include'../../template/client_division/header.default.php';


$tablename = 'sr_frieght_bill';
$tablename1 = 'sr_frieght_bill_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>
<?php
if ($id_error == false) {
    $Query = "SELECT id,branch_code,branch,stationary_no,client_name,division_name,branch_name,service_tax_payable_by,party_address_line1,party_address_line2,party_city,party_pincode,bill_no,bill_date,pan_no,total from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $branch_code = $UDB->Record["branch_code"];
        $branch = $UDB->Record["branch"];
        $stationary_no = $UDB->Record["stationary_no"];
        $client_name = $UDB->Record["client_name"];
        $division_name = $UDB->Record["division_name"];
        $branch_name = $UDB->Record["branch_name"];
        $service_tax_payable_by = $UDB->Record["service_tax_payable_by"];
        $party_address_line1 = $UDB->Record["party_address_line1"];
        $party_address_line2 = $UDB->Record["party_address_line2"];
        $party_city = $UDB->Record["party_city"];
        $party_pincode = $UDB->Record["party_pincode"];
        $bill_no = $UDB->Record["bill_no"];
        $bill_date = $UDB->Record["bill_date"];
        $pan_no = $UDB->Record["pan_no"];
        $total = $UDB->Record["total"];
    }
    $edit_product_count = 0;
    $Query = "SELECT id,bill_date_item,no_item,particular,from_to,weight,rate,rate_type,sub_total from $tablename1 where bill_no='" . $bill_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $bill_date_item_array[] = $UDB->Record["bill_date_item"];
        $no_item_array[] = $UDB->Record["no_item"];
        $particular_array[] = $UDB->Record["particular"];
        $from_to_array[] = $UDB->Record["from_to"];
        $weight_array[] = $UDB->Record["weight"];
        $rate_array[] = $UDB->Record["rate"];
        $rate_type_array[] = $UDB->Record["rate_type"];
        $sub_total_array[] = $UDB->Record["sub_total"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Freight Bill
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="frieght_bill_grid.php">Freight Bill</a></li>
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
                    <table cellspacing="0" style="border-right:1px solid #FFF; width:900px; margin:auto;" rules="all" class="table_print_letterhead">
                        <thead>
                            <tr>
                                <td style="width:30%;border-right:1px solid #FFF;">
                                    <?php
                                    echo '<img src="../../theme/img/logo_left.png"/>';
                                    ?>
                                </td>
                                <td style="width:40%; text-align: center;border-right:1px solid #FFF;">
                                    <div class="print_header_full" >
                                        FREIGHT BILL
                                    </div>
                                </td>
                                <td style="width:30%;">
                                    <?php
                                    echo '<img src="../../theme/img/logo_right_print.png"/><br>';
                                    ?>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <table cellspacing="0" style="border-right:1px solid #FFF; width:900px; margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td  align="left" style="width:50%;border-bottom:1px solid #FFF;">
                                <?php
                                $Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,fax_no,website_id,tin_no,cst_no from sr_company where branch_code='WA-BR-100'";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    $company_caption = $DB->Record["company_caption"];
                                    echo "<br><span style=\"font-size:50px;\"><u>" . $DB->Record["company_name"] . "</u></span><br>";
                                    // echo "<br><span class=\"print_caption\">" . $DB->Record["company_caption"] . "</span><br>";

                                    echo $DB->Record["address_line1"] . ' ,' . $DB->Record["address_line2"] . ',' . $DB->Record["city"] . ', ' . $DB->Record["pincode"] . ".<br>";

                                    echo "Tel : " . $DB->Record["telephone_no"] . ', Fax :' . $DB->Record["fax_no"] . "<br>";
                                    echo "Email : " . $DB->Record["email_id"] . ', Website :' . $DB->Record["website_id"] . "<br><br>";
                                }
                                ?>
                            </td>
                            <td style="border-bottom:1px solid #FFF;width:2%;">

                            </td>
                            <td rowspan="3" align="right" style="width:48%;  padding-right: 10px;border-bottom:1px solid #FFF;">
                                <table cellspacing="0" align="right"  style=" border:1px solid #000000; margin-left: 30px; width:320px;  margin:auto;margin-top:15px; padding-left: 30px;height: 40px;" rules="all" class="table_print_letterhead">
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; text-align: center; ">
                                            SERVICE TAX PAYABLE BY :<?php echo $service_tax_payable_by; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="text-align: center">

                                        </td>
                                    </tr>
                                  <!--  <tr>
                                        <td colspan="3" class="print_label" style="border-bottom:1px solid #FFF; text-align: center; ">
                                            SERVICE TAX PAYABLE BY
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content" style="border-right:1px solid #FFF;text-align: left" width="35%">
                                            Consignee<i class="fa fa-fw fa-square-o"></i>
                                        </td>

                                        <td class="print_content" style="border-right:1px solid #FFF;text-align: left" width="35%">
                                            Consignor<i class="fa fa-fw fa-square-o"></i>
                                        </td>
                                        <td class="print_content_small" style="text-align: left" width="30%">
                                            Transporter<i class="fa fa-fw fa-square-o"></i>
                                        </td>
                                    </tr>-->
                                </table>
                                <table cellspacing="0" align="right"  style=" border:1px solid #000000; margin-left: 30px; width:400px;  margin:auto; padding-top: 10px; margin-top: 10px; padding-left: 30px;height: 100px;" rules="all" class="table_print_letterhead">
                                    <tr>
                                        <td  class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; text-align: left;" width="30%">
                                            Branch
                                        </td>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; text-align: left; " width="70%">
                                            : <?php echo $branch_code . '-' . $branch; ?>
                                        </td
                                    </tr>
                                    <tr>
                                        <td class="print_content" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;text-align: left">
                                            Bill No
                                        </td>

                                        <td class="print_content" style="border-bottom:1px solid #FFF;text-align: left">
                                            : <?php echo $bill_no; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-right:1px solid #FFF;text-align: left">
                                            Dated
                                        </td>
                                        <td class="print_content_small" style="text-align: left;padding-left: 10px;">
                                            : <?php echo $bill_date; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td  style="border-bottom:1px solid #FFF; text-align: left;">
                                <table>
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; ">
                                            Messers
                                        </td>
                                        <td class="print_content_small" style="text-align: left;padding-left: 10px;">
                                            : <?php echo $client_name; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="print_label" style="border-bottom:1px solid #FFF; text-align: left; ">

                            </td>

                        </tr>
                        <tr>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF; text-align: left;padding-left:8em;">
                                <?php echo $party_city; ?>
                            </td>
                            <td class="print_label" style="border-bottom:1px solid #FFF; text-align: left; ">

                            </td>

                        </tr>
                        <tr>
                            <td colspan="2" class="print_content_small" style="border-bottom:1px solid #FFF; text-align: left;">
                                We hereby submit our freight bill as under, Please release the payment immediately.
                            </td>

                            <td style="border-bottom:1px solid #FFF; text-align: left; ">
                                <table>
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; padding-left:30px; ">
                                            Party's Code
                                        </td>
                                        <td class="print_content_small" style="text-align: left;padding-left: 10px;">
                                            : <?php echo $stationary_no; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td colspan="2"  class="print_label align_center" style="width:10%;">
                                CONSIGNMENT
                            </td>
                            <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                            </td>
                            <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                            </td>
                            <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                            </td>
                            <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                            </td>
                            <td colspan="2"  class="print_label align_center" style="width:10%;">
                                SUB TOTAL
                            </td>

                        </tr>
                        <tr>
                            <td  class="print_label align_center" style="width:10%;">
                                Dated
                            </td>
                            <td class="print_label align_center" style="width:10%;">
                                No.
                            </td>
                            <td   class="print_label align_center" style="width:20%;">
                                PARTICULARS
                            </td>
                            <td   class="print_label align_center" style="width:30%;">
                                FROM-TO
                            </td>
                            <td class="print_label align_center" style="width:8%;">
                                WEIGHT
                            </td>
                            <td  class="print_label align_center" style="width:10%;">
                                RATE
                            </td>
                            <td   class="print_label align_center" style="width:8%;">
                                Rs.
                            </td>
                            <td   class="print_label align_center" style="width:4%;">
                                P.
                            </td>
                        </tr>
                        <?php
                        $loop_end_value = 0;
                        $serial_no = 1;
                        if ($edit_product_count <= 8) {
                            $loop_end_value = 7;
                        } else if ($edit_product_count > 8 && $edit_product_count <= 16) {
                            $loop_end_value = 15;
                        }
                        for ($i = 1; $i <= $loop_end_value; $i++) {
                            $product_count = $i;
                            if ($amount_array[$i - 1] >= 0) {
                                ?>
                                <tr style="">
                                    <td align="center" class="print_content_small align_center" style="border-bottom:1px solid #FFF; height:35px;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $bill_date_item_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $no_item_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $particular_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $from_to_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $weight_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $rate_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        $subtotal_split = explode('.', $sub_total_array[$i - 1]);
                                        $subtotal1 = trim($subtotal_split[0]);
                                        $subtotal2 = trim($subtotal_split[1]);
                                        if ($id_error == false) {
                                            echo $subtotal1;
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $subtotal2;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                if ($i == 8) {
                                    ?>
                                    <tr style="height:45px;"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

                                    <tr><td colspan="8" style="text-align:right; padding-right:10px; border-left:1px solid #FFF; border-right:1px solid #FFF;">Page 1 of 2<div style="height:110px;"></div></td></tr>
                                    <tr>
                                        <td colspan="2"  class="print_label align_center" style="width:10%;">
                                            CONSIGNMENT
                                        </td>
                                        <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                                        </td>
                                        <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                                        </td>
                                        <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                                        </td>
                                        <td  class="print_label align_center" style="width:10%;border-bottom:1px solid #FFF;">

                                        </td>
                                        <td colspan="2"  class="print_label align_center" style="width:10%;">
                                            SUB TOTAL
                                        </td>

                                    </tr>
                                    <tr>
                                        <td  class="print_label align_center" >
                                            Dated
                                        </td>
                                        <td class="print_label align_center">
                                            No.
                                        </td>
                                        <td   class="print_label align_center" >
                                            PARTICULARS
                                        </td>
                                        <td   class="print_label align_center" >
                                            FROM-TO
                                        </td>
                                        <td class="print_label align_center" >
                                            WEIGHT
                                        </td>
                                        <td  class="print_label align_center" >
                                            RATE
                                        </td>
                                        <td   class="print_label align_center" >
                                            Rs.
                                        </td>
                                        <td   class="print_label align_center">
                                            P.
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
                                    <td style="border-bottom:1px solid #FFF;"></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="print_label" style="height:25px; border-bottom:1px solid #FFF;">Amount In Words:</td>
                            <td colspan="2" rowspan="2" class="print_label align_right">Total</td>
                            <td rowspan="2" class="print_label align_right" colspan="2">
                                <i class="fa fa-fw fa-rupee"></i>
                                <?php echo number_format((float) $total, 2, '.', ','); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="print_content_small" style="height:25px; vertical-align:top;">
                                Rupees <?php echo number_to_words($total); ?> Only
                            </td>

                        </tr>
                        <tr>
                            <td colspan="8" class="print_label align_right" style="border-bottom:1px solid #FFF;"><?php echo "For " . strtoupper(validate(CLIENTCOMPANYNAME)); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="print_content_small" style="height:25px; border-bottom:1px solid #FFF;border-right:1px solid #FFF;text-align:justify;">Enclosed : ACKNOWLEDGEMENT<br>
                                OUR PAN NO. AAACW6413A <p> 24 % interest will be charged on outstanding bill <br>
                                    above Rs. 2000 /- Pay by A/c. Payee's Cheque only.<br>
                                    Note : we will not avail the cenvat credit on inputs & input services <br> or cliam the benefit of notification No. 12/2003 dt. 20-06-2003.</td>
                            <td colspan="1" class="print_label" style="height:25px; border-bottom:1px solid #FFF;border-right:1px solid #FFF;text-align: center;font-size: 24px;">No. <?php echo $stationary_no; ?></td>
                            <td colspan="4" class="print_label align_right" style="border-bottom:1px solid #FFF;"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="print_label align_right" style="height:40px;border-bottom:1px solid #FFF;border-right:1px solid #FFF;"></td>
                            <td colspan="2" class="print_label align_right" style="height:40px;border-bottom:1px solid #FFF;border-right:1px solid #FFF;">Checked by</td>
                            <td colspan="3" class="print_label align_right" style="height:40px;border-bottom:1px solid #FFF;">Bill Incharge</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="print_label align_center"><?php echo $company_caption; ?></td>
                        </tr>
                        <?php
                        if ($edit_product_count <= 8) {
                            ?>
                            <tr>
                                <td colspan="4" style="text-align:left; border:1px solid #fff;"><?php echo validate(SYSTEMNAME) . validate(VERSION); ?></td>
                                <td colspan="4" style="text-align:right; border:1px solid #fff;">Page 1 of 1</td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" style="text-align:left; border:1px solid #fff;"><?php echo validate(SYSTEMNAME) . validate(VERSION); ?></td>
                                <td colspan="4" style="text-align:right; border:1px solid #fff;">Page 2 of 2</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>



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