<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blood-bank - Admin Login</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .back-image {
            background-image: url('img/background1.jpeg');
            background-size: cover;
        }

        .mycontainer {
            padding-top: 80px;
            height: 100vh;
            max-width: 960px;
            margin-left: auto;
        }

        .titles {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .lb {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        input{
            width: 100%;
            padding: 10px 15px;
        }
        .col-lg-6 {
            width: 50%;
            float: right;
        }
    </style>

</head>

<body>
    <!--Navbar-->
    <?php include('Navbar_component.php'); ?>

    <div class="back-image w-100 vh-100 d-flex justify-content-center">
        <div class="container-fluid mycontainer" style="padding-top: 80px; height: 100vh;">
            <div class="row">
                <div class="col-lg-6 order-sm-12">
                    <h1 class="titles" style="text-align:center">Admin Login Form</h1>
                    <div id="add_err2"></div>
                    <form action="">
                        <div class="form-group">
                            <label for="email" class="lb">Email Address</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="lb">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary" id="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ script ================== -->
    <script type="text/javascript" async>
        $(document).ready(function() {
            $("#login").click(function() {
                // sending the post reqq to checkafmin for admin login
                $.ajax({
                    type: "POST",
                    url: "checkadmin.php",
                    data: {
                        email: $("#email").val(),
                        password: $("#password").val()
                    },
                    // for success response
                    success: function(html) {
                        if (html == 'true') {
                            $("#add_err2").html('<div class="alert alert-success"> <strong>Authenticated</strong></div>');

                            window.location.href = "adminhome.php";

                        } else if (html == 'false') {
                            $("#add_err2").html('<div class="alert alert-danger"><strong>Authentication</strong> failed </div>');

                        } else {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Error</strong> processing request. Please try again. </div>');
                        }
                    },
                    // error handlign 
                    error: function(xhr, status, error) {
                        console.log(error)
                    },
                    // adding loading text for better view
                    beforeSend: function() {
                        $("#add_err2").html("loading...");
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>