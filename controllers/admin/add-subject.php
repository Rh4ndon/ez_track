<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_level = $_POST['grade_level'];
    $subject_name = $_POST['subject_name'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];

    //check subject on database
    $subject = getRecord('subjects', 'grade_level = "' . $grade_level . '" AND subject_name = "' . $subject_name . '"');
    if ($subject) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Subject already exists.'));
        exit();
    }

    $data = array(
        'grade_level' => $grade_level,
        'subject_name' => $subject_name,
        'description' => $description,
        'icon' => $icon
    );

    $result = insertRecord('subjects', $data);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
