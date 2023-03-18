<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'bilty_form.php';
$action_page = 'bilty_action.php';
$child_form_page = 'lorry_chellan_form.php';
$vehicle_placement_page = 'vehicle_placement_closed_operation_grid.php';
$tablename = 'sr_bilty';
$print_page = 'bilty_print.php';
$return_page = '../accounts/bilty_grid.php';
//$excel_export_page = '../../functions/excel_export/excel_export_userdb_custom.php';
//$excel_condition = "booking_status='Not Yet Placed' order by order_no";
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bilty
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Bilty</li>
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
                                    <td colspan="15">
                                        <a href="<?php echo $vehicle_placement_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Order No.</th>
                                    <th>SO No.</th>
                                    <th>Consignor Name</th>
                                    <th>Consignment Note No.</th>
                                    <th>Consignment Date</th>
                                    <th>Booking Address</th>
                                    <th>Delivery Address</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Order No.</th>
                                    <th>SO No.</th>
                                    <th>Consignor Name</th>
                                    <th>Consignment Note No.</th>
                                    <th>Consignment Date</th>
                                    <th>Booking Address</th>
                                    <th>Delivery Address</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,order_no,order_date,so_no,so_date,consignor_name,consignor_address_line1,consignor_address_line2,consignor_city,consignor_pincode,po_no,consignor_invoice_no,consignor_tin_no,consignment_note_no,consignment_date,lane_from,lane_to,consignee_account_no,consignee_account_name,consignee_bank,consignee_branch,booking_company_name,booking_address_line1,booking_address_line2,booking_city,booking_pincode,delivery_company_name,delivery_address_line1,delivery_address_line2,delivery_city,bill_party,bill_vide_permit_no,delivery_pincode,service_tax_payable_by,packing,private_note,bill_type,total_frieght,hamall,sur_charges,st_charges,risk_charges,checkpost,fov,total,insurance,insurance_company,policy_no,insurance_date,insurance_amount,risk  from $tablename where bilty_status='Not Yet Released'";
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
                                                                <a href="<?php echo $action_page; ?>?order_no=<?php echo $UDB->Record["order_no"] ?>&form_action=Delete" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $UDB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a>
                                            <a href="<?php echo $child_form_page . "?order_no=" . $UDB->Record["order_no"]; ?>" title="Lorry Chellan"><i class="fa fa-fw fa-plus-circle"></i></a>
                                        </td>
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

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>