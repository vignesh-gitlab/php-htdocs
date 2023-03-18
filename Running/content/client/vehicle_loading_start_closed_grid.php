<?php include'../../template/client/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_loading_start_form.php';
$child_form_page = 'vehicle_loading_end_form.php';
//$child_form_page = 'vehicle_dispatch_form.php';
$tablename = 'sr_vehicle_loading_start';
$return_page = '../client/vehicle_loading_start_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "loading_status='Loaded' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Loading - Start - Closed
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reports</li>
            <li class="active">Vehicle Loading - Start - Closed</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td colspan="20">
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename . "&condition=" . $excel_condition ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Placement Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Loading Start Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,action_user from $tablename where loading_status='Loaded'  and client_name='" . $Display_Name . "' order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["placement_date"] . " " . $UDB->Record["placement_time"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["loading_start_date"] . " " . $UDB->Record["loading_start_time"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Placement Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Loading Start Date & Time</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>