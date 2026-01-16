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
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeTitle('activity')">Activities</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeTitle('quiz')">Quizzes</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeTitle('exam')">Exams</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeTitle('performance')">Performance Task</a></li>
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
        // Student and subject data from session storage
        const studentId = localStorage.getItem('id');
        const subjectId = sessionStorage.getItem('subject_id');
        const activityType = sessionStorage.getItem('type') || 'activity';

        // Background Music (keep existing code)
        let bgMusic = new Audio('../sounds/game-music-loop-7.mp3');
        bgMusic.loop = true;
        bgMusic.volume = 0.3;
        let isMuted = true;

        let winMusic = new Audio('../sounds/small-win.mp3');
        winMusic.volume = 1.0;

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

        // Fetch and populate activity data
        async function loadActivityData() {
            try {
                // Show loading state
                const activityTable = document.getElementById('activityTable');
                activityTable.innerHTML = '<tr><td colspan="2" class="text-center py-5">Loading activities...</td></tr>';

                // Fetch data from your PHP API
                const response = await fetch(`../../controllers/student/get-student-progress.php?subject_id=${subjectId}&student_id=${studentId}&type=${activityType}`);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const studentData = await response.json();

                // Clear loading message
                activityTable.innerHTML = '';

                // Populate the table with activities
                if (studentData.activities && studentData.activities.length > 0) {
                    studentData.activities.forEach(activity => {
                        const row = document.createElement('tr');

                        // Add animation delay based on index
                        const delay = (activity.activity_index * 0.1) + 's';
                        row.style.animationDelay = delay;

                        // Activity name cell
                        const nameCell = document.createElement('td');
                        nameCell.textContent = `${activity.activity_index}. ${activity.activity_name}`;

                        // Status cell with checkbox
                        const statusCell = document.createElement('td');
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'activity-checkbox';
                        checkbox.dataset.activityId = activity.activity_id;
                        checkbox.dataset.studentId = studentId;

                        // Check if activity is completed (progress = '1')
                        if (activity.progress === '1') {
                            checkbox.checked = true;
                        }

                        // Add event listener for checkbox changes
                        checkbox.addEventListener('change', function() {
                            updateActivityProgress(this, activity.activity_id);
                            updateProgress();

                            // Add animation to the row when checkbox is clicked
                            if (this.checked) {
                                row.style.background = 'linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.1))';
                                row.style.animation = 'rowEntry 0.6s ease-out backwards';
                            } else {
                                row.style.background = '';
                            }
                        });

                        statusCell.appendChild(checkbox);

                        // Append cells to row
                        row.appendChild(nameCell);
                        row.appendChild(statusCell);

                        // Append row to table
                        activityTable.appendChild(row);
                    });
                } else {
                    // No activities found
                    activityTable.innerHTML = '<tr><td colspan="2" class="text-center py-5">No activities found for this subject.</td></tr>';
                }

                // Update progress after loading
                updateProgress();

            } catch (error) {
                console.error('Error loading activity data:', error);
                const activityTable = document.getElementById('activityTable');
                activityTable.innerHTML = '<tr><td colspan="2" class="text-center py-5 text-danger">Error loading activities. Please try again.</td></tr>';
            }
        }

        // Update activity progress via API
        async function updateActivityProgress(checkbox, activityId) {
            const progressValue = checkbox.checked ? '1' : '0';
            const studentId = checkbox.dataset.studentId;

            try {
                const formData = new FormData();
                formData.append('student_id', studentId);
                formData.append('activity_id', activityId);
                formData.append('progress', progressValue);

                const response = await fetch('../../controllers/student/update-progress.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Failed to update progress');
                }

                const result = await response.json();
                if (!result.success) {
                    console.error('Progress update failed:', result.message);
                    // Revert checkbox if update failed
                    checkbox.checked = !checkbox.checked;
                }

            } catch (error) {
                console.error('Error updating progress:', error);
                // Revert checkbox on error
                checkbox.checked = !checkbox.checked;
            }
        }

        // Progress tracking
        function updateProgress() {
            const checkboxes = document.querySelectorAll('.activity-checkbox');
            const checked = document.querySelectorAll('.activity-checkbox:checked').length;
            const total = checkboxes.length;
            const percentage = total > 0 ? Math.round((checked / total) * 100) : 0;

            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
            progressBar.textContent = total > 0 ? `${checked}/${total} Complete` : 'No Activities';

            const badge = document.getElementById('completionBadge');
            if (percentage === 100 && total > 0) {
                badge.innerHTML = '<i class="fas fa-trophy"></i> All Complete! Amazing! 🎉';
                badge.style.background = 'linear-gradient(135deg, #ffd700, #ff8c00)';
                if (!isMuted) winMusic.play().catch(e => console.log('Audio play failed:', e));
            } else if (percentage >= 66 && total > 0) {
                badge.innerHTML = '<i class="fas fa-fire"></i> Almost There! 🔥';
                badge.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
                if (!isMuted) progressSound.play().catch(e => console.log('Audio play failed:', e));
            } else if (percentage >= 33 && total > 0) {
                badge.innerHTML = '<i class="fas fa-star"></i> Good Progress! ⭐';
                badge.style.background = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                if (!isMuted) progressSound.play().catch(e => console.log('Audio play failed:', e));
            } else if (total > 0) {
                badge.innerHTML = '<i class="fas fa-rocket"></i> Keep Going! 🚀';
                badge.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            } else {
                badge.innerHTML = '<i class="fas fa-info-circle"></i> No Activities Available';
                badge.style.background = 'linear-gradient(135deg, #6b7280, #4b5563)';
            }
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingStars();
            createParticles();

            // Load activity data
            loadActivityData();

            // Set navigation titles
            document.getElementById('navCenterLogo').textContent = sessionStorage.getItem('subject') || 'Subject';

            const type = sessionStorage.getItem('type') || 'activity';
            let typeText = 'ACTIVITIES';
            switch (type) {
                case 'activity':
                    typeText = 'ACTIVITIES';
                    break;
                case 'performance':
                    typeText = 'PERFORMANCE';
                    break;
                case 'quiz':
                    typeText = 'QUIZZES';
                    break;
                case 'exam':
                    typeText = 'EXAMS';
                    break;
            }

            document.getElementById('navCenterSpan').textContent = typeText;
            document.getElementById('pageTitle').textContent = typeText;
        });

        function changeTitle(type) {
            sessionStorage.setItem('type', type);
            window.location.reload();
        }
    </script>
</body>

</html>