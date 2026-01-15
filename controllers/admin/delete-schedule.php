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

    // Get the schedule ID from POST data
    $scheduleId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate schedule ID
    if (!$scheduleId || !is_numeric($scheduleId)) {
        $response['message'] = 'Invalid schedule ID';
        echo json_encode($response);
        exit;
    }

    // Check if the schedule exists
    $existingSchedule = getRecord('schedules',  $scheduleId);
    if (!$existingSchedule) {
        $response['message'] = 'Schedule not found';
        echo json_encode($response);
        exit;
    }

    // Delete the schedule
    $deleteSchedule = deleteRecordById('schedules', $scheduleId);
    if ($deleteSchedule) {
        $response['success'] = true;
        $response['message'] = 'Schedule deleted successfully!';
    } else {
        $response['message'] = 'Error deleting schedule';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
