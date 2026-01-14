<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZTrack - Welcome</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #84a9ff 0%, #f5f8ff 100%);
        }

        .welcome-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .upper-section {
            background-color: #00167a;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 2rem;
            border-radius: 0 0 50px 50px;
        }

        .lower-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .welcome-title {
            font-size: 1.5rem;
            font-weight: 300;
            letter-spacing: 2px;
            margin-bottom: 2rem;
            text-transform: uppercase;
        }

        .logo-circle {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-have-account {
            background-color: #00167a;
            border: none;
            color: white;
            border-radius: 25px;
            padding: 12px 40px;
            font-size: 1rem;
            font-weight: 500;
            width: 250px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .btn-have-account:hover {
            background-color: #001a87;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 22, 122, 0.3);
        }

        .btn-create-account {
            background-color: white;
            border: 2px solid #00167a;
            color: #00167a;
            border-radius: 25px;
            padding: 12px 40px;
            font-size: 1rem;
            font-weight: 500;
            width: 250px;
            transition: all 0.3s ease;
        }

        .btn-create-account:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 22, 122, 0.15);
        }

        @media (max-width: 576px) {
            .welcome-title {
                font-size: 1.3rem;
                letter-spacing: 1px;
            }



            .btn-have-account,
            .btn-create-account {
                width: 220px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <!-- Upper Section -->
        <div class="upper-section">
            <h1 class="welcome-title">Welcome to<br>EZTrack</h1>
            <div class="logo-circle">
                <img src="view/img/logo.png" alt="EZTrack Logo">
            </div>
        </div>

        <!-- Lower Section -->
        <div class="lower-section">
            <a href="login.php" class="btn btn-have-account mb-3">
                I have an account
            </a>
            <a href="register.php" class="btn btn-create-account">
                Create an account
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="view/js/show-alert.js"></script>
    <script>
        if (localStorage.getItem('verification')) {
            localStorage.removeItem('verification');
        }
        if (localStorage.getItem('is_logged_in') === 'true' && localStorage.getItem('role') === 'student') {
            window.location.href = 'view/student/student-subjects.php?msg=You are already logged in as a student.';
        } else if (localStorage.getItem('is_logged_in') === 'true' && localStorage.getItem('role') === 'teacher') {
            window.location.href = 'view/teacher/teacher-sections.php?msg=You are already logged in as a teacher.';
        }
    </script>
</body>

</html>