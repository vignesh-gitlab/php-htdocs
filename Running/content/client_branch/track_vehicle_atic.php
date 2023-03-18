<?php
include'../../template/client_branch/header.default.php';
$tablename = 'sr_atic_vehicle_track_all';
$actionpage = "track_vehicle_all_action.php";
$excel_export_page = '../../functions/excel_export/excel_export_userdb.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Track Vehicle - Atic
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div style="height:15px;clear:both;"></div>
        <div class="tab-pane active" id="tab_1">
            <div class="box-body table-responsive">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Vehicle Number</th>
                            <th>Date and Time</th>
                            <th>Vehicle Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Query = "SELECT id,vehicle_number,track_date_time,track_location from $tablename";
                        $UDB->query($Query);
                        while ($UDB->Multicoloums()) {
                            ?>
                            <tr>
                                <td><?php echo $UDB->Record["vehicle_number"] ?></td>
                                <td><?php echo $UDB->Record["track_date_time"] ?></td>
                                <td><?php echo $UDB->Record["track_location"] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Vehicle Number</th>
                            <th>Date and Time</th>
                            <th>Vehicle Location</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.tab-pane -->
    </section>
</aside>

<?php include'../../template/common/footer.default.php'; ?>