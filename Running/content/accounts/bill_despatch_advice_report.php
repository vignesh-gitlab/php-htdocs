<?php include'../../template/accounts/header.default.php'; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<?php
$actionpage = 'bill_despatch_advice_action.php';
$tablename = 'sr_bill_despatch_advice';
$tablename1 = 'sr_bill_despatch_advice_item';
$selfpage = 'bill_despatch_advice_report.php';
$return_page = '../accounts/bill_despatch_advice_report.php';


$client_error = true;
if (isset($_REQUEST["client_name"]) && !empty($_REQUEST["client_name"]) && $_REQUEST["client_name"] != "Select") {
    $client_name = $_REQUEST["client_name"];
    $branch_code = $_REQUEST["branch_code"];
    $branch_name = $_REQUEST["branch_name"];
    $bank_name = $_REQUEST["hd_bank_name"];
    $ac_no = $_REQUEST["hd_ac_no"];
    $da_no = $_REQUEST["da_no"];
    $da_date = $_REQUEST["da_date"];
    $client_error = false;
} else {
    $client_name = "";
}
$bank_error = true;
if (isset($_REQUEST["hd_bank_name"]) && !empty($_REQUEST["hd_bank_name"]) && $_REQUEST["hd_bank_name"] != "Select") {
    $bank_name = $_REQUEST["hd_bank_name"];
    $bank_error = false;
}
?>
<script type="text/javascript">
    function AjaxFunction_display_bank1(branch_code)
    {
        //var client_list = encodeURIComponent(client_list);
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

                for (j = document.form.hd_bank_name.options.length - 1; j >= 0; j--)
                {
                    document.form.hd_bank_name.remove(j);
                }

                if (myarray.length > 0)
                {
                    document.form.branch_name.value = myarray[0];
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.form.hd_bank_name.options.add(optn);
                    for (i = 2; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.form.hd_bank_name.options.add(optn);
                    }
                }
            }
        }

        var url = "bill_despatch_advice_dependent1.php"
        var branch_code = encodeURIComponent(branch_code);
        url = url + "?branch_code=" + branch_code;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
    function AjaxFunction_display_bankname(bank_name)
    {
        var branch_code = document.getElementById("branch_code").value;
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
                var length = document.getElementById("hd_ac_no").options.length;

                for (j = (length - 1); j >= 0; j--)
                {
                    document.getElementById("hd_ac_no").remove(j);
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.getElementById("hd_ac_no").options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.getElementById("hd_ac_no").options.add(optn);
                    }
                }
            }
        }
        var url = "bill_despatch_advice_dependent2.php"
        url = url + "?branch_code=" + branch_code + "&bank_name=" + bank_name;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
    function AjaxFunction_display_bill_amount(bill_no, line_id)
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
                    document.getElementById('bill_date' + line_id).value = myarray[0];
                    document.getElementById('bill_amount' + line_id).value = myarray[1];
                }
            }
        }
        var url = "bill_despatch_advice_dependent3.php"
        url = url + "?bill_no=" + bill_no;
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);

    }
    function calculate_total(line_id)
    {
        bill_total = 0;
        for (i = 1; i <= 15; i++)
        {
            bill_total = Number(bill_total) + (Number(document.getElementById('bill_amount' + i).value));
        }
        document.getElementById('total').value = bill_total;


    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Bills / Documents Despatch Advice</h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Billing</li>
            <li class="active">Bills / Documents Despatch Advice</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row no-print">
            <div class="col-xs-12">
                <form role="form" name="form" id="form1" method="post" onsubmit="return checkForm(this);" action="<?php echo $selfpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
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
                                            Despatch Advice No.
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <?php
                                            $Query = "SELECT max(cast(da_id as unsigned))as max_id from $tablename";
                                            $UDB->query($Query);
                                            while ($UDB->Multicoloums()) {
                                                $max_id = $UDB->Record["max_id"];
                                            }
                                            $new_max_id = $max_id + 1;
                                            $new_max_orderno = $commonvar_despatch_advice_no_prefix . $new_max_id;
                                            ?>
                                            <input type="text" name="da_no" readonly class="form-control" value="<?php
                                            echo $new_max_orderno;
                                            ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Despatch Advice Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="da_date" class="form-control pull-right" id="da_date" onfocus="pick_date(this.id);" value="<?php
                                                echo date('d-m-Y');
                                                ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <span class="red">*&nbsp;</span>Client Name
                                        </td>
                                        <td class="form_content_split2" align="left" colspan="3">
                                            <select class="chosen-select form-control dropdown_padding" name="client_name" id="client_name">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(client_name) from sr_client order by client_name";
                                                $DB->query($Query);

                                                while ($DB->Multicoloums()) {
                                                    if ($id_error == false && $client_name == $DB->Record["client_name"]) {
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
                                            Branch Code
                                        </td>
                                        <td class="form_content_split2" align="left">
                                            <select class="chosen-select form-control dropdown_padding" name="branch_code" id="branch_code" onchange="AjaxFunction_display_bank1(this.value)">
                                                <option>Select</option>
                                                <?php
                                                $Query = "select distinct(branch_code) from sr_company order by id";
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
                                            <input type="text" name="branch_name" id="branch_name" readonly class="form-control" value="<?php if ($id_error == false) echo $branch_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            Bank Name
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="hd_bank_name" id="hd_bank_name" onchange="AjaxFunction_display_bankname(this.value)">
                                                <option>Select</option>
                                                <?php
                                                if ($id_error == false && $bank_name) {
                                                    echo'<option selected>' . $bank_name . '</option>';
                                                } else {
                                                    echo'<option selected>' . $bank_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td  class="form_label_split2">
                                            A/C Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <select class="form-control dropdown_padding" name="hd_ac_no" id="hd_ac_no" >
                                                <option>Select</option>
                                                <?php
                                                if ($id_error == false && $ac_no) {
                                                    echo'<option selected>' . $ac_no . '</option>';
                                                } else {
                                                    echo'<option selected>' . $ac_no . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <button type="submit" style="width:160px;margin-left: 20px;margin-bottom: 10px; height:25px; line-height:10px;" onsubmit="this.style.display = 'none';
                                clear_but.style.display = 'none';
                                submit_loader.style.display = 'block';
                                ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw  fa-search"></i>&nbsp;Search</button>
                        <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>


                    </div><!-- /.box-body -->

            </div><!-- /.box -->
            </form>
        </div>

        <?php
        if ($client_error == false || $bank_error == false) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                        <div class="row">
                            <div class="col-xs-12">
                                <form role="form" name="form" id="form1" method="post" onsubmit="submit_form()" action="<?php echo $actionpage; ?>" enctype="multipart/form-data" autocomplete="<?php echo AUTOCOMPLETE ?>">
                                    <div class="box">
                                        <div class="box-body table-responsive">
                                            <div class="box-body table-responsive">
                                                <div class="form_tablebox">
                                                    <table cellspacing="0">
                                                        <tr>
                                                            <td  class="form_label_split2">
                                                                S No
                                                            </td>
                                                            <td class="form_content_split2" align="center">
                                                                <input type="text" name="da_no" readonly class="form-control" value="<?php
                                                                echo $new_max_orderno;
                                                                ?>">
                                                            </td>
                                                            <td  class="form_label_split2">
                                                                Date
                                                            </td>
                                                            <td class="form_content_split2" align="center">
                                                                <div class="input-group">
                                                                    <input type="text" readonly="true" name="da_date" class="form-control pull-right" id="da_date" onfocus="pick_date(this.id);" value="<?php
                                                                    echo date('d-m-Y');
                                                                    ?>">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <input type="hidden" name="client_name" value="<?php echo $client_name; ?>"/>
                                                        <input type="hidden" name="branch_code" value="<?php echo $branch_code; ?>"/>
                                                        <input type="hidden" name="branch_name" value="<?php echo $branch_name; ?>"/>
                                                        <input type="hidden" name="bank_name" value="<?php echo $bank_name; ?>"/>
                                                        <input type="hidden" name="ac_no" value="<?php echo $ac_no; ?>"/>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="box-body table-responsive">
                                                <div class="form_tablebox">
                                                    <table cellspacing="0">
                                                        <tr>
                                                            <td  class="form_label_multiple" style="width:10%;">
                                                                Bill Number
                                                            </td>
                                                            <td  class="form_label_multiple" style="width:10%;">
                                                                Bill Date
                                                            </td>
                                                            <td  class="form_label_multiple" style="width:20%;">
                                                                Bill Amount
                                                            </td>

                                                        </tr>
                                                        <?php
                                                        for ($i = 1; $i <= 15; $i++) {
                                                            $product_count = $i;
                                                            ?>
                                                            <tr>
                                                                <td class="form_content_multiple">
                                                                    <select class="form-control dropdown_padding" name="bill_no<?php echo $i; ?>" id="bill_no<?php echo $i; ?>" onchange="AjaxFunction_display_bill_amount(this.value,<?php echo $i; ?>)" onblur="calculate_total(<?php echo $i; ?>)">
                                                                        <option>Select</option>
                                                                        <?php
                                                                        $Query = "select bill_no,sub_date from sr_frieght_bill where client_name='" . $client_name . "' order by bill_no";
                                                                        $UDB->query($Query);

                                                                        while ($UDB->Multicoloums()) {
                                                                            if ($client_error == false && $product_category_array[$i - 1] == $UDB->Record["bill_no"]) {
                                                                                echo'<option selected>' . $UDB->Record["bill_no"] . '</option>';
                                                                            } else {
                                                                                echo'<option>' . $UDB->Record["bill_no"] . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td class="form_content_multiple">
                                                                    <input type="text" id="bill_date<?php echo $i; ?>"  name="bill_date<?php echo $i; ?>" class="form-control" value="<?php
                                                                    if ($id_error == false)
                                                                        echo $bill_date_array[$i - 1];
                                                                    ?>">
                                                                </td>
                                                                <td class="form_content_multiple">
                                                                    <input type="text" style="text-align:right;" id="bill_amount<?php echo $i; ?>"  name="bill_amount<?php echo $i; ?>" class="form-control" value="<?php
                                                                    if ($id_error == false)
                                                                        echo $bill_amount_array[$i - 1];
                                                                    ?>">
                                                                </td>

                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="2" class="form_label_multiple_right">Total</td>
                                                            <td class="form_content_multiple">
                                                                <input type="text" style="text-align:right;" id="total" readonly name="total" class="form-control" value="<?php
                                                                if ($id_error == false)
                                                                    echo $total;
                                                                ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" onsubmit="this.style.display = 'none';
                                                            clear_but.style.display = 'none';
                                                            submit_loader.style.display = 'block';
                                                            ajax_load.style.display = 'block';" class="btn-sm btn-primary"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Submit</button>
                                                <img src="../../theme/img/ajax-loader.gif" id="submit_loader" class="img_hide"/>
                                                <span class="ajax_class img_hide" id="ajax_load">On Progress Please Wait...</span>

                                                <input type="hidden" name="product_count" value="<?php echo $product_count; ?>"/>
                                                <?php
                                                if ($id_error == false) {
                                                    echo'<input type="hidden" name="form_action" value="Update"/>';
                                                    echo'<input type="hidden" name="id" value="' . $_REQUEST["id"] . '"/>';
                                                } else {
                                                    echo'<input type="hidden" name="form_action" value="Insert"/>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    </section><!-- /.content -->
                    </aside><!-- /.right-side -->

                    <?php include'../../template/common/footer.default.php'; ?>