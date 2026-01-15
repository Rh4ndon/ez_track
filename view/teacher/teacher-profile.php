<?php
include '../../models/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Dashboard - Subjects</title>
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
            overflow-x: hidden;
        }

        /* Top Navigation Bar */
        .top-nav {
            background-color: #00167a;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: relative;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .nav-center {
            color: white;
            font-size: 40px;
            font-style: italic;
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            min-height: calc(100vh - 70px);
            text-align: center;
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .subject-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .subject-card {
                padding: 20px;
                min-height: 160px;
            }

            .subject-name {
                font-size: 24px;
            }

            .nav-center {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .subject-container {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .top-nav {
                padding: 0 15px;
            }

            .nav-center {
                font-size: 30px;
            }
        }

        .page-title {
            text-align: center;
            color: #00167a;
            margin: 20px 0;
            font-weight: 700;
            font-size: 32px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .profile-container {
            max-width: 400px;
            width: 100%;
            margin-bottom: 40px;
        }

        .profile-avatar {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            overflow: hidden;
        }

        .profile-avatar img {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            object-fit: cover;
        }



        .profile-name {
            color: #1e40af;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            padding: 15px;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 12px;
            border: 2px solid rgba(239, 68, 68, 0.3);
        }

        .logout-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border: none;
            color: white;
            padding: 12px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 25px;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
            color: white;
        }

        .nav-back {
            color: white;
            font-size: 24px;
            text-decoration: none;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <a href="teacher-sections.php" class="nav-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <div class="nav-center">
            YOUR ACCOUNT
        </div>

        <div style="width: 40px;"></div> <!-- Spacer for balance -->
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="profile-container">
            <div class="profile-avatar">
                <img src="" id="profile-pic" alt="">
            </div>

            <h2 class="profile-name" id="profile-name"></h2>
            <div class="profile-section" id="profile-section"></div>
        </div>

        <div class="warning-text">
            ONLY ADMIN AND YOU CAN<br>
            SEE THIS INFORMATION
        </div>
        <!-- Edit Profile Button -->
        <button class="btn logout-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>

        <br>



        <!-- Logout Button -->
        <button class="btn logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">Log-Out</button>

        <!-- Logout Confirmation Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirm Log-Out</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

        <script>
            document.getElementById('confirmLogoutBtn').addEventListener('click', function() {
                // Add your logout logic here
                console.log('Logging out...');
                // window.location.href = 'login.html';
                var modal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
                modal.hide();
                window.location.href = '../../controllers/logout.php?role=teacher';
            });
        </script>
    </main>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 350px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" id="closeModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data">
                        <input type="hidden" id="edit_profile_id" name="id">

                        <div class="mb-3">
                            <label for="edit_photo" class="form-label">Photo (Leave empty to keep current)</label>
                            <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                            <small class="text-muted">Current photo will be kept if not changed</small>
                        </div>

                        <div class="mb-3">
                            <label for="edit_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="Enter profile first name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="Enter profile last name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="edit_middle_initial" name="middle_initial" placeholder="Enter profile middle initial" maxlength="2">
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
                            <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter profile email" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password (Leave empty to keep current)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" id="edit_password" name="password" placeholder="Enter profile password">
                                <button type="button" class="input-group-text" onclick="togglePassword('edit_password')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update</button>
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
                    <h5 class="modal-title" id="emailOtpModalLabel">Email OTP</h5>

                </div>
                <div class="modal-body">
                    <form id="emailOtpForm">
                        <div class="mb-3">
                            <label for="emailOtp" class="form-label">Enter OTP</label>
                            <input type="text" class="form-control" id="emailOtp" name="emailOtp" placeholder="Enter OTP" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;" onclick="resendCode()">Resend OTP</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        if (!localStorage.getItem('is_logged_in') && !localStorage.getItem('role')) {
            window.location.href = '../../index.php?error=Your not logged in!';
        }

        if (localStorage.getItem('role') !== 'teacher') {
            window.location.href = '../../index.php?error=You are not a teacher!';
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

        // Edit Profile Form
        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('../../controllers/teacher/edit-profile.php', {
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

        document.addEventListener('DOMContentLoaded', function() {
            const id = localStorage.getItem('id');
            fetch('../../controllers/teacher/get-profile.php?id=' + id, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const profilePic = document.getElementById('profile-pic');
                        const profilePicSrc = data.photo;
                        if (profilePicSrc) {
                            profilePic.src = '../uploads/teachers/' + profilePicSrc;
                        }

                        const profileName = document.getElementById('profile-name');
                        const firstName = data.first_name;
                        const middleInitial = data.middle_initial;
                        const lastName = data.last_name;
                        profileName.textContent = `${firstName} ${middleInitial} ${lastName}`;

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