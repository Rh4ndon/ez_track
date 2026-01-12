<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EZTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(to bottom, #001a66 0%, #001a66 55%, #b3d9ff 55%, #b3d9ff 100%);
        }

        .container-custom {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .content {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-bottom: 60px;
        }

        .logo-container {
            width: 500px;
            height: 500px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .welcome-text {
            color: white;
            font-size: 72px;
            font-weight: 300;
            letter-spacing: 12px;
            text-transform: uppercase;
        }

        .enter-button {
            background: white;
            color: #001a66;
            font-size: 64px;
            font-weight: bold;
            padding: 20px 120px;
            border: 4px solid #001a66;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login {
            background: white;
            color: #001a66;
            border: 4px solid #001a66;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }


        .enter-button:hover {
            background: #001a66;
            color: white;
            transform: scale(1.05);
        }

        .modal-header {
            background: #001a66;
            color: white;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .form-control {
            border-radius: 50px;
            border: 2px solid #001a66;
            padding: 15px 20px;
            font-size: 16px;
            color: #333;
        }

        @media (max-width: 968px) {
            .content {
                flex-direction: column;
                gap: 30px;
            }

            .logo-container {
                width: 200px;
                height: 200px;
            }

            .welcome-text {
                font-size: 48px;
                letter-spacing: 8px;
                text-align: center;
            }

            .enter-button {
                font-size: 48px;
                padding: 15px 80px;
            }
        }

        @media (max-width: 600px) {
            .logo-container {
                width: 150px;
                height: 150px;
            }

            .welcome-text {
                font-size: 32px;
                letter-spacing: 4px;
            }

            .enter-button {
                font-size: 36px;
                padding: 12px 60px;
            }
        }
    </style>
</head>

<body>
    <div class="container-custom">
        <div class="content">
            <div class="logo-container">
                <img src="../img/logo.png" alt="EZTrack Logo">
            </div>
            <h1 class="welcome-text">WELCOME TO<br>EZTRACK</h1>
        </div>
        <button class="enter-button" onclick="enterSite()">Enter</button>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <input type="hidden" id="role" name="role" value="admin">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>

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

                        <button type="submit" class="btn login w-100">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/show-alert.js"></script>
    <script>
        if (localStorage.getItem('is_logged_in') === 'true' && localStorage.getItem('role') === 'admin') {
            window.location.href = 'admin-dashboard.php';
        }

        function enterSite() {
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            formData.append('role', role);

            // Send data to ../../controllers/login.php
            fetch('../../controllers/login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        localStorage.setItem('id', data.id);
                        localStorage.setItem('role', data.role);
                        localStorage.setItem('email', data.email);
                        localStorage.setItem('is_logged_in', true);
                        localStorage.setItem('login_time', data.login_time);
                        showAlert(data.message, 'success');
                        setTimeout(() => {
                            window.location.href = 'admin-dashboard.php';
                        }, 2000);
                    } else {
                        console.log(data);
                    }
                })
                .catch(error => showAlert(error));
        });

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
    </script>
</body>

</html>