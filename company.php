
<?php
include('functions.php');
include('conn.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$user=$_SESSION['user']['id'];
$select="SELECT * FROM sme WHERE user_id=".$user;
$run_select=mysqli_query($conn,$select);
$row=mysqli_fetch_array($run_select);
$userRow = $row['ownerName'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sme::Company</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
<ul class="nav nav-pills categories">
    <li class="active"><a href="index.php">Home </a></li>
    <li><a href="#">Online Applications</a></li>
    <li><a href="profile.php">Profile </a></li>
    <li><a href="company.php">Company Registration</a></li>
    <li><a href="index.php?logout='1"">Logout </a></li>
</ul>
<div class="container post">
    <div class="row">

        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            h2
        </div>
    </div>
</div>
<footer>
    <h5>Tafara© 2018</h5></footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>