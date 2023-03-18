<?php
  /*$ip=$_SERVER['REMOTE_ADDR'];
  //$ip = IP\Address::factory('::1');
  echo $ip;
  $host=getenv("REMOTE_ADDR");
  
  echo "<br>".$host;*/
  /*if(!empty($_SERVER['HTTP_CLIENT_IP'])){  
    $ip_address=$_SERVER['HTTP_CLIENT_IP'];
    echo "This is client";
  }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    echo "This is proxy";
} else if(($_SERVER['REMOTE_ADDR'])!='::1') {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    echo "This is local";
}else{
  $ip_address="failed";
}
echo $ip_address;
*/
?>
<html>
  <body>
    <h1>Get user location</h1>
    <p id="para"></p>    
    <input type="text" id="latitude" name="latitude"><br><br>
    <button onclick="getlocation()">Get Location</button>

<script type="text/javascript">
  const getlocation=()=>{
    //alert("hi");
    fetch("https://ipapi.co/json/")
      .then((response)=>response.json())
      .then((data)=>{
        console.log(data);
        
        const des=document.querySelector("#para");
        //des.innerHTML = "Latitude: ${data.latitude} Longitude: ${data.longitude}";
        //const des = document.getElementById("location");
        des.innerHTML = "Latitude: " + data.latitude + " Longitude: " + data.longitude;
        var longitude=data.longitude;
        alert(longitude);
        
        

    });
  };
</script>
</body>
<html>
<?php



// create curl resource
/*$ch =curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, "https://api.ipgeolocation.io/ipgeo?apiKey=136e81c4cbe147d4a123c8148d563cfd&ip=");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string
$output= curl_exec($ch);
print_r($output);
// close curl resource to free up system resources.
curl_close($ch);*/

/*$ip_address = '117.221.214.42';
$arr_location = file_get_contents('http://freegeoip.net/json/'.$ip_address);
echo "<pre><br>";
print_r(json_decode($arr_location)); 
echo "</pre>";*/



/*getRealIpAddr();
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    //return $ip;
    echo "<br>".$ip;
}*/
?>