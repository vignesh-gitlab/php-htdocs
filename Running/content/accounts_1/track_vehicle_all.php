<?php
include'../../template/accounts/header.default.php';
$tablename = 'sr_vehicle_track_all';
$actionpage = "track_vehicle_all_action.php";
$excel_export_page = '../../functions/excel_export/excel_export_userdb.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Track Vehicle - Vendor Name
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
                                                <td style="text-align:center;" rowspan=2"  class="form_label_split2">
                                                    <button type="submit" onsubmit="this.style.display = 'none';
                                                            clear_but.style.display = 'none';
                                                            submit_loader.style.display = 'block';
                                                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-search"></i>&nbsp;Find All Location</button>
                                                    <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%;" class="form_content_split2" align="center">
                                                    <select class="form-control dropdown_padding" name="vendor_name">
                                                        <option>Select</option>                                                                                                       <option>PC Sites</option>
                                                        <option>ATIC</option>
                                                    </select>
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
        if (isset($_REQUEST["opr"]) && !empty($_REQUEST["opr"])) {
            ?>
            <div class="tab-pane active" id="tab_1">
                <div class="box-body table-responsive">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Vehicle Number</th>
                                <th>Date and Time</th>
                                <th>Vehicle Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Query = "SELECT id,vehicle_number,track_date_time,track_location from $tablename";
                            $UDB->query($Query);
                            while ($UDB->Multicoloums()) {
                                ?>
                                <tr>
                                    <td><?php echo $UDB->Record["vehicle_number"] ?></td>
                                    <td><?php echo $UDB->Record["track_date_time"] ?></td>
                                    <td><?php echo $UDB->Record["track_location"] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Vehicle Number</th>
                                <th>Date and Time</th>
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