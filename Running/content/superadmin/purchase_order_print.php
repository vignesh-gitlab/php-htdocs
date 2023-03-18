<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'purchase_order_action.php';
$tablename = 'sr_purchase_order';
$tablename1 = 'sr_purchase_order_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id, so_no, product_group, po_id, po_number, po_date,po_delivery_date, po_reference,client_name_address, vendor_name, vendor_company, vendor_address_line1, vendor_address_line2, vendor_city, vendor_pincode, vendor_contact_number, vendor_tin_no, delivery_name, delivery_company, delivery_address_line1, delivery_address_line2, delivery_city, delivery_pincode, delivery_contact_number, delivery_tin_no, terms_and_condition, sub_total, total_tax, discount_percentage, discount, grand_total from $tablename where id = '" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $so_no = $UDB->Record["so_no"];
        $product_group = $UDB->Record["product_group"];
        $po_id = $UDB->Record["po_id"];
        $po_number = $UDB->Record["po_number"];
        $po_date = $UDB->Record["po_date"];
        $po_delivery_date = $UDB->Record["po_delivery_date"];
        $po_reference = $UDB->Record["po_reference"];
        $client_name_address = $UDB->Record["client_name_address"];
        $vendor_name = $UDB->Record["vendor_name"];
        $vendor_company = $UDB->Record["vendor_company"];
        $vendor_address_line1 = $UDB->Record["vendor_address_line1"];
        $vendor_address_line2 = $UDB->Record["vendor_address_line2"];
        $vendor_city = $UDB->Record["vendor_city"];
        $vendor_pincode = $UDB->Record["vendor_pincode"];
        $vendor_contact_number = $UDB->Record["vendor_contact_number"];
        $vendor_tin_no = $UDB->Record["vendor_tin_no"];
        $delivery_name = $UDB->Record["delivery_name"];
        $delivery_company = $UDB->Record["delivery_company"];
        $delivery_address_line1 = $UDB->Record["delivery_address_line1"];
        $delivery_address_line2 = $UDB->Record["delivery_address_line2"];
        $delivery_city = $UDB->Record["delivery_city"];
        $delivery_pincode = $UDB->Record["delivery_pincode"];
        $delivery_contact_number = $UDB->Record["delivery_contact_number"];
        $delivery_tin_no = $UDB->Record["delivery_tin_no"];
        $terms_and_condition = $UDB->Record["terms_and_condition"];
        $sub_total = $UDB->Record["sub_total"];
        $total_tax = $UDB->Record["total_tax"];
        $discount_percentage = $UDB->Record["discount_percentage"];
        $discount = $UDB->Record["discount"];
        $grand_total = $UDB->Record["grand_total"];
    }

    $edit_product_count = 0;
    $Query = "SELECT id, product_brand, product_name, product_description, quantity, unit, unit_price, tax_rate, tax_type, product_total, tax_total, total_amount from $tablename1 where po_no = '" . $po_number . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $product_category_array[] = $UDB->Record["product_brand"];
        $product_name_array[] = $UDB->Record["product_name"];
        $product_description_array[] = $UDB->Record["product_description"];
        $quantity_array[] = $UDB->Record["quantity"];
        $unit_array[] = $UDB->Record["unit"];
        $unit_price_array[] = $UDB->Record["unit_price"];
        $tax_rate_array[] = $UDB->Record["tax_rate"];
        $tax_type_array[] = $UDB->Record["tax_type"];
        $product_total_array[] = $UDB->Record["product_total"];
        $tax_total_array[] = $UDB->Record["tax_total"];
        $amount_array[] = $UDB->Record["total_amount"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Order</li>
            <li><a href="purchase_order_grid.php">Purchase Order</a></li>
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
                    <table cellspacing="0" style="border:1px solid #000000; width:700px; margin:auto;" rules="all" class="table_print_letterhead">
                        <thead>

                        <td colspan="3" style="height:22px; vertical-align:middle;">
                            <div class="print_header_full align_center">
                                PURCHASE ORDER
                            </div>
                        </td>
                        </thead>
                        <tr>
                            <td rowspan="6" align="center" style="width:50%;">
                                <?php
                                $Query = "select company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,tin_no,cst_no,company_logo from sr_company where product_group='" . $product_group . "'";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    echo '<img src="../../files/uploads/company_logo/' . $DB->Record["company_logo"] . '" style="height:35px;"/>';
                                    echo "<br><span class=\"print_caption\">" . $DB->Record["company_caption"] . "</span><br>";
                                    echo"<span class=\"print_content_small\">";
                                    echo $DB->Record["address_line1"] . ",<br>";
                                    echo $DB->Record["address_line2"] . ', ' . $DB->Record["city"] . ', ' . $DB->Record["pincode"] . ".<br>";
                                    echo "Contact : " . $DB->Record["telephone_no"] . ', ' . $DB->Record["mobile_no"] . "<br>";
                                    echo "Email : " . $DB->Record["email_id"] . "<br>";
                                    echo "TIN : " . $DB->Record["tin_no"] . ", CST : " . $DB->Record["cst_no"] . "</span>";
                                }
                                ?>
                            </td>
                            <td class="print_label" style="border-bottom:1px solid #FFF; border-right:1px solid #FFF; width:20%;">
                                PO. Number
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF; width:30%;">
                                : <?php echo $po_number; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF; border-right:1px solid #FFF;">
                                PO. Date
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                : <?php echo $po_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF; border-right:1px solid #FFF;">
                                Pro. Req Date
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                : <?php echo $po_delivery_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-right:1px solid #FFF;">
                                Sales Order Ref. No
                            </td>
                            <td class="print_content_small">
                                : <?php echo $so_no; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;" colspan="2">
                                Reference / Description
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="print_content_small" style="vertical-align:top;" colspan="2">
                                <?php echo $po_reference; ?>
                            </td>
                        </tr>
                    </table>

                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:700px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF; width:50%;">
                                Client Name & Address
                            </td>
                            <td class="print_label" style="border-bottom:1px solid #FFF; width:50%;">
                                Delivery Name & Address
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                <?php echo $vendor_name; ?>,
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                <?php echo $delivery_name; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                <?php echo $vendor_company; ?>,
                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;">
                                <?php echo $delivery_company; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $vendor_address_line1; ?>,
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $delivery_address_line1; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $vendor_address_line2; ?>,
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $delivery_address_line2; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $vendor_city . ", " . $vendor_pincode; ?>.
                            </td>
                            <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                <?php echo $delivery_city . ", " . $delivery_pincode; ?>.
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content_small">
                                Tin No : <?php echo $vendor_tin_no; ?>,
                            </td>
                            <td class="print_content_small">
                                Tin No : <?php echo $delivery_tin_no; ?>,
                            </td>
                        </tr>
                    </table>

                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:700px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td  class="print_label align_center" style="width:5%; line-height:25px;">
                                Sr. No
                            </td>
                            <td  class="print_label align_center" style="width:45%;">
                                Product Name
                            </td>
                            <td  class="print_label align_center" style="width:8%;">
                                Unit Price
                            </td>
                            <td  class="print_label align_center" style="width:8%;">
                                Qty
                            </td>
                            <td  class="print_label align_center" style="width:8%;">
                                Unit Total
                            </td>
                            <td  class="print_label align_center" style="width:8%;">
                                Tax Rate
                            </td>
                            <td  class="print_label align_center" style="width:8%;">
                                Tax
                            </td>
                            <td  class="print_label align_center" style="width:10%;">
                                Amount
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
                            if ($amount_array[$i - 1] >= 0) {
                                ?>
                                <tr style="">
                                    <td align="center" style="border-bottom:1px solid #FFF; height:35px;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo $serial_no;
                                            $serial_no = $serial_no + 1;
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($product_category_array[$i - 1] != "Select" && isset($product_description_array [$i - 1])) {
                                            if ($tax_type_array[$i - 1] == "In") {
                                                echo $product_category_array[$i - 1] . " - " . $product_name_array [$i - 1] . " (Including Tax)<br>" . $product_description_array [$i - 1];
                                            } else {
                                                echo $product_category_array[$i - 1] . " - " . $product_name_array [$i - 1] . "<br>" . $product_description_array [$i - 1];
                                            }
                                        } else if ($product_category_array[$i - 1] == "Select" && $product_description_array [$i - 1] != NULL) {
                                            if ($tax_type_array[$i - 1] == "In") {
                                                echo $product_description_array[$i - 1] . " (Including Tax)";
                                            } else {
                                                echo $product_description_array[$i - 1];
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo number_format((float) $unit_price_array[$i - 1], 2, '.', ',');
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            if ($unit_array [$i - 1] == "NA") {
                                                echo $quantity_array [$i - 1];
                                            } else {
                                                echo $quantity_array[$i - 1] . " " . $unit_array[$i - 1];
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo number_format((float) $product_total_array [$i - 1], 2, '.', ',');
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo number_format((float) $tax_rate_array [$i - 1], 2, '.', ',') . " %";
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo number_format((float) $tax_total_array[$i - 1], 2, '.', ',');
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="border-bottom:1px solid #FFF;">
                                        <?php
                                        if ($amount_array[$i - 1] > 0) {
                                            echo number_format((float) $amount_array[$i - 1], 2, '.', ',');
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                if ($i == 10) {
                                    ?>
                                    <tr style="height:90px;"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

                                    <tr><td colspan="8" style="text-align:right; padding-right:10px; border-left:1px solid #FFF; border-right:1px solid #FFF;">Page 1 of 2<div style="height:35px;"></div></td></tr>

                                    <tr>
                                        <td  class="print_label align_center" style=line-height:25px;">
                                            Sr. No
                                        </td>
                                        <td  class="print_label align_center">
                                            Product Name
                                        </td>
                                        <td  class="print_label align_center">
                                            Unit Price
                                        </td>
                                        <td  class="print_label align_center">
                                            Qty
                                        </td>
                                        <td  class="print_label align_center">
                                            Unit Total
                                        </td>
                                        <td  class="print_label align_center">
                                            Tax Rate
                                        </td>
                                        <td  class="print_label align_center">
                                            Tax
                                        </td>
                                        <td  class="print_label align_center">
                                            Amount
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
                            <td colspan="2" class="print_content_small align_right">Sub Total</td>
                            <td class="print_content_small align_right" colspan="2">
                                <i class="fa fa-fw fa-rupee"></i>
                                <?php echo number_format((float) $sub_total, 2, '.', ','); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" <?php
                            if ($discount > 0) {
                                echo 'rowspan="3"';
                            } else {
                                echo 'rowspan="2"';
                            }
                            ?> class="print_content_small" style="height:25px; vertical-align:top;">
                                Rupees <?php echo number_to_words($grand_total); ?>  Only
                            </td>
                            <td colspan="2" class="print_content_small align_right">(+) Total Tax</td>
                            <td class="print_content_small align_right" colspan="2">
                                <i class="fa fa-fw fa-rupee"></i>
                                <?php echo number_format((float) $total_tax, 2, '.', ','); ?>
                            </td>
                        </tr>
                        <?php
                        if ($discount > 0) {
                            ?>
                            <tr>
                                <td colspan="2" class="print_content_small align_right">
                                    (-) Discount
                                    <?php
                                    if ($discount_percentage > 0) {
                                        echo "( " . $discount_percentage . " %)";
                                    }
                                    ?>
                                </td>
                                <td class="print_content_small align_right" colspan="2">
                                    <i class="fa fa-fw fa-rupee"></i>
                                    <?php echo number_format((float) $discount, 2, '.', ','); ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2" class="print_label align_right">Grand Total</td>
                            <td class="print_label align_right" colspan="2">
                                <i class="fa fa-fw fa-rupee"></i>
                                <?php echo number_format((float) $grand_total, 2, '.', ','); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="print_label align_left" style="border-bottom:1px solid #FFF;">Terms and Conditions</td>
                            <td colspan="4" class="print_label align_center" style="border-bottom:1px solid #FFF;">   <?php echo "For " . validate(CLIENTCOMPANYNAME); ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="print_content_small align_left" style="vertical-align:top; height:80px; border-bottom:1px solid #FFF;">
                                <?php echo $terms_and_condition; ?>
                            </td>
                            <td colspan="4" class="print_label align_center" style="border-bottom:1px solid #FFF;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="print_label align_left">E.&O.E. </td>
                            <td colspan="4" class="print_label align_center">Signature</td>
                        </tr>
                        <?php
                        if ($edit_product_count <= 10) {
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