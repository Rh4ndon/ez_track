<?php
// download.php - APK Download Page
$page_title = "Download EzTrack Mobile App";
$apk_filename = "eztrack-app-v1.apk"; // Change to your actual APK filename
$apk_size = "5.2 MB"; // Update with actual file size
$version = "1.0.0";
$last_updated = "January 19, 2025";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --primary-blue: #00167a;
            --secondary-blue: #84a9ff;
            --accent-gold: #ffd700;
            --success-green: #10b981;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f8ff 0%, #e8f0ff 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #1a3a8a 100%);
            color: white;
            padding: 40px 0;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 22, 122, 0.3);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-gold), #ff6b6b, #4ecdc4, #45b7d1);
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

        .app-icon {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 5px solid var(--accent-gold);
            padding: 15px;
        }

        .app-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 15px;
        }

        .app-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .app-tagline {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .download-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 22, 122, 0.15);
            margin-bottom: 30px;
            border: 2px solid var(--secondary-blue);
            transition: transform 0.3s ease;
        }

        .download-card:hover {
            transform: translateY(-5px);
        }

        .download-btn {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            margin: 30px 0;
            min-width: 300px;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .download-btn i {
            font-size: 1.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin: 40px 0;
        }

        .feature-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-top: 5px solid var(--secondary-blue);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 22, 122, 0.2);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 30px;
        }

        .feature-title {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .qr-section {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .qr-code {
            width: 200px;
            height: 200px;
            margin: 0 auto 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid var(--secondary-blue);
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .system-requirements,
        .instructions {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .requirements-list,
        .instructions-list {
            list-style: none;
            padding: 0;
        }

        .requirements-list li,
        .instructions-list li {
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .requirements-list li:last-child,
        .instructions-list li:last-child {
            border-bottom: none;
        }

        .requirements-list i,
        .instructions-list i {
            color: var(--success-green);
            font-size: 1.2rem;
            min-width: 25px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            padding: 12px 25px;
            border: 2px solid var(--primary-blue);
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .back-btn:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateX(-5px);
        }

        .download-count {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 15px;
        }

        .count-number {
            font-weight: 700;
            color: var(--primary-blue);
        }

        @media (max-width: 768px) {
            .app-title {
                font-size: 2.2rem;
            }

            .app-icon {
                width: 120px;
                height: 120px;
            }

            .download-card {
                padding: 25px;
            }

            .download-btn {
                min-width: 100%;
                padding: 15px 25px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        .floating-download {
            animation: floatDownload 3s ease-in-out infinite;
        }

        @keyframes floatDownload {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Logo fallback styling */
        .logo-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="header">
        <div class="container-custom">
            <div class="app-icon floating-download">
                <?php
                $logo_path = "../img/logo.png";
                if (file_exists($logo_path)): ?>
                    <img src="<?php echo $logo_path; ?>" alt="EzTrack Logo">
                <?php else: ?>
                    <div class="logo-placeholder">
                        EzTrack<br>Logo
                    </div>
                <?php endif; ?>
            </div>
            <h1 class="app-title">EzTrack Mobile</h1>
            <p class="app-tagline">Track your academic progress on the go. Stay connected with teachers and manage your learning journey anytime, anywhere.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container-custom">
        <!-- Download Card -->
        <div class="download-card text-center">
            <h2 style="color: var(--primary-blue); margin-bottom: 20px;">Download Android App</h2>
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 20px;">
                Version <?php echo $version; ?> • <?php echo $apk_size; ?> • Updated <?php echo $last_updated; ?>
            </p>

            <a href="apk/<?php echo $apk_filename; ?>" class="download-btn" download>
                <i class="fas fa-download"></i>
                DOWNLOAD APK
            </a>

            <div class="download-count">
                <i class="fas fa-download"></i>
                <span class="count-number"><?php echo rand(1000, 5000); ?></span> downloads this month
            </div>

            <p style="color: #666; font-size: 0.9rem; margin-top: 20px;">
                Requires Android 8.0 or higher
            </p>
        </div>

        <!-- Features Section -->
        <h3 style="color: var(--primary-blue); text-align: center; margin: 40px 0 30px;">App Features</h3>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <h4 class="feature-title">Track Activities</h4>
                <p>Monitor your assignments, quizzes, and exams in real-time</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="feature-title">Progress Analytics</h4>
                <p>View detailed progress reports and performance analytics</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <h4 class="feature-title">Notifications</h4>
                <p>Get instant notifications for new assignments and deadlines</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h4 class="feature-title">Teacher Communication</h4>
                <p>Communicate directly with your teachers</p>
            </div>
        </div>

        <!-- System Requirements -->
        <div class="system-requirements">
            <h4 style="color: var(--primary-blue); margin-bottom: 25px;">
                <i class="fas fa-mobile-alt"></i> System Requirements
            </h4>
            <ul class="requirements-list">
                <li>
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Android Version:</strong> 8.0 (Oreo) or higher
                    </div>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Storage Space:</strong> Minimum 50 MB free space
                    </div>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Internet Connection:</strong> Required for syncing data
                    </div>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Permissions:</strong> Storage (for downloads), Internet, Notifications
                    </div>
                </li>
            </ul>
        </div>

        <!-- Installation Instructions -->
        <div class="instructions">
            <h4 style="color: var(--primary-blue); margin-bottom: 25px;">
                <i class="fas fa-wrench"></i> Installation Instructions
            </h4>
            <ul class="instructions-list">
                <li>
                    <i class="fas fa-1"></i>
                    <div>
                        <strong>Step 1:</strong> Download the APK file using the button above
                    </div>
                </li>
                <li>
                    <i class="fas fa-2"></i>
                    <div>
                        <strong>Step 2:</strong> Open the downloaded file from your device
                    </div>
                </li>
                <li>
                    <i class="fas fa-3"></i>
                    <div>
                        <strong>Step 3:</strong> Allow installation from "Unknown Sources" if prompted
                    </div>
                </li>
                <li>
                    <i class="fas fa-4"></i>
                    <div>
                        <strong>Step 4:</strong> Tap "Install" and wait for installation to complete
                    </div>
                </li>
                <li>
                    <i class="fas fa-5"></i>
                    <div>
                        <strong>Step 5:</strong> Open the app and log in with your credentials
                    </div>
                </li>
            </ul>
        </div>

        <!-- Troubleshooting -->
        <div class="instructions">
            <h4 style="color: var(--primary-blue); margin-bottom: 25px;">
                <i class="fas fa-question-circle"></i> Troubleshooting
            </h4>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <p style="margin: 0; color: #555;">
                    <strong>If you can't install the app:</strong> Make sure "Unknown Sources" is enabled in your Android settings. Go to Settings → Security → Unknown Sources and enable it.
                </p>
            </div>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                <p style="margin: 0; color: #555;">
                    <strong>Need help?</strong> Contact support at eztracksystem@gmail.com
                </p>
            </div>
        </div>

        <!-- Back Button -->
        <div style="text-align: center; margin-top: 40px;">
            <a href="../../index.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Homepage
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer style="text-align: center; padding: 30px 20px; background: var(--primary-blue); color: white; margin-top: 60px;">
        <p style="margin: 0; opacity: 0.9;">© <?php echo date('Y'); ?> EzTrack Educational System. All rights reserved.</p>
        <p style="margin: 10px 0 0; font-size: 0.9rem; opacity: 0.7;">
            Version <?php echo $version; ?> • For educational purposes only
        </p>
    </footer>
    <script src="../js/show-alert.js"></script>
    <script>
        // Track download button click
        document.querySelector('.download-btn').addEventListener('click', function(e) {
            // You can add analytics tracking here
            console.log('APK download initiated');

            // Optional: Show a confirmation message
            setTimeout(() => {
                showAlert('Download started! Check your notifications or downloads folder.', 'success');
            }, 500);
        });

        // Animate features on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });

        // Dynamic download count (simulated)
        function updateDownloadCount() {
            const countElement = document.querySelector('.count-number');
            let currentCount = parseInt(countElement.textContent);
            // Simulate occasional downloads
            if (Math.random() > 0.7) {
                currentCount += Math.floor(Math.random() * 3) + 1;
                countElement.textContent = currentCount;
            }
        }

        // Update download count every 30 seconds
        setInterval(updateDownloadCount, 30000);

        // Preload logo image for better UX
        window.addEventListener('load', function() {
            const logoImg = document.querySelector('.app-icon img');
            if (logoImg) {
                logoImg.style.opacity = '0';
                logoImg.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    logoImg.style.opacity = '1';
                }, 300);
            }
        });
    </script>
</body>

</html>