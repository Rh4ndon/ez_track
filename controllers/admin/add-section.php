<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_level = $_POST['grade_level'];
    $section_name = $_POST['section_name'];

    //check section on database
    $section = getRecord('sections', 'grade_level = "' . $grade_level . '" AND section_name = "' . $section_name . '"');
    if ($section) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section already exists.'));
        exit();
    }

    $data = array(
        'grade_level' => $grade_level,
        'section_name' => $section_name
    );

    $result = insertRecord('sections', $data);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
