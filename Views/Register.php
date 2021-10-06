<?php
include_once('../config.php');
if (isset($_COOKIE['message'])) {
    alert($_COOKIE['message']);
}

if (isset($_COOKIE['username'])) {
    header("location:" . URL . "index.php");
}

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../Assets/css/register.css">
        <link rel="stylesheet" href="../Assets/css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            function checkUsername()
            {
                var user_name = document.getElementById('UserName').value;
                
                if (user_name) {
                    $.ajax({
                        type: 'post',
                        url: 'register.php',
                        data: {
                            username = user_name
                        },
                        success: function (response) {
                            $('#username_status').html(response);
                            if (response == 'Username already exists!') {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    })
                } else {
                    $('#username_status').html('');
                    return false;
                }
            }
    </head>

    <body>
        <form method="POST" action="insertdata.php" onsubmit="return checkUsername();">
            <input type="text" name="username" id="UserName" onkeyup="checkname();">
            <span id="username_status"></span>
            <br>
            <input type="text" name="useremail" id="UserEmail">
            <br>
            <input type="password" name="userpass" id="UserPassword">
            <br>
            <input type="submit" name="submit_form" value="Submit">
        </form>
    </body>
</html>
