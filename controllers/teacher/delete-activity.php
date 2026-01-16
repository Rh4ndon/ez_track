<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection and functions
include '../../models/functions.php';

// Set content type to JSON for AJAX response
header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'message' => ''];

try {
    // Check if request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $response['message'] = 'Invalid request method';
        echo json_encode($response);
        exit;
    }

    // Get the activity ID from POST data
    $activityId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate activity ID
    if (!$activityId || !is_numeric($activityId)) {
        $response['message'] = 'Invalid activity ID';
        echo json_encode($response);
        exit;
    }

    // Check if the activity exists
    $existingActivity = getRecord('activities',  'id = ' . $activityId);
    if (!$existingActivity) {
        $response['message'] = 'Activity not found';
        echo json_encode($response);
        exit;
    }

    $deleteStudentProgress = deleteRecordById('student_progress', $activityId, 'activity_id');
    if (!$deleteStudentProgress) {
        $response['message'] = 'Error deleting student progress';
        echo json_encode($response);
        exit;
    }

    // Delete the activity
    $deleteActivity = deleteRecordById('activities', $activityId);
    if ($deleteActivity) {
        $response['success'] = true;
        $response['message'] = 'Activity deleted successfully!';
    } else {
        $response['message'] = 'Error deleting activity';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
