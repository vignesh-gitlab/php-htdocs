<html>
    <body>
        <div style="width:100px; margin-left:auto; margin-right:auto; margin-top:200px;">
            <img src="../../theme/img/ajax-loader1.gif"/>
        </div>
    </body>
</html>
<?php
require("../../template/common/header.config.php");
require("../../template/common/userdb_cofiguration.php");
include "class/excel_reader2.php";

$redirectpage = '../master.php';
$msg = "Insert Success&msgtype=Success&pageid=11";

if ($_FILES["excelfile"]["error"] > 0) {
    echo "Return Code: " . $_FILES["excelfile"]["error"] . "<br />";
} else {
    move_uploaded_file($_FILES["excelfile"]["tmp_name"], "../../files/excel_import/" . $_FILES["excelfile"]["name"]);
    $csvfile = "../../files/excel_import/" . $_FILES["excelfile"]["name"];
}

$voucher_date = $_REQUEST["voucher_date"];
$voucher_week = $_REQUEST ["voucher_start_week"] . ":" . $_REQUEST["voucher_end_week"];
$redirect_page = $_REQUEST["redirect_path"];

$data = new Spreadsheet_Excel_Reader($csvfile);
$baris = $data->rowcount($sheet_index = 0);

for ($i = 4; $i <= $baris; $i++) {
    $employee_name = $data->val($i, 1);
    if ($employee_name != NULL) {
        $ot_rate = 0;
        $ot_hours = $data->val($i, 8);
        if ($ot_hours == NULL) {
            $ot_hours = 0;
        }
        $tea_charges = $data->val($i, 9);
        if ($tea_charges == NULL) {
            $tea_charges = 0;
        }
        $Query = "SELECT ot_rate from sr_employee where status=1 and employee_first_name='" . $employee_name . "'";
        $DB->query($Query);
        if ($DB->Multicoloums()) {
            $ot_rate = $DB->Record ["ot_rate"];
        }
        if ($ot_rate == 0) {
            $total_roundoff_charges = 0;
        } else {
            $roundoff_charges = (($ot_hours * $ot_rate) + $tea_charges);
            $total_roundoff_charges = number_format($roundoff_charges, 2);
        }
        $query = "INSERT INTO sr_otentry VALUES (NULL,'$voucher_date', '$voucher_week','$employee_name', '$ot_rate','$ot_hours','$tea_charges','$total_roundoff_charges')";
//echo $query."<br>";
        $UDB->query($query);
    }
}
$FN->page_redirect($redirect_page);
?> 