<?php
include '../../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_initial = $_POST['middle_initial'];
    $email = $_POST['email'];
    $section_handled = $_POST['section_handled'];
    $gender = $_POST['gender'];

    //check section on database
    $teacher_exists = getRecord('teachers', 'first_name = "' . $first_name . '" AND last_name = "' . $last_name . '"' . ' AND middle_initial = "' . $middle_initial . '" AND id != "' . $id . '"');
    if ($teacher_exists) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Teacher already exists.'));
        exit();
    }
    $teacher_section = getRecord('teachers', 'section_handled = "' . $section_handled . '" AND id != "' . $id . '"');
    if ($teacher_section) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Section already has a teacher.'));
        exit();
    }
    $teacher_email = getRecord('teachers', 'email = "' . $email . '" AND id != "' . $id . '"');
    if ($teacher_email) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Email already exists.'));
        exit();
    }

    $data = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'middle_initial' => $middle_initial,
        'email' => $email,
        'section_handled' => $section_handled,
        'gender' => $gender
    );

    // Check if password is not empty
    if (!empty($_POST['password'])) {
        $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    // Handle file upload if photo is not empty
    if (!empty($_FILES['photo']['name'])) {
        // delete first the old photo
        $teacher = getRecord('teachers', 'id = "' . $_POST['id'] . '"');
        if ($teacher['photo']) {
            $photo_path = '../../view/uploads/teachers/' . $teacher['photo'];
            if (file_exists($photo_path)) {
                unlink($photo_path);
            }
        }

        $image = $_FILES['photo'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

        if (!in_array($image['type'], $allowed_types)) {
            throw new Exception("Invalid image type. Only JPG, PNG, and GIF are allowed.");
        }

        $upload_dir = '../../view/uploads/teachers/';

        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }

        // Generate unique filename
        $image_name = time() . '_' . $first_name   . '_' . $last_name . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image['name']);
        $upload_file = $upload_dir . $image_name;

        if (!move_uploaded_file($image['tmp_name'], $upload_file)) {
            throw new Exception("Failed to upload image. Check directory permissions.");
        }

        $data['photo'] = $image_name;
    }




    $result = editRecord('teachers', $data, 'id = ' . $id);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
