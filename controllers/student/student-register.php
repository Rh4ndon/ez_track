<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $email = $_POST['email'];
    $section = $_POST['section'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $lrn = $_POST['lrn'];


    $hash_password = password_hash($password, PASSWORD_BCRYPT);
    $data = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'middle_initial' => $middle_initial,
        'email' => $email,
        'section_id' => $section,
        'password' => $hash_password,
        'gender' => $gender,
        'lrn' => $lrn
    );

    $result = insertRecord('students', $data);
    $id = getRecord('students', 'email = "' . $email . '"');

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'id' => $id['id']));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
