<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="active">
        <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-exchange"></i>
            <span>Track Vehicle</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="track_vehicle.php"><i class="fa fa-angle-double-right"></i> <span>By Vehicle Number</span></a></li>
            <li><a href="track_vehicle_all.php"><i class="fa fa-angle-double-right"></i> <span>By Vendor Name</span></a></li>
            <li><a href="track_vehicle_atic.php"><i class="fa fa-angle-double-right"></i> <span>ATIC Location List</span></a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-book"></i>
            <span>Booking</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="customer_order_grid.php"><i class="fa fa-angle-double-right"></i>Order</a></li>
            <li><a href="vehicle_booking_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Booking</a></li>
            <li><a href="vehicle_placement_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Placement</a></li>
        </ul>
    </li>

    <li clas<li class="treeview">
        <a href="#">
            <i class="fa fa-upload"></i>
            <span>Loading & Dispatch</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <?php
            $Query = "SELECT count(*)as dispatch_count from sr_vehicle_dispatch where dispatch_status='Not Yet Reached' and expected_dateof_delivery='" . $cur_date . "'";
            $UDB->query($Query);
            while ($UDB->Multicoloums()) {
                $dispatch_count = $UDB->Record["dispatch_count"];
            }

            $delay_count = 0;
            $Query = "SELECT expected_dateof_delivery from sr_vehicle_dispatch where dispatch_status='Not Yet Reached'";
            $UDB->query($Query);
            while ($UDB->Multicoloums()) {

                $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];

                $now = time(); // or your date as well
                $your_date = strtotime($expected_dateof_delivery);
                $datediff = $now - $your_date;
                $diff = floor($datediff / (60 * 60 * 24));

                if ($diff > 0) {
                    $delay_count = $delay_count + 1;
                }
            }
            ?>
            <li><a href="vehicle_loading_start_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Loading-Start</a></li>
            <li><a href="vehicle_loading_end_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Loading-End</a></li>
            <li><a href="vehicle_dispatch_grid.php"><small class="badge pull-right bg-blue"><?php echo $dispatch_count; ?></small><i class="fa fa-angle-double-right"></i>Vehicle Dispatch EDD</a></li>
            <li><a href="vehicle_dispatch_edd_grid.php"><small class="badge pull-right bg-blue"><?php echo $delay_count; ?></small><i class="fa fa-angle-double-right"></i>Vehicle Delay EDD</a></li>
            <li><a href="vehicle_transit_status_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Transit Status</a></li>
            <li><a href="vehicle_status_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Delay Status</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-download"></i>
            <span>Landing & Reporting</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="vehicle_landing_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Landing</a></li>
            <li><a href="vehicle_unloading_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Unloading</a></li>
            <li><a href="vehicle_reporting_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Reporting</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-truck"></i>
            <span>Reports</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <!--
            <li><a href="shipment_status_grid.php"><i class="fa fa-angle-double-right"></i>Order Status</a></li>
            -->
            <li><a href="closed_shipments_grid.php"><i class="fa fa-angle-double-right"></i>Closed Shipments</a></li>
            <li><a href="onprogress_shipments_grid.php"><i class="fa fa-angle-double-right"></i>On Progress Shipments</a></li>
            <li class="treeview">
                <a href="#"><i class="fa  fa-angle-double-right"></i><span>Closed Stage Shipments</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="customer_order_closed_grid.php"><i class="fa fa-angle-double-right"></i>Order</a></li>
                    <li><a href="vehicle_booking_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Booking</a></li>
                    <li><a href="vehicle_placement_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Placement</a></li>
                    <li><a href="vehicle_loading_start_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Loading Start</a></li>
                    <li><a href="vehicle_loading_end_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Loading End</a></li>
                    <li><a href="vehicle_dispatch_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Dispatch</a></li>
                    <li><a href="vehicle_status_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Status</a></li>
                    <li><a href="vehicle_landing_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Landing</a></li>
                    <li><a href="vehicle_unloading_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Unloading</a></li>
                    <li><a href="vehicle_reporting_closed_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Reporting</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa  fa-angle-double-right"></i><span>Email</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="mail_upload_grid.php"><i class="fa fa-angle-double-right"></i>Upload</a></li>
                    <li><a href="mail_delivery_grid.php"><i class="fa fa-angle-double-right"></i>Delivery</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa  fa-angle-double-right"></i><span>SMS</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="sms_upload_grid.php"><i class="fa fa-angle-double-right"></i>Upload</a></li>
                    <li><a href="sms_delivery_grid.php"><i class="fa fa-angle-double-right"></i>Delivery</a></li>
                </ul>
            </li>
            <!--
            <li><a href="mail_delivery_grid.php"><i class="fa fa-angle-double-right"></i>Mail Delivery</a></li>
            <li><a href="sms_delivery_grid.php"><i class="fa fa-angle-double-right"></i>SMS Delivery</a></li>
            <li><a href="sms_upload_grid.php"><i class="fa fa-angle-double-right"></i>SMS Upload</a></li>
            -->
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-book"></i>
            <span>Data</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="client_grid.php"><i class="fa fa-angle-double-right"></i>Client</a></li>
            <li><a href="client_division_grid.php"><i class="fa fa-angle-double-right"></i>Client Division</a></li>
            <li><a href="client_branch_grid.php"><i class="fa fa-angle-double-right"></i>Client Branch</a></li>
            <li><a href="vendor_grid.php"><i class="fa fa-angle-double-right"></i>Vendor</a></li>
            <li><a href="vehicle_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle</a></li>
            <li><a href="escort_grid.php"><i class="fa fa-angle-double-right"></i>Escort</a></li>
            <li><a href="supervisor_grid.php"><i class="fa fa-angle-double-right"></i>Loading Supervisor</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-building-o"></i>
            <span>Master</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="company_grid.php"><i class="fa fa-angle-double-right"></i>Company</a></li>
            <li><a href="branch_grid.php"><i class="fa fa-angle-double-right"></i>Branch</a></li>
            <li><a href="user_creation_grid.php"><i class="fa fa-angle-double-right"></i>System User</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-building-o"></i>
            <span>Sub Master</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="service_product_grid.php"><i class="fa fa-angle-double-right"></i>Service / Product</a></li>
            <li><a href="vehicle_type_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Type</a></li>
            <li><a href="vehicle_ownership_grid.php"><i class="fa fa-angle-double-right"></i>Vehicle Ownership</a></li>
            <li><a href="contract_status_grid.php"><i class="fa fa-angle-double-right"></i>Contract Status</a></li>
            <li><a href="port_grid.php"><i class="fa fa-angle-double-right"></i>Port</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-share-square-o"></i>
            <span>Backup</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="db_backup.php?database_name=srinfosoft_trackandtrace"><i class="fa fa-angle-double-right"></i>Master DB</a></li>
            <li class="treeview">
                <a href="#"><i class="fa  fa-angle-double-right"></i><span>Financial Year DB</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="db_backup.php?database_name=srinfosoft_trackandtrace20142015"><i class="fa fa-angle-double-right"></i>2014-2015</a></li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Setting</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">	
            <li><a href="change_password.php"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
            <li><a href="../common/signin.php"><i class="fa fa-angle-double-right"></i>Signout</a></li>
        </ul>
    </li>
</ul>