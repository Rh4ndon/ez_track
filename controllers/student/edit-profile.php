<?php
include '../../models/functions.php';
include '../mailer.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $otp = null;

    $student = getRecord('students', 'id = "' . $_POST['id'] . '"');

    //check student on database
    $student_exists = getRecord('students', 'first_name = "' . $first_name . '" AND last_name = "' . $last_name . '"' . ' AND middle_initial = "' . $middle_initial . '" AND id != "' . $id . '"');
    if ($student_exists) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Student already exists.'));
        exit();
    }

    $student_email = getRecord('students', 'email = "' . $email . '" AND id != "' . $id . '"');
    if ($student_email) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Email already exists.'));
        exit();
    }

    if ($email != $student['email']) {
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
    }
    $data = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'middle_initial' => $middle_initial,
        'email' => $email,
        'gender' => $gender
    );

    // Check if password is not empty
    if (!empty($_POST['password'])) {
        $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    // Handle file upload if photo is not empty
    if (!empty($_FILES['photo']['name'])) {
        // delete first the old photo

        if ($student['photo']) {
            $photo_path = '../../view/uploads/students/' . $student['photo'];
            if (file_exists($photo_path)) {
                unlink($photo_path);
            }
        }

        $image = $_FILES['photo'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($image['type'], $allowed_types)) {
            throw new Exception("Invalid image type. Only JPG, PNG, and GIF are allowed.");
        }

        $upload_dir = '../../view/uploads/students/';

        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }

        // Generate unique filename
        $image_name = time() . '_' . $first_name   . '_' . $last_name . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image['name']);
        $upload_file = $upload_dir . $image_name;

        if (!move_uploaded_file($image['tmp_name'], $upload_file)) {
            throw new Exception("Failed to upload image. Check directory permissions.");
        }

        $data['photo'] = $image_name;
    }




    $result = editRecord('students', $data, 'id = ' . $id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
            'otp' => $otp
        ));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
