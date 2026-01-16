<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activity_id = $_POST['activity_id'];
    $activity_name = $_POST['activity_name'];
    $type = $_POST['type'];
    $deadline = $_POST['deadline'];
    $grade = $_POST['grade'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];

    //check activity on database
    $activity = getRecord('activities', 'activity_name = "' . $activity_name . '" AND type = "' . $type . '" AND deadline = "' . $deadline . '" AND total_grade = "' . $grade . '" AND subject_id = "' . $subject_id . '" AND id != "' . $activity_id . '"');
    if ($activity) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Activity already exists.'));
        exit();
    }

    $data = array(
        'activity_name' => $activity_name,
        'type' => $type,
        'deadline' => $deadline,
        'total_grade' => $grade,
        'subject_id' => $subject_id,
        'teacher_id' => $teacher_id
    );

    $result = editRecord('activities', $data, 'id = ' . $activity_id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
