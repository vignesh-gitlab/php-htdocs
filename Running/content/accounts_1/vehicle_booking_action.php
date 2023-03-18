<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_booking';
$return_page = 'customer_order_grid.php';
$grid_page = 'vehicle_booking_grid.php';
$registered_at = $FN->return_date_time();
$redirect_page = 'superadmin/customer_order_grid.php';

if ($_REQUEST["form_action"] == "Insert") {
    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["order_no"] . "','" . $_REQUEST["so_no"] . "','" . $_REQUEST["client_name"] . "','" . $_REQUEST["client_division"] . "','" . $_REQUEST["client_branch"] . "','" . $_REQUEST["vehicle_required_date"] . "','" . $_REQUEST["vehicle_required_time"] . "','" . $_REQUEST["orgin"] . "','" . $_REQUEST["destination"] . "','" . $_REQUEST["vehicle_type"] . "','" . $_REQUEST["vehicle_ownership_type"] . "','" . $_REQUEST["vehicle_owner"] . "','" . $_REQUEST["primary_secondary"] . "','" . $_REQUEST["vehicle_no"] . "','" . $_REQUEST["driver_type"] . "','" . $_REQUEST["driver_name"] . "','" . $_REQUEST["driver_contact_no"] . "','" . $_REQUEST["escart_option"] . "','" . $_REQUEST["escort_name"] . "','" . $_REQUEST["tracking_device"] . "','" . $_REQUEST["sms_alert"] . "','" . $_REQUEST["email_alert"] . "','" . $_REQUEST["loading_charges"] . "','" . $_REQUEST["unloading_charges"] . "','" . $_REQUEST["dedicated_market_vehicle"] . "','Not Yet Placed','" . $_SESSION['username'] . "')";
    $UDB->query($Query);

    $Query = "update sr_customer_order set order_status='Booked' where order_no='" . $_REQUEST["order_no"] . "'";
    $UDB->query($Query);

    $Query = "update sr_vehicle set availablity='No' where registration_no='" . $_REQUEST["vehicle_no"] . "'";
    $DB->query($Query);

    $subject = 'Vehicle Booked for your order ' . $_REQUEST["order_no"];
    $message = '
<html>
<body STYLE="font-family:arial; font-size:13px;">
  <p>Dear Client,<br><br>' . $_REQUEST["vehicle_type"] . ' - ' . $_REQUEST["vehicle_no"] . ' has booked for your order. Your order number is ' . $_REQUEST["order_no"] . ' and the vehicle will reach ' . $_REQUEST["orgin"] . ' at ' . $_REQUEST["vehicle_required_date"] . ' - ' . $_REQUEST["vehicle_required_time"] . '.</p>
      Regards<br>Rhenus Logistics
</body>
</html>
';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Rhenus Logistics <noreply@in.rhenus.com>' . "\r\n";

    if ($_REQUEST["email_alert"] == "Yes") {
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

    $FN->page_redirect($return_page);
} else if ($_REQUEST["form_action"] == "Update") {
    $Query = "update $tablename set client_name='" . $_REQUEST["client_name"] . "',client_division='" . $_REQUEST["client_division"] . "',client_branch='" . $_REQUEST["client_branch"] . "',vehicle_required_date='" . $_REQUEST["vehicle_required_date"] . "',vehicle_required_time='" . $_REQUEST["vehicle_required_time"] . "',orgin='" . $_REQUEST["orgin"] . "',destination='" . $_REQUEST["destination"] . "',vehicle_type='" . $_REQUEST["vehicle_type"] . "',vehicle_ownership_type='" . $_REQUEST["vehicle_ownership_type"] . "',vehicle_owner='" . $_REQUEST["vehicle_owner"] . "',primary_secondary='" . $_REQUEST["primary_secondary"] . "',vehicle_no='" . $_REQUEST["vehicle_no"] . "',driver_type='" . $_REQUEST["driver_type"] . "',driver_name='" . $_REQUEST["driver_name"] . "',driver_contact_no='" . $_REQUEST["driver_contact_no"] . "',escart_option='" . $_REQUEST["escart_option"] . "',escart_name='" . $_REQUEST["escart_name"] . "',tracking_device='" . $_REQUEST["tracking_device"] . "',sms_alert='" . $_REQUEST["sms_alert"] . "',email_alert='" . $_REQUEST["email_alert"] . "',loading_charges='" . $_REQUEST["loading_charges"] . "',unloading_charges='" . $_REQUEST["unloading_charges"] . "',dedicated_market_vehicle='" . $_REQUEST["dedicated_market_vehicle"] . "' where id=" . $_REQUEST["id"];
    $UDB->query($Query);
    $FN->page_redirect($grid_page);
}
?>