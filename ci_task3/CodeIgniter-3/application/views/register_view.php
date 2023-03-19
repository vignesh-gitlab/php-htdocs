<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Data</title>
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url();?>jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<h2 align="center">User Registration</h2>
<div id="result">
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="form-group">
                user_name
                <input type="text" user_name="user_name" id="user_name" value="" class="form-control">
            </div>
            <div class="form-group">
                Password
                <input type="text" user_name="password" id="password" value="" class="form-control">
            </div>
            <div class="form-group">
                Latitude
                <input type="text" user_name="latitude" id="latitude" value="" class="form-control">
            </div>
            <div class="form-group">
                Longitude
                <input type="text" user_name="longitude" id="longitude" value="" class="form-control">
            </div>
            <div class="form-group">
            <input type="submit" user_name="submit" value="submit" id="submit" class="btn btn-success form-control">
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    var url='<?php echo base_url();?>';

    $('#submit').click(function(){
        var user_name=$('#user_name').val();
        var password=$('#password').val();
        var latitude=$('#latitude').val();
        var longitude=$('#longitude').val();
        $.ajax({
            url:url+"welcome/insert",
            type:"post",
            data:{user_name:user_name,password:password,latitude:latitude,longitude:longitude},
            success:function(data){
                if(data==true){
                    window.location.href=url;
                }else{
                    $('#result').text("Record Not Inserted");
                }
            }
        });
        


    });



});

</script>

</body>
</html>