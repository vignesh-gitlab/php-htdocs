<?php
include'../../template/client_division/header.default.php';

$actionpage = 'advertisement_action.php';
$tablename = 'sr_advertisement';

$approval_error = false;
if ((!isset($_REQUEST["approval"])) || (empty($_REQUEST["approval"]))) {
    $approval_error = true;
}
$order_error = false;
if ((!isset($_REQUEST["advertisement_no"])) || (empty($_REQUEST["advertisement_no"]))) {
    $order_error = true;
}


$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>

<?php
if ($id_error == false) {
    $Query = "SELECT id,advertisement_id,advertisement_no,description,amount,ad_copy,ad_status  from $tablename where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $advertisement_id = $UDB->Record["advertisement_id"];
        $advertisement_no = $UDB->Record["advertisement_no"];
        $description = $UDB->Record["description"];
        $amount = $UDB->Record["amount"];
        $ad_copy = $UDB->Record["ad_copy"];
        $ad_status = $UDB->Record["ad_status"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_product(payment_category)
    {
        if (payment_category == "To Project")
        {
            //document.form.product_brand.readOnly = false;
            document.form.project_name.disabled = false;
            document.form.project_name.value = "Select";
        } else
        {
            //document.form.product_brand.readOnly = true;
            document.form.project_name.disabled = true;
            document.form.project_name.value = "";
        }
    }
</script>
<aside class="right-side  strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advertisement
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Billing</li>
            <li><a href="advertisement_grid.php">Advertisement</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Advertisement No
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(advertisement_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_advertisement_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="advertisement_no" readonly class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $advertisement_no;
                                            } else {
                                                echo $new_max_orderno;
                                            }
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center" rowspan="3">
                                            <textarea name="description" style="height:82px;" class="form-control"><?php if ($id_error == false) echo $description; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Amount
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-rupee"></i>
                                                </div>
                                                <input type="text" name="amount" class="form-control pull-right" value="<?php
                                                if ($id_error == false) {
                                                    echo $amount;
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Adv Copy
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="file" class="form-control" name="adv_copy" id="adv_copy" style="padding:0px;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php
                            if ($order_error != false) {
                                ?>
                                <button type="submit" onsubmit="this.style.display = 'none';
                                        clear_but.style.display = 'none';
                                        submit_loader.style.display = 'block';
                                        ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($order_error == false) {
                                        ?>
                                <button type="submit" onsubmit="this.style.display = 'none';
                                        clear_but.style.display = 'none';
                                        submit_loader.style.display = 'block';
                                        ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Approve</button>
                                        <?php
                                    }
                                    ?>
                            <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                            <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
                            <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                            <?php
                            if ($id_error == false && $order_error != false) {
                                echo'<input type="hidden" name="form_action" value="Update"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else if ($order_error == false) {
                                echo'<input type="hidden" name="approval" value="Approve"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else {
                                echo'<input type="hidden" name="form_action" value="Insert"/>';
                            }
                            ?>
                        </div>
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>