<?php
include('../functions.php');
include('../conn.php');

if (!isProvider()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$user = $_SESSION['user']['username'];

$provider_id = $_SESSION['user']['id'];
$sql = "select * from provider where user_id='$provider_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$id = $row['id'];
if (isset($_POST['submit'])) {
    $date_submitted = $_POST['date_submitted'];
    $businessType = $_POST['businessType'];
    $sector = $_POST['sector'];
    $maximum_amount = $_POST['maximum_amount'];
    $minimum_amount = $_POST['minimum_amount'];
    $status = $_POST['status'];

//INSERT
    $query = "INSERT INTO loan (date_submitted, businessType, sector, minimum_amount,  maximum_amount,provider_id, status)
VALUES ('$date_submitted', '$businessType', '$sector','$minimum_amount','$maximum_amount','$id','$status' ) ";
    var_dump($query);
    $result = mysqli_query($conn, $query);
// echo $result;
    if ($result) {
        ?>
        <script type="text/javascript">
            alert('Loan added successfully.');
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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Loan Provider</title>

    <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">

    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/material.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css"/>

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>

    <!-- Inline CSS based on choices in "Settings" tab -->
    <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form {
            font-family: Arial, Helvetica, sans-serif;
            color: black
        }

        .bootstrap-iso form button, .bootstrap-iso form button:hover {
            color: white !important;
        }

        .asteriskField {
            color: red;
        }</style>
</head>
<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Loan Provider <?php echo $user; ?></a>
        </div>
        <!-- Top Menu Items -->


        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="applicants.php"><i class="fa fa-fw fa-user"></i>Applications</a>
                </li>
                <li>
                    <a href="loan.php"><i class="fa fa-fw fa-table"></i> Loans</a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a>
                </li>
                <li>
                    <a href="home.php?logout='1'""><i class="fa fa-fw fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- navigation end -->

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">
                        Applications
                    </h4>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Applications
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Page Heading end-->

            <!-- panel start -->

            <!-- panel end -->
            <div class="panel panel-primary filterable">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">Applicants</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter
                        </button>
                    </div>
                </div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="AmountRequested" disabled></th>
                            <th><input type="text" class="form-control" placeholder="RepayementPeriod" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Assets" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Investments" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Co Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Phone No." disabled></th>
                            <th><input type="text" class="form-control" placeholder="Approved Status" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Decision" disabled></th>
                        </tr>
                        </thead>

                        <?php
                        $sql = "SELECT loanRequested,repayment,investments
 ,assets ,phoneNumber,coName, a.id as id FROM appliedloan a JOIN loan ln ON a.loan_id=ln.id JOIN sme s  ON a.sme_id=s.id WHERE ln.provider_id='$id' AND 
                              a.status=''";
                        $res = mysqli_query($conn, $sql);
                        if (!$res) {
                            printf("Error: %s\n", mysqli_error($conn));
                            exit();
                        }
                        while ($approvedLoan = mysqli_fetch_array($res)) {

                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . "$" . $approvedLoan['loanRequested'] . "</td>";
                            echo "<td>" . $approvedLoan['repayment'] . "</td>";
                            echo "<td>" . $approvedLoan['assets'] . "</td>";
                            echo "<td>" . $approvedLoan['investments'] . "</td>";
                            echo "<td>" . $approvedLoan['coName'] . "</td>";
                            echo "<td>" . $approvedLoan['phoneNumber'] . "</td>";
                            echo "<td>" . $approvedLoan['phoneNumber'] . "</td>";

                            echo "<form method='POST'>";
                            echo "<td class='text-center'><a href='#' id='" . $approvedLoan['id'] . "' class='aprove'><span class='glyphicon glyphicon-user' aria-hidden='true'>Approve</span></a>";

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


        <div class="col-md-4">

            <!-- Large modal -->

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title" id="myModalLabel">Loan Details</h5>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->
                            <form action="<?php $_PHP_SELF ?>" method="post">
                                <table class="table table-user-information">
                                    <tbody>

                                    <tr>
                                        <td>Date Submitted:</td>
                                        <td><input type="date" class="form-control" name="date_submitted" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Business Type</td>
                                        <td><select class="select form-control" id="businessType"
                                                    name="businessType"
                                                    type="text" required>
                                                <option value="">Select Type</option>
                                                <option value="parternship">
                                                    Paternship
                                                </option>
                                                <option value="incoporation">
                                                    Incoporation
                                                </option>
                                                <option value="nonproit">
                                                    Non-Profit
                                                </option></td>
                                    </tr>


                                    <tr>
                                        <td> Operating Sector</td>
                                        <td>
                                            <select class="select form-control" id="sector" name="sector"
                                                    type="text" required>
                                                <option value="">Select Sector</option>
                                                <option value="agriculture">
                                                    Agriculture
                                                </option>
                                                <option value="manufacturing">
                                                    Manufacturing
                                                </option>
                                                <option value="wholesale">
                                                    Wholesale
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Minimum Amount</td>
                                        <td><input type="number" class="form-control" name="minimum_amount"/></td>
                                    </tr>
                                    <tr>
                                        <td>Maximum Amount</td>
                                        <td><input type="number" class="form-control" name="maximum_amount"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><select class="select form-control" id="status" name="status"
                                                    type="text" required>
                                                <option value="">Select Status</option>
                                                <option value="available">
                                                    Available
                                                </option>
                                                <option value="notavailable">
                                                    Not Available
                                                </option>

                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="submit" class="btn btn-info" value="Add Loan">
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>


                            </form>
                            <!-- form end -->
                        </div>

                    </div>
                </div>
            </div>
            <br/><br/>
        </div>

    </div>

</div>


<!-- jQuery -->
<script src="assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- script for jquery datatable start-->

<script src="assets/js/bootstrap-clockpicker.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- script for jquery datatable start-->
<!-- Include Date Range Picker -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript">
    $(function () {
        $(".aprove").click(function () {

            var element = $(this);
            var appid = element.attr("id");
            var info = appid;

            if (confirm("Are you sure you want to approve this?")) {
                $.ajax({
                    type: "POST",
                    url: "approve.php",
                    data: {info: info},
                    success: function () {
                    }
                });
                $(this).parent().parent().fadeOut(300, function () {
                    $(this).remove();
                });
            }
            return false;
        });
    });
</script>


<script>
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
<script type="text/javascript">
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    $(document).ready(function () {
        $('.filterable .btn-filter').click(function () {
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function (e) {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function () {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
            }
        });
    });
</script>
<script src="assets/js/bootstrap-clockpicker.js"></script>
<script src="assets/js/bootstrap-clockpicker.js"></script>


</body>
</html>