<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$tablename = 'sr_lorry_arrival_report';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lorry Arrival Report - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History</li>
            <li class="active">Lorry Arrival Report - Closed</li>
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
                            <tfoot class="footer_row">
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
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,lar_no,lorry_no,lorry_from,lorry_to,reporting_date,packages_load,packages_received from $tablename where lar_status='Released'";
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

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>