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

    //check section on database
    $student_exists = getRecord('students', 'first_name = "' . $first_name . '" AND last_name = "' . $last_name . '"' . ' AND middle_initial = "' . $middle_initial . '"');
    if ($student_exists) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Student already exists.'));
        exit();
    }

    $student_email = getRecord('students', 'email = "' . $email . '"');
    if ($student_email) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Email already exists.'));
        exit();
    }

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
