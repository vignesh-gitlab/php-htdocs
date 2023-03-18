<?php
include'../../template/client_division/header.default.php';

$actionpage = 'lorry_arrival_report_action.php';
$tablename1 = 'sr_lorry_arrival_report';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,order_no,order_date,so_no,so_date,lar_no,branch,stationary_no,lorry_no,lar_date,lorry_from,dispatched_on,lorry_to,reporting_date,chellan_no,unloading_date,packages_load,packages_received,weight_received,weight_loaded,weight_loss,short_received,short_loss,damage_received,damage_loss,remarks_received,remarks_loss,consignment_received,consignment_loss,party_name_received,party_name_loss from $tablename1 where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $order_date = $UDB->Record["order_date"];
        $so_no = $UDB->Record["so_no"];
        $so_date = $UDB->Record["so_date"];
        $lar_no = $UDB->Record["lar_no"];
        $branch_code = $UDB->Record["branch"];
        $stationary_no = $UDB->Record["stationary_no"];
        $lorry_no = $UDB->Record["lorry_no"];
        $lar_date = $UDB->Record["lar_date"];
        $lorry_from = $UDB->Record["lorry_from"];
        $dispatched_on = $UDB->Record["dispatched_on"];
        $lorry_to = $UDB->Record["lorry_to"];
        $reporting_date = $UDB->Record["reporting_date"];
        $chellan_no = $UDB->Record["chellan_no"];
        $unloading_date = $UDB->Record["unloading_date"];
        $packages_load = $UDB->Record["packages_load"];
        $packages_received = $UDB->Record["packages_received"];
        $weight_loaded = $UDB->Record["weight_loaded"];
        $weight_received = $UDB->Record["weight_received"];
        $weight_loss = $UDB->Record["weight_loss"];
        $short_received = $UDB->Record["short_received"];
        $short_loss = $UDB->Record["short_loss"];
        $damage_received = $UDB->Record["damage_received"];
        $damage_loss = $UDB->Record["damage_loss"];
        $remarks_received = $UDB->Record["remarks_received"];
        $remarks_loss = $UDB->Record["remarks_loss"];
        $consignment_received = $UDB->Record["consignment_received"];
        $consignment_loss = $UDB->Record["consignment_loss"];
        $party_name_received = $UDB->Record["party_name_received"];
        $party_name_loss = $UDB->Record["party_name_loss"];
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
            Lorry Arrival Report
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="lorry_arrival_report_grid.php">Lorry Arrival Report</a></li>
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
                    <table cellspacing="0" style=" width:700px; margin:auto;" rules="all" class="table_print_letterhead">
                        <thead>

                        <td colspan="3" style="height:22px; vertical-align:middle;border-bottom:1px solid #FFF;">
                            <div class="print_label_large align_center">
                                LORRY ARRIVAL REPORT
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

                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:700px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;">
                                Branch :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 39%;">
                                <?php echo $city; ?>
                            </td>
                            <td class="print_content" style=" padding-left:10em;width: 50%;"colspan="2">
                                <?php echo $lar_no; ?>
                            </td>

                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                Lorry No :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 39%;">
                                <?php echo $lorry_no; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Dated :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $lar_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                From :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 39%;">
                                <?php echo $lorry_from; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Dispatched on :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $dispatched_on; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                To :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 39%;">
                                <?php echo $lorry_to; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Reporting Date :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $reporting_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_label" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; width: 15%;margin-top: 20px;">
                                Ch.No. :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 39%;">
                                <?php echo $chellan_no; ?>
                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Unloading Date :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $unloading_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF; border-right:1px solid #FFF; width: 15%;margin-top: 20px;">

                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;border-right:1px solid #FFF; width: 39%;margin-top: 20px;">

                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Packages Loaded :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $packages_load; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;border-right:1px solid #FFF; width: 15%;margin-top: 20px;">

                            </td>
                            <td class="print_content" style="border-bottom:1px solid #FFF;border-left:1px solid #FFF;border-top:1px solid #FFF;border-right:1px solid #FFF; width: 39%;margin-top: 20px;">

                            </td>
                            <td class="print_label" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;padding-left:2em;width: 23%;text-align: right;">
                                Packages Received :
                            </td>
                            <td class="print_content" style="padding-left:2em;width: 23%;">
                                <?php echo $packages_received; ?>
                            </td>
                        </tr>
                    </table>
                    <div style="height:10px;"></div>
                    <table cellspacing="0" style="border:1px solid #000000; margin-top:-20px; width:700px;  margin:auto;" rules="all" class="table_print_letterhead">
                        <tr style="">
                            <td class="print_content_small" align="center" colspan="4">

                            </td>
                            <td class="print_label" align="center" style="width: 20%;">
                                Value Of Loss
                            </td>
                        </tr>
                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px; width: 20%;border-right:1px solid #FFF;">    Weight Loaded :

                            </td>
                            <td class="print_content_small" align="left" style=" width: 20%;border-right:1px solid #FFF;">
                                <?php echo $weight_loaded; ?>
                            </td>
                            <td class="print_label" align="center" style="  width: 20%;border-right:1px solid #FFF;">
                                Received :
                            </td>
                            <td class="print_content_small" align="left" style="  width: 20%;">
                                <?php echo $weight_received; ?>
                            </td>
                            <td class="print_label" align="center" style="width: 20%;">
                                <?php echo $weight_loss; ?>
                            </td>
                        </tr>

                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px;width: 20%;border-right:1px solid #FFF;">
                                Short/Excess :
                            </td>
                            <td class="print_content_small" align="center" style=""colspan="3">
                                <?php echo $short_received; ?>
                            </td>
                            <td class="print_content_small" align="center"  style="width: 20%;">
                                <?php echo $short_loss; ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px;width: 20%;border-right:1px solid #FFF;">
                                Damage :
                            </td>
                            <td class="print_content_small" align="center" style=""colspan="3">
                                <?php echo $damage_received; ?>
                            </td>
                            <td class="print_content_small" align="center"  style="width: 20%;">
                                <?php echo $damage_loss; ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px;width: 20%;border-right:1px solid #FFF;">
                                Other Remarks :
                            </td>
                            <td class="print_content_small" align="center" style=""colspan="3">
                                <?php echo $remarks_received; ?>
                            </td>
                            <td class="print_content_small" align="center" style="width: 20%;">
                                <?php echo $remarks_loss; ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px;width: 20%;border-right:1px solid #FFF;">
                                Consignment No :
                            </td>
                            <td class="print_content_small" align="center" style=""colspan="3">
                                <?php echo $consignment_received; ?>
                            </td>
                            <td class="print_content_small"  align="center" style="width: 20%;">
                                <?php echo $consignment_loss; ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td class="print_label" align="center" style=" height:45px;width: 20%;border-right:1px solid #FFF;">
                                Vehicle Type :
                            </td>
                            <td class="print_content_small" align="center" style=""colspan="4">
                                <?php echo $party_name_received; ?>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" style="border-right:1px solid #FFF; width:700px; margin:auto;margin-top: 35px;" rules="all" class="table_print_letterhead">
                        <tr>
                            <td  align="left" style="width:40%;border-bottom:1px solid #FFF;">

                            </td>
                            <td  align="Center" style="width:20%; border-bottom:1px solid #FFF;text-align: center;font-size: 24px; " rowspan="2">
                                <strong>  NO.<?php echo $stationary_no; ?></strong>
                            </td>
                            <td  align="right" style="width:40%; border-bottom:1px solid #FFF; ">

                        </tr>
                        <tr>
                            <td  align="left" style="width:40%; padding-left: 10px;padding-top: 10px;">
                                <strong> Signature Of Lorry Owner / Driver</strong>

                            </td>
                            <td  align="right" style="width:40%;  padding-right: 10px;">
                                <strong> Signature of Incharge</strong>
                            </td>
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