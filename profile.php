<?php
include('functions.php');
include('conn.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

 $username=$_SESSION['user']['username'];
$userId=$_SESSION['user']['id'];
$select="select * from sme where user_id=".$userId;
$run_select=mysqli_query($conn,$select);
$row=mysqli_fetch_array($run_select);



if (isset($_POST['submit'])) {
//variables
$ownerName = $_POST['ownerName'];
$ownerSurname = $_POST['ownerSurname'];
$ownerPhone = $_POST['ownerPhone'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$businessType = $_POST['businessType'];
$address = $_POST['address'];
$coName=$_POST['coName'];

$sql="UPDATE sme SET ownerName='$ownerName', ownerSurname='$ownerSurname', ownerPhone='$ownerPhone', 
coName='$coName', businessType='$businessType', phoneNumber='$phoneNumber', address='$address', email='$email' WHERE user_id='$userId'";
$res=mysqli_query($conn,$sql);


header( 'Location: profile.php' ) ;
}

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
    <li>SME Name::<?php echo $row['ownerName'];?></li>

    <li><a href="index.php?logout='1"">Logout </a></li>
</ul>
<div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <div class="user-wrapper">
                <img src="assets/images/icon.png" width="100" height="100" class="img-responsive" />
                <div class="description">
                    <h4><?php echo $row['ownerName']; ?> <?php echo $row['ownerSurname']; ?></h4>
                    <h5> <strong> SME Details </strong></h5>
                    <p>

                    </p>
                    <hr />
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
                </div>
            </div>

        </div>
        <div class="col-sm-9">


            <div class="description">
                <h3> <b>Company Name</b> <?php echo $row['coName']; ?> </h3>
                <hr />

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-user-information" align="center">
                            <tbody>
                            <tr>
                                <td>Registration Number</td>
                                <td><?php echo $row['regNumber']; ?></td>
                            </tr>

                           <tr>
                                <td>Owner Firstname</td>
                                <td><?php echo $row['ownerName']; ?></td>
                            </tr>
                            <tr>
                                <td>Owner Surname</td>
                                <td><?php echo $row['ownerSurname']; ?></td>
                            </tr>
                            <tr>
                                <td>Company Name</td>
                                <td><?php echo $row['coName']; ?></td>
                            </tr>
                           <tr>
                               <td>Company Phone Number</td>
                               <td><?php echo $row['phoneNumber']; ?>
                               </td>
                           </tr>
                           <tr>
                               <td>Company Physical Address</td>
                               <td><?php echo $row['address']; ?>
                               </td>
                           </tr>
                            <tr>
                                <td>Company Registration Number</td>
                                <td><?php echo $row['regNumber']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Business Type</td>
                                <td><?php echo $row['businessType']; ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <h4 class="modal-title" id="myModalLabel">Profile Detail</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form action="<?php $_PHP_SELF ?>" method="post" >
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Registration Number</td>
                                    <td><?php echo $row['regNumber']; ?></td>
                                </tr>
                                <tr>
                                    <td>Owner Firstname</td>
                                    <td><input type="text" class="form-control" name="ownerName" required value="<?php echo $row['ownerName']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Owner Surname:</td>
                                    <td><input type="text" class="form-control" name="ownerSurname" required value="<?php echo  $row['ownerSurname']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Owner Phone:</td>
                                    <td><input type="text" class="form-control" name="ownerPhone" required value="<?php echo  $row['ownerPhone']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Company Name</td>
                                    <td><input type="text" class="form-control" name="coName" required value="<?php echo $row['coName']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Company Phone </td>
                                    <td><input type="text" class="form-control" name="phoneNumber" required value="<?php echo $row['phoneNumber']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" name="email"  required value="<?php echo $row['email']; ?>"  /></td>
                                </tr>

                                <tr>
                                    <td>Business Type</td>

                                    <td>
                                        <div class="radio" required>
                                            <label><input type="radio" name="businessType" value="Private">Private Sector</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="businessType" value="Public" >Public Sector</label>
                                        </div>

                                    </td>
                                </tr>
                                <!-- radio button end -->
                                                              <tr>
                                    <td>Address</td>
                                    <td><textarea class="form-control" name="address"  ><?php echo $row['address']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
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
<footer>
    <h5>Tafara© 2018</h5></footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>