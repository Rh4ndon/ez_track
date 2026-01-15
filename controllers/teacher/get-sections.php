<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sections = getAllRecords('sections', 'WHERE id = ' . $id . ' ORDER BY grade_level ASC');
    $schedules = getAllRecords('schedules', 'WHERE teacher_id = ' . $id . ' GROUP BY section_id');
    $subject_sections = array();

    foreach ($schedules as $schedule) {
        $section = getRecord('sections', 'id = ' . $schedule['section_id']);
        $subject = getRecord('subjects', 'id = ' . $schedule['subject_id']);
        $subject_sections[] = array(
            'subject_id' => $schedule['subject_id'],
            'section_id' => $schedule['section_id'],
            'section_name' => $section['grade_level'] . '-' . $section['section_name'],
            'subject_name' => $subject['grade_level'] . '-' . $subject['subject_name'],
            'day_of_week' => $schedule['day_of_week'],
            'start_time' => $schedule['start_time'],
            'end_time' => $schedule['end_time']
        );
    }
    header('Content-Type: application/json');
    echo json_encode(array(
        'sections' => $sections,
        'subject_sections' => $subject_sections
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
