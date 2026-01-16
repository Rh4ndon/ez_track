<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $subject_id = $_GET['subject_id'];
    $student_id = $_GET['student_id'];
    $type = $_GET['type'];

    // Get the subject details
    $subject = getRecord('subjects', 'id = ' . $subject_id);

    // Get the student details
    $student = getRecord('students', 'id = ' . $student_id);

    // Get all activities for this subject and type
    $activities = getAllRecords(
        'activities',
        'WHERE subject_id = ' . $subject_id . ' AND type = "' . $type . '" 
         ORDER BY created_at ASC'
    );

    $student_activities = array();
    $activity_index = 1;

    // For each activity, check if student has progress
    foreach ($activities as $activity) {
        $progress = getRecord(
            'student_progress',
            'student_id = ' . $student_id . ' AND activity_id = ' . $activity['id']
        );

        $student_activities[] = array(
            'activity_id' => (string)$activity['id'],
            'activity_name' => $activity['activity_name'],
            'progress' => $progress ? (string)$progress['progress'] : "0",
            'student_grade' => $progress && $progress['student_grade'] !== null ? (string)$progress['student_grade'] : null,
            'activity_index' => $activity_index
        );

        $activity_index++;
    }

    // Prepare the student data
    $student_data = array(
        'name' => $student['last_name'] . ', ' . $student['first_name'],
        'first_name' => $student['first_name'],
        'last_name' => $student['last_name'],
        'id' => (string)$student['id'],
        'activities' => $student_activities
    );

    header('Content-Type: application/json');
    echo json_encode($student_data);
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
