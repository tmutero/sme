<?php
include('functions.php');
include('conn.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$user = $_SESSION['user']['id'];
$select = "SELECT * FROM sme WHERE user_id=" . $user;
$run_select = mysqli_query($conn, $select);
$row = mysqli_fetch_array($run_select);
$userRow = $row['ownerName'];
$sme_id = $row['id'];


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sme::Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
<ul class="nav nav-pills categories">
    <li class="active"><a href="index.php">Home </a></li>
    <li><a href="online.php">Online Applications</a></li>
    <li><a href="profile.php">Profile </a></li>
    <li>SME Name::<?php echo $userRow; ?></li>

    <li><a href="index.php?logout='1"">Logout </a></li>
</ul>
<div class="container" style="background-color: #fff">
    <div class="row" style="padding: 30px;">
        <?php if ($userRow == "") {


            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your Company profile.";
            echo "  </div>";


        } else {
        ?>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="text-justify panel-title">Online SME Platform</h2></div>
                <div class="panel-body">
                    <h4>Online Loan Application</h4>
                    <p style="text-align: left;">
                        Offers Online Loan Application application.</p>
                    <h4>Online Company Registration</h4>
                    <p style="text-align: left;">
                        SME can register companies online and get access to information
                    </p>
                    <h4>Online Business Forums</h4>
                    <p style="text-align: left;">
                        Through online SMS platform .
                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="text-justify panel-title">Approved Applications</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>

                            <th>Approved Date</th>
                            <th>Loan Provider</th>
                            <th>Amount Payable</th>
                            <th>Loan Sector</th>
                            <th>Status</th>

                        </tr>
                        </thead>

                        <?php
                        $sql = "SELECT ln.sector, ln.minimum_amount, p.companyName, a.date_created, a.status FROM appliedloan a 
                        JOIN loan ln ON a.loan_id=ln.id JOIN provider p ON ln.provider_id=p.id
                        WHERE a.sme_id='$sme_id' AND a.status='approved'";
                        $res = mysqli_query($conn, $sql);
                        if (!$res) {
                            printf("Error: %s\n", mysqli_error($conn));
                            exit();
                        }

                        while ($approvedLoan = mysqli_fetch_array($res)) {

                            $sector = $approvedLoan['sector'];
                            $minimum_amount = $approvedLoan['minimum_amount'];
                            $date_created = $approvedLoan['date_created'];
                            $status = $approvedLoan['status'];
                            $companyName = $approvedLoan['companyName'];


                        ?>
                        <tr>
                            <td><?php echo $date_created; ?></td>
                            <td><?php echo $companyName; ?></td>
                            <td><?php echo $minimum_amount; ?></td>
                            <td><?php echo $sector; ?></td>
                            <td><?php echo $status; ?></td>



                        </tr>
                        <?php
                        }


                        ?>
                </div>

            </div>

        </div>
    </div>
    <?php


    }
    ?>


</div>
</div>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>