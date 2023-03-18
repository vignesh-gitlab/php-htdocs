<?php
include'../../template/operation/header.default.php';

//$actionpage = 'work_order_action.php';
$tablename = 'sr_work_order';
$tablename1 = 'sr_work_order_item';

$id_error = false;
if ((!isset($_REQUEST["id"])) || (empty($_REQUEST["id"]))) {
    $id_error = true;
}

$wono_error = false;
if ((!isset($_REQUEST["quotation_no"])) || (empty($_REQUEST["quotation_no"]))) {
    $wono_error = true;
}
?>

<script type="text/javascript">
    function AjaxFunction_display_product(product_brand, line_id)
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

                var length = document.getElementById("product_name" + line_id).options.length;
                for (j = (length - 1); j >= 0; j--)
                {
                    document.getElementById("product_name" + line_id).options[j] = null;
                }

                if (myarray.length > 0)
                {
                    var optn = document.createElement("OPTION");
                    optn.text = "Select";
                    optn.value = "Select";
                    document.getElementById("product_name" + line_id).options.add(optn);
                    for (i = 0; i < myarray.length; i++)
                    {
                        var optn = document.createElement("OPTION");
                        optn.text = myarray[i];
                        optn.value = myarray[i];
                        document.getElementById("product_name" + line_id).options.add(optn);
                    }
                }
            }
        }
        var url = "sales_invoice_dependent1.php";
        url = url + "?product_brand=" + product_brand;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }
    function AjaxFunction_display_price(product_name, line_id)
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
                //var myarray = decodeURIComponent(myarray);
                //alert(myarray);
                //var product_name = decodeURIComponent(product_name);
                /*var length = document.getElementById("product_name" + line_id).options.length;
                 for (j = (length - 1); j >= 0; j--)
                 {
                 document.getElementById("product_name" + line_id).options[j] = null;
                 }
                 */
                if (myarray.length > 0)
                {
                    document.getElementById('unit_price' + line_id).value = myarray[0];
                    document.getElementById('line_discount' + line_id).value = myarray[1];

                }
            }
        }
        var url = "quotation_dependent1.php";
        var product_name = encodeURIComponent(product_name);
        url = url + "?product_name=" + product_name;
        //url=url+"&sid="+Math.random();
        httpxml.onreadystatechange = stateck;
        httpxml.open("GET", url, true);
        httpxml.send(null);
    }


    function AjaxFunction_display_terms(terms_list)
    {
        if (terms_list == "New Terms")
        {
            document.form.terms_and_condition.readOnly = false;
            document.form.terms_and_condition.value = "";
        } else
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
                        document.form.terms_and_condition.readOnly = true;
                        document.form.terms_and_condition.value = myarray[0];
                    }
                }
            }
            var url = "sales_invoice_dependent2.php";
            url = url + "?terms_list=" + terms_list;
            //url=url+"&sid="+Math.random();
            httpxml.onreadystatechange = stateck;
            httpxml.open("GET", url, true);
            httpxml.send(null);
        }
    }

    function calculate_total(line_id)
    {
        var tax_amount = "0";
        var quantity = document.getElementById('quantity' + line_id).value;
        var unit_price = document.getElementById('unit_price' + line_id).value;
        var tax_rate = document.getElementById('tax_rate' + line_id).value;
        var tax_type = document.getElementById('tax_type' + line_id).value;
        var line_discount = document.getElementById('line_discount' + line_id).value;
        var amount = (Number(quantity) * Number(unit_price));
        //var line_discount;
        var line_amount = 0;
        var total_amount = 0;
        discount_amount = (Number(amount) / 100);
        discount_amount = (Number(discount_amount) * line_discount);
        document.getElementById('line_discount_amount' + line_id).value = discount_amount;
        amount = (Number(amount) - Number(discount_amount));
        if (tax_rate != "NA")
        {
            if (tax_type == "Ex")
            {
                tax_amount = ((Number(amount) * Number(tax_rate)) / 100);
            }
            if (tax_type == "In")
            {
                //tax_amount = (Number(tax_rate) / 100) * Number(amount);
                tax_amount = (Number(amount) - (Number(amount) * 100) / (Number(tax_rate) + 100));
            }
        }
        if (tax_type == "Ex")
        {
            line_amount = (Number(amount));
            total_amount = (Number(amount) + Number(tax_amount));
        }
        if (tax_type == "In")
        {
            //line_amount = (Number(amount) - Number(tax_amount));
            line_amount = (Number(amount) * 100) / (Number(tax_rate) + 100);
            total_amount = (Number(amount));
        }
        //var total_amount = (Number(amount) + Number(tax_amount));
        //var total_amount = (Number(amount));
        var line_amount_charges = Number(line_amount).toFixed(2);
        var line_tax_charges = Number(tax_amount).toFixed(2);
        var total_amount_charges = Number(total_amount).toFixed(2);
        document.getElementById('line_total' + line_id).value = line_amount_charges;
        document.getElementById('line_tax' + line_id).value = line_tax_charges;
        document.getElementById('amount' + line_id).value = total_amount_charges;

        var sub_total = 0;
        var sale_tax = 0;
        var total_line_discount = 0;

        for (i = 1; i <= 25; i++)
        {
            total_line_discount = Number(total_line_discount) + (Number(document.getElementById('line_discount_amount' + i).value));
            sub_total = Number(sub_total) + (Number(document.getElementById('line_total' + i).value));
            if (document.getElementById('tax_rate' + i).value != "NA")
            {
                sale_tax = sale_tax + (Number(document.getElementById('line_tax' + i).value));
            }
        }
        //sub_total = Number(sub_total) + Number(sale_tax);
        var total_line_discount_charges = Number(total_line_discount).toFixed(2);
        var sub_total_charges = Number(sub_total).toFixed(2);
        var sale_tax_charges = Number(sale_tax).toFixed(2);
        document.getElementById('discount').value = total_line_discount_charges;
        document.getElementById('sub_total').value = sub_total_charges;
        document.getElementById('sale_tax').value = sale_tax_charges;
        var grand_total = Number(sub_total) + Number(sale_tax);
        var grand_total_charges = Number(grand_total).toFixed(2);
        document.getElementById('grand_total').value = grand_total_charges;
    }

    function calculate_discount()
    {
        var sub_total = document.getElementById('sub_total').value;
        var sale_tax = document.getElementById('sale_tax').value;
        var discount_percentage = document.getElementById('discount_percentage').value;
        var discount_amount = 0;
        if (discount_percentage != "NA")
        {
            discount_amount = ((Number(sub_total) + Number(sale_tax)) * Number(discount_percentage)) / 100;
            discount_amount = Number(discount_amount).toFixed(2);
            document.getElementById('discount').value = discount_amount;
        }
        var discount = document.getElementById('discount').value;
        var grand_total = (Number(sub_total) + Number(sale_tax)) - Number(discount);
        var grand_total_charges = Number(grand_total).toFixed(2);
        document.getElementById('grand_total').value = grand_total_charges;
    }

</script>
<?php
/*
  if ($wono_error == false) {
  $Query = "SELECT  id,quotation_no,product_group,client_name,client_company, terms_and_condition, sub_total, total_tax, discount_percentage, discount, grand_total from sr_quotation where quotation_no='" . $_REQUEST["quotation_no"] . "'";
  $UDB->query($Query);
  while ($UDB->Multicoloums()) {
  $quotation_no = $UDB->Record["quotation_no"];
  $product_group = $UDB->Record["product_group"];
  $client_name = $UDB->Record["client_name"];
  $client_company = $UDB->Record["client_company"];
  $terms_and_condition = $UDB->Record["terms_and_condition"];
  $sub_total = $UDB->Record["sub_total"];
  $total_tax = $UDB->Record["total_tax"];
  $discount_percentage = $UDB->Record["discount_percentage"];
  $discount = $UDB->Record["discount"];
  $grand_total = $UDB->Record["grand_total"];
  }

  $edit_product_count = 0;
  $Query = "SELECT  id,product_brand,product_name,product_description,quantity,unit,unit_price,line_discount,line_discount_amount,tax_rate,tax_type,product_total,tax_total,total_amount from sr_quotation_item where quotation_no='" . $quotation_no . "'";
  $UDB->query($Query);
  while ($UDB->Multicoloums()) {
  $edit_product_count = $edit_product_count + 1;
  $product_category_array[] = $UDB->Record["product_brand"];
  $product_name_array[] = $UDB->Record["product_name"];
  $product_description_array[] = $UDB->Record["product_description"];
  $quantity_array[] = $UDB->Record["quantity"];
  $unit_array[] = $UDB->Record["unit"];
  $unit_price_array[] = $UDB->Record["unit_price"];
  $line_discount_array[] = $UDB->Record["line_discount"];
  $line_discount_amount_array[] = $UDB->Record["line_discount_amount"];
  $tax_rate_array[] = $UDB->Record["tax_rate"];
  $tax_type_array[] = $UDB->Record["tax_type"];
  $product_total_array[] = $UDB->Record["product_total"];
  $tax_total_array[] = $UDB->Record["tax_total"];
  $amount_array[] = $UDB->Record["total_amount"];
  }

  $Query = "SELECT id, customer_name, customer_company, address_line1, address_line2, city, pincode, mobile_number, tin_no from sr_customer where customer_name = '" . $client_name . "' and customer_company = '" . $client_company . "'";
  $DB->query($Query);
  while ($DB->Multicoloums()) {
  $client_name = $DB->Record["customer_name"];
  $client_company_name = $DB->Record["customer_company"];
  $client_address_line1 = $DB->Record["address_line1"];
  $client_address_line2 = $DB->Record["address_line2"];
  $client_city = $DB->Record["city"];
  $client_pincode = $DB->Record["pincode"];
  $client_contact_no = $DB->Record["mobile_number"];
  $client_tin_no = $DB->Record["tin_no"];
  }
  }

  if ($id_error == false) {
  $Query = "SELECT id, quotation_no, product_group, wo_id, wo_number, wo_date, wo_reference, client_name, client_company, client_address_line1, client_address_line2, client_city, client_pincode, client_contact_number, client_tin_no, terms_and_condition, sub_total, total_tax, discount_percentage, discount, grand_total from $tablename where id = '" . $_REQUEST["id"] . "'";
  $UDB->query($Query);
  while ($UDB->Multicoloums()) {
  $quotation_no = $UDB->Record["quotation_no"];
  $product_group = $UDB->Record["product_group"];
  $wo_id = $UDB->Record["wo_id"];
  $wo_number = $UDB->Record["wo_number"];
  $wo_date = $UDB->Record["wo_date"];
  $wo_reference = $UDB->Record["wo_reference"];
  $client_name = $UDB->Record["client_name"];
  $client_company_name = $UDB->Record["client_company"];
  $client_address_line1 = $UDB->Record["client_address_line1"];
  $client_address_line2 = $UDB->Record["client_address_line2"];
  $client_city = $UDB->Record["client_city"];
  $client_pincode = $UDB->Record["client_pincode"];
  $client_contact_no = $UDB->Record["client_contact_number"];
  $client_tin_no = $UDB->Record["client_tin_no"];
  $terms_and_condition = $UDB->Record["terms_and_condition"];
  $sub_total = $UDB->Record["sub_total"];
  $total_tax = $UDB->Record["total_tax"];
  $discount_percentage = $UDB->Record["discount_percentage"];
  $discount = $UDB->Record["discount"];
  $grand_total = $UDB->Record["grand_total"];
  }

  $edit_product_count = 0;
  $Query = "SELECT id, product_brand, product_name, product_description, quantity, unit, unit_price,line_discount,line_discount_amount, tax_rate, tax_type, product_total, tax_total, total_amount from $tablename1 where wo_no = '" . $wo_number . "'";
  $UDB->query($Query);
  while ($UDB->Multicoloums()) {
  $edit_product_count = $edit_product_count + 1;
  $product_category_array[] = $UDB->Record["product_brand"];
  $product_name_array[] = $UDB->Record["product_name"];
  $product_description_array[] = $UDB->Record["product_description"];
  $quantity_array[] = $UDB->Record["quantity"];
  $unit_array[] = $UDB->Record["unit"];
  $unit_price_array[] = $UDB->Record["unit_price"];
  $line_discount_array[] = $UDB->Record["line_discount"];
  $line_discount_amount_array[] = $UDB->Record["line_discount_amount"];
  $tax_rate_array[] = $UDB->Record["tax_rate"];
  $tax_type_array[] = $UDB->Record["tax_type"];
  $product_total_array[] = $UDB->Record["product_total"];
  $tax_total_array[] = $UDB->Record["tax_total"];
  $amount_array[] = $UDB->Record["total_amount"];
  }
  }
 */
?>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Work Order
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Order</li>
            <li><a href = "">Work Order</a></li>
            <li class = "active">Entry</li>
        </ol>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class = "row">
            <div class = "col-xs-12">
                <form role = "form" name = "form" id = "form1" method = "post" onsubmit = "return checkForm(this);" action = "<?php echo $actionpage; ?>" enctype = "multipart/form-data" autocomplete = "<?php echo AUTOCOMPLETE ?>">
                    <div class = "box">
                        <div class = "box-body table-responsive">
                            <div class = "form_tablebox">
                                <table cellspacing = "0">
                                    <tr>
                                        <td  class="form_label_split2" rowspan="7">
                                            Client Name & Address
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_name" readonly placeholder="Customer Name" name="client_name" class="form-control" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Work Order Number
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" readonly name="wo_no" class="form-control">
                                            <?php /*  $Query = "SELECT max(cast(wo_id as unsigned))as max_id from $tablename";
                                              $UDB->query($Query);
                                              while ($UDB->Multicoloums()) {
                                              $max_id = $UDB->Record["max_id"];
                                              }
                                              $new_max_id = $max_id + 1;
                                              $new_max_orderno = $commonvar_wo_no_prefix . $new_max_id;
                                              ?>
                                              <input type="text" name="wo_no" readonly class="form-control" value="<?php
                                              if ($id_error == false) {
                                              echo $wo_number;
                                              } else {
                                              echo $new_max_orderno;
                                              }
                                              ?>">
                                              <?php
                                              if ($form_error == false) {
                                              ?>
                                              <input type="hidden" name="wo_id" class="form-control" value="<?php echo $quotation_id; ?>">
                                              <?php
                                              }
                                             */ ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_company_name" readonly name="client_company_name" class="form-control" placeholder="Company Name" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_company_name; ?>">
                                        </td>
                                        <td  class="form_label_split2">
                                            Work Order Date
                                        </td>
                                        <td class="form_content_split2" align="center">
                                            <div class="input-group">
                                                <input type="text" readonly="true" name="wo_date" class="form-control pull-right" id="quotation_date" onfocus="pick_date(this.id);" value="<?php
                                                if ($id_error == false) {
                                                    echo $wo_date;
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
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_address_line1" readonly name="client_address_line1" class="form-control" placeholder="Address Line 1" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_address_line1; ?>">
                                        </td>
                                        <td class = "form_label_split2">
                                            Quotation Ref. Number
                                        </td>
                                        <td class = "form_label_split2">
                                            <input type = "text" readonly name = "quotation_no" class = "form-control" value = "<?php if (($id_error == false) || ($wono_error == false)) echo $quotation_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_address_line2" readonly name="client_address_line2" class="form-control" placeholder="Address Line 2" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_address_line2; ?>">
                                        </td>
                                        <td class = "form_label_split2" rowspan = "4">
                                            Reference / Description
                                        </td>
                                        <td class = "form_content_split2" rowspan = "4" align = "center">
                                            <textarea name = "wo_reference" style = "height:80px;" autofocus class = "form-control"><?php
                                                if ($id_error == false)
                                                    echo $wo_reference;
                                                ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label_split2">
                                            <input type="text" id="client_city" name="client_city" readonly class="form-control" placeholder="City" style="float:left; width:70%;" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_city; ?>">
                                            <input type="text" id="client_pincode" name="client_pincode" readonly class="form-control" placeholder="Pincode" style="float:left; width:30%;" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_pincode; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_contact_number" readonly name="client_contact_number" class="form-control" placeholder="Contact Number" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_contact_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_content_split2" align="center">
                                            <input type="text" id="client_tin_no" readonly name="client_tin_no" class="form-control" placeholder="TIN Number" value="<?php if (($id_error == false) || ($leadno_error == false)) echo $client_tin_no; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="form_tablebox">
                                <table cellspacing="0">
                                    <tr>
                                        <td  class="form_label_multiple" style="width:12%;">
                                            Product Category
                                        </td>
                                        <td  class="form_label_multiple" style="width:14%;">
                                            Product Name
                                        </td>
                                        <td  class="form_label_multiple" style="width:16%;">
                                            Description
                                        </td>
                                        <td  class="form_label_multiple" style="width:7%;">
                                            Unit Price
                                        </td>
                                        <td  class="form_label_multiple" style="width:9%;">
                                            Quantity
                                        </td>
                                        <td  class="form_label_multiple" style="width:7%;">
                                            Discount %
                                        </td>
                                        <td  class="form_label_multiple" style="width:7%;">
                                            Discount Amt
                                        </td>
                                        <td  class="form_label_multiple" style="width:6%;">
                                            Unit Total
                                        </td>
                                        <td  class="form_label_multiple" style="width:14%;">
                                            Tax
                                        </td>
                                        <td  class="form_label_multiple" style="width:10%;">
                                            Amount
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 25; $i++) {
                                        $product_count = $i;
                                        ?>
                                        <tr>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" name="product_category<?php echo $i; ?>" id="product_category<?php echo $i; ?>" onchange="AjaxFunction_display_product(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                    <?php /*   $Query = "select distinct(product_brand) from sr_product where product_group='" . $product_group . "' order by product_name";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if (($id_error == false || $wono_error == false) && $product_category_array[$i - 1] == $DB->Record["product_brand"]) {
                                                      echo'<option selected>' . $DB->Record["product_brand"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["product_brand"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" name="product_name<?php echo $i; ?>" id="product_name<?php echo $i; ?>" onchange="AjaxFunction_display_price(this.value,<?php echo $i; ?>)">
                                                    <option>Select</option>
                                                    <?php
                                                    if (($id_error == false || $wono_error == false) && $product_name_array[$i - 1] != NULL) {
                                                        echo'<option selected>' . $product_name_array[$i - 1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" name="description<?php echo $i; ?>" class="form-control" value="<?php if ($id_error == false || $wono_error == false) echo $product_description_array[$i - 1]; ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:center;" onblur="calculate_total(<?php echo $i; ?>)" id="unit_price<?php echo $i; ?>" name="unit_price<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $unit_price_array[$i - 1];
                                                } else {
                                                    echo"0";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" id="quantity<?php echo $i; ?>" name="quantity<?php echo $i; ?>" onblur="calculate_total(<?php echo $i; ?>)" style="width:45%; text-align:center; float:left;" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $quantity_array[$i - 1];
                                                } else {
                                                    echo"0";
                                                }
                                                ?>">
                                                <select class="form-control dropdown_padding" style="width:55%;" name="unit<?php echo $i; ?>">
                                                    <option>NA</option>
                                                    <?php /*    $Query = "select unit from master_unit order by unit";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if (($id_error == false || $wono_error == false) && $unit_array[$i - 1] == $DB->Record["unit"]) {
                                                      echo'<option selected>' . $DB->Record["unit"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["unit"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:center;" onblur="calculate_total(<?php echo $i; ?>)" id="line_discount<?php echo $i; ?>" name="line_discount<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $line_discount_array[$i - 1];
                                                } else {
                                                    echo"0";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:center;" onblur="calculate_total(<?php echo $i; ?>)" id="line_discount_amount<?php echo $i; ?>" name="line_discount_amount<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $line_discount_amount_array[$i - 1];
                                                } else {
                                                    echo"0";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right; float:left;" readonly id="line_total<?php echo $i; ?>"  name="line_total<?php echo $i; ?>" class="form-control" value="<?php
                                                if (($id_error == false || $wono_error == false) || $wono_error == false) {
                                                    echo $product_total_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <select class="form-control dropdown_padding" style="width:32%; float:left;" onchange="calculate_total(<?php echo $i; ?>)" id="tax_rate<?php echo $i; ?>" name="tax_rate<?php echo $i; ?>">
                                                    <option>NA</option>
                                                    <?php /*   $Query = "select tax_rate from master_tax_rate order by tax_rate";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if (($id_error == false || $wono_error == false) && $tax_rate_array[$i - 1] == $DB->Record["tax_rate"]) {
                                                      echo'<option selected>' . $DB->Record["tax_rate"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["tax_rate"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                                <select class="form-control dropdown_padding" style="width:27%;  float:left;" onchange="calculate_total(<?php echo $i; ?>)" id="tax_type<?php echo $i; ?>" name="tax_type<?php echo $i; ?>">
                                                    <?php /*   $Query = "select tax_type from master_tax_type order by tax_type";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if (($id_error == false || $wono_error == false) && $tax_type_array[$i - 1] == $DB->Record["tax_type"]) {
                                                      echo'<option selected>' . $DB->Record["tax_type"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["tax_type"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                                <input type="text" style="text-align:right; width:41%;" readonly id="line_tax<?php echo $i; ?>"  name="line_tax<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $tax_total_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                            <td class="form_content_multiple">
                                                <input type="text" style="text-align:right;" readonly id="amount<?php echo $i; ?>"  name="amount<?php echo $i; ?>" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $amount_array[$i - 1];
                                                } else {
                                                    echo "0.00";
                                                }
                                                ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="form_label_multiple">Terms & Condition</td>
                                        <td colspan="3" class="form_label_multiple_right">Subtotal</td>
                                        <td colspan="2" class="form_content_multiple"><input type="text" style="text-align:right;" readonly id="sub_total" name="sub_total" class="form-control" value="<?php
                                            if ($id_error == false || $wono_error == false) {
                                                echo $sub_total;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" rowspan="3" class="form_content_multiple">
                                            <select class="form-control dropdown_padding" id="terms_list" name="terms_list" onchange="AjaxFunction_display_terms(this.value)">
                                                <option>Select</option>
                                                <option>New Terms</option>
                                                <?php /*     $Query = "select term_name from master_terms_condition order by term_name";
                                                  $DB->query($Query);

                                                  while ($DB->Multicoloums()) {
                                                  if (($id_error == false || $wono_error == false) && $terms_condition == $DB->Record["term_name"]) {
                                                  echo'<option selected>' . $DB->Record["term_name"] . '</option>';
                                                  } else {
                                                  echo'<option>' . $DB->Record["term_name"] . '</option>';
                                                  }
                                                  }
                                                 */ ?>
                                            </select>
                                            <textarea id="terms_and_condition" style="height:56px;" readonly name="terms_and_condition" class="form-control"><?php if ($id_error == false || $wono_error == false) echo $terms_and_condition; ?></textarea>
                                        </td>
                                        <td colspan="3" class="form_label_multiple_right">(+) Total Tax</td>
                                        <td colspan="2" class="form_content_multiple"><input type="text" style="text-align:right;" readonly id="sale_tax" name="sale_tax" class="form-control" value="<?php
                                            if ($id_error == false || $wono_error == false) {
                                                echo $total_tax;
                                            } else {
                                                echo"0.00";
                                            }
                                            ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="form_label_multiple_right">(-) Discount</td>
                                        <td colspan="2" class="form_content_multiple">
                                            <div style="float:left; width:30%;">
                                                <div class="input-group">
                                                    <input type="text" onblur="calculate_discount()" id="discount_percentage" name="discount_percentage" class="form-control" value="<?php
                                                    if ($id_error == false || $wono_error == false) {
                                                        echo $discount_percentage;
                                                    } else {
                                                        echo"NA";
                                                    }
                                                    ?>">
                                                    <div class="input-group-addon">
                                                        <b>%</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="float:right; width:70%;">
                                                <input type="text" style="text-align:right;" onblur="calculate_discount()" id="discount" name="discount" class="form-control" value="<?php
                                                if ($id_error == false || $wono_error == false) {
                                                    echo $discount;
                                                } else {
                                                    echo"0.00";
                                                }
                                                ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="form_label_multiple_right">Grand Total</td>
                                        <td colspan="2" class="form_content_multiple"><input type="text" style="text-align:right;" readonly id="grand_total" name="grand_total" class="form-control" value="<?php
                                            if ($id_error == false || $wono_error == false) {
                                                echo $grand_total;
                                            } else {
                                                echo"0.00";
                                            }
                                            ?>"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                        if ($id_error == true) {
                            ?>
                            <div class="box-body table-responsive">
                                <div class="form_tablebox">
                                    <table cellspacing="0">
                                        <tr>
                                            <td  class="form_label_split2">
                                                Project No
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <?php /*      $Query = "SELECT max(cast(project_id as unsigned))as max_id from sr_project";
                                                  $UDB->query($Query);
                                                  while ($UDB->Multicoloums()) {
                                                  $max_id = $UDB->Record["max_id"];
                                                  }
                                                  $new_max_id = $max_id + 1;
                                                  $new_max_orderno = $commonvar_project_no_prefix . $new_max_id;
                                                 */ ?>
                                                <input type="text" name="project_no" readonly class="form-control" value="<?php
                                                echo $new_max_orderno;
                                                ?>">
                                            </td>
                                            <td  class="form_label_split2" rowspan="3">
                                                Project Description
                                            </td>
                                            <td class="form_content_split2" align="center" rowspan="3">
                                                <textarea name="project_description" class="form-control" style="height:80px;"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="form_label_split2">
                                                <span class="red">*&nbsp;</span>Project Name
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <input type="text" required name="project_name" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="form_label_split2">
                                                Client Name
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <input type="text" name="project_client_name" readonly class="form-control" value="<?php
                                                echo $client_name . " - " . $client_company_name;
                                                ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="form_label_split2">
                                                Start Date
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="start_date" class="form-control pull-right" id="start_date" onfocus="pick_date(this.id);" value="<?php echo date('d-m-Y'); ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td  class="form_label_split2">
                                                End Date
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="end_date" class="form-control pull-right" id="end_date" onfocus="pick_date(this.id);" value="<?php echo date('d-m-Y'); ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="form_label_split2">
                                                Client Deadline
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <div class="input-group">
                                                    <input type="text" readonly="true" name="client_deadline" class="form-control pull-right" id="client_deadline" onfocus="pick_date(this.id);" value="<?php echo date('d-m-Y'); ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td  class="form_label_split2">
                                                Assigned To
                                            </td>
                                            <td class="form_content_split2">
                                                <select class="form-control dropdown_padding" name="assigned_to">
                                                    <option>Select</option>
                                                    <?php /*       $Query = "select distinct(employee_name) from sr_employee order by employee_name";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if ($id_error == false && $assigned_to == $DB->Record["employee_name"]) {
                                                      echo'<option selected>' . $DB->Record["employee_name"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["employee_name"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="form_label_split2">
                                                Client Work Order
                                            </td>
                                            <td class="form_content_split2" align="center">
                                                <input type="file" class="form-control" name="work_order" id="work_order" style="padding:0px;">
                                            </td>
                                            <td  class="form_label_split2">
                                                Lead By
                                            </td>
                                            <td class="form_content_split2">
                                                <select class="form-control dropdown_padding" name="lead_converted_by">
                                                    <option>Select</option>
                                                    <?php /*     $Query = "select distinct(employee_name) from sr_employee order by employee_name";
                                                      $DB->query($Query);

                                                      while ($DB->Multicoloums()) {
                                                      if ($id_error == false && $assigned_to == $DB->Record["employee_name"]) {
                                                      echo'<option selected>' . $DB->Record["employee_name"] . '</option>';
                                                      } else {
                                                      echo'<option>' . $DB->Record["employee_name"] . '</option>';
                                                      }
                                                      }
                                                     */ ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
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
                            if ($id_error == false) {
                                echo'<input type="hidden" name="form_action" value="Update"/>';
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