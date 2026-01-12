<?php include 'models/functions.php'; ?>
<?php
$sections = getAllRecords('sections');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>EzTrack Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .container-fluid {
            min-height: 100vh;
            padding: 0;
        }

        .top-section {
            background: linear-gradient(180deg, #84a9ff 0%, #f5f8ff 100%);
            height: 22vh;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 10px;
            position: relative;
        }

        .bottom-section {
            background-color: #00167a;
            border-radius: 20px 20px 0 0;
            height: 78vh;
            min-height: calc(100vh - 150px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 30px 15px 15px;
            position: relative;
            overflow-y: auto;
        }

        .back-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #00167a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            z-index: 20;
        }

        .login-title {
            color: #00167a;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 15px;
            letter-spacing: 1px;
            text-align: center;
            padding: 0 15px;
        }

        .logo-container {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;

            border-radius: 50%;
            padding: 8px;

            width: 90px;
            height: 90px;
        }

        .logo-circle {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .form-container {
            width: 100%;
            max-width: 100%;
            margin-top: 40px;
            padding: 0 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            color: white;
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 20px;
            padding: 12px 16px;
            font-size: 14px;
            color: #333;
            height: 44px;
        }

        .form-select {
            height: 44px;
            font-size: 14px;
        }

        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(132, 169, 255, 0.3);
            border-color: transparent;
        }

        .sign-in-btn {
            background: white;
            border: 2px solid #00167a;
            color: #00167a;
            font-weight: bold;
            font-size: 14px;
            padding: 12px 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 180px;
            transition: all 0.3s ease;
            margin-top: 10px;
            height: 44px;
        }

        .sign-in-btn:hover {
            background: #00167a;
            color: white;
            border-color: #00167a;
        }

        .clouds {
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 40px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23ffffff" opacity="0.1"/></svg>') no-repeat center bottom;
            background-size: cover;
        }

        /* iPhone SE and very small devices */
        @media (max-width: 375px) {
            .top-section {
                height: 20vh;
                min-height: 130px;
                padding-top: 8px;
            }

            .bottom-section {
                height: 80vh;
                min-height: calc(100vh - 130px);
                padding: 25px 10px 10px;
            }

            .login-title {
                font-size: 48px;
                margin: 5px 0 10px;
            }

            .logo-container {
                width: 150px;
                height: 150px;
                padding: 6px;
                top: 23%;
            }

            .form-container {
                margin-top: 30px;
            }

            .form-control {
                padding: 10px 14px;
                font-size: 13px;
                height: 40px;
            }

            .form-select {
                height: 40px;
                font-size: 13px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .sign-in-btn {
                font-size: 13px;
                padding: 10px 20px;
                height: 40px;
                max-width: 160px;
            }

            .back-btn {
                font-size: 13px;
                top: 12px;
                left: 12px;
            }
        }

        /* Medium devices */
        @media (min-width: 376px) and (max-width: 576px) {
            .logo-container {
                width: 100px;
                height: 100px;
            }

            .form-container {
                max-width: 320px;
            }
        }

        /* Larger devices */
        @media (min-width: 577px) {
            .form-container {
                max-width: 400px;
            }

            .logo-container {
                width: 120px;
                height: 120px;
                padding: 10px;
            }

            .login-title {
                font-size: 48px;
            }
        }

        /* Prevent horizontal scroll on all devices */
        * {
            max-width: 100%;
        }

        /* Improve touch targets for mobile */
        input,
        select,
        button {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Top Section with Gradient -->
        <div class="top-section">
            <a href="index.php" class="back-btn">← Back</a>
            <h1 class="login-title">SIGN UP</h1>
        </div>

        <!-- Logo Container (overlapping both sections) -->
        <div class="logo-container">
            <div class="logo-circle">
                <img src="view/img/logo.png" alt="EZTrack Logo">
            </div>
        </div>

        <!-- Bottom Section with Blue Background -->
        <div class="bottom-section">
            <div class="form-container">
                <form id="registerForm" enctype="multipart/form-data">
                    <!-- Name Field -->
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Middle Initial</label>
                        <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Enter your middle initial" maxlength="2" required>
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

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <!-- LRN Field -->
                    <div class="form-group">
                        <label class="form-label">LRN</label>
                        <input type="text" class="form-control" id="lrn" name="lrn" placeholder="Enter your LRN" required>
                    </div>

                    <!-- Grade & Section Field -->
                    <div class="form-group">
                        <label class="form-label">Grade & Section</label>
                        <select name="section" id="section" class="form-select form-control" required>
                            <?php foreach ($sections as $section) : ?>
                                <option value="<?php echo $section['id']; ?>"><?php echo $section['grade_level']; ?>-<?php echo $section['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Gender Field -->
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
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
        // Add Teacher Form
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('controllers/student/student-check-details.php', {
                    method: 'POST',
                    body: formData,
                    enctype: 'multipart/form-data'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        showAlert('Student details checked successfully! Please enter verification code', 'success');
                        localStorage.setItem('verification', data.verification);
                        localStorage.setItem('first_name', formData.get('first_name'));
                        localStorage.setItem('middle_initial', formData.get('middle_initial'));
                        localStorage.setItem('last_name', formData.get('last_name'));
                        localStorage.setItem('email', formData.get('email'));
                        localStorage.setItem('password', formData.get('password'));
                        localStorage.setItem('section', formData.get('section'));
                        localStorage.setItem('gender', formData.get('gender'));
                        localStorage.setItem('lrn', formData.get('lrn'));
                        setTimeout(() => {
                            window.location.href = 'verification.php?msg=Please enter verification code';
                        }, 2000);
                    } else {
                        showAlert((data.error || 'Failed to verify student'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while verifying student', 'danger');
                });
        });
    </script>
</body>

</html>