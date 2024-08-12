<?php
session_start();

unset($_SESSION['alogin']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
// redirecting to adminlogin if use logous
header("location:adminlogin.php?logout=true");

?>
