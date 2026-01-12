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

    // Get the teacher ID from POST data
    $teacherId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate teacher ID
    if (!$teacherId || !is_numeric($teacherId)) {
        $response['message'] = 'Invalid teacher ID';
        echo json_encode($response);
        exit;
    }

    // Check if the teacher exists
    $existingTeacher = getRecord('teachers',  $teacherId);
    if (!$existingTeacher) {
        $response['message'] = 'Teacher not found';
        echo json_encode($response);
        exit;
    }

    // Delete teacher photo
    $teacherPhoto = $existingTeacher['photo'];
    if ($teacherPhoto) {
        $photoPath = '../../view/uploads/teachers/' . $teacherPhoto;
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }


    // Delete the teacher
    $deleteTeacher = deleteRecordById('teachers', $teacherId);
    if ($deleteTeacher) {
        $response['success'] = true;
        $response['message'] = 'Teacher deleted successfully!';
    } else {
        $response['message'] = 'Error deleting teacher';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
