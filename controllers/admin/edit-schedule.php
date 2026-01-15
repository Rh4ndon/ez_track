<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['schedule_id'];
    $teacher = $_POST['teacher'];
    $subject = $_POST['subject'];
    $section = $_POST['section'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];


    // Validate times
    if (strtotime($end_time) <= strtotime($start_time)) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'End time must be after start time.'));
        exit();
    }

    // Check for exact duplicate schedule
    $schedule = getRecord('schedules', 'teacher_id = "' . $teacher . '" AND subject_id = "' . $subject . '" AND section_id = "' . $section . '" AND day_of_week = "' . $day . '" AND start_time = "' . $start_time . '" AND end_time = "' . $end_time . '" AND id != "' . $id . '"');
    if ($schedule) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Schedule already exists.'));
        exit();
    }

    // Check for teacher time conflicts (teacher can't teach two classes at the same time)
    $teacherConflict = getRecord(
        'schedules',
        'teacher_id = "' . $teacher . '" AND day_of_week = "' . $day . '" AND ' .
            '((start_time < "' . $end_time . '" AND end_time > "' . $start_time . '") OR ' .
            '(start_time >= "' . $start_time . '" AND end_time <= "' . $end_time . '")) AND id != "' . $id . '"'
    );

    if ($teacherConflict) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Teacher already has a class scheduled at this time.'));
        exit();
    }

    // Check for section time conflicts (section can't have two classes at the same time)
    $sectionConflict = getRecord(
        'schedules',
        'section_id = "' . $section . '" AND day_of_week = "' . $day . '" AND ' .
            '((start_time < "' . $end_time . '" AND end_time > "' . $start_time . '") OR ' .
            '(start_time >= "' . $start_time . '" AND end_time <= "' . $end_time . '")) AND id != "' . $id . '"'
    );

    if ($sectionConflict) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section already has a class scheduled at this time.'));
        exit();
    }

    // Check for overlapping time conflicts (more comprehensive)
    $overlapCheck = getRecord(
        'schedules',
        'section_id = "' . $section . '" AND day_of_week = "' . $day . '" AND ' .
            '((start_time <= "' . $start_time . '" AND end_time > "' . $start_time . '") OR ' . // New class starts during existing class
            '(start_time < "' . $end_time . '" AND end_time >= "' . $end_time . '") OR ' . // New class ends during existing class
            '("' . $start_time . '" <= start_time AND "' . $end_time . '" >= end_time)) AND id != "' . $id . '"'
    ); // New class completely covers existing class

    if ($overlapCheck) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Schedule conflicts with existing class time.'));
        exit();
    }

    // Check for subject conflicts in the same section (optional - if you don't want same subject twice in same section)
    $subjectConflict = getRecord(
        'schedules',
        'section_id = "' . $section . '" AND subject_id = "' . $subject . '" AND day_of_week = "' . $day . '" AND id != "' . $id . '"'
    );

    if ($subjectConflict) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'This subject is already scheduled for this section on the same day.'));
        exit();
    }


    $data = array(
        'teacher_id' => $teacher,
        'subject_id' => $subject,
        'section_id' => $section,
        'day_of_week' => $day,
        'start_time' => $start_time,
        'end_time' => $end_time
    );

    $result = editRecord('schedules', $data, 'id = ' . $id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
