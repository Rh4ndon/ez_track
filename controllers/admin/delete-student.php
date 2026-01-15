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

    // Get the student ID from POST data
    $studentId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate student ID
    if (!$studentId || !is_numeric($studentId)) {
        $response['message'] = 'Invalid student ID';
        echo json_encode($response);
        exit;
    }

    // Check if the student exists
    $existingStudent = getRecord('students',  $studentId);
    if (!$existingStudent) {
        $response['message'] = 'Student not found';
        echo json_encode($response);
        exit;
    }

    // Delete student photo
    $studentPhoto = $existingStudent['photo'];
    if ($studentPhoto) {
        $photoPath = '../../view/uploads/students/' . $studentPhoto;
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }


    // Delete the student
    $deleteStudent = deleteRecordById('students', $studentId);
    if ($deleteStudent) {
        $response['success'] = true;
        $response['message'] = 'Student deleted successfully!';
    } else {
        $response['message'] = 'Error deleting student';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
