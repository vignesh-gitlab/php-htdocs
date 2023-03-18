<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'lorry_chellan_action.php';
$tablename = 'sr_lorry_chellan';
$tablename1 = 'sr_lorry_chellan_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,order_no,order_date,so_no,so_date,branch_code,stationary_no,lorry_chellan_no,lorry_chellan_date,lorry_from,lorry_to,lorry_no,branch,chassis_no,engine_no,owner_name,owner_address_line1,owner_address_line2,owner_city,owner_pincode,driver_name,license_no,driver_address_line1,driver_address_line2,driver_city,driver_pincode,lorry_model,lorry_color,lorry_make,permit_status,permit_valid_upto,ongaged_through,delivery_date,destination_address_line1,destination_address_line2,destination_city,destination_pincode,total_packages,rate_per_ton,rate_per_kg,frieght,extra_for,total,advance,less_tds,balance from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $branch_code = $UDB->Record["branch_code"];
        $stationary_no = $UDB->Record["stationary_no"];
        $lorry_chellan_no = $UDB->Record["lorry_chellan_no"];
        $lorry_chellan_date = $UDB->Record["lorry_chellan_date"];
        $lorry_from = $UDB->Record["lorry_from"];
        $lorry_to = $UDB->Record["lorry_to"];
        $lorry_no = $UDB->Record["lorry_no"];
        $branch = $UDB->Record["branch"];
        $chassis_no = $UDB->Record["chassis_no"];
        $engine_no = $UDB->Record["engine_no"];
        $owner_name = $UDB->Record["owner_name"];
        $owner_address_line1 = $UDB->Record["owner_address_line1"];
        $owner_address_line2 = $UDB->Record["owner_address_line2"];
        $owner_city = $UDB->Record["owner_city"];
        $owner_pincode = $UDB->Record["owner_pincode"];
        $driver_name = $UDB->Record["driver_name"];
        $license_no = $UDB->Record["license_no"];
        $driver_address_line1 = $UDB->Record["driver_address_line1"];
        $driver_address_line2 = $UDB->Record["driver_address_line2"];
        $driver_city = $UDB->Record["driver_city"];
        $driver_pincode = $UDB->Record["driver_pincode"];
        $lorry_model = $UDB->Record["lorry_model"];
        $lorry_color = $UDB->Record["lorry_color"];
        $lorry_make = $UDB->Record["lorry_make"];
        $permit_status = $UDB->Record["permit_status"];
        $permit_valid_upto = $UDB->Record["permit_valid_upto"];
        $ongaged_through = $UDB->Record["ongaged_through"];
        $delivery_date = $UDB->Record["delivery_date"];
        $destination_address_line1 = $UDB->Record["destination_address_line1"];
        $destination_address_line2 = $UDB->Record["destination_address_line2"];
        $destination_city = $UDB->Record["destination_city"];
        $destination_pincode = $UDB->Record["destination_pincode"];
        $total_packages = $UDB->Record["total_packages"];
        $rate_per_ton = $UDB->Record["rate_per_ton"];
        $rate_per_kg = $UDB->Record["rate_per_kg"];
        $frieght = $UDB->Record["frieght"];
        $extra_for = $UDB->Record["extra_for"];
        $total = $UDB->Record["total"];
        $advance = $UDB->Record["advance"];
        $less_tds = $UDB->Record["less_tds"];
        $balance = $UDB->Record["balance"];
    }

    $edit_product_count = 0;
    $Query = "SELECT  id,code,consignment_no,no_of_packages,packing,description,weight,destination,to_pay from $tablename1 where order_no='" . $order_no . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $edit_product_count = $edit_product_count + 1;
        $code_array[] = $UDB->Record["code"];
        $consignment_no_array[] = $UDB->Record["consignment_no"];
        $no_of_packages_array[] = $UDB->Record["no_of_packages"];
        $packing_array[] = $UDB->Record["packing"];
        $description_array[] = $UDB->Record["description"];
        $weight_array[] = $UDB->Record["weight"];
        $destination_array[] = $UDB->Record["destination"];
        $to_pay_array[] = $UDB->Record["to_pay"];
    }

    $Query = "SELECT  id,city from sr_company where branch_code='" . $branch_code . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $city = $DB->Record["city"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Challan
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="lorry_chellan_grid.php">Lorry Challan</a></li>
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
                                LORRY CHALLAN
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

                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_content" style=" width: 30%;">
                                <?php echo $branch_code; ?>
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 30%;">
                                Date:  <?php echo $order_date; ?>
                            </td>
                            <td class="print_label" style=" border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; padding-left:10em;width: 15%;text-align: right;">
                                Branch:
                            </td>
                            <td class="print_content" align="center" style=" padding-left:4em;width: 25%; ">
                                <?php echo $city; ?>
                            </td>

                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;border-right:1px solid #FFF; width: 15%;margin-top: 20px;">

                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; border-right:1px solid #FFF;padding-left:2em;width: 39%;">

                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Lorry No :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $lorry_no; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                Chassis No : <u><?php echo $chassis_no; ?></u>
                        </td>
                        <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF;border-bottom:1px solid #FFF;border-left:1px solid #FFF;padding-left:2em;width: 39%;">
                            Engine No:  <u><?php echo $engine_no; ?></u>
                        </td>
                        <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                            From :
                        </td>
                        <td class="print_content" style="padding-left:2em;width: 23%;">
                            <?php echo $lorry_from; ?>
                        </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                Owner : <u><?php echo $owner_name; ?></u>
                        </td>
                        <td class="print_label" style="border-bottom:1px solid #FFF;padding-left:2em;width: 39%;border-right:1px solid #FFF;">
                            Address :<u><?php echo $owner_city; ?></u>
                        </td>
                        <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                            To :
                        </td>
                        <td class="print_label" style="padding-left:2em;width: 23%;">
                            <?php echo $lorry_to; ?>
                        </td>
                        </tr>

                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;border-right:1px solid #FFF; width: 15%;margin-top: 20px;">
                                Driver :<?php echo $driver_name; ?>
                            </td>
                            <td class="print_label" style="border-right:1px solid #FFF;border-bottom:1px solid #FFF;padding-left:2em;width: 39%;">
                                L.No :<?php echo $lorry_no; ?>
                            </td>
                            <td class="print_label" style="border-right:1px solid #FFF;border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Address :
                            </td>
                            <td class="print_label" style=" border-bottom:1px solid #FFF;border-right:1px solid #FFF;padding-left:2em;width: 23%;">
                                <?php echo $driver_city; ?>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 20%;margin-top: 20px;">
                                Model :<?php echo $lorry_model; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 20%;">
                                Make :<?php echo $lorry_make; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 20%;">
                                L.Colour :<?php echo $lorry_color; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF;border-bottom:1px solid #FFF;padding-left:2em;width: 20%;">
                                Permit Valid Upto :<?php echo $permit_valid_upto; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF;border-bottom:1px solid #FFF;padding-left:2em;width: 20%;">
                                Of States : <?php echo $permit_status; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 50%;margin-top: 20px;"colspan="2">
                                Engaged Through :<?php echo $ongaged_through; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF;border-right:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 50%;"colspan="3">
                                Destination Address :<?php echo $destination_address_line1; ?>,<?php echo $destination_address_line2; ?>
                            </td>
                        </tr>

                    </table>
                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td  class="print_label align_center" style="width:20%;">
                                Con. Code
                            </td>
                            <td   class="print_label align_center" style="width:10%;">
                                No Of Packages
                            </td>
                            <td   class="print_label align_center" style="width:10%;">
                                Method Of Packaging
                            </td>
                            <td class="print_label align_center" style="width:8%;">
                                CONTENTS
                            </td>
                            <td  class="print_label align_center" style="width:10%;">
                                Weight in Kgs
                            </td>
                            <td   class="print_label align_center" style="width:8%;">
                                Destination
                            </td>
                            <td   class="print_label align_center" style="width:4%;">
                                TO PAY/TBB Rs.
                            </td>
                        </tr>
                        <?php
                        $loop_end_value = 0;
                        if ($edit_product_count <= 10) {
                            $loop_end_value = 10;
                        }
                        for ($i = 1; $i <= $loop_end_value; $i++) {
                            $product_count = $i;
                            if ($code_array[$i - 1] >= 0) {
                                ?>
                                <tr style="">
                                    <td align="center" style=" height:35px;">
                                        <?php
                                        if ($id_error == false) {
                                            echo $code_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $no_of_packages_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $packing_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_right" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $description_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $weight_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $destination_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                    <td class="print_content_small align_center" style="">
                                        <?php
                                        if ($id_error == false) {
                                            echo $to_pay_array[$i - 1];
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                if ($i == 10) {
                                    ?>



                                    <?php
                                }
                            } else {
                                ?>

                                <?php
                            }
                        }
                        ?>

                    </table>
                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; margin-top: 20px; text-align: center;">
                                <strong> Acknowledgement Should be given within 20 days after Rs.100 /- would be deducted per day.</strong>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:900px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; margin-top: 20px; text-align: center;">
                                <strong> MATERIAL SHALL BE DELIVERED BEFORE DATE:<i><u><?php echo $delivery_date; ?></u></i> OTHERWISE TRUCK 500/-/TRAILOR 1000/- PER DAY BE DEDUCTED FROM FREIGHT.<br>Freight Payment by A/c.Payees Cheque Only.</strong>
                            </td>
                        </tr>
                    </table>
                    <div style="width:900px; margin:auto;">
                        <div >
                            <table cellspacing="0" style="float: left;border:1px solid #000000; margin-top:-20px; width:450px;margin:auto;" rules="all" class="table_print_letterhead">
                                </tr>
                                <tr style="">
                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;width: 30%;">
                                        Rate <u>&nbsp;&nbsp;<?php echo "   " . $rate_per_ton . "    "; ?>&nbsp;&nbsp;</u>per ton
                                </td>
                                <td class="print_label align_center" style="width: 30%;">
                                    Freight
                                </td>
                                <td class="print_label align_right" style="width: 30%;">
                                    <?php echo $frieght; ?>
                                </td>
                                <td class="print_label align_right" style="width: 10%;">

                                </td>
                                </tr>
                                </tr>
                                <tr style="">
                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;">

                                    </td>
                                    <td class="print_label align_center" style="">
                                        Extra For
                                    </td>
                                    <td class="print_label align_right" style="">
                                        <?php echo $extra_for; ?>
                                    </td>
                                    <td class="print_label align_right" style="width: 10%;">

                                    </td>
                                </tr>
                                </tr>
                                <tr style="">

                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;">
                                        For<u>&nbsp;&nbsp;<?php echo "   " . $rate_per_kg . "    "; ?>&nbsp;&nbsp;</u>Kgs.
                                </td>
                                <td class="print_label align_center" style="">
                                    TOTAL
                                </td>
                                <td class="print_label align_right" style="">
                                    <?php echo $total; ?>
                                </td>
                                <td class="print_label align_right" style="width: 10%;">

                                </td>
                                </tr>
                                </tr>
                                <tr style="">

                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;">

                                    </td>
                                    <td class="print_label align_center" style="">
                                        Advance
                                    </td>
                                    <td class="print_label align_right" style="">
                                        <?php echo $advance; ?>
                                    </td>
                                    <td class="print_label align_right" style="width: 10%;">

                                    </td>
                                </tr>

                                <tr style="">
                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;">

                                    </td>
                                    <td class="print_label align_center" style="">
                                        Less T.D.S
                                    </td>
                                    <td class="print_label align_right" style="">
                                        <?php echo $less_tds; ?>
                                    </td>
                                    <td class="print_label align_right" style="width: 10%;">

                                    </td>
                                </tr>

                                <tr style="">
                                    <td class="print_label align_center" style="">

                                    </td>
                                    <td class="print_label align_center" style="">
                                        Balance
                                    </td>
                                    <td class="print_label align_right" style="">
                                        <?php echo $balance; ?>
                                    </td>
                                    <td class="print_label align_right" style="width: 10%;">

                                    </td>
                                </tr>
                                <tr style="">
                                    <td class="print_label align_left" style="border-top:1px solid #FFF;border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;padding-top: 40px;text-align: left;">
                                        Rupees in Words:
                                    </td>
                                    <td class="print_label align_center" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;padding-top: 40px;text-align: left;"colspan="3">
                                        Rupees <?php echo number_to_words($balance); ?> Only.
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <table cellspacing="0" style=" border:1px solid #000000; margin-top:-20px; width:450px;  margin:auto;" rules="all" class="table_print_letterhead">
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 50%;margin-top: 20px;">
                                        PAN NO:AAACW6413A
                                    </td>
                                    <td class="print_label" align="center" style="padding-left:2em;width: 50%;">
                                        <?php echo $city; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 50%;margin-top: 20px;">
                                        Balance Hire Charges will be paid after Receiving the goods in condition at destination against original copy only.
                                    </td>
                                    <td class="print_label" align="center" style="padding-left:2em;width: 50%;">
                                        TOTAL PKGS: <?php echo $total_packages; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="print_content" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 20%;margin-top: 20px;" colspan="2">
                                        I accept all the terms & conditions mentioned above and agreed to deliver the goods in the same condition.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 50%;margin-top: 20px;text-align: left;padding-top: 30px;">
                                        Driver's Signature,
                                    </td>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 50%;margin-top: 20px;text-align: right;padding-top: 30px;">
                                        Dispatch Incharges,
                                    </td>
                                </tr>
                                <tr>
                                    <td class="print_label" style="border-bottom:1px solid #FFF;border-right:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 20%;margin-top: 20px;text-align: center;" colspan="2">
                                        No unloading on Saturday,Sunday,Holiday & after office Hours.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <table cellspacing="0" style=" margin-top:-20px; width:900px;  margin:auto;margin-top:15px;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td  class="print_label align_center" style="border-bottom:1px solid #FFF;font-size: 14px; text-align: justify;" colspan="3">
                                ENGINE NO., CHASSIS NO., DOCUMENTS, TYRE, BROKER SLIP, TRAPAULINS, LORRY ENGAGEMENT FORM ETC.
                            </td>
                        <tr>
                            <td  class="print_label align_left" style="border-right:1px solid #FFF;padding-top: 25px;">
                                Checked by_______________
                            </td>
                            <td  class="print_label align_center" style="border-right:1px solid #FFF;padding-top: 25px;text-align: center;font-size: 16px;">
                                No.<?php echo $stationary_no; ?>
                            </td>
                            <td  class="print_label align_right" style="padding-top: 25px;">
                                ACCOUNTS COPY______________
                            </td>
                        </tr>
                        </tr>
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