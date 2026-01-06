<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $grade_level = $_POST['grade_level'];
    $section_name = $_POST['section_name'];

    $section = getRecord('sections', 'id = ' . $id);
    if (!$section) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section not found.'));
        exit();
    }


    //check section on database
    $existingSection = getRecord('sections', 'grade_level = "' . $grade_level . '" AND section_name = "' . $section_name . '"');
    if ($existingSection) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section already exists.'));
        exit();
    }

    $data = array(
        'grade_level' => $grade_level,
        'section_name' => $section_name
    );

    $result = editRecord('sections', $data, 'id = ' . $id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
