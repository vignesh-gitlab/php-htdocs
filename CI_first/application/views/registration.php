<html>
    <head>
        <title>Registration Page</title>
    </head>
    <body>
        <h2>Registration</h2>
        <form method="post" action="registration">
            <label>Name</label>
            <input type="text" name="name" value="" required><br><br>
            <label>Email</label>
            <input type="text" name="email" value="" required><br><br>
            <label>Password</label>
            <input type="password" name="password" value="" required><br><br>
            <label>User Type</label>
            <select name="user_type" required>
                <option>Select</option>
                <option value="normal">Normal</option>
                <option value="admin">Admin</option>
            </select>       
            <br><br>
            <input type="submit" name="registration_submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </form>
    </body>
</html>