<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_loading_end_form.php';
$child_form_page = 'vehicle_dispatch_form.php';
$tablename = 'sr_vehicle_loading_end';
$return_page = '../client_division/vehicle_loading_end_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
$excel_condition = "loading_status='Not Yet Dispatched' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Loading - End
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Operation</li>
            <li class="active">Vehicle Loading - End</li>
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
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Placement Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Loading Start Date & Time</th>
                                    <th>Loading End Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,action_user from $tablename where loading_status='Not Yet Dispatched'  and client_name='" . $Display_Name . "' and (client_division='" . $_SESSION["division"] . "' or client_division='" . $_SESSION["division1"] . "' or client_division='" . $_SESSION["division2"] . "') order by order_no";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <ul class="pull-left" style="list-style-type: none;display:block; margin:0px; padding: 0px;">
                                                <li class="dropdown pull-left">
                                                    <a href="#" data-toggle="dropdown">
                                                        <i class="fa fa-fw fa-trash-o" title="Delete"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="user-footer">
                                                            <div style="text-align:center;">
                                                                <p>Confirm Delete?</p>

                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                <a href="<?php echo $commonvar_userdb_deletepage; ?>?id=<?php echo $UDB->Record["id"] ?>&tablename=<?php echo $tablename ?>&returnpage=<?php echo $return_page ?>" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Dispatch Vehicle"><i class="fa fa-fw fa-plus-circle"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["placement_date"] . " " . $UDB->Record["placement_time"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["loading_start_date"] . " " . $UDB->Record["loading_start_time"] ?></td>
                                        <td><?php echo $UDB->Record["loading_end_date"] . " " . $UDB->Record["loading_end_time"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>Client</th>
                                    <th>Placement Date & Time</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Loading Start Date & Time</th>
                                    <th>Loading End Date & Time</th>
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