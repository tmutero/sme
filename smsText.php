<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 5/21/2018
 * Time: 11:40 PM
 */
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;
	include('functions.php');
	include ('conn.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}
$admin = $_SESSION['user']['username'];
$admin_id = $_SESSION['user']['id'];

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC0d0511516020eb1f0e4eb7abf2195e67';
$auth_token = '68066cfb95dceefe9cde3e519d18e552';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+17246801182";

$client = new Client($account_sid, $auth_token);


if (isset($_POST['btn'])) {
    $message = $_POST['message'];

    $client->messages->create(
// Where to send a text message (your cell phone?)
        '+263774226217',
        array(
            'from' => $twilio_number,
            'body' => $message."\n"."Created By-".$admin."\n".date("Y-m-d")
        )
    );

    ?>
    <div class="alert alert-success">Message was successfully send</div>

<?php

}



?>