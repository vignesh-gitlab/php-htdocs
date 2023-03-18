<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'bill_form.php';
$action_page = 'bill_action.php';
$print_page = 'bill_submission_advice_print.php';
$tablename = 'sr_bill_despatch_advice';
$selfpage = 'bill_submission_advice_grid.php';
$return_page = '../accounts/bill_submission_advice_grid.php';
$view_page = 'payments_grid.php';

$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"])) {
    $client_name = $_REQUEST["client_name"];
    $client_error = false;
} else {
    $client_name = "";
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Bill Submission Advice</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Accounts</li>
            <li class="active">Bill Submission Advice</li>
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
                                    <th>Action</th> 
                                    <th>Da ID </th>
                                    <th>Da No </th>
                                    <th>Da Date </th>
                                    <th>Client Name </th>
                                    <th>Branch Code </th>
                                    <th>Branch Name </th>
                                    <th>Bank Name </th>
                                    <th>Acc No </th>
                                    <th>Total </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Query = "SELECT id,da_id,da_no,da_date,client_name,branch_code,branch_name,bank_name,ac_no,total from $tablename order by id ";
                                $UDB->query($Query);
                                while ($UDB->Multicoloums()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <!--     <ul class="pull-left" style="list-style-type: none;display:block; margin:0px; padding: 0px;">
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
                                              <a href="<?php echo $form_page . "?id=" . $DB->Record["id"]; ?>" title="Edit"><i class="fa fa-fw fa-edit"></i></a>-->
                                            <a href="<?php echo $print_page . "?id=" . $UDB->Record["id"]; ?>" title="Print"><i class="fa fa-fw fa-print"></i></a>
                                        </td>
                                        <td><?php echo $UDB->Record["da_id"] ?></td>
                                        <td><?php echo $UDB->Record["da_no"] ?></td>
                                        <td><?php echo $UDB->Record["da_date"] ?></td>
                                        <td><?php echo $UDB->Record["client_name"] ?></td>
                                        <td><?php echo $UDB->Record["branch_code"] ?></td>
                                        <td><?php echo $UDB->Record["branch_name"] ?></td>
                                        <td><?php echo $UDB->Record["bank_name"] ?></td>
                                        <td><?php echo $UDB->Record["ac_no"] ?></td>
                                        <td><?php echo $UDB->Record["total"] ?></td>
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