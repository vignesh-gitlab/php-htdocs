<?php
include'../../template/operation/header.default.php';

$actionpage = 'port_action.php';
$tablename = 'master_ports';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,port_type,port_name from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $port_type = $DB->Record["port_type"];
        $port_name = $DB->Record["port_name"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Port
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Sub Master</li>
            <li><a href="port_grid.php">Port</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                    <div class="box">
                        <div id="ajaxloader" class="overlay">
                            <div class="loader_block">
                                <img src="../../theme/img/ajax-loader1.gif" class="loader_img"/>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Port Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="port_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select customer_location from master_customer_location where id>=2 and id<=3 order by customer_location";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $port_type == $DB->Record["customer_location"]) {
                                                        echo'<option selected>' . $DB->Record["customer_location"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["customer_location"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Port Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="port_name" class="form-control" value="<?php if ($id_error == false) echo $port_name; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="button_box">
                            <button type="submit" id="submit_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                            <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                            <?php
                            if ($id_error == false) {
                                echo'<input type="hidden" name="form_action" value="Update"/>';
                                echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                            } else {
                                echo'<input type="hidden" name="form_action" value="Insert"/>';
                            }
                            ?>
                        </div>
                        <div id="submit_loader">
                            <img src="../../theme/img/submit_loader.gif" style="height:25px;"/>
                        </div>
                    </div>
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>