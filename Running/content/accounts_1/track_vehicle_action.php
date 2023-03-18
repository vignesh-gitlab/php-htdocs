<?php

include'../../template/common/header.default_action.php';
$tablename = 'sr_vehicle_track';
$return_page = 'track_vehicle.php?vehicle_number=' . $_REQUEST["vehicle_number"];
$registered_at = $FN->return_date_time();

if ($_REQUEST["vendor_name"] == "ATIC") {

    $Query = "SELECT * from master_aticvehicles where vehicle_no='" . $_REQUEST["vehicle_number"] . "'";
    $DB->query($Query);
    while ($DB->Multicoloums()) {
        $unit_id = trim($DB->Record["unit_id"]);
        $username = trim($DB->Record["username"]);
        $password = trim($DB->Record["password"]);
    }
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

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["vehicle_number"] . "','" . $registered_at . "','" . $response . "')";
    $UDB->query($Query);
}

if ($_REQUEST["vendor_name"] == "PC Sites") {

    $soapUrl = "http://www.pcsites.in/pcsasp/WSGetLocation.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetLocation xmlns="http://pcsites.in/PCSASP"><vehicleList>' . $_REQUEST["vehicle_number"] . '</vehicleList></GetLocation></soap12:Body></soap12:Envelope>';

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
    /* $response1 = str_replace("<soap:Body>", "", $response);
      $response2 = str_replace("</soap:Body>", "", $response1);
      $parser = simplexml_load_string($response2);
      print_r($parser); */

    $Query = "insert into $tablename values(NULL,'" . $_REQUEST["vehicle_number"] . "','" . $registered_at . "','" . $response . "')";
    $UDB->query($Query);
}

if ($_REQUEST["vendor_name"] == "Roambee") {
    $shipment_id = $_REQUEST["vehicle_number"];
    if (isset($shipment_id) && !empty($shipment_id)) {
        $json = "https://portal.roambee.com/services/shipment/detail?apikey=&sid=" . $shipment_id;
        $jsonfile = file_get_contents($json);
        $obj = json_decode($jsonfile, true);
        var_dump($obj);

        echo "<br><br>Count : " . count($obj['user']);

        echo "<br><br>User ID : " . $obj['user']['id'] . "<br>";
        echo "Name : " . $obj['user']['name'] . "<br>";
        echo "Phone Number : " . $obj['user']['phone_no'] . "<br>";
        echo "Address : " . $obj['user']['address'] . "<br>";
        echo "Zone : " . $obj['user']['zone'] . "<br>";
        echo "Locality : " . $obj['user']['locality'] . "<br>";
        echo "City : " . $obj['user']['city'] . "<br>";
    } else {
        echo "Input Error : Required Input Data Not Found";
    }
}

$FN->page_redirect($return_page);
?>