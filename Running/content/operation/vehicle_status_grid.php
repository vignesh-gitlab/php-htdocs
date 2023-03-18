<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vehicle_status_form.php';
$child_form_page = 'vehicle_landing_form.php';
$tablename = 'sr_vehicle_status';
$return_page = '../operation/vehicle_status_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_vehicle_status.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Delay Status
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Operation</li>
            <li class="active">Vehicle Delay Status</li>
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
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename; ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>LR Number</th>
                                    <th>Client</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>EDD</th>
                                    <th>Status Date & Time</th>
                                    <th>Current Location</th>
                                    <th>Delay Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$Query = "SELECT id,order_no,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery,status_date_time,vehicle_current_position,remarks,delay_reason,expected_delay_time,action_user from $tablename where vehicle_status='Status Updated' order by order_no";
                                $Query = "SELECT t1.id,t1.order_no,t1.client_name,t1.client_division,t1.client_branch,t1.orgin,t1.destination,t1.vehicle_type,t1.vehicle_no,t1.dispatch_date,t1.dispatch_time,t1.expected_dateof_delivery,t1.status_date_time,t1.vehicle_current_position,t1.remarks,t1.delay_reason,t1.expected_delay_time,t1.action_user,t2.lr_no from sr_vehicle_status t1,sr_vehicle_dispatch t2 where t1.vehicle_status='Status Updated' and t1.order_no=t2.order_no  and t1.delay_reason<>'' order by t1.order_no";
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
                                            <!--
    <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
    <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Unloading Status"><i class="fa fa-fw fa-plus-circle"></i></a>
                                            -->
                                        </td>
                                        <td><?php echo $UDB->Record["order_no"] ?></td>
                                        <td><?php echo $UDB->Record["lr_no"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] . "<br>" . $UDB->Record["client_division"] . "<br>" . $UDB->Record["client_branch"] ?></td>
                                        <td><?php echo $UDB->Record["orgin"]; ?></td>
                                        <td><?php echo $UDB->Record["destination"]; ?></td>
                                        <td><?php echo $UDB->Record["vehicle_type"] . " - " . $UDB->Record["vehicle_no"] ?></td>
                                        <td><?php echo $UDB->Record["dispatch_date"] . " " . $UDB->Record["dispatch_time"] ?></td>
                                        <td><?php echo $UDB->Record["expected_dateof_delivery"] ?></td>
                                        <td><?php echo $UDB->Record["status_date_time"] ?></td>
                                        <td><?php echo $UDB->Record["vehicle_current_position"] . " - " . $UDB->Record["remarks"] ?></td>
                                        <td><?php echo $UDB->Record["delay_reason"] . " - " . $UDB->Record["expected_delay_time"] ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Action</th>
                                    <th>Order Number</th>
                                    <th>LR Number</th>
                                    <th>Client</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Vehicle Details</th>
                                    <th>Dispatch Date & Time</th>
                                    <th>EDD</th>
                                    <th>Status Date & Time</th>
                                    <th>Current Location</th>
                                    <th>Delay Details</th>
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