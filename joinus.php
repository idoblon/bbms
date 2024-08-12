<?php
// Initialise session
session_start();

if (isset($_SESSION['login'])) {

    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>blood-bank - Join Us</title>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style2.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--Script-->
        <script type="text/javascript">
            $(document).ready(function() {
                // function to add the member 
                $("#join").click(function() {
                    // getting donor details from input 
                    if ($("#donor_name").val() == "") {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>Name</strong> is required. </div>');
                        return false;
                    }

                    if ($("#mobile_no").val().length != 10) {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>Mobile Number</strong> must be 10 digits. </div>');
                        return false;
                    }

                    if ($("#bloodgroup").val() == "") {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>BloodGroup</strong> is required. </div>');
                        return false;
                    }

                    if ($("#age").val() < 18) {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>Age</strong> is required. Cannot be negative or below 18 </div>');
                        return false;
                    }

                    if ($("#gender").val() == "") {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>Gender</strong> is required. </div>');
                        return false;
                    }

                    if ($("#address").val() == "") {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>Address</strong> is required. </div>');
                        return false;
                    }

                    if ($("#city").val() == "") {
                        $("#add_err2").html('<div class="alert alert-danger"> <strong>City</strong> is required. </div>');
                        return false;
                    }

                    donor_name = $("#donor_name").val();
                    mobile_no = $("#mobile_no").val();
                    bloodgroup = $("#bloodgroup").val();
                    age = $("#age").val();
                    gender = $("#gender").val();
                    address = $("#address").val();
                    city = $("#city").val();
                    // pos req to adddonor to add the donor
                    $.ajax({
                        type: "POST",
                        url: "adddonor.php",
                        data: {
                            donor_name: donor_name,
                            mobile_no: mobile_no,
                            bloodgroup: bloodgroup,
                            age: age,
                            gender: gender,
                            address: address,
                            city: city
                        },
                        success: function(html) {
                            if (html == 'true') {
                                $("#add_err2").html('<div class="alert alert-success"> <strong>Account</strong> processed. </div>');
                                // redirecting to usedashboard on success response
                                window.location.href = "userdashboard.php";
                            }

                        },
                        beforeSend: function() {
                            $("#add_err2").html("loading...")
                        }
                    });
                    return false;
                });
            });
        </script>

        <style>
            .container-fluid {
                padding-top: 80px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .row.justify-content-center {
                display: flex;
                justify-content: center;
            }

            .col-lg-6 {
                max-width: 100%;
            }

            .form-row {
                display: flex;
                flex-wrap: wrap;
                margin-right: -5px;
                margin-left: -5px;
            }

            .form-group {
                flex: 0 0 50%;
                max-width: 50%;
                margin-bottom: 1rem;
            }

            .form-control {
                display: block;
                width: 100%;
                height: calc(2.25rem + 2px);
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .btn {
                display: inline-block;
                font-weight: 400;
                color: #212529;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
            }

            .btn-primary:focus,
            .btn-primary.focus {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
                box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
            }
        </style>

    </head>

    <body>
        <?php include 'UserNavbar.php' ?>

        <div class="container-fluid" style="padding-top: 80px;">
            <div class="row justify-content-center">
                <div class="col-lg-6" style="align-items: center;">
                    <h1 class="intro-text text-center">Donor's Registration form
                    </h1>
                    <div id="add_err2"></div>
                    <form role="form" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="donor_name">Donor's Full Name</label>
                            </div>
                            <div class="form-group col-md-6 ">
                                <input type="text" class="form-control" id="donor_name" name="donor_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mobile_no">Mobile Number</label>
                            </div>
                            <div class="form-group col-md-6 ">
                                <input type="number" class="form-control" id="mobile_no" name="mobile_no">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bloodgroup">Blood Group</label>
                            </div>
                            <div class="form-group col-md-6">
                                <select id="bloodgroup" name="bloodgroup" class="form-control">
                                    <option selected>Choose...</option>
                                    <option value="A ve">A+</option>
                                    <option value="A -ve">A-</option>
                                    <option value="B ve">B+</option>
                                    <option value="B -ve">B-</option>
                                    <option value="AB ve">O+</option>
                                    <option value="AB -ve">O-</option>
                                    <option value="O ve">AB+</option>
                                    <option value="O -ve">AB-</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="age">Age</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" id="age" name="age" min="0">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                            </div>
                            <div class="form-group col-md-6">
                                <select id="gender" name="gender" class="form-control">
                                    <option selected>Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="address">Address</label>
                            </div>
                            <div class="form-group col-md-7">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="address">City</label>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="city" name="city" placeholder="city">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="join">Register</button>
                    </form>
                </div>
            </div>
        </div>


        <?php require_once "footer.php" ?>
    </body>

    </html>

<?php
} else {
    // homepage redirection incase not found 
    header("location:index.php");
}
?>