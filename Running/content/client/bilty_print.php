<?php
include'../../template/client/header.default.php';

$actionpage = 'bilty_action.php';
$tablename = 'sr_bilty';
$tablename1 = 'sr_bilty_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  order_no,order_date,so_no,so_date,branch_code,branch_city,consignor_name,consignor_address_line1,consignor_address_line2,consignor_city,consignor_pincode,po_no,consignor_invoice_no,consignor_tin_no,stationary_no,consignment_note_no,consignment_date,lane_from,lane_to,consignee_account_no,consignee_account_name,consignee_bank,consignee_branch,to_be_billed_at,vehicle_no,container_no,booking_company_name,booking_address_line1,booking_address_line2,booking_city,booking_pincode,delivery_company_name,delivery_address_line1,delivery_address_line2,delivery_city,bill_party,bill_vide_permit_no,delivery_pincode,service_tax_payable_by,packing,private_note,bill_type,total_frieght,hamall,sur_charges,st_charges,risk_charges,checkpost,fov,total,insurance,insurance_company,policy_no,insurance_date,insurance_amount,risk from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $branch_code = $UDB->Record["branch_code"];
        $branch_city = $UDB->Record["branch_city"];
        $consignor_name = $UDB->Record["consignor_name"];
        $consignor_address_line1 = $UDB->Record["consignor_address_line1"];
        $consignor_address_line2 = $UDB->Record["consignor_address_line2"];
        $consignor_city = $UDB->Record["consignor_city"];
        $consignor_pincode = $UDB->Record["consignor_pincode"];
        $po_no = $UDB->Record["po_no"];
        $consignor_invoice_no = $UDB->Record["consignor_invoice_no"];
        $consignor_tin_no = $UDB->Record["consignor_tin_no"];
        $stationary_no = $UDB->Record["stationary_no"];
        $consignment_note_no = $UDB->Record["consignment_note_no"];
        $consignment_date = $UDB->Record["consignment_date"];
        $lane_from = $UDB->Record["lane_from"];
        $lane_to = $UDB->Record["lane_to"];
        $consignee_account_no = $UDB->Record["consignee_account_no"];
        $consignee_account_name = $UDB->Record["consignee_account_name"];
        $consignee_bank = $UDB->Record["consignee_bank"];
        $consignee_branch = $UDB->Record["consignee_branch"];
        $to_be_billed_at = $UDB->Record["to_be_billed_at"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $container_no = $UDB->Record["container_no"];
        $booking_company_name = $UDB->Record["booking_company_name"];
        $booking_address_line1 = $UDB->Record["booking_address_line1"];
        $booking_address_line2 = $UDB->Record["booking_address_line2"];
        $booking_city = $UDB->Record["booking_city"];
        $booking_pincode = $UDB->Record["booking_pincode"];
        $delivery_company_name = $UDB->Record["delivery_company_name"];
        $delivery_address_line1 = $UDB->Record["delivery_address_line1"];
        $delivery_address_line2 = $UDB->Record["delivery_address_line2"];
        $delivery_city = $UDB->Record["delivery_city"];
        $delivery_pincode = $UDB->Record["delivery_pincode"];
        $bill_party = $UDB->Record["bill_party"];
        $bill_vide_permit_no = $UDB->Record["bill_vide_permit_no"];
        $service_tax_payable_by = $UDB->Record["service_tax_payable_by"];
        $packing = $UDB->Record["packing"];
        $private_note = $UDB->Record["private_note"];
        $bill_type = $UDB->Record["bill_type"];
        $total_frieght = $UDB->Record["total_frieght"];
        $hamall = $UDB->Record["hamall"];
        $sur_charges = $UDB->Record["sur_charges"];
        $st_charges = $UDB->Record["st_charges"];
        $risk_charges = $UDB->Record["risk_charges"];
        $checkpost = $UDB->Record["checkpost"];
        $fov = $UDB->Record["fov"];
        $total = $UDB->Record["total"];
        $insurance = $UDB->Record["insurance"];
        $insurance_company = $UDB->Record["insurance_company"];
        $policy_no = $UDB->Record["policy_no"];
        $insurance_date = $UDB->Record["insurance_date"];
        $insurance_amount = $UDB->Record["insurance_amount"];
        $risk = $UDB->Record["risk"];
    }

    $edit_product_count = 0;
    $Query = "SELECT id,description,product_category,product_name,packages_unit,packages,weight_actual,weight_charged,frieght_charge from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $description_array[] = $UDB->Record["description"];
        $product_category_array[] = $UDB->Record["product_category"];
        $product_name_array[] = $UDB->Record["product_name"];
        $packages_unit_array[] = $UDB->Record["packages_unit"];
        $packages_array[] = $UDB->Record["packages"];
        $weight_actual_array[] = $UDB->Record["weight_actual"];
        $weight_charged_array[] = $UDB->Record["weight_charged"];
        $frieght_charge_array[] = $UDB->Record["frieght_charge"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bilty
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="bilty_grid.php">Bilty</a></li>
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
                    <table cellspacing="0" style="border-right:1px solid #FFF; width:1100px; margin:auto;" rules="all" class="table_print_letterhead">

                        <tr>
                            <td rowspan="6" align="left" style="width:50%; padding-left: 20px;">
                                <?php
                                $Query = "select branch_code,company_name,company_caption,address_line1,address_line2,city,pincode,telephone_no,mobile_no,email_id,tin_no,cst_no from sr_company where branch_code='WA-BR-100'";
                                $DB->query($Query);

                                while ($DB->Multicoloums()) {
                                    echo '<img src="../../theme/img/logo_left.png"/>';
                                    echo "<br><span class=\"print_caption\">" . $DB->Record["company_caption"] . "</span><br>";
                                    echo"<span class=\"print_content_small\" style=\"padding:0px;\">";
                                    echo $DB->Record["address_line1"] . ' ,' . $DB->Record["address_line2"] . ',' . $DB->Record["city"] . ', ' . $DB->Record["pincode"] . ".<br>";

                                    echo "Tel No : " . $DB->Record["telephone_no"] . ', Mobile No :' . $DB->Record["mobile_no"] . "<br>";
                                    echo "Email : " . $DB->Record["email_id"] . "<br>";
                                }
                                ?>
                            </td>
                            <td rowspan="6" align="right" style="width:50%; padding-bottom: 80px; padding-right: 10px;">
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
                            <td style="border:1px solid #FFF;">
                                <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:350px;  margin:auto; padding-left: 2em; height: 165px;" rules="all" class="table_print_letterhead">
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; text-align: center; "colspan="2">
                                            INSURANCE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width: 50%">
                                            <strong>  The Customer has stated that :</strong>
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"  class="print_content_small" style="border-bottom:1px solid #FFF;" >
                                            <i class="fa fa-square-o"></i> <strong>  he has not insured the consignment </strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width: 50%">
                                            <strong> OR </strong>
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="2"  class="print_content_small" style="border-bottom:1px solid #FFF; ">
                                            <i class="fa fa-square-o"></i> <strong> he has insured the consignment  </strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width: 50%">
                                            Company :
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">
                                            <?php echo $insurance_company; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;width: 50%;">
                                            <strong> Policy No :</strong><?php echo $policy_no; ?>
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">
                                            <strong>   Date :</strong> <?php echo $insurance_date; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-right:1px solid #FFF;width: 50%;">
                                            <strong>Amount :</strong> <?php echo $insurance_amount; ?>
                                        </td>
                                        <td class="print_content_small" style=" width: 50%">
                                            <strong>   Risk :</strong> <?php echo $risk; ?>
                                        </td>
                                    </tr>

                                </table> </td>
                            <td style="border:1px solid #FFF;">
                                <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:150px;  margin:auto; padding-left: 20px;height: 165px;" rules="all" class="table_print_letterhead">
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF; text-align: center; ">
                                            ACCOUNT COPY
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content" style="border-bottom:1px solid #FFF;padding-left:2em;padding-top: 20px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF;text-align: center;">
                                            NO DELIVER
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="print_label" style="text-align: left;">
                                            AGAINST THIS COPY
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td class="print_content" style="border-bottom:1px solid #FFF;padding-left:2em; padding-top: 10px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style=" border-bottom:1px solid #FFF; text-align: center; margin-bottom: 20px; ">
                                            AT OWNER'S RISK
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content" style="padding-left:2em;padding-bottom: 10px;">

                                        </td>
                                    </tr>
                        </tr>
                    </table>
                    </td>
                    <td style="border:1px solid #FFF;">
                        <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:300px;  margin:auto; padding-left: 2em; height: 40px;" rules="all" class="table_print_letterhead">
                            <tr>
                                <td class="print_label" style=" ">
                                    SCHEDULE OF DEMURRAGE CHARGES
                                </td>
                            </tr>
                            <tr>
                                <td class="print_content" style="padding-left:2em;">
                                    Demurrage Chargeable after 15 days from today @ 3/-per day per Qtl.on weight Charged.
                                </td>
                            </tr>


                        </table>
                        <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:300px;  margin:auto; padding-left: 2em; height: 40px;" rules="all" class="table_print_letterhead">
                            <tr>
                                <td class="print_label" style=" ">
                                    CONSIGNMENT NOTE NO :
                                </td>
                            </tr>
                            <tr>
                                <td class="print_content" style="padding-left:2em; height: 30px;">
                                    <?php echo $consignment_note_no; ?>
                                </td>
                            </tr>


                        </table>
                        <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:300px;  margin:auto; padding-left: 2em; height: 30px;" rules="all" class="table_print_letterhead">
                            <tr>
                                <td class="print_label" style=" ">
                                    Date :<?php echo $consignment_date; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table cellspacing="0" style="border:1px solid #000000; margin-top: -20px; width:300px;  margin:auto; padding-left: 2em; height: 165px;" rules="all" class="table_print_letterhead">
                            <tr>
                                <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF;width:45%;">
                                    Booking Address:
                                </td>
                                <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%; text-align: left;">
                                    <?php echo $booking_company_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="print_content_small" style="border-bottom:1px solid #FFF; width:45%;height: 25px;" colspan="2">
                                    <?php echo $booking_address_line1 . "," . $booking_address_line2 . "," . $booking_city . "-" . $booking_pincode; ?>
                                </td>

                            </tr>
                            <tr>
                                <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF;width:45%;">
                                    Delivery Address:
                                </td>
                                <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;">
                                    <?php echo $delivery_company_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="print_content_small" style="border-bottom:1px solid #FFF; width:45%;height: 25px;" colspan="2">
                                    <?php echo $delivery_address_line1 . "," . $delivery_address_line2 . "," . $delivery_city . "-" . $delivery_pincode . "."; ?>
                                </td>

                            </tr>
                            <tr>
                                <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF;width:45%;">
                                    P.O.No:
                                </td>
                                <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;">
                                    <?php echo $po_no; ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="print_label" style="border-right:1px solid #FFF;width:45%;">
                                    Bill Party:
                                </td>
                                <td class="print_content_small" style=" width:55%;">
                                    <?php echo $bill_party; ?>
                                </td>
                            </tr>

                        </table>
                    </td>
                    </tr>
                    </table>
                    <table cellspacing="0" style=" margin-top:-20px; width:850px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td style="border:1px solid #FFF;">
                                <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:550px;  margin:auto; padding-left: 2em; height: 40px;" rules="all" class="table_print_letterhead">

                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width: 50%;">
                                            Consignor's Name & Address:
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">
                                            <?php echo $consignor_name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%;height: 30px;"colspan="2">
                                            <?php echo $consignor_address_line1 . "," . $consignor_address_line2 . "," . $consignor_city . "-" . $consignor_pincode . "."; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%;" colspan="2">

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width: 50%;">
                                            Consignee Bank's Name & Address:
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width: 50%">
                                            <?php echo $consignee_bank . "-" . $consignee_branch; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style=" border-bottom:1px solid #FFF; width: 50%; height: 30px;"colspan="2">

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style=" "colspan="2">

                                        </td>

                                    </tr>
                                </table>
                            </td>
                            <td style="border:1px solid #FFF;">
                                <table cellspacing="0" style="border:1px solid #000000; margin-left: 20px; width:250px;  margin:auto; padding-left: 2em; height: 100px;" rules="all" class="table_print_letterhead">

                                    <tr>
                                        <td class="print_label" style="border-top:1px solid #FFF;border-left:1px solid #FFF;border-right:1px solid #FFF; width: 50%;padding-top: 1px;">
                                            From:
                                        </td>
                                        <td class="print_content_small" style="border-top:1px solid #FFF;border-right:1px solid #FFF; width: 50%">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style=" padding-top: 10px; height: 30px;text-align: center;"colspan="2">
                                            <?php echo $lane_from; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-top:1px solid #FFF;border-left:1px solid #FFF;border-right:1px solid #FFF; width: 50%;padding-top: 1px;">
                                            To:
                                        </td>
                                        <td class="print_content_small" style="border-top:1px solid #FFF;border-right:1px solid #FFF; width: 50%">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style=" padding-top: 10px; height: 30px;text-align: center;"colspan="2">
                                            <?php echo $lane_to; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table cellspacing="0" style="border:1px solid #000000; margin-top: -20px; width:300px;  margin:auto; padding-left: 2em; height: 40px;" rules="all" class="table_print_letterhead">
                                    <tr>
                                        <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF;">
                                            Bill Type
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                            : <?php echo $bill_type; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF; width:45%;padding-top: 10px;">
                                            Packing
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;"colspan="2">
                                            : <?php echo $packing; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_content_small" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF; width:45%;padding-top: 10px;">

                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;"colspan="2">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF; width:45%;">
                                            Private Mark
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;"colspan="2">
                                            : <?php echo $private_note; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="print_label" style=" border-right:1px solid #FFF;width:45%;padding-top: 10px;">
                                            Container No

                                        </td>
                                        <td class="print_content_small" style=" width:55%;"colspan="2">
                                            : <?php echo $container_no; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div style="width: 1100px;margin: auto;">
                        <div>
                            <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:400px;  margin:auto;float: left;" rules="all" class="table_print_letterhead">
                                <tr>
                                    <td  class="print_label align_center" style="width:10%; line-height:25px;">
                                        Packages
                                    </td>
                                    <td  class="print_label align_center" style="width:60%;">
                                        Description(Said to Contain)
                                    </td>
                                    <td  class="print_label align_center" style="width:15%;">
                                        Actual Weight
                                    </td>
                                    <td  class="print_label align_center" style="width:15%;">
                                        Charged Weight
                                    </td>

                                </tr>
                                <?php
                                $loop_end_value = 0;
                                if ($edit_product_count <= 5) {
                                    $loop_end_value = 5;
                                } else if ($edit_product_count > 5 && $edit_product_count <= 6) {
                                    $loop_end_value = 5;
                                }
                                for ($i = 1; $i <= $loop_end_value; $i++) {
                                    $product_count = $i;
                                    if ($packages_array[$i - 1] >= 0) {
                                        ?>
                                        <tr style="">
                                            <td align="center" style="border-bottom:1px solid #FFF; height:35px;">
                                                <?php
                                                echo $packages_array[$i - 1];
                                            }
                                            ?>
                                        </td>
                                        <td class="print_content_small" style="border-bottom:1px solid #FFF;">
                                            <?php
                                            echo $description_array[$i - 1];
                                            ?>
                                        </td>
                                        <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                            <?php
                                            echo $weight_actual_array[$i - 1];
                                            ?>
                                        </td>
                                        <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                            <?php
                                            echo $weight_charged_array[$i - 1];
                                            ?>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                <tr>
                                    <td></td><td></td><td></td><td></td>
                                </tr>

                            </table>
                        </div>
                        <div>
                            <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:400px;  margin:auto;height: 220px;float: left;" rules="all" class="table_print_letterhead">
                                <tr>
                                    <td  class="print_label align_center" style="width:30%;">
                                        Rate
                                    </td>
                                    <td  class="print_label align_center" style="width:70%;">
                                        Amount to pay/Paid/T.B.B
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        Freight
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $total_frieght; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        Hamali
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $hamall; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        Sur.Ch
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $sur_charges; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        St.Ch
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $st_charges; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        Risk.Ch
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $risk_charges; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        Checkpost
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $checkpost; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="border-bottom:1px solid #FFF;">
                                        F.O.V
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $fov; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small align_center" style="">
                                        Total
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php echo $total; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <table cellspacing="0" style="border:1px solid #000000; margin-top: -20px; width:300px;  margin:auto; padding-left: 2em; float: right; height: 220px; " rules="all" class="table_print_letterhead">
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF; width:45%;"colspan="2">
                                        Consignor CST/VAT/TIN No.
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF; height: 10px;text-align: center;" colspan="2">
                                        <?php echo $consignor_tin_no; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF; width:45%;padding-top: 10px;"colspan="2">
                                        Consignee CST/VAT/TIN No.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF;height: 10px;"colspan="2">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF; width:45%;padding-top: 10px;"colspan="2">
                                        Consignor Invice No:
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width:45%;height: 10px;">

                                    </td>
                                    <td class="print_content_small" style=" width:55%;border-bottom:1px solid #FFF;"colspan="2">
                                        <?php echo $consignor_invoice_no; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF; width:45%;padding-top: 10px;"colspan="2">
                                        Bill Vide Permit No:
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF; width:45%;height: 15px;">

                                    </td>
                                    <td class="print_content_small" style="border-bottom:1px solid #FFF; width:55%;">
                                        <?php echo $bill_vide_permit_no; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;"colspan="2">
                                        SERVICE TAX PAYABLE BY:
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="height: 10px; text-align: center;"colspan="2">
                                        <?php echo $service_tax_payable_by; ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div>
                        <table cellspacing="0" style="border-right:1px solid #FFF; width:1100px; margin:auto;" rules="all" class="table_print_letterhead">
                            <tr>
                                <td  align="left" style="width:40%;border-bottom:1px solid #FFF;">

                                </td>
                                <td  align="Center" style="width:20%; border-bottom:1px solid #FFF; ">
                                    <strong> PAN NO: AAACW6413A</strong>
                                </td>
                                <td  align="right" style="width:40%; border-bottom:1px solid #FFF; ">

                            </tr>
                            <tr>
                                <td  align="left" style="width:40%; padding-left: 10px;padding-top: 10px;">
                                    <strong> (Signature of Consignor or his agent)</strong><br>
                                    Note: We will not avail the cenvat credit on<br>  inputs & input services or claim the benefit<br> of notification.12/2003 Dt.20-6-2003.<br>This Consignment is booked as per specific Terms & Conditions.
                                </td>
                                <td  align="Center" style="width:20%;  padding-right: 10px;padding-top: 40px;">
                                    <strong> Value :</strong><br><br>
                                    <span style="font-size: 18px;"> <strong>No. <?php echo $stationary_no; ?></strong></span>
                                </td>
                                <td  align="right" style="width:40%;  padding-right: 10px;">
                                    <strong> Signature of the transport operator</strong>
                                </td>
                            </tr>
                        </table>
                    </div>



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