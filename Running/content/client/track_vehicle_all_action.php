<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_track_all';
$return_page = 'track_vehicle_all.php?opr=true';
$registered_at = $FN->return_date_time();

$Query = "TRUNCATE TABLE $tablename";
$UDB->query($Query);

if ($_REQUEST["vendor_name"] == "ATIC") {

    $Query = "SELECT * from master_aticvehicles";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $vehicle_no = trim($DB->Record["vehicle_no"]);
        $unit_id = trim($DB->Record["unit_id"]);
        $username = trim($DB->Record["username"]);
        $password = trim($DB->Record["password"]);

        $soapUrl = "http://data.waylinkone.in/webservice.asmx";

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetDetails xmlns="http://tempuri.org/"><Unit_Id>' . $unit_id . '</Unit_Id><Username>waws</Username><Pwd>waws</Pwd></GetDetails></soap12:Body></soap12:Envelope>';

        $headers = array(
            "POST /webservice.asmx HTTP/1.1",
            "Host: data.waylinkone.in",
            "Content-Type: application/soap+xml; charset=utf-8",
            "Content-Length: " . strlen($xml_post_string)
        );

        $url = $soapUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $Query = "insert into $tablename values(NULL,'" . $vehicle_no . "','" . $registered_at . "','" . $response . "')";
        $UDB->query($Query);
    }
}

if ($_REQUEST["vendor_name"] == "PC Sites") {

    $Query = "SELECT * from master_pcsitesvehicles";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $vehicle_no = trim($DB->Record["vehicle_number"]);

        $soapUrl = "http://www.pcsites.in/pcsasp/WSGetLocation.asmx";

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetLocation xmlns="http://pcsites.in/PCSASP"><vehicleList>' . $vehicle_no . '</vehicleList></GetLocation></soap12:Body></soap12:Envelope>';

        $headers = array(
            "POST /pcsasp/WSGetLocation.asmx HTTP/1.1",
            "Host: www.pcsites.in",
            "Content-Type: application/soap+xml; charset=utf-8",
            "Content-Length: " . strlen($xml_post_string)
        );

        $url = $soapUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $Query = "insert into $tablename values(NULL,'" . $vehicle_no . "','" . $registered_at . "','" . $response . "')";
        $UDB->query($Query);
    }
}

$FN->page_redirect($return_page);
?>