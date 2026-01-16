<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $subject_id = $_GET['subject_id'];
    $type = $_GET['type'];
    $get_activity = getAllRecords('activities', 'WHERE subject_id = ' . $subject_id . ' AND type = "' . $type . '"');
    $activities = array();

    foreach ($get_activity as $activity) {
        $subject = getRecord('subjects', 'id = ' . $activity['subject_id']);
        $activities[] = array(
            'activity_name' => $activity['activity_name'],
            'type' => $activity['type'],
            'subject_name' => $subject['grade_level'] . '-' . $subject['subject_name'],
            'deadline' => date('m/d/Y', strtotime($activity['deadline'])),
            'total_grade' => $activity['total_grade'],
            'id' => $activity['id']
        );
    }
    header('Content-Type: application/json');
    echo json_encode(array(
        'success' => true,
        'activities' => $activities
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
