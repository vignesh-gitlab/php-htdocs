<?php
include'../../template/client_branch/header.default.php';

$actionpage = 'user_creation_client_action.php';
$tablename = 'sr_user';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

if ($id_error == false) {
    $Query = "SELECT id,usertype,display_name,username,password from $tablename where id='" . $_REQUEST["id"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $usertype = $DB->Record["usertype"];
        $display_name = $DB->Record["display_name"];
        $username = $DB->Record["username"];
        $password = $DB->Record["password"];
    }
}
?>
<script type="text/javascript">
    function AjaxFunction_display_name(display_name)
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
                // Before adding new we must remove previously loaded elements
                for (j = document.form.division.options.length - 1; j >= 0; j--)
                {
                    document.form.division.remove(j);
                }
                for (j = document.form.division1.options.length - 1; j >= 0; j--)
                {
                    document.form.division1.remove(j);
                }
                for (j = document.form.division2.options.length - 1; j >= 0; j--)
                {
                    document.form.division2.remove(j);
                }
                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.division.options.add(optn);
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.division1.options.add(optn);
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.division2.options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.division.options.add(optn);
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.division1.options.add(optn);
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.division2.options.add(optn);
                    }
                }
            }
        }
        var url = "user_creation_client_dependent.php";
        url = url + "?display_name=" + display_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }

    function AjaxFunction_division(division, optval)
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
                // Before adding new we must remove previously loaded elements
                if (optval == 1)
                {
                    for (j = document.form.branch.options.length - 1; j >= 0; j--)
                    {
                        document.form.branch.remove(j);
                    }
                    if (myarray.length > 0)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.form.branch.options.add(optn);
                        for (i = 0; i < myarray.length; i++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[i];
                            optn.value = myarray[i];
                            document.form.branch.options.add(optn);
                        }
                    }
                }
                if (optval == 2)
                {
                    for (j = document.form.branch1.options.length - 1; j >= 0; j--)
                    {
                        document.form.branch1.remove(j);
                    }
                    if (myarray.length > 0)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.form.branch1.options.add(optn);
                        for (i = 0; i < myarray.length; i++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[i];
                            optn.value = myarray[i];
                            document.form.branch1.options.add(optn);
                        }
                    }
                }
                if (optval == 3)
                {
                    for (j = document.form.branch2.options.length - 1; j >= 0; j--)
                    {
                        document.form.branch2.remove(j);
                    }
                    if (myarray.length > 0)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = "Select";
                        optn.value = "Select";
                        document.form.branch2.options.add(optn);
                        for (i = 0; i < myarray.length; i++)
                        {
                            var optn = document.createElement("OPTION");
                            optn.text = myarray[i];
                            optn.value = myarray[i];
                            document.form.branch2.options.add(optn);
                        }
                    }
                }
            }
        }
        var url = "user_creation_client_dependent1.php";
        url = url + "?division=" + division;
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
            System User - Client
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Master</li>
            <li><a href="user_creation_grid.php">System User</a></li>
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
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(user_id)as max_id from $tablename";
                                            $DB->query($Query);
                                            while ($DB->Multicoloums()) {
                                                $max_id = $DB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            ?>
                                            <input type="hidden" name="user_id" class="form-control" value="<?php if ($id_error == true) echo $new_max_id; ?>">
                                            <select class="form-control dropdown_padding" name="usertype">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(usertype) from master_usertype order by usertype";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($DB->Record["usertype"] != "Super Administrator") {
                                                        if ($DB->Record["usertype"] != "Administrator") {
                                                            if ($DB->Record["usertype"] != "User") {
                                                                if ($DB->Record["usertype"] != "Supervisor") {
                                                                    if ($id_error == false && $usertype == $DB->Record["usertype"]) {
                                                                        echo'<option selected>' . $DB->Record["usertype"] . '</option>';
                                                                    } else {
                                                                        echo'<option>' . $DB->Record["usertype"] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Client Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <!--
                                            <input type="text" required name="display_name" class="form-control" value="<?php if ($id_error == false) echo $display_name; ?>">
                                            -->
                                            <select class="form-control dropdown_padding" id="display_name" onchange="AjaxFunction_display_name(this.value)" name="display_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $display_name == $DB->Record["client_name"]) {
                                                        echo'<option selected>' . $DB->Record["client_name"] . '</option>';
                                                    } else {
                                                        echo'<option>' . $DB->Record["client_name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span> Login Email
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="username" class="form-control" value="<?php if ($id_error == false) echo $username; ?>" placeholder="username@westernarya.com">
                                        </td>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Password
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" required name="password" class="form-control" value="<?php
                                            if ($id_error == false) {
                                                echo $password;
                                            } else {
                                                echo "westernarya";
                                            }
                                            ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="division" id="division" onchange="AjaxFunction_division(this.value, 1)">
                                                <option>Select</option>
                                            </select>
                                        <td  class="form_label_split2">
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch" id="branch">
                                                <option>Select</option>
                                                <?php
                                                /* $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                  $DB->query($Query);

                                                  while ($DB->Multicoloums()) {
                                                  if ($id_error == false && $branch_name == $DB->Record["branch_name"]) {
                                                  echo'<option selected>' . $DB->Record["branch_name"] . '</option>';
                                                  } else {
                                                  echo'<option>' . $DB->Record["branch_name"] . '</option>';
                                                  }
                                                  } */
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" id="division1" onchange="AjaxFunction_division(this.value, 2)" name="division1">
                                                <option>Select</option>
                                            </select>
                                        <td  class="form_label_split2">
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch1" id="branch1">
                                                <option>Select</option>
                                                <?php
                                                /* $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                  $DB->query($Query);

                                                  while ($DB->Multicoloums()) {
                                                  if ($id_error == false && $branch_name == $DB->Record["branch_name"]) {
                                                  echo'<option selected>' . $DB->Record["branch_name"] . '</option>';
                                                  } else {
                                                  echo'<option>' . $DB->Record["branch_name"] . '</option>';
                                                  }
                                                  } */
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Division
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" id="division2" onchange="AjaxFunction_division(this.value, 3)" name="division2">
                                                <option>Select</option>
                                            </select>
                                        <td  class="form_label_split2">
                                            Branch
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="branch2" id="branch2">
                                                <option>Select</option>
                                                <?php
                                                /* $Query = "select distinct(branch_name) from sr_client order by branch_name";
                                                  $DB->query($Query);

                                                  while ($DB->Multicoloums()) {
                                                  if ($id_error == false && $branch_name == $DB->Record["branch_name"]) {
                                                  echo'<option selected>' . $DB->Record["branch_name"] . '</option>';
                                                  } else {
                                                  echo'<option>' . $DB->Record["branch_name"] . '</option>';
                                                  }
                                                  } */
                                                ?>
                                            </select>
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