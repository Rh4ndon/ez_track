<?php
// update-progress.php
include '../../models/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $activity_id = $_POST['activity_id'];
    $progress = $_POST['progress'];

    // Check if progress record exists
    $existing = getRecord(
        'student_progress',
        "student_id = $student_id AND activity_id = $activity_id"
    );

    if ($existing) {
        // Update existing record
        $data = ['progress' => $progress];
        if ($progress === '1') {
            $data['submitted_at'] = date('Y-m-d H:i:s');
        }
        $result = editRecord(
            'student_progress',
            $data,
            "id = {$existing['id']}"
        );
    } else {
        // Create new record
        $data = [
            'student_id' => $student_id,
            'activity_id' => $activity_id,
            'progress' => $progress
        ];
        if ($progress === '1') {
            $data['submitted_at'] = date('Y-m-d H:i:s');
        }
        $result = addRecord('student_progress', $data);
    }

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Progress updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
