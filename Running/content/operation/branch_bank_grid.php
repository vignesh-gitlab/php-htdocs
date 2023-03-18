<?php include'../../template/operation/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'branch_bank_form.php';
$tablename = 'sr_branch_bank';
$return_page = '../operation/branch_bank_grid.php';
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Bank</li>
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
                                    <td colspan="15">
                                        <a href="<?php echo $form_page; ?>" title="Add New"><i class="fa fa-fw fa-plus"></i>&nbsp; Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <th>Branch Code</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Bank Name</th>
                                    <th>Bank Branch</th>
                                    <th>Account No.</th>
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>IFSC Code</th>
                                </tr>
                            </thead>
                            <tfoot class="footer_row">
                                <tr>
                                    <th>Action</th>
                                    <th>Branch Code</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Bank Name</th>
                                    <th>Bank Branch</th>
                                    <th>Account No.</th>
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>IFSC Code</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $Query = "SELECT id,branch_code,bank_name,bank_branch,ac_no,ac_name,ac_type,ifsc_code from $tablename order by branch_code";
                                $DB->query($Query);
                                while ($DB->Multicoloums()) {
                                    $Query1 = "SELECT company_name,address_line1,address_line2,city,pincode from sr_company where branch_code='" . $DB->Record["branch_code"] . "'";
                                    $DB1->query($Query1);
                                    while ($DB1->Multicoloums()) {
                                        $company_name = $DB1->Record["company_name"];
                                        $address_line1 = $DB1->Record["address_line1"];
                                        $address_line2 = $DB1->Record["address_line2"];
                                        $city = $DB1->Record["city"];
                                        $pincode = $DB1->Record["pincode"];
                                    }
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
                                        </td>
                                        <td><?php echo $DB->Record["branch_code"] ?></td>
                                        <td><?php echo $company_name; ?></td>
                                        <td><?php echo $address_line1 . '<br>' . $address_line2 . '<br>' . $city . '-' . $pincode; ?></td>
                                        <td><?php echo $DB->Record["bank_name"] ?></td>
                                        <td><?php echo $DB->Record["bank_branch"] ?></td>
                                        <td><?php echo $DB->Record["ac_no"] ?></td>
                                        <td><?php echo $DB->Record["ac_name"] ?></td>
                                        <td><?php echo $DB->Record["ac_type"] ?></td>
                                        <td><?php echo $DB->Record["ifsc_code"] ?></td>
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