<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sections = getAllRecords('students', 'WHERE section_id = ' . $_GET['id'] . ' ORDER BY last_name, gender ASC');

    $section = getRecord('sections', 'id = ' . $_GET['id']);
    header('Content-Type: application/json');
    echo json_encode(array(
        'section_name' => $section['grade_level'] . '-' . $section['section_name'],
        'students' => $sections
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
