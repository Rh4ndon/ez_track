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

    // Get the section ID from POST data
    $sectionId = isset($_POST['id']) ? $_POST['id'] : null;

    // Validate section ID
    if (!$sectionId || !is_numeric($sectionId)) {
        $response['message'] = 'Invalid section ID';
        echo json_encode($response);
        exit;
    }

    // Check if the section exists
    $existingSection = getRecord('sections',  $sectionId);
    if (!$existingSection) {
        $response['message'] = 'Section not found';
        echo json_encode($response);
        exit;
    }
    $existingStudents = getRecord('students', 'section_id = ' . $sectionId);
    if ($existingStudents) {
        $response['message'] = 'Cannot delete section with students';
        echo json_encode($response);
        exit;
    }


    // Delete the section
    $deleteSection = deleteRecordById('sections', $sectionId);
    if ($deleteSection) {
        $response['success'] = true;
        $response['message'] = 'Section deleted successfully!';
    } else {
        $response['message'] = 'Error deleting section';
    }
} catch (Exception $e) {


    $response['message'] = 'Error: ' . $e->getMessage();
    $response['error_details'] = $e->getFile() . ':' . $e->getLine();
}

// Send JSON response
echo json_encode($response);
exit;
