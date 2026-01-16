<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $subject_id = $_GET['subject_id'];
    $type = $_GET['type'];
    $subject = getRecord('subjects', 'id = ' . $subject_id);

    $subjects_data =  array();
    $sections = getAllRecords('sections', 'WHERE grade_level = ' . $subject['grade_level']);

    foreach ($sections as $section) {
        $subject_data = array(
            'section_name' => $section['grade_level'] . '-' . $section['section_name'],
            'section_id' => $section['id']
        );

        // Get all activities for this subject
        $activities = getAllRecords('activities', 'WHERE subject_id = ' . $subject_id . ' AND type = "' . $type . '"');

        $get_students = getAllRecords('students', 'WHERE section_id = ' . $section['id'] . ' ORDER BY gender, last_name');
        foreach ($get_students as $student) {
            $student_activities = array();

            // For each activity, check if student has progress
            foreach ($activities as $activity) {
                $progress = getRecord(
                    'student_progress',
                    'student_id = ' . $student['id'] . ' AND activity_id = ' . $activity['id']
                );

                $student_activities[] = array(
                    'activity_id' => $activity['id'],
                    'activity_name' => $activity['activity_name'],
                    'progress' => $progress ? $progress['progress'] : '0',
                    'student_grade' => $progress ? $progress['student_grade'] : null,
                    'activity_index' => array_search($activity, $activities) + 1 // For "Act 1", "Act 2", etc.
                );
            }

            $subject_data['students'][] = array(
                'name' => $student['last_name'] . ', ' . $student['first_name'],
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'id' => $student['id'],
                'activities' => $student_activities
            );
        }

        $subjects_data[] = $subject_data;
    }

    header('Content-Type: application/json');
    echo json_encode(array(
        'subjects' => $subjects_data,
        'subject_name' => $subject['subject_name'],
        'subject_icon' => $subject['icon'],
        'activity_count' => isset($activities) ? count($activities) : 0
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
