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
$sql ="select * from sme where user_id='$user'";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$id=$row['id'];
if (isset($_POST['next'])) {
    $loan_id = $_POST['id'];

    $query = "INSERT INTO appliedloan (sme_id,loan_id)
VALUES ('$id','$loan_id') ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <script type="text/javascript">

            setTimeout(function () {
                window.location.href = 'apply.php'
            }, 6000);
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert('Added fail. Please try again.');
        </script>
        <?php
    }
}

//header('location: index.php');

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sme::Apply</title>
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
    <div class="row">
        <div class="col-md-1"></div>
        <div id="result">
        <div class="col-md-10">


                <?php
                $sql = "SELECT a.id as id,a.repayment FROM appliedloan a JOIN loan ln ON a.loan_id=
ln.id JOIN provider p ON  ln.provider_id=p.id WHERE sme_id='$id' ORDER BY a.id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $repayment = $row['repayment'];


                if (empty($repayment)) {

                $loanId=$row['id'];


                echo "<div class=''>";
                echo "<div class='alert alert-info alert-dismissable'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your profile.";
                echo "  </div>";

                ?>

                <div class="panel panel-default " style="margin-top: 50px;
    box-shadow: 0 0 20px grey;
    padding:0 10px 0 10px;">
                    <div class="panel-heading"><font size="5">Complete Loan Application</font></div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading"><font size="2">Basic Information</font></div>
                            <div class="panel-body">
                                <form id="myForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Loan Amount Request</label>
                                                <input type="number" class="form-control" id="amount" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Repayment Period</label><br>

                                                <select class="form-control" id="repayment">
                                                    <option value="">Select Period</option>
                                                <option value="6">6 Months</option>
                                                    <option value="12">12 Months</option>
                                                    <option value="24">24 Months</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Asset</label>
                                                <select class="form-control" id="assets">
                                                    <option value="">Select Assets</option>
                                                    <option value="Cars">Cars</option>
                                                    <option value="House">House</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Assets  Value$</label>
                                                <input type="number" class="form-control" id="assetsValue">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Investment</label>

                                                <select class="form-control" id="investments">
                                                    <option value="">Select Investments</option>
                                                    <option value="Building">Building Society</option>
                                                    <option value="Shares">Shares</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Investment Value $</label>
                                                <input type="number" class="form-control" id="investmentsValue">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Loan Purpose</label>
                                            <textarea class="form-control" id="loanPurpose"></textarea>
                                        </div>

                                        <input type="hidden" id="loanId" value="<?php echo $loanId; ?>">
                                    </div>
                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm" id="btn" onclick="validateForm()">Next Step &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-4">

                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            <?php


            } else {


            }


            ?>
        </div>
        </div>
    </div>
        <div class="col-md-1"></div>



    </div>
</div>

<script>
    function validateForm() {
        var x = document.forms["myForm"]["amount"].value;
        if (x == "") {
            alert("Amount must be filled out");
            return false;
        }
        var y = document.forms["myForm"]["assetsValue"].value;
        if (y == "") {
            alert("Assets Value  must be filled out");
            return false;
        }

        var a = document.forms["myForm"]["repayment"].value;
        if (a == "") {
            alert("Repayment period must be filled out");
            return false;
        }
        var b = document.forms["myForm"]["loanPurpose"].value;
        if (b == "") {
            alert("Loan Purpose must be filled out");
            return false;
        }
        basicInfo();
    }
</script>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
    function basicInfo() {

        var btn =$("#btn").val();
        var amount=$("#amount").val();
        var assets=$("#assets").val();
        var investments=$("#investments").val();
        var repayment=$("#repayment").val();
        var assetsValue=$("#assetsValue").val();
        var loanPurpose=$("#loanPurpose").val();
        var investmentsValue=$("#investmentsValue").val();
        var loanId=$("#loanId").val();
        $.post("updateApply.php", {

                btn :btn ,
                amount:amount,
                assets:assets,
                investments:investments,
                repayment:repayment,
                assetsValue:assetsValue,
                investmentsValue:investmentsValue,
                loanId:loanId,
                loanPurpose:loanPurpose,
                investments:investments,

            },

            function(data) {
                $('#result').html(data);
                $('#su')[0].reset()

            });
    }
</script>


<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
