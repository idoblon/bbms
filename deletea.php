<?php

session_start();
// checking if the user session is availabe or not 

if (isset($_SESSION['login'])) {
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
} else {
    // redirection to adminlogin if the user session is not found 
    header("location:adminlogin.php");
}

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "blood-bank";
// creating the connection
$mysqli = new mysqli($servername, $username, $password, $db);
// error handling if connection is not success or timeouts

if ($mysqli->connect_error) {
    die("Connection Failed " . $mysqli->connect_error);
}
//  fetching the selected data from donors such as donor 's id, name 
$sql = "SELECT donor_id, donor_name, mobile_no, bloodgroup,age,gender, address, city FROM donors";
$result = $mysqli->query($sql);

?>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php include 'Navbar.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <h1>Delete Donor's Records</h1>
    </div>
    <div class="row table-responsive">
        <table border='1' class="table table-hover" cellspacing="2" cellpadding="2">
            <?php
            // showing the data if the data is not empty or  if not less than 0
            if ($result->num_rows > 0) {

                echo "<thead>
                        <tr>
                        <th>Donor's ID</th>
                        <th>Donor's Name</th>
                        <th>Mobile Number</th>
                        <th>Blood Group </th>
                        <th>Donor's Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>City</th>
                        </tr>
                        </thead>";
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row["donor_id"]; ?></td>
                        <td><?php echo $row["donor_name"]; ?></td>
                        <td><?php echo $row["mobile_no"]; ?></td>
                        <td><?php echo $row["bloodgroup"]; ?></td>
                        <td><?php echo $row["age"]; ?></td>
                        <td><?php echo $row["gender"]; ?></td>
                        <td><?php echo $row["address"]; ?></td>
                        <td><?php echo $row["city"]; ?></td>
                        <!-- send to deleteusera route to delete the user  -->
                        <td><a class="btn btn-danger rounded-pill" href="delusera.php?donor_id=<?php echo $row["donor_id"] ?>">Delete</a></td>
                    </tr>

                <?php
                }
                ?>
        </table>
    </div>

    <?php require_once "footer.php" ?>
</div>

<?php
            } else {
                // showing 0 result if not found 
                echo "0 Results";
            }

            $mysqli->close();
?>