<?php

include'../../template/common/header.default_noredirect_action.php';
$sender = $_REQUEST["strsender"];
$message = strtoupper($_REQUEST["strmessage"]);
$delivery_date = date('d-m-Y');
$delivery_time = date('H:i:s');
$registered_at = $FN->return_date_time();
/* * *********Vehicle Placement ********************* */
if (strpos($message, 'PLACE') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,vehicle_required_date,vehicle_required_time,orgin,destination,vehicle_type,vehicle_no,driver_type,escart_option,tracking_device,loading_charges,unloading_charges,dedicated_market_vehicle,booking_status from sr_vehicle_booking where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $vehicle_required_date = $UDB->Record["vehicle_required_date"];
        $vehicle_required_time = $UDB->Record["vehicle_required_time"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $driver_type = $UDB->Record["driver_type"];
        $escart_option = $UDB->Record["escart_option"];
        $tracking_device = $UDB->Record["tracking_device"];
        $loading_charges = $UDB->Record["loading_charges"];
        $unloading_charges = $UDB->Record["unloading_charges"];
        $dedicated_market_vehicle = $UDB->Record["dedicated_market_vehicle"];
        $booking_status = $UDB->Record["booking_status"];
    }

    if ($booking_status == "Not Yet Placed") {
        $Query = "insert into sr_vehicle_placement values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $vehicle_required_date . "','" . $vehicle_required_time . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $driver_type . "','" . $escart_option . "','" . $tracking_device . "','" . $loading_charges . "','" . $unloading_charges . "','" . $dedicated_market_vehicle . "','" . $delivery_date . "','" . $delivery_time . "','','','Not Yet Released','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_booking set booking_status='Placed' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);

        $subject = 'Vehicle Placed at ' . $orgin . ' for your order ' . $order_no;
        $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $vehicle_type . ' - ' . $vehicle_no . ' has placed for your order ' . $order_no . ' at ' . $orgin . ' on ' . $delivery_date . ' - ' . $delivery_time . '.</p>
      Regards<br>Rhenus Logistics
</body>
</html>
';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

        $Query = "SELECT  email_alert,sms_alert from sr_vehicle_booking where order_no='" . $order_no . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $email_alert = $UDB->Record["email_alert"];
            $sms_alert = $UDB->Record["sms_alert"];
        }

        if ($email_alert == "Yes") {
            $Query = "SELECT  email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10 from sr_customer_order where order_no='" . $order_no . "'";
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
            $Query = "SELECT  mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $order_no . "'";
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

            $strmsg = "Dear Client, " . $vehicle_type . " - " . $vehicle_no . " has placed for your order " . $order_no . " at " . $orgin . " on " . $delivery_date . " : " . $delivery_time . " - Rhenus Logistics";
            $strmsglen = strlen($strmsg);
            $total_count_quo = intval($strmsglen / 160);
            $total_count_rem = intval($strmsglen % 160);
            if ($total_count_rem > 0) {
                $total_count_rem = 1;
            }
            $total_count = $total_count_quo + $total_count_rem;
            $ch = curl_init();
            $url = 'http://www.smsintegra.com/smsweb/desktop_sms/desktopsms.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD . '&mobile=' . $mobile_no . '&msg=' . urlencode($strmsg) . '&sid=' . urlencode(SENDERID) . '&dtNow=01-Dec-2014';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            $Query = "insert into sr_sms_delivery values(NULL,'" . $registered_at . "','" . $mobile_no . "','" . $strmsg . "','" . $total_count . "')";
            $UDB->query($Query);
        }
    }
}
/* * *********Vehicle Placement ********************* */

/* * *********Vehicle Loading Start ********************* */
if (strpos($message, 'LOADS') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,placement_status from sr_vehicle_placement where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $placement_status = $UDB->Record["placement_status"];
    }

    if ($placement_status == "Not Yet Released") {
        $Query = "insert into sr_vehicle_loading_start values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $placement_date . "','" . $placement_time . "','" . $delivery_date . "','" . $delivery_time . "','Not Yet Loaded','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_placement set placement_status='Released' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);
    }
}
/* * *********Vehicle Loading Start ********************* */

/* * *********Vehicle Loading END ********************* */
if (strpos($message, 'LOADE') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_status from sr_vehicle_loading_start where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_status = $UDB->Record["loading_status"];
    }

    if ($loading_status == "Not Yet Loaded") {
        $Query = "insert into sr_vehicle_loading_end values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $placement_date . "','" . $placement_time . "','" . $loading_start_date . "','" . $loading_start_time . "','" . $delivery_date . "','" . $delivery_time . "','Not Yet Dispatched','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_loading_start set loading_status='Loaded' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);
    }
}
/* * *********Vehicle Loading End ********************* */

/* * *********Vehicle Dispatch ********************* */
if (strpos($message, 'START') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,loading_status from sr_vehicle_loading_end where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
        $loading_status = $UDB->Record["loading_status"];
    }

    if ($loading_status == "Not Yet Dispatched") {

        $Query = "insert into sr_vehicle_dispatch values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $placement_date . "','" . $placement_time . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $loading_start_date . "','" . $loading_start_time . "','" . $loading_end_date . "','" . $loading_end_time . "','" . $delivery_date . "','" . $delivery_time . "','','','','','','','','','','','','Not Yet Reached','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_loading_end set loading_status='Dispatched' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);

        $subject = 'Transit starts for your order ' . $order_no . ' from ' . $orgin;
        $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $vehicle_type . ' - ' . $vehicle_no . ' for your order ' . $order_no . ' has starts its transit from ' . $orgin . ' at ' . $delivery_date . ' - ' . $delivery_time . '. The vehicle will reach ' . $destination . ' Soon.<br></p>      
Regards<br>Rhenus Logistics
</body>
</html>
';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

        $Query = "SELECT  email_alert,sms_alert from sr_vehicle_booking where order_no='" . $order_no . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $email_alert = $UDB->Record["email_alert"];
            $sms_alert = $UDB->Record["sms_alert"];
        }

        if ($email_alert == "Yes") {
            $Query = "SELECT  email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10 from sr_customer_order where order_no='" . $order_no . "'";
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
            $Query = "SELECT  mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $order_no . "'";
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

            $strmsg = 'Dear Client,Transit starts for your order ' . $order_no . ' from ' . $orgin . ' at ' . $delivery_date . ' - ' . $delivery_time . '. The vehicle will reach ' . $destination . ' on ' . $expected_dateof_delivery . '.You may get vehicle transit status at anytime using your LR Number : ' . $lr_no . ' at our website-Rhenus Logistics';
            $strmsglen = strlen($strmsg);
            $total_count_quo = intval($strmsglen / 160);
            $total_count_rem = intval($strmsglen % 160);
            if ($total_count_rem > 0) {
                $total_count_rem = 1;
            }
            $total_count = $total_count_quo + $total_count_rem;
            $ch = curl_init();
            $url = 'http://www.smsintegra.com/smsweb/desktop_sms/desktopsms.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD . '&mobile=' . $mobile_no . '&msg=' . urlencode($strmsg) . '&sid=' . urlencode(SENDERID) . '&dtNow=01-Dec-2014';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            //echo "<br><br>".$mobile_no."<br>".$strmsg;

            $Query = "insert into sr_sms_delivery values(NULL,'" . $registered_at . "','" . $mobile_no . "','" . $strmsg . "','" . $total_count . "')";
            $UDB->query($Query);
        }
    }
}
/* * *********Vehicle Dispatch ********************* */

/* * *********LR Number ********************* */
if (strpos($message, 'LRNUM') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);
    $lr_no = trim($message_split[2]);

    $Query = "update sr_vehicle_dispatch set lr_no='" . $lr_no . "' where order_no='" . $order_no . "'";
    $UDB->query($Query);
    $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
    $UDB->query($Query);
}
/* * *********LR Number ********************* */

/* * *********Vehicle Delay ********************* */
if (strpos($message, 'DELAY') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);
    $trans_status = trim($message_split[2]);
    $delay_reason = "Delay";

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,dispatch_date,dispatch_time,expected_dateof_delivery,dispatch_status from sr_vehicle_dispatch where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $dispatch_status = $UDB->Record["dispatch_status"];
    }

    if ($dispatch_status == "Not Yet Reached") {

        $Query = "insert into sr_vehicle_status values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $delivery_date . "-" . $delivery_time . "','" . $trans_status . "','','Delay','','','','','','','','','','','','','','','','','','','','','','Status Updated','SMS Upload')";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);

        $subject = 'Unexpected delay has occurred for your order ' . $order_no . ' at ' . $trans_status;
        $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $vehicle_type . ' - ' . $vehicle_no . ' for your order ' . $order_no . ' has delayed unexpectedly at ' . $trans_status . ' due to ' . $delay_reason . '. The vehicle will reach ' . $destination . ' on ' . $expected_delay_time . '.<br>
We apologize for any inconveniences this issue might have caused you.</p>      
Regards<br>Rhenus Logistics
</body>
</html>
';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

        $Query = "SELECT  email_alert,sms_alert from sr_vehicle_booking where order_no='" . $order_no . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $email_alert = $UDB->Record["email_alert"];
            $sms_alert = $UDB->Record["sms_alert"];
        }

        if ($email_alert == "Yes") {
            $Query = "SELECT  email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10 from sr_customer_order where order_no='" . $order_no . "'";
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
            $Query = "SELECT  mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $order_no . "'";
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

            $strmsg = 'Dear Client, Un expected delay happend for your order ' . $order_no . '  at ' . $trans_status . ' due to ' . $delay_reason . '. The vehicle will reach  ' . $destination . ' on' . $expected_delay_time . '. We apologize for any inconveniences this issue might have caused you.- Rhenus Logistics';
            $strmsglen = strlen($strmsg);
            $total_count_quo = intval($strmsglen / 160);
            $total_count_rem = intval($strmsglen % 160);
            if ($total_count_rem > 0) {
                $total_count_rem = 1;
            }
            $total_count = $total_count_quo + $total_count_rem;
            $ch = curl_init();
            $url = 'http://www.smsintegra.com/smsweb/desktop_sms/desktopsms.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD . '&mobile=' . $mobile_no . '&msg=' . urlencode($strmsg) . '&sid=' . urlencode(SENDERID) . '&dtNow=01-Dec-2014';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            //echo "<br><br>".$mobile_no."<br>".$strmsg;

            $Query = "insert into sr_sms_delivery values(NULL,'" . $registered_at . "','" . $mobile_no . "','" . $strmsg . "','" . $total_count . "')";
            $UDB->query($Query);
        }
    }
}
/* * *********Vehicle Delay ********************* */

/* * *********Vehicle Transit ********************* */
if (strpos($message, 'TRANS') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);
    $trans_status = trim($message_split[2]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,dispatch_date,dispatch_time,expected_dateof_delivery,dispatch_status from sr_vehicle_dispatch where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $dispatch_status = $UDB->Record["dispatch_status"];
    }

    if ($dispatch_status == "Not Yet Reached") {
        $Query = "insert into sr_vehicle_status values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $delivery_date . "-" . $delivery_time . "','" . $trans_status . "','','','','','','','','','','','','','','','','','','','','','','','','Status Updated','SMS Upload')";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);
    }
}
/* * *********Vehicle Transit ********************* */

/* * *********Vehicle Landing ********************* */
if (strpos($message, 'REACH') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,placement_date,placement_time,loading_start_date,loading_start_time,loading_end_date,loading_end_time,dispatch_date,dispatch_time,expected_dateof_delivery,dispatch_status from sr_vehicle_dispatch where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $placement_date = $UDB->Record["placement_date"];
        $placement_time = $UDB->Record["placement_time"];
        $loading_start_date = $UDB->Record["loading_start_date"];
        $loading_start_time = $UDB->Record["loading_start_time"];
        $loading_end_date = $UDB->Record["loading_end_date"];
        $loading_end_time = $UDB->Record["loading_end_time"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $dispatch_status = $UDB->Record["dispatch_status"];
    }

    if ($dispatch_status == "Not Yet Reached") {
        $Query = "insert into sr_vehicle_landing values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $delivery_date . "','" . $delivery_time . "','Not Yet Unloaded','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_dispatch set dispatch_status='Reached' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "update sr_vehicle_status set vehicle_status='Reached' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);

        $subject = 'Vehicle reached at ' . $destination . ' for your order ' . $order_no;
        $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $vehicle_type . ' - ' . $vehicle_no . ' for your order ' . $order_no . ' has reached ' . $destination . ' at ' . $delivery_date . ' - ' . $delivery_time . '.</p>      
Regards<br>Rhenus Logistics
</body>
</html>
';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

        $Query = "SELECT  email_alert,sms_alert from sr_vehicle_booking where order_no='" . $order_no . "'";
        $UDB->query($Query);
        while ($UDB->Multicoloums()) {
            $email_alert = $UDB->Record["email_alert"];
            $sms_alert = $UDB->Record["sms_alert"];
        }

        if ($email_alert == "Yes") {
            $Query = "SELECT  email_id1,email_id2,email_id3,email_id4,email_id5,email_id6,email_id7,email_id8,email_id9,email_id10 from sr_customer_order where order_no='" . $order_no . "'";
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
            $Query = "SELECT  mobile_no1,mobile_no2,mobile_no3,mobile_no4,mobile_no5,mobile_no6,mobile_no7,mobile_no8,mobile_no9,mobile_no10 from sr_customer_order where order_no='" . $order_no . "'";
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

            $strmsg = 'Dear Client,' . $vehicle_type . ' - ' . $vehicle_no . ' for your order ' . $order_no . ' has reached ' . $destination . ' at ' . $delivery_date . ' - ' . $delivery_time . '.- Rhenus Logistics';
            $strmsglen = strlen($strmsg);
            $total_count_quo = intval($strmsglen / 160);
            $total_count_rem = intval($strmsglen % 160);
            if ($total_count_rem > 0) {
                $total_count_rem = 1;
            }
            $total_count = $total_count_quo + $total_count_rem;
            $ch = curl_init();
            $url = 'http://www.smsintegra.com/smsweb/desktop_sms/desktopsms.asp?uid=' . SMSUSERNAME . '&pwd=' . SMSPASSWORD . '&mobile=' . $mobile_no . '&msg=' . urlencode($strmsg) . '&sid=' . urlencode(SENDERID) . '&dtNow=01-Dec-2014';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            //echo "<br><br>".$mobile_no."<br>".$strmsg;

            $Query = "insert into sr_sms_delivery values(NULL,'" . $registered_at . "','" . $mobile_no . "','" . $strmsg . "','" . $total_count . "')";
            $UDB->query($Query);
        }
    }
}
/* * *********Vehicle Landing ********************* */

/* * *********Vehicle Unloading ********************* */
if (strpos($message, 'UNLOAD') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery,landing_date,landing_time,landing_status from sr_vehicle_landing where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $landing_date = $UDB->Record["landing_date"];
        $landing_time = $UDB->Record["landing_time"];
        $landing_status = $UDB->Record["landing_status"];
    }

    if ($landing_status == "Not Yet Unloaded") {
        $Query = "insert into sr_vehicle_unloading values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $landing_date . "','" . $landing_time . "','" . $delivery_date . "','" . $delivery_time . "','Not Yet Reported','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_landing set landing_status='Unloaded' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);
    }
}
/* * *********Vehicle Unloading ********************* */

/* * *********Vehicle Release ********************* */
if (strpos($message, 'RELEASE') !== false) {
    $message_split = explode(" ", $message);
    $order_no = trim($message_split[1]);

    $Query = "SELECT  id,client_name,client_division,client_branch,orgin,destination,vehicle_type,vehicle_no,dispatch_date,dispatch_time,expected_dateof_delivery,landing_date,landing_time,unloading_date,unloading_time,unloading_status from sr_vehicle_unloading where order_no='" . $order_no . "'";

    $UDB->query($Query);
    while ($UDB->Multicoloums()) {
        $client_name = $UDB->Record["client_name"];
        $client_division = $UDB->Record["client_division"];
        $client_branch = $UDB->Record["client_branch"];
        $orgin = $UDB->Record["orgin"];
        $destination = $UDB->Record["destination"];
        $vehicle_type = $UDB->Record["vehicle_type"];
        $vehicle_no = $UDB->Record["vehicle_no"];
        $dispatch_date = $UDB->Record["dispatch_date"];
        $dispatch_time = $UDB->Record["dispatch_time"];
        $expected_dateof_delivery = $UDB->Record["expected_dateof_delivery"];
        $landing_date = $UDB->Record["landing_date"];
        $landing_time = $UDB->Record["landing_time"];
        $unloading_date = $UDB->Record["unloading_date"];
        $unloading_time = $UDB->Record["unloading_time"];
        $unloading_status = $UDB->Record["unloading_status"];
    }

    if ($unloading_status == "Not Yet Reported") {
        $Query = "insert into sr_vehicle_reporting values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $dispatch_date . "','" . $dispatch_time . "','" . $expected_dateof_delivery . "','" . $landing_date . "','" . $landing_time . "','" . $unloading_date . "','" . $unloading_time . "','" . $delivery_date . "','" . $delivery_time . "','','','','','','Reported','SMS Upload')";
        $UDB->query($Query);

        $Query = "update sr_vehicle_unloading set unloading_status='Reported' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "update sr_customer_order set order_status='Delivered' where order_no='" . $order_no . "'";
        $UDB->query($Query);

        $Query = "insert into sr_sms_upload values(NULL,'" . $sender . "','" . $message . "','" . $delivery_date . "','" . $delivery_time . "','Updated Successfully')";
        $UDB->query($Query);
    }
}
/* * *********Vehicle Release ********************* */
?>