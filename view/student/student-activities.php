<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Dashboard - Activities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            flex-direction: column;
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

        .nav-center span {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            margin-top: 5px;
            opacity: 0.9;
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
            color: white;
        }

        .dropdown-toggle {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 3px solid #ffd700 !important;
            color: #00167a !important;
            font-weight: 700;
            padding: 10px 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .dropdown-toggle:hover {
            background: #ffd700 !important;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.5);
        }

        .dropdown-menu {
            border-radius: 15px;
            border: 3px solid #00167a;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .dropdown-item {
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
            color: #00167a;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #84a9ff, #6a91ff);
            color: white;
            transform: translateX(5px);
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
            max-width: 900px;
            width: 100%;
            margin-bottom: 40px;
        }

        .page-title {
            text-align: center;
            color: #00167a;
            margin: 20px 0 30px;
            font-weight: 800;
            font-size: 42px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Table Styling */
        .table-responsive {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 22, 122, 0.2);
            position: relative;
            overflow: hidden;
            animation: tableEntry 0.8s ease-out;
        }

        @keyframes tableEntry {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .table-responsive::before {
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

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #00167a, #1a3a8a);
            color: white;
        }

        .table thead th {
            padding: 20px;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 2px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(132, 169, 255, 0.1), rgba(245, 248, 255, 0.5));
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 22, 122, 0.1);
        }

        .table tbody td {
            padding: 20px;
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            vertical-align: middle;
        }

        .table tbody td:first-child {
            color: #00167a;
            font-weight: 700;
        }

        /* Custom Checkbox Styling */
        .table input[type="checkbox"] {
            width: 30px;
            height: 30px;
            cursor: pointer;
            accent-color: #10b981;
            transition: all 0.3s ease;
            position: relative;
        }

        .table input[type="checkbox"]:hover {
            transform: scale(1.2);
        }

        .table input[type="checkbox"]:checked {
            animation: checkPulse 0.3s ease;
        }

        @keyframes checkPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Completion Badge */
        .completion-badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            margin-top: 20px;
            animation: badgePulse 2s ease-in-out infinite;
        }

        @keyframes badgePulse {

            0%,
            100% {
                box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            }

            50% {
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
            }
        }

        /* Progress Bar */
        .progress-container {
            margin: 30px 0;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 22, 122, 0.15);
        }

        .progress-label {
            font-weight: 700;
            color: #00167a;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .progress {
            height: 30px;
            border-radius: 15px;
            background: #e2e8f0;
            overflow: hidden;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            background: linear-gradient(90deg, #10b981, #059669);
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.6s ease;
            animation: progressShine 2s ease-in-out infinite;
        }

        @keyframes progressShine {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-center {
                font-size: 24px;
            }

            .nav-center span {
                font-size: 12px;
            }

            .page-title {
                font-size: 32px;
            }

            .table-responsive {
                padding: 20px;
            }

            .table thead th,
            .table tbody td {
                padding: 15px 10px;
                font-size: 14px;
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

            .page-title {
                font-size: 28px;
            }

            .table-responsive {
                padding: 15px;
            }

            .table input[type="checkbox"] {
                width: 25px;
                height: 25px;
            }
        }

        /* Row Animation */
        .table tbody tr {
            animation: rowEntry 0.6s ease-out backwards;
        }

        .table tbody tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        .table tbody tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        .table tbody tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        .table tbody tr:nth-child(4) {
            animation-delay: 0.4s;
        }

        .table tbody tr:nth-child(5) {
            animation-delay: 0.5s;
        }

        @keyframes rowEntry {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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
            <div id="navCenterLogo">🎯 TLE</div>
            <span id="navCenterSpan">ACTIVITIES</span>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="activityDropdown">
                <li><a class="dropdown-item" href="student-activities.php"><i class="fas fa-tasks"></i> Activities</a></li>
                <li><a class="dropdown-item" href="student-exam-quiz.html"><i class="fas fa-clipboard-check"></i> Exams and Quizzes</a></li>
                <li><a class="dropdown-item" href="student-performance.html"><i class="fas fa-chart-line"></i> Performance Task</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sound Toggle Button -->
    <div class="sound-toggle" id="soundToggle" title="Toggle Sound">
        <i class="fas fa-volume-up"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="profile-container">
            <h1 class="page-title">📝 <span id="pageTitle"></span> 📝</h1>

            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-label">
                    <i class="fas fa-trophy"></i> Completion Progress
                </div>
                <div class="progress">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                        1/3 Complete
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fas fa-list-alt"></i> Activity</th>
                            <th scope="col"><i class="fas fa-check-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody id="activityTable">
                        <tr>
                            <td>Activity 1</td>
                            <td><input type="checkbox" class="activity-checkbox"></td>
                        </tr>
                        <tr>
                            <td>Activity 2</td>
                            <td><input type="checkbox" class="activity-checkbox"></td>
                        </tr>
                        <tr>
                            <td>Activity 3</td>
                            <td><input type="checkbox" class="activity-checkbox"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="completion-badge" id="completionBadge">
                <i class="fas fa-star"></i> Keep Going!
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Background Music
        let bgMusic = new Audio('../sounds/game-music-loop-7.mp3');
        bgMusic.loop = true;
        bgMusic.volume = 0.3;
        let isMuted = true;

        let winMusic = new Audio('../sounds/small-win.mp3');
        winMusic.volume = 0.5;

        let progressSound = new Audio('../sounds/win-chime.mp3');
        progressSound.volume = 0.5;

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
            const starEmojis = ['⭐', '✨', '🌟', '💫', '📚', '✏️', '📝', '🎯'];

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

        // Progress tracking
        function updateProgress() {
            const checkboxes = document.querySelectorAll('.activity-checkbox');
            const checked = document.querySelectorAll('.activity-checkbox:checked').length;
            const total = checkboxes.length;
            const percentage = Math.round((checked / total) * 100);

            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
            progressBar.textContent = `${checked}/${total} Complete`;

            const badge = document.getElementById('completionBadge');
            if (percentage === 100) {
                badge.innerHTML = '<i class="fas fa-trophy"></i> All Complete! Amazing! 🎉';
                badge.style.background = 'linear-gradient(135deg, #ffd700, #ff8c00)';
                winMusic.play().catch(e => console.log('Audio play failed:', e));
            } else if (percentage >= 66) {
                badge.innerHTML = '<i class="fas fa-fire"></i> Almost There! 🔥';
                badge.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
                progressSound.play().catch(e => console.log('Audio play failed:', e));
            } else if (percentage >= 33) {
                badge.innerHTML = '<i class="fas fa-star"></i> Good Progress! ⭐';
                badge.style.background = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                progressSound.play().catch(e => console.log('Audio play failed:', e));
            } else {
                badge.innerHTML = '<i class="fas fa-rocket"></i> Keep Going! 🚀';
                badge.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            }

        }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingStars();
            createParticles();
            updateProgress();

            // Add event listeners to checkboxes
            const checkboxes = document.querySelectorAll('.activity-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateProgress();

                    // Add animation to the row when checkbox is clicked
                    const row = this.closest('tr');
                    if (this.checked) {
                        row.style.background = 'linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.1))';
                    } else {
                        row.style.background = '';
                    }
                });
            });

            document.getElementById('navCenterLogo').textContent = sessionStorage.getItem('subject');
            document.getElementById('navCenterSpan').textContent = sessionStorage.getItem('type');
            document.getElementById('pageTitle').textContent = sessionStorage.getItem('type');
        });
    </script>
</body>

</html>