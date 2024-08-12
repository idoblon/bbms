<?php
// Initialise session
session_start();

if (isset($_SESSION['login'])) {

    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood-bank";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to calculate total stock
    $sqlStock = "SELECT SUM(stock) AS total_stock FROM stock";

    // Execute SQL query for total stock
    $resultStock = $conn->query($sqlStock);

    // Check if query execution was successful
    if ($resultStock->num_rows > 0) {
        // Fetch total stock value
        $rowStock = $resultStock->fetch_assoc();
        $totalStock = $rowStock["total_stock"];
    } else {
        $totalStock = 0; // If no data found, set total stock to 0
    }

    // SQL query to calculate total donors
    $sqlDonors = "SELECT COUNT(*) AS total_donors FROM donors";

    // Execute SQL query for total donors
    $resultDonors = $conn->query($sqlDonors);

    // Check if query execution was successful
    if ($resultDonors->num_rows > 0) {
        // Fetch total donors count
        $rowDonors = $resultDonors->fetch_assoc();
        $totalDonors = $rowDonors["total_donors"];
    } else {
        $totalDonors = 0; // If no data found, set total donors to 0
    }

    // SQL query to calculate total requests
    $sqlRequests = "SELECT COUNT(*) AS total_requests FROM request";

    // Execute SQL query for total requests
    $resultRequests = $conn->query($sqlRequests);

    // Check if query execution was successful
    if ($resultRequests->num_rows > 0) {
        // Fetch total requests count
        $rowRequests = $resultRequests->fetch_assoc();
        $totalRequests = $rowRequests["total_requests"];
    } else {
        $totalRequests = 0; // If no data found, set total requests to 0
    }

    // Close database connection
    $conn->close();
?>

    <html>

    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style2.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            .container-fluid.container {
                padding-top: 80px;
            }

            .row.justify-content-center {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }

            .col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                padding-right: 15px;
                padding-left: 15px;
            }

            .card.mycards {
                border: 1px solid rgba(0, 0, 0, 0.125);
                border-radius: 0.25rem;
            }

            .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
                padding: 0.75rem 1.25rem;
                margin-bottom: 0;
            }

            .card-body {
                flex: 1 1 auto;
                padding: 1.25rem;
            }

            .card-text {
                margin-bottom: 0;
            }

            .btn {
                display: inline-block;
                font-weight: 400;
                color: #fff;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                background-color: #007bff;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .btn:hover {
                color: #fff;
                background-color: #0056b3;
                border-color: #0056b3;
                text-decoration: none;
            }

            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                color: #fff;
                background-color: #0056b3;
                border-color: #0056b3;
            }

            .col-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                padding-right: 15px;
                padding-left: 15px;
            }
        </style>
    </head>

    <body>
        <?php include 'Navbar.php' ?>


        <div class="container-fluid container">
            <div class="row justify-content-center" style="margin-top:20px">
                <div class="col-md-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Delete Records</div>
                        <div class="card-body">
                            <p class="card-text">Review and Delete Specific Donor's Data</p>
                            <a href="deletea.php" class="btn btn-danger">Delete</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Review and update Stocks</div>
                        <div class="card-body">
                            <p class="card-text">Review and Update blood-bank's Stock </p>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <a href="updatea.php" class="btn btn-primary w-100">Update</a>
                                <a href="adminstock.php" class="btn btn-primary w-100 ml-2">Review</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Requests</div>
                        <div class="card-body">
                            <p class="card-text">View Requests to the blood-bank</p>
                            <a href="requests.php" class="btn btn-info">Requests</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Total Donors</div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $totalDonors; ?></p>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Total Request</div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $totalRequests; ?></p>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card mycards col-md-3 text-dark bg-light mb-3" style="max-width: 18rem;margin:10px">
                        <div class="card-header">Available Stock</div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $totalStock; ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php require_once "footer.php" ?>
    </body>

    </html>
<?php
} else {
    header("location:adminlogin.php");
}
?>