<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'vehicle_action.php';
$tablename = 'sr_vehicle';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT  id,vehicle_type,manufacturer,year_of_manufacturer,model_no,color,chase_no,registration_no,ownership,vendor_name,description,permit_type,permit_expires_on,last_fc_date,next_fc_date,last_service_date,next_service_date from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $vehicle_type = $DB->Record["vehicle_type"];
        $manufacturer = $DB->Record["manufacturer"];
        $year_of_manufacturer = $DB->Record["year_of_manufacturer"];
        $model_no = $DB->Record["model_no"];
        $color = $DB->Record["color"];
        $chase_no = $DB->Record["chase_no"];
        $registration_no = $DB->Record["registration_no"];
        $ownership = $DB->Record["ownership"];
        $vendor_name = $DB->Record["vendor_name"];
        $description = $DB->Record["description"];
        $permit_type = $DB->Record["permit_type"];
        $permit_expires_on = $DB->Record["permit_expires_on"];
        $last_fc_date = $DB->Record["last_fc_date"];
        $next_fc_date = $DB->Record["next_fc_date"];
        $last_service_date = $DB->Record["last_service_date"];
        $next_service_date = $DB->Record["next_service_date"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="vehicle_grid.php">Vehicle</a></li>
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
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vehicle_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select vehicle_type from sr_vehicle_type order by vehicle_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $vehicle_type == $DB->Record["vehicle_type"]) {
                                                        echo'<option selected>' . $DB->Record["vehicle_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vehicle_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Ownership Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="ownership">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select ownership from master_ownership order by ownership";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $ownership == $DB->Record["ownership"]) {
                                                        echo'<option selected>' . $DB->Record["ownership"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["ownership"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Owner
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="vendor_name">
                                                <option>Select</option>
                                                <option>Western Arya</option>
                                                <?php
                                                $Query = "select vendor_name from sr_vendor order by vendor_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $vendor_name == $DB->Record["vendor_name"]) {
                                                        echo'<option selected>' . $DB->Record["vendor_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vendor_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Registration Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="registration_no" class="form-control" value="<?php if ($id_error == false) echo $registration_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Manufacturer
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="manufacturer" class="form-control" value="<?php if ($id_error == false) echo $manufacturer; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Year of Manufacturing
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="year_of_manufacturer" class="form-control" value="<?php if ($id_error == false) echo $year_of_manufacturer; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Model Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="model_no" class="form-control" value="<?php if ($id_error == false) echo $model_no; ?>">
                                        </td>
                                        <td  class="form_label_split2" rowspan="3">
                                            Description
                                        </td>
                                        <td class="form_content_split2" align="center" rowspan="3">
                                            <textarea class="form-control" name="description" style="height:80px;"><?php if ($id_error == false) echo $description; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Color
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="color" class="form-control" value="<?php if ($id_error == false) echo $color; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Chase Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="chase_no" class="form-control" value="<?php if ($id_error == false) echo $chase_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            Permit Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="permit_type" class="form-control" value="<?php if ($id_error == false) echo $permit_type; ?>" placeholder="National / Maharastra">
                                        </td>
                                        <td  class="form_label_split2">
                                            Permit Expires On
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="permit_expires_on" class="form-control pull-right" id="permit_expires_on" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $permit_expires_on;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Last FC Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="last_fc_date" class="form-control pull-right" id="last_fc_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $last_fc_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Next FC Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="next_fc_date" class="form-control pull-right" id="next_fc_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $next_fc_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Last Service Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="last_service_date" class="form-control pull-right" id="last_service_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $last_service_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td  class="form_label_split2">
                                            Next Service Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="next_service_date" class="form-control pull-right" id="next_service_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $next_service_date;
                                                } else {
                                                    echo date('d-m-Y');
                                                }
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
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