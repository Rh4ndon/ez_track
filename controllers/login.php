<?php
include '../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    if ($role == 'admin') {
        $user = getRecord('admins', 'email = "' . $email . '"');
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['login_time'] = time();
            $data = array(
                'id' => $user['id'],
                'role' => $role,
                'email' => $user['email'],
                'is_logged_in' => true,
                'login_time' => time(),
                'message' => 'Login successful',
                'success' => true
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        } else if ($user && !password_verify($password, $user['password'])) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid password.'));
            exit();
        } else if (!$user) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Invalid email or password.'));
            exit();
        }
    } else {
    }
}
