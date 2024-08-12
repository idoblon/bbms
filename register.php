<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blood-bank - Registration </title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Script-->
    <script type="text/javascript">
        $(document).ready(function() {

            $("#register").click(function() {

                // fname = $("#fname").val();
                // lname = $("#lname").val();
                // email = $("#email").val();
                // password = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "adduser.php",
                    data: {
                        fname: $("#fname").val(),
                        lname: $("#lname").val(),
                        email: $("#email").val(),
                        password: $("#password").val()
                    },
                    success: function(html) {
                        console.log(html)
                        if (html == 'true') {

                            $("#add_err2").html('<div class="alert alert-success"> <strong>Donors Registration Successful</strong> processed. </div>');

                            window.location.href = "userdashboard.php";

                        } else if (html == 'false') {
                            $("#add_err2").html('<div class="alert alert-danger"><strong>Email Address</strong> already in system. </div>');

                        } else if (html == 'fname') {
                            $("#add_err2").html('<div class="alert alert-danger">  <strong>First Name</strong> is required.  </div>');

                        } else if (html == 'lname') {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Last Name</strong> is required. </div>');

                        } else if (html == 'eshort') {
                            $("#add_err2").html('<div class="alert alert-danger"><strong>Email Address</strong> is required.  </div>');

                        } else if (html == 'eformat') {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Email Address</strong> format is not valid.  </div>');

                        } else if (html == 'pshort') {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Password</strong> must be at least 4 characters . </div>');

                        } else {
                            $("#add_err2").html('<div class="alert alert-danger"> <strong>Error</strong> processing request. Please try again.  </div>');
                        }
                    },
                    error: function(chr, status, error) {
                        console.log(error)
                    },
                    beforeSend: function() {
                        $("#add_err2").html("loading...");
                    }
                });
                return false;
            });
        });
    </script>


    <style>
        .back-image {
            background-image: url('img/background1.jpeg');
            background-size: cover;
        }

        .container {
            padding-top: 80px;
            height: 100vh;
            max-width: 960px;
            margin-left: auto;
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

        .col-lg-6 {
            width: 50%;
            float: right;
        }

        .text-center {
            text-align: center;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        input{
            width: 100%;
            padding: 10px 15px;
        }
    </style>

</head>

<body>
    <!--Navbar-->
    <?php include('Navbar_component.php'); ?>
    <div class="container-fluid back-image w-100 vh-100 d-flex justify-content-center">
        <div class="container register" style="padding-top: 80px; height: 100vh;">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="titles intro-text text-center">Registration form</h1>
                    <div id="add_err2"></div>
                    <form role="form" method="post">
                        <div class="row">
                            <div class="form-group">
                                <label class="lb" for="fname">First Name</label>
                                <input type="text" id="fname" name="fname" maxlength="25" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="lb" for="lname">Last Name</label>
                                <input type="text" id="lname" name="lname" maxlength="25" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="lb" for="email">Email Address</label>
                                <input type="email" id="email" name="email" maxlength="25" class="form-control" required>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label class="lb" for="password">Password</label>
                                <input type="password" id="password" name="password" maxlength="25" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <button type="submit" class="btn btn-primary" id="register">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>