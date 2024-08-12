<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container-fluid {
            padding-top: 80px;
        }

        .row.justify-content-center {
            display: flex;
            justify-content: center;
        }

        .col-lg-6 {
            align-items: center;
        }

        h1.intro-text {
            text-align: center;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .form-row {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="submit"] {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            margin-top: 10px;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #fff;
            background-color: #007bff;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="submit"]:hover {
            color: #fff;
            background-color: #0056b3;
            border-color: #0056b3;
        }

        input[type="hidden"] {
            display: none;
        }
    </style>
</head>

<body>
    <?php include 'Navbar.php' ?>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "blood-bank";

    $mysqli = new mysqli($servername, $username, $password, $db);

    if ($mysqli->connect_error) {
        die("Connection Failed " . $mysqli->connect_error);
    }

    $donor_id = $_GET["donor_id"];

    $sql = "SELECT * FROM donors WHERE donor_id='$donor_id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $donor_id = $row["donor_id"];
            $donor_name = $row["donor_name"];
            $mobile_no = $row["mobile_no"];
            $bloodgroup = $row["bloodgroup"];
            $age = $row["age"];
            $gender = $row["gender"];
            $address = $row["address"];
            $city = $row["city"];
        }
    } else {
        echo "0 results";
    }
    ?>
    <div class="container-fluid justify-content-center">
        <div class="row justify-content-center">

            <div class="col-lg-6" style="align-items: center;">
                <h1 class="intro-text text-center">Update Donor's Information</h1>
                <form action="updateuserm.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="donor_name">Donor's Full Name</label>
                        </div>
                        <div class="form-group col-md-6 ">
                            <input type="text" class="form-control" id="donor_name" value="<?php echo $donor_name; ?>" name="donor_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mobile_no">Mobile Number</label>
                        </div>
                        <div class="form-group col-md-6 ">
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $mobile_no; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bloodgroup">Blood Group</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="bloodgroup" name="bloodgroup" class="form-control" value="<?php echo $bloodgroup; ?>">

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="gender" name="gender" class="form-control" value="<?php echo $gender; ?>">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="address">Address</label>
                        </div>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>">
                        </div>
                    </div>
                    <input type="submit" value="Update">

                    <input type="hidden" name="donor_id" id="donor_id" value="<?php echo $donor_id ?>">
                </form>
            </div>

        </div>
    </div>

    <?php require_once "footer.php" ?>
</body>

</html>