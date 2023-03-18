<?php include'../../template/superadmin/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$form_page = 'bill_form.php';
$action_page = 'bill_action.php';
$print_page = 'bill_print.php';
$selfpage = 'bill_submission_advice_grid.php';
$return_page = '../superadmin/bill_submission_advice_grid.php';
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
            <li class="active">Billing</li>
            <li class="active">Bill Submission Advice</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row no-print">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $selfpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Client Name
                                        </td>
                                        <td class="form_content_multiple">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if (($id_error == false) && $client_name == $DB->Record["client_name"]) {
                                                        echo'<option selected>' . $DB->Record["client_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["client_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split3 center_align">
                                            <button type="submit" style="width:100%; height:25px; line-height:10px;" onsubmit="this.style.display = 'none';
                                                    clear_but.style.display = 'none';
                                                    submit_loader.style.display = 'block';
                                                    ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-search"></i>&nbsp;Search</button>
                                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
            </form>
        </div>

        <?php
        if ($client_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <?php
                            $Query = "SELECT count(bill_no)as total_bills,sum(total)as total_amount from sr_frieght_bill where client_name='" . $client_name . "'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_sales_bills = $UDB->Record["total_bills"];
                                $total_sales_amount = $UDB->Record["total_amount"];
                            }


                            $Query = "SELECT count(bmr_no)as total_bills,sum(claim_amount)as total_amount from sr_money_receipt where client_name='" . $client_name . "'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_service_bills = $UDB->Record["total_bills"];
                                $total_service_amount = $UDB->Record["total_amount"];
                            }

                            $Query = "SELECT count(document_no)as total_bills,sum(cheque_amount)as total_amount from sr_payment_advice where client_name='" . $client_name . "'";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $total_payment_bills = $UDB->Record["total_bills"];
                                $total_payment_amount = $UDB->Record["total_amount"];
                            }
                            ?>


                            <div style="height:30px;"></div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="align_center">
                                        <th colspan="8" class="align_center">CLIENT NAME : <?php echo $client_name; ?></th>
                                    </tr>

                                    <tr>
                                        <th style="width:14.2%">Invoice Type</th>
                                        <th style="width:14.2%">Invoice Generated</th>
                                        <th style="width:14.2%">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Frieght Bill</td>
                                        <td><?php echo $total_sales_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_sales_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Money Receipt</td>
                                        <td><?php echo $total_service_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_service_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Advice</td>
                                        <td><?php echo $total_payment_bills ?></td>
                                        <td>
                                            <i class="fa fa-fw fa-rupee"></i>
                                            <?php echo number_format((float) $total_payment_amount, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row no-print" style="margin-bottom:-350px;">
            <div class="col-xs-12" style="margin-bottom:20px;">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <span class="red">&nbsp;*&nbsp;</span>Configured Paper Size A4
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>