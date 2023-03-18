<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_landing';
$return_page = 'vehicle_dispatch_edd_grid.php';
$grid_page = 'vehicle_landing_grid.php';
$registered_at = $FN->return_date_time();

if ($_REQUEST["form_action"] == "Insert") {

    $Query = "insert into sr_vehicle_status values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["dispatch_date"] . "','" . $_REQUEST["dispatch_time"] . "','" . $_REQUEST["expected_dateof_delivery"] . "','" . $_REQUEST["status_date_time"] . "','" . $_REQUEST["vehicle_current_position"] . "','" . $_REQUEST["remarks"] . "','" . $_REQUEST["delay_reason"] . "','" . $_REQUEST["expected_delay_time"] . "','','','','','','','','','','','','','','','','','','','','','Status Updated','" . $_SESSION['username'] . "')";
    $UDB->query($Query);


    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["dispatch_date"] . "','" . $_REQUEST["dispatch_time"] . "','" . $_REQUEST["expected_dateof_delivery"] . "','" . $_REQUEST["landing_date"] . "','" . $_REQUEST["landing_time"] . "','Not Yet Unloaded','" . $_SESSION['username'] . "')";
    $UDB->query($Query);

    $Query = "update sr_vehicle_dispatch set dispatch_status='Reached' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);

    $Query = "update sr_vehicle_status set vehicle_status='Reached' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);

    $subject = 'Vehicle reached at ' . $_REQUEST["destination"] . ' for your order ' . $_REQUEST["order_no"];
    $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $_REQUEST["vehicle_type"] . ' - ' . $_REQUEST["vehicle_no"] . ' for your order ' . $_REQUEST["order_no"] . ' has reached ' . $_REQUEST["destination"] . ' at ' . $_REQUEST["landing_date"] . ' - ' . $_REQUEST["landing_time"] . '.</p>
Regards<br>Rhenus Logistics
</body>
</html>
';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

    $Query = "SELECT  email_alert,sms_alert from sr_vehicle_booking where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $email_alert = $UDB->Record["email_alert"];
        $sms_alert = $UDB->Record["sms_alert"];
    }

    if ($email_alert == "Yes") {
        $Query = "SELECT  email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10 from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $email_id1 = $UDB->Record["email_id1"];
            $email_id2 = $UDB->Record["email_id2"];
            $email_id3 = $UDB->Record["email_id3"];
            $email_id4 = $UDB->Record["email_id4"];
            $email_id5 = $UDB->Record["email_id5"];
            $email_id6 = $UDB->Record["email_id6"];
            $email_id7 = $UDB->Record["email_id7"];
            $email_id8 = $UDB->Record["email_id8"];
            $email_id9 = $UDB->Record["email_id9"];
            $email_id10 = $UDB->Record["email_id10"];
        }

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
        mail($to, $subject, $message, $headers);

        $Query = "insert into sr_mail_delivery values(NULL,'" . $registered_at . "','" . $to . "','" . $subject . "','" . $message . "')";
        $UDB->query($Query);
    }

    if ($sms_alert == "Yes") {
        $Query = "SELECT  mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $_REQUEST["order_no"] . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $mobile_no1 = $UDB->Record["mobile_no1"];
            $mobile_no2 = $UDB->Record["mobile_no2"];
            $mobile_no3 = $UDB->Record["mobile_no3"];
            $mobile_no4 = $UDB->Record["mobile_no4"];
            $mobile_no5 = $UDB->Record["mobile_no5"];
            $mobile_no6 = $UDB->Record["mobile_no6"];
            $mobile_no7 = $UDB->Record["mobile_no7"];
            $mobile_no8 = $UDB->Record["mobile_no8"];
            $mobile_no9 = $UDB->Record["mobile_no9"];
            $mobile_no10 = $UDB->Record["mobile_no10"];
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

        $strmsg = 'Dear Client,' . $_REQUEST["vehicle_type"] . ' - ' . $_REQUEST["vehicle_no"] . ' for your order ' . $_REQUEST["order_no"] . ' has reached ' . $_REQUEST["destination"] . ' at ' . $_REQUEST["landing_date"] . ' - ' . $_REQUEST["landing_time"] . '.- Rhenus Logistics';
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
    $Query = "update $tablename set landing_date='" . $_REQUEST["landing_date"] . "',landing_time='" . $_REQUEST["landing_time"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>