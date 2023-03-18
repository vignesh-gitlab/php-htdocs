<html>
    <head>
        <title>Hello</title>
</head>
<body>
<h1>Welcome to CodeIgniter!</h1>

<table>
<tr>
<th>IP Address</th>
<th>Opreting system</th>
<th>Browser Detail</th>
</tr>
<tr>
<td><?php echo $ip_address; ?></td>
<td><?php echo $os; ?></td>
<td><?php echo $browser_version; ?></td>
<td><?php echo $browser. ' '. $browser_version;?></td>
</tr>
<?php
$ch =curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, "https://api.ipgeolocation.io/ipgeo?apiKey=136e81c4cbe147d4a123c8148d563cfd&ip=");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string
$output= curl_exec($ch);
print_r($output);
// close curl resource to free up system resources.
curl_close($ch);
?>
</table>
</body>
</html>