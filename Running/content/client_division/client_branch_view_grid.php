<?php include'../../template/client_division/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'client_form.php';
$tablename = 'sr_client';
$return_page = '../client_division/client_branch_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client Branch - Contact Details
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="client_branch_grid.php">Client Branch</a></li>
            <li class="active">View</li>
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
                                    <th>S.No</th>
                                    <th>Contact Person Name</th>
                                    <th>Telephone Number</th>
                                    <th>Mobile Number</th>
                                    <th>Email ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,contact_person_name1,telephone_no1,mobile_no1,email_id1,contact_person_name2,telephone_no2,mobile_no2,email_id2,contact_person_name3,telephone_no3,mobile_no3,email_id3 from $tablename where id='" . $_REQUEST["id"] . "'";
                                $DB->query($Query);
                                while ($DB->Multicoloums()) {
                                    if (!empty($DB->Record["contact_person_name1"])) {
                                        ?>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $DB->Record["contact_person_name1"] ?></td>
                                            <td><?php echo $DB->Record["telephone_no1"] ?></td>
                                            <td><?php echo $DB->Record["mobile_no1"] ?></td>
                                            <td><?php echo $DB->Record["email_id1"] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if (!empty($DB->Record["contact_person_name2"])) {
                                        ?>
                                        <tr>
                                            <td>2</td>
                                            <td><?php echo $DB->Record["contact_person_name2"] ?></td>
                                            <td><?php echo $DB->Record["telephone_no2"] ?></td>
                                            <td><?php echo $DB->Record["mobile_no2"] ?></td>
                                            <td><?php echo $DB->Record["email_id2"] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if (!empty($DB->Record["contact_person_name3"])) {
                                        ?>
                                        <tr>
                                            <td>3</td>
                                            <td><?php echo $DB->Record["contact_person_name3"] ?></td>
                                            <td><?php echo $DB->Record["telephone_no3"] ?></td>
                                            <td><?php echo $DB->Record["mobile_no3"] ?></td>
                                            <td><?php echo $DB->Record["email_id3"] ?></td>
                                        </tr>

                                        <?php
                                    }
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