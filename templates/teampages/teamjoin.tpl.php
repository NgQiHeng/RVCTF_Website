<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./static/css/teampages/teamjoin.css?<?php echo time(); ?>">
    </head>
    <body>
    <form method = "POST" action = "./backend/teamjoin.php">
            <div>
                <label for = "teamname">Team Name</label>
                <input id = "teamname" class = "notempty" name = "teamname" maxlength = "255">
            </div>
            <div>
                <label for = "password">Password</label>
                <input id = "password" class = "nospace notempty"  name = "teampassword" type = "password" maxlength = "512">
                <p class = "errormsg" id = "passworderror">Incorrect password! Please ask the password from your team captain, or ask admins to reset the password for you.</p>
            </div>
            <input id = "info" name = "info" type = "hidden">
            <input type = "submit"  value = "Join" onClick="return empty()">
        </form>
        <script>
            document.getElementById("info").value = localStorage.getItem("sessioninfo")
        </script>
        <script src="./static/js/teampages/teamjoin.js?<?php echo time(); ?>"></script>
    </body>
</html> 