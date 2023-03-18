<?php
include'../../template/operation/header.default.php';

$actionpage = 'vehicle_booking_action.php';
$tablename = 'sr_vehicle_booking';

$orderno_error = false;
if ((!isset($_REQUEST["order_no"])) || (empty($_REQUEST["order_no"]))) {
    $orderno_error = true;
}
if ($orderno_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_ownership_type,vehicle_owner,primary_secondary,escort_type from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_ownership_type = $UDB->Record["vehicle_ownership_type"];
        $vehicle_owner = $UDB->Record["vehicle_owner"];
        $primary_secondary = $UDB->Record["primary_secondary"];
        $escort_type = $UDB->Record["escort_type"];
    }
}

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}
?>
<script type="text/javascript">
    function check_escort_type(escort_type)
    {
        alert(escort_type);
        document.getElementById("ddl_escort_name").style.display = 'hidden';
        alert(escort_type);
    }
</script>
<?php
if ($id_error == false) {
    $Query = "SELECT  id,order_no,so_no,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_ownership_type,vehicle_owner,primary_secondary,vehicle_no,driver_type,driver_name,driver_contact_no,escart_option,escart_name,tracking_device,sms_alert,email_alert,loading_charges,unloading_charges,dedicated_market_vehicle from $tablename where id='" . $_REQUEST["id"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $order_no = $UDB->Record["order_no"];
        $so_no = $UDB->Record["so_no"];
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_ownership_type = $UDB->Record["vehicle_ownership_type"];
        $vehicle_owner = $UDB->Record["vehicle_owner"];
        $primary_secondary = $UDB->Record["primary_secondary"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $driver_type = $UDB->Record["driver_type"];
        $driver_name = $UDB->Record["driver_name"];
        $driver_contact_no = $UDB->Record["driver_contact_no"];
        $escart_option = $UDB->Record["escart_option"];
        $escart_name = $UDB->Record["escart_name"];
        $tracking_device = $UDB->Record["tracking_device"];
        $sms_alert = $UDB->Record["sms_alert"];
        $email_alert = $UDB->Record["email_alert"];
        $loading_charges = $UDB->Record["loading_charges"];
        $unloading_charges = $UDB->Record["unloading_charges"];
        $dedicated_market_vehicle = $UDB->Record["dedicated_market_vehicle"];
    }
}
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehicle Booking <?php echo $escort_type; ?>
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Operation</li>
            <li><a href="vehicle_booking_grid.php">Vehicle Booking</a></li>
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
                                            Order Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="order_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $order_no; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_name" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Client Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_division" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_division; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Client Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="client_branch" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $client_branch; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Required Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_required_date" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_required_date; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Required Time
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_required_time" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_required_time; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Origin
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="orgin" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $orgin; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Destination
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="destination" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $destination; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_type" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_type; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Ownership
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_ownership_type" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_ownership_type; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Vehicle Owner
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="vehicle_owner" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $vehicle_owner; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Primary / Secondary
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="primary_secondary" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $primary_secondary; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            SO Ref. NO.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="so_no" class="form-control" readonly value="<?php if ($id_error == false || $orderno_error == false) echo $so_no; ?>">
                                        </td>
                                        <td class="form_label_split2" colspan="2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Vehicle Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            if ($orderno_error == false) {
                                                if ($vehicle_ownership_type == "Contract Vehicle") {
                                                    echo'<input type="text" required name="vehicle_no" class="form-control">';
                                                } else {
                                                    ?>
                                                    <select class="form-control dropdown_padding" name="vehicle_no">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select registration_no from sr_vehicle where vehicle_type='" . $vehicle_type . "' and availablity='Yes' order by registration_no";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if ($id_error == false && $vehicle_no == $DB->Record["registration_no"]) {
                                                                echo'<option selected>' . $DB->Record["registration_no"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["registration_no"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                }
                                            } else if ($id_error == false) {
                                                ?>
                                                <input type="text" readonly name="vehicle_no" class="form-control" value="<?php if ($id_error == false) echo $vehicle_no; ?>" placeholder="Number 1 / Number 2">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td  class="form_label_split2">
                                            Driver Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="driver_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select driver_type from sr_driver_type order by driver_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $driver_type == $DB->Record["driver_type"]) {
                                                        echo'<option selected>' . $DB->Record["driver_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["driver_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Driver Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="driver_name" class="form-control" value="<?php if ($id_error == false) echo $driver_name; ?>" placeholder="Name 1 / Name 2">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Driver Contact Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="driver_contact_no" class="form-control" value="<?php if ($id_error == false) echo $driver_contact_no; ?>" placeholder="Number 1 / Number 2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Tracking Device
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="tracking_device">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $tracking_device == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Escort Option
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="escart_option">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $escart_option == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Escort Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            if ($orderno_error == false) {
                                                if ($escort_type == "Contract Escort") {
                                                    echo'<input type="text"  name="escort_name" class="form-control">';
                                                } else {
                                                    ?>
                                                    <select class="form-control dropdown_padding" name="escort_name">
                                                        <option>Select</option>
                                                        <?php
                                                        $Query = "select escart_name from sr_escort order by escart_name";
                                                        $DB->query($Query);

                                                        while ($DB->Multicoloums()) {
                                                            if ($id_error == false && $escart_name == $DB->Record["escart_name"]) {
                                                                echo'<option selected>' . $DB->Record["escart_name"] . '</option>';
                                                            } else {
                                                                echo'<option>' . $DB->Record["escart_name"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                }
                                            } else if ($id_error == false) {
                                                ?>
                                                <input type="text" name="escart_name" class="form-control" value="<?php if ($id_error == false) echo $escart_name; ?>" placeholder="Number 1 / Number 2">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td  class="form_label_split2">
                                            SMS Alert
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="sms_alert">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $sms_alert == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Email Alert
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="email_alert">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $email_alert == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Loading Charges
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="loading_charges">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $loading_charges == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Unloading Charges
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="unloading_charges">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select option_name from master_options order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $unloading_charges == $DB->Record["option_name"]) {
                                                        echo'<option selected>' . $DB->Record["option_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["option_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Vehicle Category
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="dedicated_market_vehicle">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select vehicle_type from sr_dedicated_vehicle_type order by id";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $dedicated_market_vehicle == $DB->Record["vehicle_type"]) {
                                                        echo'<option selected>' . $DB->Record["vehicle_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["vehicle_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
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
            </div><!-- /.box -->
            </form>
        </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>