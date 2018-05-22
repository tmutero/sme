<?php
include('../functions.php');
include('../conn.php');

if (!isProvider()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$user = $_SESSION['user']['username'];

$provider_id = $_SESSION['user']['id'];
$sql ="select * from provider where user_id='$provider_id'";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$id=$row['id'];
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
                        Loans
                    </h4>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Loan Available
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Page Heading end-->

            <!-- panel start -->

            <!-- panel end -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Loan</button>
            <div class="panel panel-primary filterable">

                <!-- panel heading starat -->
                <div class="panel-heading">
                    <h3 class="panel-title">List of Loan</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter
                        </button>
                    </div>
                </div>
                <!-- panel heading end -->

                <div class="panel-body">
                    <!-- panel content start -->
                    <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Date Submitted" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Business Type" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Sector" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Minimum Amount." disabled></th>
                            <th><input type="text" class="form-control" placeholder="Maximum Amount" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Date Created" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Action" disabled></th>
                        </tr>
                        </thead>

                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM loan WHERE  provider_id='$id'");


                        while ($loan = mysqli_fetch_array($result)) {


                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $loan['date_submitted'] . "</td>";
                            echo "<td>" . $loan['businessType'] . "</td>";
                            echo "<td>" . $loan['sector'] . "</td>";
                            echo "<td>" . $loan['minimum_amount'] . "</td>";
                            echo "<td>" . $loan['maximum_amount'] . "</td>";
                            echo "<td>" . $loan['status'] . "</td>";
                            echo "<td>" . $loan['date_created'] . "</td>";

                            echo "<form method='POST'>";
                            echo "<td class='text-center'><a href='#' id='" . $loan['id'] . "' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>";

                        }
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                        echo "<div class='panel panel-default'>";
                        echo "<div class='col-md-offset-3 pull-right'>";

                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title" id="myModalLabel">Loan Details</h5>
                        </div>
                        <div class="modal-body">
                            <!-- form start -->
                            <form action="<?php $_PHP_SELF ?>" method="post" >
                                <table class="table table-user-information">
                                    <tbody>

                                    <tr>
                                        <td>Date Submitted:</td>
                                        <td><input type="date" class="form-control" name="date_submitted" required/></td>
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
                                        <td><input type="number" class="form-control" name="minimum_amount"  /></td>
                                    </tr>
                                    <tr>
                                        <td>Maximum Amount</td>
                                        <td><input type="number" class="form-control" name="maximum_amount" ></td>
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
                                            <input type="submit" name="submit" class="btn btn-info" value="Add Loan"></td>
                                    </tr>
                                    </tbody>

                                </table>



                            </form>
                            <!-- form end -->
                        </div>

                    </div>
                </div>
            </div>
            <br /><br/>
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