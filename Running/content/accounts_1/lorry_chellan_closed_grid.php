<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$tablename = 'sr_lorry_chellan';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Chellan - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Lorry Chellan - Closed</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Lorry Chellan NO</th>
                                    <th>Chellan Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Lorry No</th>
                                    <th>Delivery Date</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Order Number</th>
                                    <th>Lorry Chellan NO</th>
                                    <th>Chellan Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Lorry No</th>
                                    <th>Delivery Date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT  id,order_no,lorry_chellan_no,lorry_chellan_date,lorry_from,lorry_to,lorry_no,delivery_date from $tablename where lc_status='Released'";
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

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>