<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'user_menu_action.php';
$tablename = 'sr_user_menu';


$id_error = false;
if ((!isset($_REQUEST["userid"])) || (empty($_REQUEST["userid"]))) {
    $id_error = true;
}
$userid_error = false;
if ((!isset($_REQUEST["userid"])) || (empty($_REQUEST["userid"]))) {
    $userid_error = true;
}
$username_error = false;
if ((!isset($_REQUEST["username"])) || (empty($_REQUEST["username"]))) {
    $username_error = true;
}
?>

<?php
if ($userid_error == false) {
    $Query = "SELECT id,usertype,username from sr_user where id= '" . $_REQUEST["userid"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $usertype = $DB->Record["usertype"];
        $username = $DB->Record["username"];
    }
}
if ($username_error == false) {
    $pagename_array_count = 0;
    $Query1 = "SELECT id,usertype,username,menu_name,page_name from $tablename where username= '" . $_REQUEST["username"] . "'";
    $DB1->query($Query1);
    while ($DB1->Multicoloums()) {
        $pagename_array_count = $pagename_array_count + 1;
        //$menu_name_array[] = $DB1->Record["menu_name"];
        $page_name_array[] = $DB1->Record["page_name"];
    }
}
?>
<script type="text/javascript">

</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Menu
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="user_creation_grid.php">System User</a></li>
            <li class="active">User Menu</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            User Type
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" readonly name="usertype" class="form-control" value="<?php if ($id_error == false || $userid_error == false) echo $usertype; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            UserName
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <input type="text" readonly name="username" class="form-control" value="<?php if ($id_error == false || $userid_error == false) echo $username; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <?php
                                                $Query = "SELECT distinct(menu_name) from sr_menu";
                                                $DB->query($Query);
                                                while ($DB->Multicoloums()) {
                                                    $menu_name = $DB->Record["menu_name"];
                                                    ?>
                                                    <div class="col-md-4">
                                                        <div class="box box-solid">
                                                            <div class="box-header">
                                                                <h3 class="box-title"><?php echo $menu_name; ?></h3>
                                                            </div>
                                                            <div class="box-body" style='margin-top:-15px;'>
                                                                <?php
                                                                $Query1 = "SELECT page_name from sr_menu where menu_name='" . $menu_name . "'";
                                                                $DB1->query($Query1);
                                                                while ($DB1->Multicoloums()) {
                                                                    $page_name = $DB1->Record["page_name"];
                                                                    ?>
                                                                    <input type="hidden" readonly name="menu_name1" value="<?php echo $menu_name ?>">
                                                                    <div style="height:10px;"></div>
                                                                    <?php
                                                                    $check_pagename = strtolower(str_replace(" ", "_", $page_name));
                                                                    //$pagename_array = array("Dashboard", "By Vendor Name", "Irix", "Linux");
                                                                    ?>
                                                                    <input type="checkbox"  name="<?php echo $check_pagename ?>" value="<?php echo $page_name; ?>" <?php
                                                                    if ($id_error == false && in_array($page_name, $page_name_array)) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>>&nbsp;&nbsp;&nbsp;<strong><?php echo $page_name ?></strong><br>
                                                                           <?php
                                                                       }
                                                                       ?>
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </td>
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
                        <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                        <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>
                        <button type="reset" id="clear_but" class="btn-sm btn-primary"><i class="fa fa-fw fa-eye-slash"></i>&nbsp;Clear</button>
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
                        <?php
                        if ($pagename_array_count != 0) {
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