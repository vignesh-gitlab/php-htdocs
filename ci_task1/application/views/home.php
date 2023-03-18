<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	    <script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
	    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h2 align="center">Login</h2>
        <form action="post" id="frm_login" method="#">
        <table align="center" border="1">
            <tr>
                <td>
                    Username:
                </td>
                <td>
                    <input type="text" name="user_name" value="" id="user_name" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    Password:
                </td>
                <td>
                    <input type="password" name="password" value="" id="user_name"class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;<input type="button" name="reset" value="Reset">
                </td>
                <td>
                    &nbsp;<input type="button" name="login_submit" id="login_submit" value="Submit">
                    &nbsp;&nbsp;<input type="button" name="register" id="register" value="Register">
                </td>
            </tr>
        </table>
        </form>
        <input type="button" name="ip_address" value="Get">
    </body>
</html>


<script>
$(document).ready(function(){
    var url = '<?php echo base_url(); ?>';

    $("#frm_login").on('click','#login_submit',function(){
        var user_name=$(this).val();
        var password=$(this).val();
        $.$.ajax({
            type: "post,
            url: url+'validate/getuser',
            data: {user_name:user_name,password:password},            
            success: function (response) {
                alert("Logined");
            }
        });
    });


});

</script>
