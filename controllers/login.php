<?php
include '../models/functions.php';
include 'mailer.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    if ($role == 'admin') {
        $user = getRecord('admins', 'email = "' . $email . '"');
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['login_time'] = time();
            $data = array(
                'id' => $user['id'],
                'role' => $role,
                'email' => $user['email'],
                'is_logged_in' => true,
                'login_time' => time(),
                'message' => 'Login successful',
                'success' => true
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        } else if ($user && !password_verify($password, $user['password'])) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid password.'));
            exit();
        } else if (!$user) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid email or password.'));
            exit();
        }
    } else if ($role == 'student') {
        $user = getRecord('students', 'email = "' . $email . '"');
        if ($user && password_verify($password, $user['password'])) {
            $otp = rand(100000, 999999);

            $subject = 'EZTrack System OTP Verification';
            $name = $user['first_name'] . ' ' . $user['last_name'];
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
            $data = array(
                'id' => $user['id'],
                'role' => $role,
                'lrn' => $user['lrn'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'middle_initial' => $user['middle_initial'],
                'last_name' => $user['last_name'],
                'gender' => $user['gender'],
                'login_time' => time(),
                'message' => 'Login successful',
                'photo' => $user['photo'],
                'section' => $user['section_id'],
                'otp' => $otp,
                'success' => true
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        } else if ($user && !password_verify($password, $user['password'])) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid password.'));
            exit();
        } else if (!$user) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid email or password.'));
            exit();
        }
    } else if ($role == 'teacher') {
        $user = getRecord('teachers', 'email = "' . $email . '"');
        if ($user && password_verify($password, $user['password'])) {
            $otp = rand(100000, 999999);

            $subject = 'EZTrack System OTP Verification';
            $name = $user['first_name'] . ' ' . $user['last_name'];
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
            $data = array(
                'id' => $user['id'],
                'role' => $role,
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'middle_initial' => $user['middle_initial'],
                'last_name' => $user['last_name'],
                'login_time' => time(),
                'message' => 'Login successful',
                'photo' => $user['photo'],
                'section' => $user['section_handled'],
                'otp' => $otp,
                'success' => true
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        } else if ($user && !password_verify($password, $user['password'])) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid password.'));
            exit();
        } else if (!$user) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid email or password.'));
            exit();
        }
    }
}
