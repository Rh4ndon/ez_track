<?php
include '../../models/functions.php';
include '../mailer.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $email = $_POST['email'];



    // Generate OTP
    $otp = rand(100000, 999999);

    $subject = 'EZTrack System OTP Verification';
    $name = $first_name . ' ' . $last_name;
    $message = '
        <h3>Good day, ' . $name . '</h3>
        <p>Here is your OTP: <b>' . $otp . '</b></p>
        <p>Thanks for using our service.</p>
        <p>EZTrack System</p>
        ';
    $alt_message = 'Good day, ' . $name . '
        Here is your OTP: ' . $otp . '
        Thanks for using our service.
        EZTrack System
        ';
    send_email($email, $name, $message, $alt_message, $subject);
    $result = true;

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'verification' => $otp));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
