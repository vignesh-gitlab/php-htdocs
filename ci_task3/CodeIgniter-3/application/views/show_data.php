<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Data</title>
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url();?>jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="form-group">
            <input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url();?>welcome/register';" value="Register" />
                <div id="show_data">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var url='<?php echo base_url();?>';
    get_data();
    function get_data(){       
            $.ajax({
                type: "POST",
                url: url+"welcome/get_data",
                dataType:"json",
                success: function(data) {
                    var html='';
                    var i;
                    html+='<table border="1"><tr><th>Name</th><th>Password</th><th>Latitude</th><th>Longitude</th><th>UserType</th></tr>';
                    for(i in data){
                        html+='<tr><td>'+data[i].user_name+'</td><td>'+data[i].password+'</td><td>'+data[i].latitude+'</td><td>'+data[i].longitude+'</td><td>'+data[i].user_type+'</td></tr>'
                    }
                    html+='</table>';
                    $('#show_data').html(html);
                }
            });
        }


});


</script>
</body>
</html>