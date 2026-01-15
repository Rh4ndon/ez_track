<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $grade_level = $_POST['grade_level'];
    $subject_name = $_POST['subject_name'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];

    $subject = getRecord('subjects', 'id = ' . $id);
    if (!$subject) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Subject not found.'));
        exit();
    }


    //check subject on database
    $existingSubject = getRecord('subjects', 'grade_level = "' . $grade_level . '" AND subject_name = "' . $subject_name . '" AND id != ' . $id);
    if ($existingSubject) {
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

    $result = updateRecord('subjects', $data, 'id = ' . $id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
