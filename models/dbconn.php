<?php
//$conn = mysqli_connect('localhost', 'u545594718_EzTrack', 'EzTrack_2026', 'u545594718_ez_track') or die('Connection Failed');
$conn = mysqli_connect('localhost', 'root', '', 'eztrack') or die('Connection Failed');
mysqli_set_charset($conn, "utf8mb4");
date_default_timezone_set('Asia/Manila');
