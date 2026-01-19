<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Login Verify Code</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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

        .verify-title {
            color: #00167a;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .logo-container {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;

            border-radius: 50%;
            padding: 15px;

        }

        .logo-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-circle img {
            height: 111%;
            object-fit: cover;
            border-radius: 50%;
        }

        .verification-container {
            width: 100%;
            max-width: 320px;
            margin-top: 80px;
            text-align: center;
        }

        .verification-text {
            color: white;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .code-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .code-input {
            width: 45px;
            height: 55px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #00167a;
        }

        .code-input:focus {
            outline: none;
            background: white;
            box-shadow: 0 0 0 2px rgba(132, 169, 255, 0.5);
        }

        .verify-btn {
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
            margin-bottom: 20px;
        }

        .verify-btn:hover {
            background: #00167a;
            color: white;
            border-color: #00167a;
        }

        .resend-btn {
            background: transparent;
            border: 2px solid white;
            color: white;
            font-weight: bold;
            font-size: 14px;
            padding: 10px 30px;
            border-radius: 20px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .resend-btn:hover {
            background: white;
            color: #00167a;
        }

        .timer {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        @media (max-width: 576px) {
            .logo-circle {
                width: 180px;
                height: 180px;
            }

            .verify-title {
                font-size: 38px;
            }

            .verification-container {
                max-width: 280px;
                margin-top: 60px;
            }

            .code-input {
                width: 40px;
                height: 50px;
                font-size: 20px;
            }

            .code-input-container {
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Top Section with Gradient -->
        <div class="top-section">
            <a href="index.php" class="back-btn">← Back</a>
            <h1 class="verify-title">Verify Code</h1>
        </div>

        <!-- Logo Container (overlapping both sections) -->
        <div class="logo-container">
            <div class="logo-circle">
                <img src="view/img/logo.png" alt="EZTrack Logo">
            </div>
        </div>

        <!-- Bottom Section with Blue Background -->
        <div class="bottom-section">
            <div class="verification-container">
                <!-- Verification Message -->
                <p class="verification-text">
                    An authentication code has been sent to your email
                </p>

                <!-- Code Input Fields -->
                <div class="code-input-container">
                    <input type="number" class="code-input" maxlength="1" id="code1">
                    <input type="number" class="code-input" maxlength="1" id="code2">
                    <input type="number" class="code-input" maxlength="1" id="code3">
                    <input type="number" class="code-input" maxlength="1" id="code4">
                    <input type="number" class="code-input" maxlength="1" id="code5">
                    <input type="number" class="code-input" maxlength="1" id="code6">
                </div>

                <!-- Verify Button -->
                <button type="button" class="btn verify-btn" onclick="verifyCode()">VERIFY CODE</button>

                <!-- Resend Button -->
                <button type="button" class="btn resend-btn" onclick="resendCode()">RESEND CODE</button>

                <!-- Timer -->
                <div class="timer" id="timer">00:30</div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        if (!localStorage.getItem('verification')) {
            window.location.href = 'index.php?error=No verification code found';
        }

        // Auto-focus and navigation between input fields
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.code-input');

            inputs.forEach((input, index) => {
                // Add input event for handling typing
                input.addEventListener('input', function(e) {
                    // Only allow digits
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');

                    // If input has value, move to next input
                    if (e.target.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                        // Select the text in the next input for easy replacement
                        inputs[index + 1].select();
                    }

                    // If all inputs are filled, submit the form
                    checkIfAllFilled();
                });

                // Keydown event for better backspace handling
                input.addEventListener('keydown', function(e) {
                    // Handle backspace - different methods for mobile compatibility
                    if (e.key === 'Backspace' || e.key === 'Delete') {
                        // Clear current input
                        e.target.value = '';

                        // Move to previous input if current is empty OR if we're at the last input
                        if ((!e.target.value || index > 0) && !e.target.value) {
                            // Small delay to ensure value is cleared
                            setTimeout(() => {
                                if (index > 0) {
                                    inputs[index - 1].focus();
                                    // Select text in previous input
                                    inputs[index - 1].select();
                                }
                            }, 10);
                        }

                        // Prevent default to avoid browser navigation on backspace
                        e.preventDefault();
                    }

                    // Handle arrow keys for navigation
                    if (e.key === 'ArrowLeft' && index > 0) {
                        inputs[index - 1].focus();
                        inputs[index - 1].select();
                        e.preventDefault();
                    }

                    if (e.key === 'ArrowRight' && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                        inputs[index + 1].select();
                        e.preventDefault();
                    }
                });

                // Add click event for better mobile selection
                input.addEventListener('click', function() {
                    this.select();
                });

                // Add focus event for better UX
                input.addEventListener('focus', function() {
                    this.select();
                });

                // Handle paste event
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasteData = e.clipboardData.getData('text');
                    const digits = pasteData.replace(/[^0-9]/g, '').slice(0, 6);

                    // Fill inputs with pasted digits
                    for (let i = 0; i < digits.length && i < inputs.length; i++) {
                        inputs[i].value = digits[i];
                    }

                    // Focus on the next empty input or the last one
                    const nextIndex = Math.min(digits.length, inputs.length - 1);
                    inputs[nextIndex].focus();
                    inputs[nextIndex].select();

                    checkIfAllFilled();
                });

                // Add touch event for mobile (optional)
                input.addEventListener('touchstart', function() {
                    this.focus();
                    // Show mobile keyboard properly
                    this.setAttribute('inputmode', 'numeric');
                });
            });

            // Focus first input on load
            inputs[0].focus();
            setTimeout(() => {
                inputs[0].select();
            }, 100);

            // Check if all inputs are filled
            function checkIfAllFilled() {
                let allFilled = true;
                inputs.forEach(input => {
                    if (!input.value) {
                        allFilled = false;
                    }
                });

                if (allFilled) {
                    // Auto-submit or trigger next action
                    console.log('All inputs filled!');
                    // document.getElementById('codeForm').submit(); // Uncomment for auto-submit
                }
            }

            // Alternative approach: Create a hidden input for better mobile keyboard
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'text';
            hiddenInput.style.position = 'absolute';
            hiddenInput.style.opacity = '0';
            hiddenInput.style.height = '0';
            hiddenInput.style.width = '0';
            hiddenInput.style.border = 'none';
            hiddenInput.style.padding = '0';
            hiddenInput.style.margin = '0';
            hiddenInput.setAttribute('inputmode', 'numeric');
            hiddenInput.setAttribute('pattern', '[0-9]*');

            startTimer(30);

        });

        function verifyCode() {

            // Get input values
            const code1 = document.getElementById('code1').value;
            const code2 = document.getElementById('code2').value;
            const code3 = document.getElementById('code3').value;
            const code4 = document.getElementById('code4').value;
            const code5 = document.getElementById('code5').value;
            const code6 = document.getElementById('code6').value;

            // Get stored verification code
            const storedVerification = localStorage.getItem('verification');

            console.log(localStorage.getItem('verification'));

            // Compare input code with stored verification code
            if (code1 + code2 + code3 + code4 + code5 + code6 === storedVerification) {
                localStorage.setItem('is_logged_in', true);
                localStorage.removeItem('verification');
                if (localStorage.getItem('role') === 'student') {
                    showAlert('Student logged in successfully!', 'success');
                } else if (localStorage.getItem('role') === 'teacher') {
                    showAlert('Teacher logged in successfully!', 'success');
                }
                setTimeout(() => {
                    if (localStorage.getItem('role') === 'student') {
                        window.location.href = 'view/student/student-subjects.php?msg=Student logged in successfully!';
                    } else if (localStorage.getItem('role') === 'teacher') {
                        window.location.href = 'view/teacher/teacher-sections.php?msg=Teacher logged in successfully!';
                    }

                }, 2000);


            } else {
                showAlert('Invalid verification code', 'danger');
            }

        }



        function resendCode() {
            // Reset timer and resend code
            startTimer(30);
            const formData = new FormData();
            formData.append('email', localStorage.getItem('email'));
            formData.append('first_name', localStorage.getItem('first_name'));
            formData.append('middle_initial', localStorage.getItem('middle_initial'));
            formData.append('last_name', localStorage.getItem('last_name'));

            // Send Verification code to user on controllers/student/student-resend-verification.php
            fetch('controllers/student/student-resend-verification.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Verification code has been sent to your email', 'success');
                        localStorage.setItem('verification', data.verification);
                    } else {
                        showAlert('Failed to send verification code', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while sending verification code', 'danger');
                });
        }

        function startTimer(seconds) {
            const timerElement = document.getElementById('timer');
            let timeLeft = seconds;

            const countdown = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const remainingSeconds = timeLeft % 60;

                timerElement.textContent =
                    `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerElement.textContent = '00:00';
                }

                timeLeft--;
            }, 1000);
        }
    </script>

    <script src="view/js/show-alert.js"></script>
</body>

</html>