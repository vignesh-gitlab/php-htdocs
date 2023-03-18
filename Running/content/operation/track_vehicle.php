<?php
include'../../template/operation/header.default.php';
$tablename = sr_vehicle_track;
$actionpage = "track_vehicle_action.php";
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Track Vehicle - Vehicle Number
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form role="form" name="form" id="form1" method="post" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <div class="form_tablebox">
                                        <table cellspacing="0">
                                            <tr>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    Vendor Name
                                                </td>
                                                <td style="text-align:center;"  class="form_label_split2">
                                                    Vehicle Number
                                                </td>
                                                <td style="text-align:center;" rowspan=2"  class="form_label_split2">
                                                    <button type="submit" onsubmit="this.style.display = 'none';
                                                            clear_but.style.display = 'none';
                                                            submit_loader.style.display = 'block';
                                                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-search"></i>&nbsp;Find Location</button>
                                                    <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="vendor_name">
                                                        <option>Select</option>                                                                                                  <option>PC Sites</option>
                                                        <option>ATIC</option>
                                                        <option>Roambee</option>
                                                    </select>
                                                </td>
                                                <td  style="width:25%;" class="form_content_split2" align="center">
                                                    <input type="text" name="vehicle_number" required="true" placeholder="Enter Vehicle Number" class="form-control pull-right" >
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div style="height:15px;clear:both;"></div>
        <?php
        if (isset($_REQUEST["vehicle_number"]) && !empty($_REQUEST["vehicle_number"])) {
            ?>
            <div class="tab-pane active" id="tab_1">
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align:center;padding:0px;"><h4>RECENT 10 LOCATION UPDATES</h4></th>
                            </tr>
                            <tr>
                                <th>Vehicle Number</th>
                                <th>Date & Time</th>
                                <th>Vehicle Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $location_count = 0;
                            $Query = "SELECT id,vehicle_number,track_date_time,track_location from $tablename where vehicle_number='" . $_REQUEST["vehicle_number"] . "' order by id desc";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                $location_count = $location_count + 1;
                                if ($location_count <= 10) {
                                    ?>
                                    <tr>
                                        <td><?php echo $UDB->Record["vehicle_number"] ?></td>
                                        <td><?php echo $UDB->Record["track_date_time"] ?></td>
                                        <td><?php echo $UDB->Record["track_location"] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Vehicle Number</th>
                                <th>Date & Time</th>
                                <th>Vehicle Location</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.tab-pane -->
            <?php
        }
        ?>
    </section>
</aside>

<?php include'../../template/common/footer.default.php'; ?>