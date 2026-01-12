<?php session_start(); ?>
<?php include '../../models/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #84a9ff 0%, #f5f8ff 100%);
        }

        /* Top Navigation Bar */
        .top-nav {
            background-color: #00167a;
            height: 10%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: relative;
            z-index: 1000;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .menu-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background: white;
            margin: 5px 0;
            border-radius: 2px;
            transition: 0.3s;
        }

        .page-title {
            color: white;
            font-size: 36px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-icon {
            width: 48px;
            height: 48px;
            fill: white;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

        /* Side Menu */
        .side-menu {
            position: fixed;
            top: 100px;
            left: -280px;
            width: 280px;
            height: 90%;
            background-color: #bedafd;
            z-index: 999;
            transition: left 0.3s ease;
            overflow-y: auto;
        }

        .side-menu.open {
            left: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: #00167a;
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid rgba(0, 22, 122, 0.1);
            transition: background-color 0.3s ease;
        }

        .menu-item:hover {
            background-color: rgba(0, 22, 122, 0.1);
            color: #00167a;
            text-decoration: none;
        }

        .menu-item.active {
            background-color: rgba(0, 22, 122, 0.2);
        }

        .menu-icon {
            width: 36px;
            height: 36px;
            fill: #00167a;
        }

        /* Main Content */
        .main-content {
            padding: 30px 200px;
            min-height: 90%;
            transition: margin-left 0.3s ease;
        }

        .stats-container {
            max-width: 100%;
            margin-top: 90px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }

        .stat-card {
            background: white;
            width: 65%;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 22, 122, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 22, 122, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 80px;
            height: 80px;
            fill: #00167a;
        }

        .stat-info {
            flex: 1;
            text-align: center;
        }

        .stat-label {
            color: #6c757d;
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-number {
            color: #00167a;
            font-size: 72px;
            font-weight: bold;
            margin: 0;
        }

        /* Overlay for mobile menu */
        .menu-overlay {
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            height: calc(100vh - 60px);
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .menu-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }

            .stat-card {
                padding: 20px;
                margin-bottom: 15px;
            }

            .stat-number {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>