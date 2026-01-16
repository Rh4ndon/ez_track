<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activity_name = $_POST['activity_name'];
    $type = $_POST['type'];
    $deadline = $_POST['deadline'];
    $grade = $_POST['grade'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];

    //check activity on database
    $activity = getRecord('activities', 'activity_name = "' . $activity_name . '" AND type = "' . $type . '" AND deadline = "' . $deadline . '" AND total_grade = "' . $grade . '" AND subject_id = "' . $subject_id . '"');
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

    $new_activity = newRecord('activities', $data);

    if (!$new_activity) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Failed to add activity.'));
        exit();
    }

    $subject = getRecord('subjects', 'id = ' . $subject_id);
    $sections = getAllRecords('sections', 'WHERE grade_level = ' . $subject['grade_level']);
    foreach ($sections as $section) {
        $students = getAllRecords('students', 'WHERE section_id = ' . $section['id']);
        foreach ($students as $student) {
            $student_data = array(
                'student_id' => $student['id'],
                'activity_id' => $new_activity
            );
            $student_progress = insertRecord('student_progress', $student_data);
            if (!$student_progress) {
                header('Content-Type: application/json');
                echo json_encode(array('error' => 'Failed to add student progress.'));
                exit();
            }
        }
    }

    $result = true;

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
