<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width-device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie-edge">
<title>IP</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id="data"></div>
<script>

function callback(response){
console.log(response) I
alert("hi");
document.getElementById("data").innerHTML= response.IPv4;



$.ajax({
url:"https://geoip-db.com/json/",
dataType:"json",
}); 
}
</script>
</body>
</html>