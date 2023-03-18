<?php
include'../../template/accounts/header.default.php';

$actionpage = "../../functions/excel_export/excel_export_performance_report_date.php";
$actionpage1 = "dashboard.php";
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php
        if ($systemexpire_amcexpire_status == True) {
            ?>
            <!--
    <div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>
        <b style="font-size:16px">Your AMC Contract has Closed</b><br><br>
        <span style="line-height:20px; color:#000000;">
            Your <b>AMC Contract</b> has expired on <b><?php echo AMCEND ?></b>. Renew your contract to get cost free service from <a href="<?php echo COMPANYURL ?>" target="_blank"><b><?php echo COMPANYNAME ?></b></a> with one year validity.<br>
            To contact your system administrator please <a href="mailto:<?php echo COMPANYMAIL ?>?Subject=AMC Renewal Request" target="_top"><b>Click here</b></a> or send mail to <?php echo COMPANYMAIL ?>.
        </span>
    </center>
    </div>
            -->
            <?php
        }
        ?>


        <div class="row">
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as order_count from sr_bilty where bilty_status='Not Yet Released' ";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $order_count = $UDB->Record["order_count"];
                            }
                            echo $order_count;
                            ?>
                        </h3>
                        <p>
                            Bilty
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <a href="bilty_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as dispatch_count from  sr_lorry_chellan where  lc_status='Not Yet Released'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $dispatch_count = $UDB->Record["dispatch_count"];
                            }
                            echo $dispatch_count;
                            ?>
                        </h3>
                        <p>
                            Lorry Chellan
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa   fa-book"></i>
                    </div>
                    <a href="lorry_chellan_grid.php" class="small-box-footer">
                        More info <i class="fa  fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as lar_count from  sr_lorry_arrival_report where lar_status='Not Yet Released'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $lar_count = $UDB->Record["lar_count"];
                            }
                            echo $lar_count;
                            ?>
                        </h3>
                        <p>
                            Lorry Arrival Report
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <a href="lorry_arrival_report_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as delivery_count from  sr_frieght_bill where frieght_status<>'Close'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $delivery_count = $UDB->Record["delivery_count"];
                            }
                            echo $delivery_count;
                            ?>
                        </h3>
                        <p>
                            Frieght Bill
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa  fa-pencil-square-o"></i>
                    </div>
                    <a href="frieght_bill_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as mr_count from  sr_money_receipt";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $mr_count = $UDB->Record["mr_count"];
                            }
                            echo $mr_count;
                            ?>
                        </h3>
                        <p>
                            Money Receipt
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa  fa-money"></i>
                    </div>
                    <a href="money_receipt_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">

                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3>
                            <?php
                            $Query = "SELECT  count(*) as pa_count from  sr_payment_advice";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $pa_count = $UDB->Record["pa_count"];
                            }
                            echo $pa_count;
                            ?>
                        </h3>
                        <p>
                            Payment Advice
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="payment_advice_grid.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div style="height:15px;clear:both;"></div>

        <!--Start -->
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Bilty</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Lorry Chellan</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Lorry Arrival Report</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Frieght Bill</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Money Receipt</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Payment Advice</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>SO No.</th>
                                            <th>Consignor Name</th>
                                            <th>Consignment Note No.</th>
                                            <th>Consignment Date</th>
                                            <th>Booking Address</th>
                                            <th>Delivery Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT id,order_no,order_date,so_no,so_date,consignor_name,consignor_address_line1,consignor_address_line2,consignor_city,consignor_pincode,po_no,consignor_invoice_no,consignor_tin_no,consignment_note_no,consignment_date,lane_from,lane_to,consignee_account_no,consignee_account_name,consignee_bank,consignee_branch,booking_company_name,booking_address_line1,booking_address_line2,booking_city,booking_pincode,delivery_company_name,delivery_address_line1,delivery_address_line2,delivery_city,bill_party,bill_vide_permit_no,delivery_pincode,service_tax_payable_by,packing,private_note,bill_type,total_frieght,hamall,sur_charges,st_charges,risk_charges,checkpost,fov,total,insurance,insurance_company,policy_no,insurance_date,insurance_amount,risk  from sr_bilty where bilty_status='Not Yet Released'";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"] ?></td>
                                                <td><?php echo $UDB->Record["so_no"] ?></td>
                                                <td><?php echo $UDB->Record["consignor_name"] ?></td>
                                                <td><?php echo $UDB->Record["consignment_note_no"]; ?></td>
                                                <td><?php echo $UDB->Record["consignment_date"]; ?></td>
                                                <td><?php echo $UDB->Record["booking_company_name"] . '<br>' . $UDB->Record["booking_address_line1"] . '<br>' . $UDB->Record["booking_address_line2"] . '<br>' . $UDB->Record["booking_city"] . '-<br>' . $UDB->Record["booking_pincode"]; ?></td>
                                                <td><?php echo $UDB->Record["delivery_company_name"] . '<br>' . $UDB->Record["delivery_address_line1"] . '<br>' . $UDB->Record["delivery_address_line2"] . '<br>' . $UDB->Record["booking_city"] . '-<br>' . $UDB->Record["booking_pincode"]; ?></td>

                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>SO No.</th>
                                            <th>Consignor Name</th>
                                            <th>Consignment Note No.</th>
                                            <th>Consignment Date</th>
                                            <th>Booking Address</th>
                                            <th>Delivery Address</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Lorry Chellan No</th>
                                            <th>Chellan Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Lorry No</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT  id,order_no,lorry_chellan_no,lorry_chellan_date,lorry_from,lorry_to,lorry_no,delivery_date from sr_lorry_chellan where lc_status='Not Yet Released'";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"] ?></td>
                                                <td><?php echo $UDB->Record["lorry_chellan_no"] ?></td>
                                                <td><?php echo $UDB->Record["lorry_chellan_date"]; ?></td>
                                                <td><?php echo $UDB->Record["lorry_from"]; ?></td>
                                                <td><?php echo $UDB->Record["lorry_to"]; ?></td>
                                                <td><?php echo $UDB->Record["lorry_no"]; ?></td>
                                                <td><?php echo $UDB->Record["delivery_date"]; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Lorry Chellan No</th>
                                            <th>Chellan Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Lorry No</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>LAR No</th>
                                            <th>Lorry No</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Reporting Date</th>
                                            <th>Packages Load</th>
                                            <th>Packages Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT id,order_no,lar_no,lorry_no,lorry_from,lorry_to,reporting_date,packages_load,packages_received from sr_lorry_arrival_report where lar_status='Not Yet Released'";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"] ?></td>
                                                <td><?php echo $UDB->Record["lar_no"] ?></td>
                                                <td><?php echo $UDB->Record["lorry_no"]; ?></td>
                                                <td><?php echo $UDB->Record["lorry_from"]; ?></td>
                                                <td><?php echo $UDB->Record["lorry_to"]; ?></td>
                                                <td><?php echo $UDB->Record["reporting_date"]; ?></td>
                                                <td><?php echo $UDB->Record["packages_load"]; ?></td>
                                                <td><?php echo $UDB->Record["packages_received"]; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order No</th>
                                            <th>LAR No</th>
                                            <th>Lorry No</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Reporting Date</th>
                                            <th>Packages Load</th>
                                            <th>Packages Received</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bill No</th>
                                            <th>Bill Date</th>
                                            <th>Branch</th>
                                            <th>Client Name</th>
                                            <th>Service Tax Payable By</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT id,branch,client_name,service_tax_payable_by,bill_no,bill_date,frieght_status from sr_frieght_bill where frieght_status<>'Close'";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["bill_no"]; ?></td>
                                                <td><?php echo $UDB->Record["bill_date"]; ?></td>
                                                <td><?php echo $UDB->Record["branch"] ?></td>
                                                <td><?php echo $UDB->Record["client_name"]; ?></td>
                                                <td><?php echo $UDB->Record["service_tax_payable_by"]; ?></td>
                                                <td><?php echo $UDB->Record["frieght_status"]; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Bill No</th>
                                            <th>Bill Date</th>
                                            <th>Branch</th>
                                            <th>Client Name</th>
                                            <th>Service Tax Payable By</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_5">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Client Name</th>
                                            <th>Branch</th>
                                            <th>B.M.R No</th>
                                            <th>B.M.R Date</th>
                                            <th>Receipt Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT id,order_no,client_name,branch,bmr_no,bmr_date,mr_date,mr_status from sr_money_receipt";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["order_no"]; ?></td>
                                                <td><?php echo $UDB->Record["client_name"]; ?></td>
                                                <td><?php echo $UDB->Record["branch"]; ?></td>
                                                <td><?php echo $UDB->Record["bmr_no"] ?></td>
                                                <td><?php echo $UDB->Record["bmr_date"]; ?></td>
                                                <td><?php echo $UDB->Record["mr_date"]; ?></td>
                                                <td><?php echo $UDB->Record["mr_status"]; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Client Name</th>
                                            <th>Branch</th>
                                            <th>B.M.R No</th>
                                            <th>B.M.R Date</th>
                                            <th>Receipt Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_6">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Document No</th>
                                            <th>Cheque No</th>
                                            <th>Cheque Date</th>
                                            <th>Bank</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Query = "SELECT id,client_name,document_no,cheque_no,cheque_date,bank_name,cheque_amount,pa_status from sr_payment_advice";
                                        $UDB->query($Query);
                                        while ($UDB->Multicoloums()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $UDB->Record["client_name"]; ?></td>
                                                <td><?php echo $UDB->Record["document_no"]; ?></td>
                                                <td><?php echo $UDB->Record["cheque_no"] ?></td>
                                                <td><?php echo $UDB->Record["cheque_date"]; ?></td>
                                                <td><?php echo $UDB->Record["bank_name"]; ?></td>
                                                <td><?php echo $UDB->Record["cheque_amount"]; ?></td>
                                                <td><?php echo $UDB->Record["pa_status"]; ?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Document No</th>
                                            <th>Cheque No</th>
                                            <th>Cheque Date</th>
                                            <th>Bank</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
        </div> <!-- /.row -->
        <!-- End -->

    </section>
</aside>

<?php include'../../template/common/footer.default.php'; ?>