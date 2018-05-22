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

$sql ="select * from provider where user_id='$user'";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$id=$row['id'];
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
    <li>SME Name::<?php echo $userRow;?></li>

    <li><a href="index.php?logout='1"">Logout </a></li>
</ul>
<div class="container" style="background-color: #fff">
    <div class="row" style="padding: 30px;">
        <?php if ($userRow =="") {



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
                    <tr class="filters">

                        <th><input type="text" class="form-control" placeholder="Approved Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Loan Provider" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Loan Phone" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Loan Amount" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Approved Status" disabled></th>

                    </tr>
                    </thead>

                    <?php
                    $sql = "SELECT loanRequested,repayment,investments, a.date_created,s.businessType,a.status, p.companyName,ln.minimum_amount
 ,assets ,p.phoneNumber,coName, a.id as id FROM appliedloan a JOIN loan ln ON a.loan_id=ln.id JOIN sme s  ON a.sme_id=s.id join provider p ON ln.provider_id =p.id WHERE a.sme_id='$id' AND 
                              a.status='approved'";
                    $res = mysqli_query($conn, $sql);
                    if (!$res) {
                        printf("Error: %s\n", mysqli_error($conn));
                        exit();
                    }
                    //+13203453128
                    //AC0371760d21d76c137119623a9bd1f5fa
                    //81fabad0d548d9d1451f8ea1cc4c87e7
                    while ($approvedLoan = mysqli_fetch_array($res)) {

                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $approvedLoan['date_created'] . "</td>";
                        echo "<td>" . "$" . $approvedLoan['companyName'] . "</td>";
                        echo "<td>" . $approvedLoan['phoneNumber'] . "</td>";
                        echo "<td>" . $approvedLoan['minimum_amount'] . "</td>";

                        echo "<td>" . $approvedLoan['status'] . "</td>";



                        echo "</td>";

                    }
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";
                    echo "<div class='panel panel-default'>";
                    echo "<div class='col-md-offset-3 pull-right'>";
                    echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                    echo "</div>";
                    echo "</div>";
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