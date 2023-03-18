<?php

include'../../template/common/header.default_noredirect_action.php';
//include'../../template/common/header.default_action.php';
$registered_at = $FN->return_date_time();
$cur_date = date('d-m-Y');
$cur_time = date('h:i:s');

//$imap = imap_open("{imap.gmail.com:993/ssl/novalidate-cert}INBOX", "deepa.decors1@gmail.com", "sprakash");
$imap = imap_open("{imap.gmail.com:993/ssl/novalidate-cert}INBOX", "trackandtrace@westernarya.com", "wat20142015");

if ($imap) {

    //Check no.of.msgs 
    $num = imap_num_msg($imap);
    //$end_num = $num-25;
    $end_num = $num;
    //if there is a message in your inbox 
    for ($i = $num; $i >= $end_num; $i--) {
        ////if ($num > 0) {
        //read that mail recently arrived 
        $header = imap_header($imap, $i);
        $from = $header->from;
        foreach ($from as $id => $object) {
            $fromname = $object->personal;
            $fromaddress = $object->mailbox . "@" . $object->host;
            $subject = $object->subject;
        }
        $message = imap_qprint(imap_body($imap, $i));
        echo $subject;

        //**************************Vehicle Placement Starts***************
        if (strpos($message, 'PLACE') !== false) {
            $message_split = explode("PLACE", $message);
            $order_no_split = explode("-", $message_split[1]);
            $order_no = trim($order_no_split[0]);

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
                $Query = "insert into sr_vehicle_placement values(NULL,'" . $order_no . "','" . $client_name . "','" . $client_division . "','" . $client_branch . "','" . $vehicle_required_date . "','" . $vehicle_required_time . "','" . $orgin . "','" . $destination . "','" . $vehicle_type . "','" . $vehicle_no . "','" . $driver_type . "','" . $escart_option . "','" . $tracking_device . "','" . $loading_charges . "','" . $unloading_charges . "','" . $dedicated_market_vehicle . "','" . $cur_date . "','" . $cur_time . "','','','Not Yet Released','Email Upload')";
                $UDB->query($Query);

                $Query = "update sr_vehicle_booking set booking_status='Placed' where order_no='" . $order_no . "'";
                $UDB->query($Query);

                $Query = "insert into sr_mail_upload values(NULL,'" . $fromname . "','" . $fromaddress . "','" . $cur_date . "','" . $cur_time . "','PLACE " . $order_no . "')";
                $UDB->query($Query);

                $subject = 'Vehicle Placed at ' . $orgin . ' for your order ' . $order_no;
                $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $vehicle_type . ' - ' . $vehicle_no . ' has placed for your order ' . $order_no . ' at ' . $orgin . ' on ' . $cur_date . ' - ' . $cur_time . '.</p>
      Regards<br>Rhenus Logistics
</body>
</html>
';
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                //$headers .= 'To: Naren <naren@srinfosoft.com.com>, Kelly <kelly@example.com>' . "\r\n";
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

                    $strmsg = "Dear Client, " . $vehicle_type . " - " . $vehicle_no . " has placed for your order " . $order_no . " at " . $orgin . " on " . $placement_date . " : " . $placement_time . " - Rhenus Logistics";
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
        //**************************Vehicle Placement Ends***************
    }
    //close the stream 
    imap_close($imap);
    echo '<center><h1 style="margin-top:300px;">Email Upload Success</h1></center>';
}
?>