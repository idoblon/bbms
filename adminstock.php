<?php

session_start();
// checking if the session has login or cookies
if (isset($_SESSION['login'])) {
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
} else {
    // redirecting to adminlog if the user session is not found 
    header("location:adminlogin.php");
}

?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blood-bank";
// databse conntection
$mysqli = new mysqli($servername, $username, $password, $db);
// eror handlign 
if ($mysqli->connect_error) {
    die("Connection Failed " . $mysqli->connect_error);
}
// finding or quering the basebase to fetch each and every stock available
$sql = "SELECT * FROM stock";
$result = $mysqli->query($sql);

?>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container {
            padding-top: 80px;
        }

        .row.justify-content-center {
            display: flex;
            justify-content: center;
        }

        h1 {
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
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
            text-decoration: none;
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
            width: 100%;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'Navbar.php' ?>


    <div class="container">
        <div class="row justify-content-center">
            <h1>Review and Update Stocks</h1>
        </div>
        <div class="table-responsive">
            <table border='1' class="table table-hover" cellspacing="2" cellpadding="2">
                <?php
                // if the stock found showing the data for stock in table format
                if ($result->num_rows > 0) {

                    echo " <thead>
                        <tr>
                        <th>Stock ID</th>
                        <th>Blood Group </th>
                        <th>Stock</th>
                        </tr>
                        </thead>";
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row["stock_id"]; ?></td>
                            <td><?php echo $row["bloodgroup"]; ?></td>
                            <td><?php echo $row["stock"]; ?></td>
                            <!-- update the stock if user / admin click on update  -->
                            <td><a class="btn btn-primary rounded-pill" href="updatestock.php?stock_id=<?php echo $row["stock_id"] ?>">Update</a></td>
                        </tr>

                    <?php
                    }
                    ?>
            </table>

        </div>

    </div>

    <?php require_once "footer.php" ?>
</body>
<?php
                } else {
                    // /if the stock is empty or result is 0
                    echo "0 Results";
                }

                $mysqli->close();
?>