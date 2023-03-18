<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$tablename = 'sr_payments';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payments
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Payments</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div id="ajaxloader" class="overlay">
                        <div class="loader_block">
                            <img src="../../theme/img/ajax-loader1.gif" class="loader_img"/>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Inv. Type</th>
                                    <th>Inv. Number</th>
                                    <th>Pmt. Date</th>
                                    <th>Amt. Received</th>
                                    <th>Pmt. Mode</th>
                                    <th>Description</th>
                                    <th>Received From</th>
                                    <th>Received By</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                            <th class="no-print">Inv. Type</th>
                            <th class="no-print">Inv. Number</th>
                            <th class="no-print">Pmt. Date</th>
                            <th class="no-print">Amt. Received</th>
                            <th class="no-print">Pmt. Mode</th>
                            <th class="no-print">Description</th>
                            <th class="no-print">Received From</th>
                            <th class="no-print">Received By</th>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,invoice_type,invoice_no,payment_date,amount_received,payment_mode,payment_description,received_from,received_by from $tablename where invoice_type='" . $_REQUEST["type"] . "' and invoice_no='" . $_REQUEST["invoice_no"] . "' order by payment_date desc";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["invoice_type"] ?></td>
                                        <td><?php echo $UDB->Record["invoice_no"] ?></td>
                                        <td><?php echo $UDB->Record["payment_date"] ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $UDB->Record["amount_received"], 2, '.', ','); ?>
                                        </td>
                                        <td><?php echo $UDB->Record["payment_mode"] ?></td>
                                        <td><?php echo $UDB->Record["payment_description"] ?></td>
                                        <td><?php echo $UDB->Record["received_from"] ?></td>
                                        <td><?php echo $UDB->Record["received_by"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>