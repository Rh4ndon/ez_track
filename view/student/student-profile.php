<?php
include '../../models/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Dashboard - Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #84a9ff 0%, #f5f8ff 100%);
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Elements */
        .game-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .floating-star {
            position: absolute;
            font-size: 20px;
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: radial-gradient(circle, #fff, #84a9ff);
            border-radius: 50%;
            animation: particle-float 8s infinite ease-in-out;
            opacity: 0.5;
        }

        @keyframes particle-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
                opacity: 0.5;
            }

            50% {
                transform: translate(50px, -100px) scale(1.5);
                opacity: 0.8;
            }
        }

        /* Top Navigation Bar */
        .top-nav {
            background: linear-gradient(135deg, #00167a 0%, #1a3a8a 100%);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: relative;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .nav-center {
            color: white;
            font-size: 36px;
            font-style: italic;
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {

            0%,
            100% {
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5), 0 0 20px rgba(132, 169, 255, 0.5);
            }

            50% {
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5), 0 0 30px rgba(132, 169, 255, 0.8);
            }
        }

        .nav-back {
            color: white;
            font-size: 28px;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-back:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Sound Toggle Button */
        .sound-toggle {
            position: fixed;
            top: 90px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.5);
            transition: all 0.3s ease;
            border: 3px solid white;
        }

        .sound-toggle:hover {
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.8);
        }

        .sound-toggle i {
            font-size: 28px;
            color: #00167a;
        }

        .sound-toggle.muted {
            background: linear-gradient(135deg, #6c757d, #9099a5);
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            min-height: calc(100vh - 70px);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .profile-container {
            max-width: 500px;
            width: 100%;
            margin-bottom: 40px;
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 22, 122, 0.2);
            position: relative;
            overflow: hidden;
            animation: profileEntry 0.8s ease-out;
        }

        @keyframes profileEntry {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .profile-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #ffd700, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 300% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .profile-avatar {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
            overflow: hidden;
            border: 5px solid #ffd700;
            position: relative;
            transition: all 0.3s ease;
            animation: avatarPulse 2s ease-in-out infinite;
        }

        @keyframes avatarPulse {

            0%,
            100% {
                box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
            }

            50% {
                box-shadow: 0 15px 40px rgba(255, 215, 0, 0.7);
            }
        }

        .profile-avatar:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .profile-avatar img {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            color: #00167a;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            color: #475569;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .warning-text {
            color: #dc2626;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 30px 0;
            padding: 20px;
            background: white;
            border-radius: 15px;
            border: 3px solid #fecaca;
            box-shadow: 0 5px 20px rgba(220, 38, 38, 0.2);
            max-width: 500px;
            animation: warningPulse 2s ease-in-out infinite;
        }

        @keyframes warningPulse {

            0%,
            100% {
                border-color: #fecaca;
            }

            50% {
                border-color: #dc2626;
            }
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .logout-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border: none;
            color: white;
            padding: 15px 45px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .logout-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.6);
            color: white;
        }

        .logout-btn:active {
            transform: translateY(-1px) scale(1.02);
        }

        .edit-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.6);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #00167a 0%, #1a3a8a 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 20px 30px;
        }

        .modal-title {
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .modal-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #00167a;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-center {
                font-size: 24px;
            }

            .profile-container {
                padding: 30px 20px;
            }

            .profile-avatar {
                width: 150px;
                height: 150px;
            }

            .profile-avatar img {
                width: 150px;
                height: 150px;
            }

            .profile-name {
                font-size: 22px;
            }

            .logout-btn {
                padding: 12px 35px;
                font-size: 16px;
            }

            .sound-toggle {
                width: 50px;
                height: 50px;
            }

            .sound-toggle i {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .top-nav {
                padding: 0 15px;
                height: 60px;
            }

            .nav-center {
                font-size: 20px;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .logout-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="game-background" id="gameBackground"></div>

    <!-- Top Navigation -->
    <nav class="top-nav">
        <a href="student-subjects.php" class="nav-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <div class="nav-center">
            🎮 YOUR ACCOUNT 🎮
        </div>

        <div style="width: 40px;"></div>
    </nav>

    <!-- Sound Toggle Button -->
    <div class="sound-toggle" id="soundToggle" title="Toggle Sound">
        <i class="fas fa-volume-up"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="profile-container">
            <div class="profile-avatar">
                <img src="" id="profile-pic" alt="Profile Picture">
            </div>

            <h2 class="profile-name" id="profile-name">Loading...</h2>
            <div class="profile-info" id="profile-section"></div>
            <div class="profile-info" id="profile-email"></div>
            <div class="profile-info" id="profile-gender"></div>
        </div>

        <div class="warning-text">
            🔒 ONLY ADMIN AND YOU CAN<br>
            SEE THIS INFORMATION 🔒
        </div>

        <div class="action-buttons">
            <button class="btn logout-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-user-edit"></i> Edit Profile
            </button>

            <button class="btn logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Log-Out
            </button>
        </div>
    </main>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Log-Out</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmLogoutBtn">Log-Out</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" id="closeModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data">
                        <input type="hidden" id="edit_profile_id" name="id">

                        <div class="mb-3">
                            <label for="edit_photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                            <small class="text-muted">Leave empty to keep current photo</small>
                        </div>

                        <div class="mb-3">
                            <label for="edit_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="Enter first name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="Enter last name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="edit_middle_initial" name="middle_initial" placeholder="Enter middle initial" maxlength="2">
                        </div>

                        <div class="mb-3">
                            <label for="edit_gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="edit_gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter email" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" id="edit_password" name="password" placeholder="Leave empty to keep current">
                                <button type="button" class="input-group-text" onclick="togglePassword('edit_password')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Leave empty to keep current password</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Email OTP Modal -->
    <div class="modal fade" id="emailOtpModal" tabindex="-1" aria-labelledby="emailOtpModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailOtpModalLabel">Email OTP Verification</h5>
                </div>
                <div class="modal-body">
                    <form id="emailOtpForm">
                        <div class="mb-3">
                            <label for="emailOtp" class="form-label">Enter OTP</label>
                            <input type="text" class="form-control" id="emailOtp" name="emailOtp" placeholder="Enter OTP code" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" onclick="resendCode()">Resend OTP</button>
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../js/show-alert.js"></script>
    <script>
        // Background Music
        let bgMusic = new Audio('../sounds/game-music-loop-7.mp3');
        bgMusic.loop = true;
        bgMusic.volume = 0.3;
        let isMuted = true;

        const soundToggle = document.getElementById('soundToggle');
        const soundIcon = soundToggle.querySelector('i');

        soundToggle.addEventListener('click', function() {
            isMuted = !isMuted;

            if (isMuted) {
                bgMusic.pause();
                soundToggle.classList.add('muted');
                soundIcon.classList.remove('fa-volume-up');
                soundIcon.classList.add('fa-volume-mute');
            } else {
                bgMusic.play().catch(e => console.log('Audio play failed:', e));
                soundToggle.classList.remove('muted');
                soundIcon.classList.remove('fa-volume-mute');
                soundIcon.classList.add('fa-volume-up');
            }
        });

        // Initialize as muted
        soundToggle.classList.add('muted');
        soundIcon.classList.remove('fa-volume-up');
        soundIcon.classList.add('fa-volume-mute');

        // Create floating stars
        function createFloatingStars() {
            const background = document.getElementById('gameBackground');
            const starEmojis = ['⭐', '✨', '🌟', '💫', '🏆', '👑'];

            for (let i = 0; i < 20; i++) {
                const star = document.createElement('div');
                star.className = 'floating-star';
                star.textContent = starEmojis[Math.floor(Math.random() * starEmojis.length)];
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 6 + 's';
                star.style.animationDuration = (Math.random() * 4 + 4) + 's';
                background.appendChild(star);
            }
        }

        // Create particles
        function createParticles() {
            const background = document.getElementById('gameBackground');

            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
                background.appendChild(particle);
            }
        }

        // Auth checks
        if (!localStorage.getItem('is_logged_in') && !localStorage.getItem('role')) {
            window.location.href = '../../index.php?error=Your not logged in!';
        }

        if (localStorage.getItem('role') !== 'student') {
            window.location.href = '../../index.php?error=You are not a student!';
        }

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

        function resendCode() {
            $('#editProfileModal').modal('show', {
                backdrop: 'static'
            });
            $('#emailOtpModal').modal('hide');
            document.getElementById('closeModalBtn').hidden = true;
        }

        // Confirm Logout
        document.getElementById('confirmLogoutBtn').addEventListener('click', function() {
            console.log('Logging out...');
            if (typeof AndroidBridge !== 'undefined') {
                AndroidBridge.onLogout();
            }
            var modal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
            modal.hide();
            window.location.href = '../../controllers/logout.php?role=student';
        });

        // Edit Profile Form
        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('../../controllers/student/edit-profile.php', {
                    method: 'POST',
                    body: formData,
                    enctype: 'multipart/form-data'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        localStorage.setItem('first_name', data.first_name);
                        localStorage.setItem('middle_initial', data.middle_initial);
                        localStorage.setItem('last_name', data.last_name);
                        localStorage.setItem('email', data.email);
                        localStorage.setItem('gender', data.gender);

                        const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
                        modal.hide();
                        showAlert('Profile updated successfully!', 'success');
                        if (data.otp) {
                            localStorage.setItem('otp', data.otp);
                            $('#emailOtpModal').modal('show');
                        } else {
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    } else {
                        showAlert((data.error || 'Failed to update profile'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while updating profile', 'danger');
                });
        });

        // Email OTP Form
        document.getElementById('emailOtpForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            if (localStorage.getItem('otp') === formData.get('emailOtp')) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('emailOtpModal'));
                modal.hide();
                showAlert('OTP verified successfully!', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('Invalid OTP', 'danger');
            }
        });

        // Load Profile Data
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingStars();
            createParticles();

            const id = localStorage.getItem('id');
            fetch('../../controllers/student/get-profile.php?id=' + id, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const profilePic = document.getElementById('profile-pic');
                        const profilePicSrc = data.photo;
                        if (profilePicSrc) {
                            profilePic.src = '../uploads/students/' + profilePicSrc;
                        }

                        const profileName = document.getElementById('profile-name');
                        const firstName = data.first_name;
                        const middleInitial = data.middle_initial;
                        const lastName = data.last_name;
                        profileName.textContent = `${firstName} ${middleInitial} ${lastName}`;
                        const profileEmail = document.getElementById('profile-email');
                        profileEmail.textContent = 'Email: ' + data.email;
                        const profileGender = document.getElementById('profile-gender');
                        profileGender.textContent = 'Gender: ' + data.gender.charAt(0).toUpperCase() + data.gender.slice(1);

                        const profileSection = document.getElementById('profile-section');
                        profileSection.textContent = 'Section: ' + data.grade_level + ' - ' + data.section_name;

                        document.getElementById('edit_profile_id').value = localStorage.getItem('id');
                        document.getElementById('edit_first_name').value = data.first_name;
                        document.getElementById('edit_last_name').value = data.last_name;
                        document.getElementById('edit_middle_initial').value = data.middle_initial;
                        document.getElementById('edit_email').value = data.email;
                        document.getElementById('edit_gender').value = data.gender;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>