<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $section_id = $_GET['section_id'];
    $type = $_GET['type'];

    // Get the section details
    $section = getRecord('sections', 'id = ' . $section_id);

    // Get all subjects for this grade level
    $subjects = getAllRecords('subjects', 'WHERE grade_level = ' . $section['grade_level']);

    $subjects_data = array();

    foreach ($subjects as $subject) {
        $subject_data = array(
            'subject_name' => $subject['subject_name'],
            'subject_icon' => $subject['icon'],
            'subject_id' => $subject['id'],
            'display_name' => $section['grade_level'] . '-' . $subject['subject_name']
        );

        // Get all activities for this subject and type
        $activities = getAllRecords(
            'activities',
            'WHERE subject_id = ' . $subject['id'] . ' AND type = "' . $type . '" 
             ORDER BY created_at ASC'
        );

        // Get all students in this section
        $students = getAllRecords('students', 'WHERE section_id = ' . $section_id . ' ORDER BY gender, last_name');

        foreach ($students as $student) {
            $student_activities = array();

            // For each activity, check if student has progress
            $activity_index = 1;
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
                    'activity_index' => $activity_index
                );

                $activity_index++;
            }

            $subject_data['students'][] = array(
                'name' => $student['last_name'] . ', ' . $student['first_name'],
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'id' => $student['id'],
                'activities' => $student_activities
            );
        }

        // Only add subject if it has activities of the specified type
        if (!empty($activities)) {
            $subject_data['activity_count'] = count($activities);
            $subjects_data[] = $subject_data;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(array(
        'subjects' => $subjects_data,
        'section_name' => $section['grade_level'] . '-' . $section['section_name'],
        'section_grade' => $section['grade_level'],
        'total_subjects' => count($subjects_data)
    ));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
