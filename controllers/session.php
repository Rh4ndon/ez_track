<?php
session_start();

if (!isset($_SESSION['id'])) {
    session_destroy();
    echo "<script>localStorage.clear();</script>";
    header("Location: ../../index.php?error=You are not logged in!");
    exit();
}
