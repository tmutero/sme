<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 5/9/2018
 * Time: 5:42 PM
 */
include('conn.php');
if (isset($_POST['btn'])) {
    $amount = $_POST['amount'];
    $assets = $_POST['assets'];
    $repayment = $_POST['repayment'];
    $assetsValue = $_POST['assetsValue'];
    $investmentsValue = $_POST['investmentsValue'];
    $loanId = $_POST['loanId'];
    $investments = $_POST['investments'];
    $loanPurpose = $_POST['loanPurpose'];

    $insert = "UPDATE `appliedloan` SET `loanRequested`='$amount',`loanPurpose`='$loanPurpose',
`repayment`='$repayment',
`assets`='$assets',`assetValue`='$assetsValue',`investments`='$investments',`investmentsValue`='$investmentsValue' WHERE id='$loanId'";
    $run_insert = mysqli_query($conn, $insert);
    if ($run_insert) {

        ?>

        <div class="container">
            <div class="row">
                <div class="alert alert-success alert-dismissible" id="myAlert">
                    <a href="#" class="close">&times;</a>
                    <strong>Success!</strong> Your application is being proccessed will contact you soon.
                </div>
            </div>
        </div>


<?php
    }
    else {
        ?>
        <div class="container">
            <div class="row">
                <div class="alert alert-danger alert-dismissible" id="myAlert">
                    <a href="#" class="close">&times;</a>
                    <strong>Error!</strong>Application failed.
                </div>
            </div>
        </div>
<?php

    }
}


?>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $("#myAlert").alert("close");
        });
    });
</script>
