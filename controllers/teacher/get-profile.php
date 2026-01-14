<?php
include '../../models/functions.php';
include '../mailer.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $student = getRecord('teachers', 'id = ' . $id);

    if (!$student) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Student not found.'));
        exit();
    }
    $section = getRecord('sections', 'id = ' . $student['section_handled']);
    if ($section) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'first_name' => $student['first_name'],
            'middle_initial' => $student['middle_initial'],
            'last_name' => $student['last_name'],
            'email' => $student['email'],
            'gender' => $student['gender'],
            'photo' => $student['photo'],
            'section_handled' => $student['section_handled'],
            'section_name' => $section['section_name'],
            'grade_level' => $section['grade_level'],
            'success' => true
        ));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
