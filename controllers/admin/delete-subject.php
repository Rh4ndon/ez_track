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

    // Get the subject ID from POST data
    $subjectId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate subject ID
    if (!$subjectId || !is_numeric($subjectId)) {
        $response['message'] = 'Invalid subject ID';
        echo json_encode($response);
        exit;
    }

    // Check if the subject exists
    $existingSubject = getRecord('subjects',  $subjectId);
    if (!$existingSubject) {
        $response['message'] = 'Subject not found';
        echo json_encode($response);
        exit;
    }

    //Check subject schedules
    $subjectSchedules = getRecord('schedules', 'WHERE subject_id = ' . $subjectId);
    if ($subjectSchedules) {
        $response['message'] = 'Cannot delete subject with schedules';
        echo json_encode($response);
        exit;
    }

    // Delete the subject
    $deleteSubject = deleteRecordById('subjects', $subjectId);
    if ($deleteSubject) {
        $response['success'] = true;
        $response['message'] = 'Subject deleted successfully!';
    } else {
        $response['message'] = 'Error deleting subject';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
