<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

if (isset($_GET['role'])) {
    $role = $_GET['role'];
    if ($role === 'admin') {
        echo "<script>
                localStorage.clear();
                window.location.href = '../view/admin/index.php?msg=You have been logged out successfully.';
                </script>";
    } else if ($role === 'teacher') {
        echo "<script>
                localStorage.clear();
                window.location.href = '../index.html?msg=You have been logged out successfully.';
                </script>";
    } else if ($role === 'student') {
        echo "<script>
                localStorage.clear();
                window.location.href = '../index.html?msg=You have been logged out successfully.';
                </script>";
    }
}
