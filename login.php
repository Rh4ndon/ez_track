<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .container-fluid {
            height: 100vh;
            padding: 0;
        }

        .top-section {
            background: linear-gradient(180deg, #84a9ff 0%, #f5f8ff 100%);
            height: 25vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 20px;
            position: relative;
        }

        .bottom-section {
            background-color: #00167a;
            border-radius: 20px 20px 0 0;
            height: 75vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 40px 20px 20px;
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #00167a;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        .back-btn:hover {
            color: #00167a;
            text-decoration: none;
        }

        .login-title {
            color: #00167a;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .logo-container {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background: white;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 8px 25px rgba(0, 22, 122, 0.2);
        }

        .logo-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-circle img {

            height: 200%;
            object-fit: cover;
            border-radius: 50%;
        }

        .logo-placeholder {
            font-size: 48px;
            color: #6c757d;
        }

        .form-container {
            width: 100%;
            max-width: 320px;
            margin-top: 80px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: white;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 25px;
            padding: 15px 20px;
            font-size: 16px;
            color: #333;
        }

        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(132, 169, 255, 0.3);
            border-color: transparent;
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 0.8;
        }

        .teacher-id-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .teacher-id-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .teacher-id-icon svg {
            width: 24px;
            height: 24px;
            color: #00167a;
        }

        .sign-in-btn {
            background: white;
            border: 2px solid #00167a;
            color: #00167a;
            font-weight: bold;
            font-size: 16px;
            padding: 15px 40px;
            border-radius: 25px;
            width: 100%;
            max-width: 200px;
            transition: all 0.3s ease;
        }

        .sign-in-btn:hover {
            background: #00167a;
            color: white;
            border-color: #00167a;
        }

        .clouds {
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 60px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23ffffff" opacity="0.1"/></svg>') no-repeat center bottom;
            background-size: cover;
        }

        @media (max-width: 576px) {
            .logo-circle {
                width: 100px;
                height: 100px;
            }

            .login-title {
                font-size: 38px;
            }

            .form-container {
                max-width: 280px;
                margin-top: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Top Section with Gradient -->
        <div class="top-section">
            <a href="index.php" class="back-btn">← Back</a>
            <br>
            <h1 class="login-title">LOGIN</h1>
        </div>

        <!-- Logo Container (overlapping both sections) -->
        <div class="logo-container">
            <div class="logo-circle">
                <!-- Placeholder for your logo - replace this div with your image -->
                <img src="view/img/logo.png" alt="EZTrack Logo">
            </div>
        </div>

        <!-- Bottom Section with Blue Background -->
        <div class="bottom-section">
            <div class="form-container">
                <form id="loginForm">
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select class="form-select form-control" name="role" id="role">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="input-group-text" onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>


                    <!-- Sign In Button -->
                    <div class="text-center">
                        <button type="submit" class="btn sign-in-btn">SIGN IN</button>
                    </div>
                </form>
            </div>


            <!-- Decorative Clouds -->
            <div class="clouds"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="view/js/show-alert.js"></script>
    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = event.currentTarget.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }
        if (localStorage.getItem('verification')) {
            localStorage.removeItem('verification');
        }
        if (localStorage.getItem('is_logged_in') === 'true' && localStorage.getItem('role') === 'student') {
            window.location.href = 'view/student/student-subjects.php?msg=You are already logged in as a student.';
        } else if (localStorage.getItem('is_logged_in') === 'true' && localStorage.getItem('role') === 'teacher') {
            window.location.href = 'view/teacher/teacher-sections.php?msg=You are already logged in as a teacher.';
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('controllers/login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        localStorage.setItem('role', data.role);
                        localStorage.setItem('id', data.id);
                        localStorage.setItem('first_name', data.first_name);
                        localStorage.setItem('middle_initial', data.middle_initial);
                        localStorage.setItem('last_name', data.last_name);
                        localStorage.setItem('section', data.section);
                        localStorage.setItem('email', data.email);
                        localStorage.setItem('gender', data.gender);
                        localStorage.setItem('login_time', data.login_time);
                        localStorage.setItem('verification', data.otp);
                        if (data.role === 'student') {
                            localStorage.setItem('lrn', data.lrn);
                        }
                        showAlert('Login successful please enter verification code', 'success');
                        setTimeout(() => {
                            window.location.href = 'login-verification.php?msg=Please enter verification code';
                        }, 2000);

                    } else {
                        showAlert((data.error || 'Failed to login'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while logging in', 'danger');
                });
        });
    </script>

</body>

</html>