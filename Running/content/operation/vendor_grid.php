<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vendor_form.php';
$tablename = 'sr_vendor';
$return_page = '../operation/vendor_grid.php';
$view_page = 'vendor_view_grid.php';
$vendor_vehicle_page = 'vendor_vehicle_grid.php';
$excel_export_page = '../../functions/excel_export/excel_export_masterdb.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vendor
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Vendor</li>
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
                                    <td colspan="9">
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                        <a href="<?php echo $excel_export_page . "?tablename=" . $tablename; ?>" title="Download Excel"><i class="fa fa-fw fa-download"></i>&nbsp; Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Vendor Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Telephone Number</th>
                                    <th>Mobile Number</th>
                                    <th>Fax No</th>
                                    <th>Email ID</th>
                                    <th>Service / Product</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Vendor Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Telephone Number</th>
                                    <th>Mobile Number</th>
                                    <th>Fax No</th>
                                    <th>Email ID</th>
                                    <th>Service / Product</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,vendor_name,address_line1,address_line2,city,pincode,telephone_no,mobile_no,fax_no,email_id,service_product1,service_product2,service_product3,service_product4 from $tablename order by vendor_name";
                                $DB->query($Query);
                                while ($DB->Multicoloums()) {
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
                                                                <a href="<?php echo $commonvar_deletepage; ?>?id=<?php echo $DB->Record["id"] ?>&tablename=<?php echo $tablename ?>&returnpage=<?php echo $return_page ?>" id="delete_button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa fa-check"></i> Yes</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <a href="<?php echo $form_page . "?id=" . $DB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?php echo $view_page . "?id=" . $DB->Record["id"]; ?>" title="View Contact Details"><i class="fa fa-fw fa-indent"></i></a>
                                            <a href="<?php echo $vendor_vehicle_page . "?vendor_name=" . $DB->Record["vendor_name"]; ?>" title="View Vehicles"><i class="fa fa-fw fa-indent"></i></a>
                                        </td>
                                        <td><?php echo $DB->Record["vendor_name"] ?></td>
                                        <td>
                                            <?php
                                            echo $DB->Record["address_line1"] . ",<br>"
                                            . $DB->Record["address_line2"];
                                            ?>
                                        </td>
                                        <td><?php echo $DB->Record["city"] ?></td>
                                        <td><?php echo $DB->Record["telephone_no"] ?></td>
                                        <td><?php echo $DB->Record["mobile_no"] ?></td>
                                        <td><?php echo $DB->Record["fax_no"] ?></td>
                                        <td><?php echo $DB->Record["email_id"] ?></td>
                                        <td>
                                            <?php
                                            echo $DB->Record["service_product1"] . ","
                                            . $DB->Record["service_product2"] . ","
                                            . $DB->Record["service_product3"] . ","
                                            . $DB->Record["service_product3"];
                                            ?>
                                        </td>
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