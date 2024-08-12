<?php
// Initialise session
session_start();

if(isset($_SESSION['login'])){

    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blood-bank - User Dashboard</title>


    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container-fluid {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
}

.row.justify-content-center {
    display: flex;
    justify-content: center;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

.card {
    max-width: 18rem;
    margin: 10px;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.card-body {
    padding: 1.25rem;
}

.card-text {
    margin-bottom: 15px;
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

.btn-primary.disabled,
.btn-primary:disabled {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:not(:disabled):not(.disabled):active,
.btn-primary:not(:disabled):not(.disabled).active,
.show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #0062cc;
    border-color: #005cbf;
}

.btn-primary:not(:disabled):not(.disabled):active:focus,
.btn-primary:not(:disabled):not(.disabled).active:focus,
.show>.btn-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
}

    </style>

</head>
<body>
    <div class="header">
        <div class="menu-bar">
           <?php include "UserNavbar.php"?>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row justify-content-center">
        <img class="img-fluid" src="img/blood_home.jpg" alt=""srcset="">
        </div>
        <div class="row justify-content-center" style="margin-top:20px" >        
            <div class="col-sm-3 card " style="max-width: 18rem;margin:10px">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <p class="card-text">Search Donor's Records By their blood Groups</p>
                    <a class="btn btn-primary" href="searchbg.php">Search</a>
                </div>
            </div>
            
            <div class="col-sm-3 card " style="max-width: 18rem;margin:10px">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <p class="card-text">Search Donor's Records Which are near you</p>
                    <a class="btn btn-primary" href="searchcity.php">Search</a>
                </div>
            </div>

           <div class="col-sm-3 card " style="max-width: 18rem;margin:10px">
                <div class="card-header">Join Us</div>
                <div class="card-body">
                    <p class="card-text">Register Yourself as a member</p>
                    <a class="btn btn-primary" href="joinus.php">Join us</a>
                </div>
            </div>

            <div class="col-sm-3 card " style="max-width: 18rem;margin:10px">
                <div class="card-header">Request</div>
                <div class="card-body">
                    <p class="card-text">Request blood from blood-bank</p>
                    <a class="btn btn-primary" href="userstock.php">Request</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "footer.php"?>

</body>
</html>

<?php
}
else{
    header("location:index.php");
}
?>