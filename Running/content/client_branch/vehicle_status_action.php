<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_status';
$return_page = 'vehicle_status_grid.php';
$grid_page = 'vehicle_status_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["dispatch_date"] . "','" . $_REQUEST["dispatch_time"] . "','" . $_REQUEST["expected_dateof_delivery"] . "','" . $_REQUEST["status_date_time"] . "','" . $_REQUEST["vehicle_current_position"] . "','" . $_REQUEST["remarks"] . "','" . $_REQUEST["delay_reason"] . "','" . $_REQUEST["expected_delay_time"] . "','" . $_REQUEST["email_id1"] . "','" . $_REQUEST["email_id2"] . "','" . $_REQUEST["email_id3"] . "','" . $_REQUEST["email_id4"] . "','" . $_REQUEST["email_id5"] . "','" . $_REQUEST["email_id6"] . "','" . $_REQUEST["email_id7"] . "','" . $_REQUEST["email_id8"] . "','" . $_REQUEST["email_id9"] . "','" . $_REQUEST["email_id10"] . "','" . $_REQUEST["mobile_no1"] . "','" . $_REQUEST["mobile_no2"] . "','" . $_REQUEST["mobile_no3"] . "','" . $_REQUEST["mobile_no4"] . "','" . $_REQUEST["mobile_no5"] . "','" . $_REQUEST["mobile_no6"] . "','" . $_REQUEST["mobile_no7"] . "','" . $_REQUEST["mobile_no8"] . "','" . $_REQUEST["mobile_no9"] . "','" . $_REQUEST["mobile_no10"] . "','Status Updated','" . $_SESSION['username'] . "')";
    $UDB->query($Query);

    $subject = 'Unexpected delay has occurred for your order ' . $_REQUEST["order_no"] . ' at ' . $_REQUEST["vehicle_current_position"];
    $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $_REQUEST["vehicle_type"] . ' - ' . $_REQUEST["vehicle_no"] . ' for your order ' . $_REQUEST["order_no"] . ' has delayed unexpectedly at ' . $_REQUEST["vehicle_current_position"] . ' due to ' . $_REQUEST["delay_reason"] . '. The vehicle will reach ' . $_REQUEST["destination"] . ' on ' . $_REQUEST["expected_delay_time"] . '.<br>
We apologize for any inconveniences this issue might have caused you.</p>
Regards<br>Rhenus Logistics
</body>
</html>
';

    $subject1 = 'Transit status for your order ' . $_REQUEST["order_no"] . ' at ' . $_REQUEST["vehicle_current_position"];
    $message1 = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $_REQUEST["vehicle_type"] . ' - ' . $_REQUEST["vehicle_no"] . ' for your order ' . $_REQUEST["order_no"] . ' crossed ' . $_REQUEST["vehicle_current_position"] . '. The vehicle will reach ' . $_REQUEST["destination"] . ' on commited time.<br></p>
Regards<br>Rhenus Logistics
</body>
</html>
';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

    $email_id1 = $_REQUEST["email_id1"];
    $email_id2 = $_REQUEST["email_id2"];
    $email_id3 = $_REQUEST["email_id3"];
    $email_id4 = $_REQUEST["email_id4"];
    $email_id5 = $_REQUEST["email_id5"];
    $email_id6 = $_REQUEST["email_id6"];
    $email_id7 = $_REQUEST["email_id7"];
    $email_id8 = $_REQUEST["email_id8"];
    $email_id9 = $_REQUEST["email_id9"];
    $email_id10 = $_REQUEST["email_id10"];
    $mobile_no1 = $_REQUEST["mobile_no1"];
    $mobile_no2 = $_REQUEST["mobile_no2"];
    $mobile_no3 = $_REQUEST["mobile_no3"];
    $mobile_no4 = $_REQUEST["mobile_no4"];
    $mobile_no5 = $_REQUEST["mobile_no5"];
    $mobile_no6 = $_REQUEST["mobile_no6"];
    $mobile_no7 = $_REQUEST["mobile_no7"];
    $mobile_no8 = $_REQUEST["mobile_no8"];
    $mobile_no9 = $_REQUEST["mobile_no9"];
    $mobile_no10 = $_REQUEST["mobile_no10"];

    $to = "";

    if ($email_id1 != NULL) {
        $to = $to . $email_id1;
    }
    if ($email_id2 != NULL) {
        $to = $to . "," . $email_id2;
    }
    if ($email_id3 != NULL) {
        $to = $to . "," . $email_id3;
    }
    if ($email_id4 != NULL) {
        $to = $to . "," . $email_id4;
    }
    if ($email_id5 != NULL) {
        $to = $to . "," . $email_id5;
    }
    if ($email_id6 != NULL) {
        $to = $to . "," . $email_id6;
    }
    if ($email_id7 != NULL) {
        $to = $to . "," . $email_id7;
    }
    if ($email_id8 != NULL) {
        $to = $to . "," . $email_id8;
    }
    if ($email_id9 != NULL) {
        $to = $to . "," . $email_id9;
    }
    if ($email_id10 != NULL) {
        $to = $to . "," . $email_id10;
    }
    //echo $subject."<br>".$to."<br>".$message;
    if (isset($_REQUEST["delay_reason"]) && !empty($_REQUEST["delay_reason"])) {
        if (isset($to) && !empty($to)) {
            mail($to, $subject, $message, $headers);

            $Query = "insert into sr_mail_delivery values(NULL,'" . $registered_at . "','" . $to . "','" . $subject . "','" . $message . "')";
            $UDB->query($Query);
        }
    } else if (isset($_REQUEST["vehicle_current_position"]) && !empty($_REQUEST["vehicle_current_position"])) {
        if (isset($to) && !empty($to)) {
            mail($to, $subject1, $message1, $headers);

            $Query = "insert into sr_mail_delivery values(NULL,'" . $registered_at . "','" . $to . "','" . $subject1 . "','" . $message1 . "')";
            $UDB->query($Query);
        }
    }

    $mobile_no = "";

    if ($mobile_no1 != NULL) {
        $mobile_no = $mobile_no . $mobile_no1;
    }
    if ($mobile_no2 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no2;
    }
    if ($mobile_no3 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no3;
    }
    if ($mobile_no4 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no4;
    }
    if ($mobile_no5 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no5;
    }
    if ($mobile_no6 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no6;
    }
    if ($mobile_no7 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no7;
    }
    if ($mobile_no8 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no8;
    }
    if ($mobile_no9 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no9;
    }
    if ($mobile_no10 != NULL) {
        $mobile_no = $mobile_no . "," . $mobile_no10;
    }

    $Query = "SELECT lr_no from sr_vehicle_dispatch where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $lr_no = $UDB->Record["lr_no"];
    }

    if (isset($_REQUEST["delay_reason"]) && !empty($_REQUEST["delay_reason"])) {

        $strmsg = 'Dear Client, Un expected delay happend for your order ' . $_REQUEST["order_no"] . '  at ' . $_REQUEST["vehicle_current_position"] . ' due to ' . $_REQUEST["delay_reason"] . '. The vehicle will reach  ' . $_REQUEST["destination"] . ' on' . $_REQUEST["expected_delay_time"] . '. We apologize for any inconveniences this issue might have caused you.- Rhenus Logistics';
    } else if (isset($_REQUEST["vehicle_current_position"]) && !empty($_REQUEST["vehicle_current_position"])) {
        $strmsg = 'Dear Client, Vehicle current position for your order ' . $_REQUEST["order_no"] . ' is near  ' . $_REQUEST["vehicle_current_position"] . ' on ' . $registered_at . ' . You may get vehicle transit status at anytime using your LR Number : ' . $lr_no . ' at our website-Rhenus Logistics';
    }
    if (isset($mobile_no) && !empty($mobile_no)) {
        $strmsglen = strlen($strmsg);
        $total_count_quo = intval($strmsglen / 160);
        $total_count_rem = intval($strmsglen % 160);
        if ($total_count_rem > 0) {
            $total_count_rem = 1;
        }
        $total_count = $total_count_quo + $total_count_rem;
        $ch = curl_init();
        $url = 'http://www.smsintegra.com/smsweb/desktop_sms/desktopsms.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD . '&mobile=' . $mobile_no . '&msg=' . urlencode($strmsg) . '&sid=' . urlencode(SENDERID) . '&dtNow=01-Dec-2014';
        //echo $strmsg."<br>";
        //echo $mobile_no."<br>";
        //echo $strmsglen."<br>";
        //echo $total_count;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        //echo $response;
        curl_close($ch);

        $Query = "insert into sr_sms_delivery values(NULL,'" . $registered_at . "','" . $mobile_no . "','" . $strmsg . "','" . $total_count . "')";
        $UDB->query($Query);
    }

    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set status_date_time='" . $_REQUEST["status_date_time"] . "',vehicle_current_position='" . $_REQUEST["vehicle_current_position"] . "',remarks='" . $_REQUEST["remarks"] . "',delay_reason='" . $_REQUEST["delay_reason"] . "',expected_delay_time='" . $_REQUEST["expected_delay_time"] . "',email_id1='" . $_REQUEST["email_id1"] . "',email_id2='" . $_REQUEST["email_id2"] . "',email_id3='" . $_REQUEST["email_id3"] . "',email_id4='" . $_REQUEST["email_id4"] . "',email_id5='" . $_REQUEST["email_id5"] . "',email_id6='" . $_REQUEST["email_id6"] . "',email_id7='" . $_REQUEST["email_id7"] . "',email_id8='" . $_REQUEST["email_id8"] . "',email_id9='" . $_REQUEST["email_id9"] . "',email_id10='" . $_REQUEST["email_id10"] . "',mobile_no1='" . $_REQUEST["mobile_no1"] . "',mobile_no2='" . $_REQUEST["mobile_no2"] . "',mobile_no3='" . $_REQUEST["mobile_no3"] . "',mobile_no4='" . $_REQUEST["mobile_no4"] . "',mobile_no5='" . $_REQUEST["mobile_no5"] . "',mobile_no6='" . $_REQUEST["mobile_no6"] . "',mobile_no7='" . $_REQUEST["mobile_no7"] . "',mobile_no8='" . $_REQUEST["mobile_no8"] . "',mobile_no9='" . $_REQUEST["mobile_no9"] . "',mobile_no10='" . $_REQUEST["mobile_no10"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>