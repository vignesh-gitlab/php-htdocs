<?php include'../../template/client/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'vendor_form.php';
$tablename = 'sr_vehicle';
$return_page = '../client/vendor_vehicle_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vendor Vehicle
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="vendor_grid.php">Vendor</a></li>
            <li class="active">Vendor Vehicle</li>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Vehicle Type</th>
                                    <th>Registration No.</th>
                                    <th>Model No.</th>
                                    <th>Color</th>
                                    <th>Description</th>
                                    <th>Permit Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,vendor_name,vehicle_type,model_no,color,registration_no,description,permit_type from $tablename where vendor_name='" . $_REQUEST["vendor_name"] . "'";
                                $DB->query($Query);
                                while ($DB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $DB->Record["vendor_name"] ?></td>
                                        <td><?php echo $DB->Record["vehicle_type"] ?></td>
                                        <td><?php echo $DB->Record["registration_no"] ?></td>
                                        <td><?php echo $DB->Record["model_no"] ?></td>
                                        <td><?php echo $DB->Record["color"] ?></td>
                                        <td><?php echo $DB->Record["description"] ?></td>
                                        <td><?php echo $DB->Record["permit_type"] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>