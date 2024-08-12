<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blood-bank - Home</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    <script type="text/javascript">
        $(document).ready(function () {
            // login 
            $("#login").click(function () {
            // sending the post request to checkuser to login a user if exist
                $.ajax({
                    type: "POST",
                    url: "checkuser.php",
                    data: {
                        email:$("#email").val(),
                        password: $("#password").val() 
                    },
                    // if login is success
                    success: function (html) {
                        if (html == 'true') {

                            $("#add_err2").html('<div class="alert alert-success"> <strong>Authenticated</strong></div>');

                            window.location.href = "userdashboard.php";

                        } else if (html == 'false') {
                            $("#add_err2").html('<div class="alert alert-danger"><strong>Authentication</strong> failed </div>');                    

                        } else {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Error</strong> processing request. Please try again. </div>');
                        }
                    },
                    // error handlign 
                    error: function(xhr,status,error){
                        console.log(error)
                    },
                    // loaing text after the login is clicked for better user experience (UX)
                    beforeSend: function () {
                        $("#add_err2").html("loading...");
                    }
                });
                return false;
            });
        });
    </script>