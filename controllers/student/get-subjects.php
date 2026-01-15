<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Missing ID parameter.'));
        exit;
    }

    $section = getRecord('sections', 'id = ' . $id);

    if (!$section) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section not found.'));
        exit;
    }

    $subjects = getAllRecords('subjects', 'WHERE grade_level = ' . $section['grade_level'] . ' ORDER BY subject_name ASC');

    foreach ($subjects as $key => $subject) {
        // Get ALL schedules for this subject and section
        $schedules = getAllRecords('schedules', 'WHERE subject_id = ' . $subject['id'] . ' AND section_id = ' . $section['id']);

        // Store all schedules as an array
        $subjects[$key]['schedules'] = $schedules;
    }

    header('Content-Type: application/json');
    echo json_encode(array(
        'subjects' => $subjects
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
