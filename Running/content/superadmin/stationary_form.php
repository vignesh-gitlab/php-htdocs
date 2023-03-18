<?php
include'../../template/superadmin/header.default.php';

$actionpage = 'stationary_action.php';
$tablename = 'sr_stationary';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,book_type,from_no,to_no,branch_name,branch_code from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $book_type = $DB->Record["book_type"];
        $from_no = $DB->Record["from_no"];
        $to_no = $DB->Record["to_no"];
        $branch_name = $DB->Record["branch_name"];
        $branch_code = $DB->Record["branch_code"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_branch_name(branch_code)
    {
        var httpxml;
        try
        {
            // Firefox, Opera 8.0+, Safari
            httpxml = new XMLHttpRequest();
        } catch (e)
        {
            // Internet Explorer
            try
            {
                httpxml = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e)
            {
                try
                {
                    httpxml = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e)
                {
                    alert("Your browser does not support AJAX!");
                    return false;
                }
            }
        }
        function stateck()
        {
            if (httpxml.readyState == 4)
            {
                var myarray = eval(httpxml.responseText);
                if (myarray.length > 0)
                {
                    document.form.branch_name.value = myarray[0];
                }
            }
        }
        var url = "stationary_dependent1.php";
        url = url + "?branch_code=" + branch_code;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stationary
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="stationary_grid.php">Stationary</a></li>
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
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch_code" id="branch_code" onchange="AjaxFunction_display_branch_name(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_company order by branch_code";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $branch_code == $DB->Record["branch_code"]) {
                                                        echo'<option selected>' . $DB->Record["branch_code"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["branch_code"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Branch Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="branch_name" readonly id="branch_name" class="form-control" value="<?php if ($id_error == false) echo $branch_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Stationary Type
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="book_type">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(stationary_type) from master_stationary_type order by stationary_type";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $book_type == $DB->Record["stationary_type"]) {
                                                        echo'<option selected>' . $DB->Record["stationary_type"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["stationary_type"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            Number From
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="from_no" class="form-control" value="<?php if ($id_error == false) echo $from_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Number To
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" name="to_no" class="form-control" value="<?php if ($id_error == false) echo $to_no; ?>">
                                        </td>
                                        <td  class="form_label_split2" colspan="2"></td>
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