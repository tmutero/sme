
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
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sme::Online</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/dataTable.bootstrap.min.css">
</head>

<body>
<ul class="nav nav-pills categories">
    <li class="active"><a href="index.php">Home </a></li>
    <li><a href="online.php">Online Applications</a></li>
    <li><a href="profile.php">Profile </a></li>
    <li>SME Name::<?php echo $userRow;?></li>

    <li><a href="index.php?logout='1"">Logout </a></li>
</ul>
<div class="container post">
    <div class="row">


            <div class="panel panel-default " style="margin-top: 50px;
    box-shadow: 0 0 20px grey;
    padding:0 10px 0 10px;">
                <div class="panel-heading"><font size="5">Available Loan</font></div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading"><font size="2">Loan Information</font></div>
                        <div class="panel-body">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                <th>Provider Name</th>
                                <th>Loan Minimum Payable</th>
                                <th>Loan Maximum Payable</th>
                                <th>Loan Sector</th>
                                <th>Date Submitted</th>

                                <th>Action</th>
                                </thead>
                                <tbody>
                                <?php
                                include_once('conn.php');
                                $sql = "SELECT p.companyName ,l.minimum_amount,l.maximum_amount,l.date_submitted, l.id as id,l.sector FROM loan l JOIN provider p ON l.provider_id=p.id WHERE l.status='available'";
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){
                                    echo
                                        "<tr>
									<td>".$row['companyName']."</td>
									<td>".$row['minimum_amount']."</td>
									<td>".$row['maximum_amount']."</td>
									<td>".$row['sector']."</td>
									<td>".$row['date_submitted']."</td>
									<td>
										<a href='#edit_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Apply</a>
										</td>
								</tr>";
                                    include ('online_modal.php');
                                }



                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>




    </div>
</div>
<footer>
    <h5>Tafara© 2018</h5></footer>
<script>
    $(document).ready(function(){
        //inialize datatable
        $('#myTable').DataTable();

        //hide alert
        $(document).on('click', '.close', function(){
            $('.alert').hide();
        })
    });
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/datatable/jquery.dataTables.min.js"></script>
<script src="assets/datatable/dataTable.bootstrap.min.js"></script>
</body>

</html>