<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

</head>
<body>



<center><h1>User Register</h1></center>
<div class="container">
    <div class="row">
        


    
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
        <div id="success">        
        </div>
        <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" id="name" value="" class="form-control">
        </div>
        <div class="form-group">
        Username
        <input type="text" name="user_name" id="user_name" value="" class="form-control">
        </div>
        <div class="form-group">
    
        Password
        <input type="password" name="password" id="password" value="" class="form-control">
        </div>
        <div class="form-group">
        Latitude
        <input type="text" name="latitude" id="latitude" value="" class="form-control" 
        </div>
    <div class="form-group">
        Longitude
        <input type="text" name="longitude" id="longitude" value="" class="form-control">
        <input type="hidden" name="single" id="single">
    </div>
        
        <input type="submit" class="form-control" name="submit" id="submit" value="submit">
        <input type="hidden" name="ip" id="ip" value="">
        </div>
        </div>
        
</div>
</div>


<div id="success"></div>
<div class="col-sm-2"></div>
    <div id="showdata">
</div>


<script>
$(document).ready(function(){
    var url='<?php echo base_url(); ?>';    
    getdata();
        function getdata(){
        $.ajax({
            type: "post",
            url: url+"welcome/getdata",            
            dataType: "json",
            success: function (data) {
                var html='';
                var i;
                html+='<table align="center" border="1" class="border"><tr><th>Name</th><th>User Name</th><th>Password</th><th>Latitude</th><th>Longitude</th><th>Action</th></tr>';
                for(i in data){
                    html+='<tr><td>'+data[i].name+'</td><td>'+data[i].user_name+'</td><td>'+data[i].password+'</td><td>'+data[i].latitude+'</td><td>'+data[i].longitude+'</td><td><button type="button" class="btn btn-success delete" id='+data[i].id+'>Delete</button>&nbsp;<button type="button" class="btn btn-success edit" id='+data[i].id+'>Edit</button></td></tr>';
                }
                html+='</table>';
                $('#showdata').html(html);                
            }
        });
    }

    $('#submit').click(function(){ 
        
        var submit=$(this).val();
        var singleid=$('#single').val();
        var name=$('#name').val();        
        var user_name=$('#user_name').val();
        var password=$('#password').val();
        var latitude=$('#latitude').val();
        var longitude=$('#longitude').val();          
        $.ajax({
            //url: "<?php echo base_url() ?>Welcome/insert",
            url: url+"welcome/insert",
            method: "POST",
            data: {submit:submit, singleid:singleid, name:name, user_name:user_name, password:password, latitude:latitude, longitude:longitude},
            success: function(data){
                $('#name').val("");
                $('#user_name').val("");
                $('#password').val("");
                $('#latitude').val("");
                $('#longitude').val("");
                $('#success').addClass("alert alert-success");
                if($('#submit').val()=="submit")
                {
                    $('#success').text("Data insert Successfully");
                    $('#success').fadeOut(3000);
                }else{
                    $('#success').text("Data Updated successfully");
                    $('#success').fadeOut(3000);
                }
                $('#success').addClass("btn btn-success");
                $('#submit').text("Submit");
                $('#submit').val("submit");
                $('#showdata').show();
                getdata();
            }
        });
    });





    $(document).on('click','.delete',function(){
        var delid=$(this).attr("id");
        if(confirm("Are you sure to delete this record! If yes then click 'ok'")){
        $.ajax({
            url: url+"welcome/deldata",
            method: "post",
            data:{delid:delid},
            success:function(data){
                $('#success').addClass("alert alert-success");
                $('#success').text("Data Deleted Successfully");
                $('#success').fadeOut(3000);
                getdata();
            }
        });
    }else{
        return false;
    }
    });
    
    $(document).on('click','.edit',function(){
        var editid=$(this).attr("id");        
        $.ajax({
            method: "post",
            url: url+"welcome/editdata",
            data: {editid:editid},
            dataType: "json",
            success: function (data) {
                var i;
                for(i in data){
                    $('#name').val(data[i].name);
                    $('#user_name').val(data[i].user_name);
                    $('#password').val(data[i].password);
                    $('#latitude').val(data[i].latitude);
                    $('#longitude').val(data[i].longitude);
                }
                $('#single').val(editid);
                $('#submit').text("update");
                $('#submit').val("update")
                $('#showdata').hide();
                
            }
        });
    });



});


</script>

</body>
</html>