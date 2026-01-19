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
            font-size: 40px;
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

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid #ffd700;
            object-fit: cover;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
            transition: transform 0.3s ease;
        }

        .profile-pic:hover {
            transform: scale(1.1) rotate(5deg);
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
            padding: 30px 20px;
            min-height: calc(100vh - 70px);
            transition: margin-left 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .subject-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .subject-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 22, 122, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 200px;
            justify-content: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transform: scale(1);
        }

        .subject-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #00167a, #4e73df);
            transition: height 0.3s ease;
        }

        .subject-card:hover::before {
            height: 100%;
            opacity: 0.1;
        }

        .subject-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 22, 122, 0.3);
        }

        .subject-card:active {
            transform: translateY(-8px) scale(0.98);
        }

        .subject-name {
            color: #00167a;
            font-size: 28px;
            font-weight: 800;
            margin: 15px 0 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 2;
        }

        .subject-abbr {
            color: #6c757d;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .subject-icon {
            width: 80px;
            height: 80px;
            font-size: 36px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .subject-card:hover .subject-icon {
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }


        /* Level Badge */
        .level-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #00167a;
            font-weight: bold;
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 20px;
            box-shadow: 0 3px 10px rgba(255, 215, 0, 0.5);
            z-index: 3;
        }

        /* Different colors for different subjects */
        .subject-card:nth-child(1)::before {
            background: linear-gradient(90deg, #4e73df, #00167a);
        }

        .subject-card:nth-child(2)::before {
            background: linear-gradient(90deg, #1cc88a, #13855c);
        }

        .subject-card:nth-child(3)::before {
            background: linear-gradient(90deg, #36b9cc, #258391);
        }

        .subject-card:nth-child(4)::before {
            background: linear-gradient(90deg, #f6c23e, #c99c0e);
        }

        .subject-card:nth-child(5)::before {
            background: linear-gradient(90deg, #e74a3b, #be2617);
        }

        .subject-card:nth-child(6)::before {
            background: linear-gradient(90deg, #858796, #5a5c69);
        }

        .subject-card:nth-child(7)::before {
            background: linear-gradient(90deg, #f8f9fc, #b7b9cc);
        }

        .subject-card:nth-child(8)::before {
            background: linear-gradient(90deg, #4e73df, #00167a);
        }

        .subject-card:nth-child(9)::before {
            background: linear-gradient(90deg, #1cc88a, #13855c);
        }

        .subject-card:nth-child(10)::before {
            background: linear-gradient(90deg, #36b9cc, #258391);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .subject-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }

            .subject-card {
                padding: 20px;
                min-height: 180px;
            }

            .subject-name {
                font-size: 24px;
            }

            .nav-center {
                font-size: 28px;
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
            .subject-container {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .top-nav {
                padding: 0 15px;
                height: 60px;
            }

            .nav-center {
                font-size: 24px;
            }
        }

        .page-title {
            text-align: center;
            color: #00167a;
            margin: 20px 0;
            font-weight: 700;
            font-size: 36px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
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

        /* Card Entry Animation */
        @keyframes cardEntry {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.8);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .subject-card {
            animation: cardEntry 0.6s ease-out backwards;
        }

        .subject-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .subject-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .subject-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .subject-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .subject-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .subject-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        .subject-card:nth-child(7) {
            animation-delay: 0.7s;
        }

        .subject-card:nth-child(8) {
            animation-delay: 0.8s;
        }

        .subject-card:nth-child(9) {
            animation-delay: 0.9s;
        }

        .subject-card:nth-child(10) {
            animation-delay: 1s;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="game-background" id="gameBackground"></div>

    <!-- Top Navigation -->
    <nav class="top-nav">
        <a href="student-profile.php" class="text-decoration-none">
            <img src="" id="profile-pic" class="profile-pic">
        </a>

        <div class="nav-center">
            🎮 SUBJECTS 🎮
        </div>

        <div style="width: 50px;"></div>
    </nav>

    <!-- Sound Toggle Button -->
    <div class="sound-toggle" id="soundToggle" title="Toggle Sound">
        <i class="fas fa-volume-up"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <h1 class="page-title">🌟 My Subjects 🌟</h1>

        <div class="subject-container" id="subject-container">
            <!-- Will be populated by JavaScript -->
        </div>


    </main>

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
            const starEmojis = ['⭐', '✨', '🌟', '💫'];

            for (let i = 0; i < 15; i++) {
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

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingStars();
            createParticles();

            // Auth checks (keeping original functionality)
            if (!localStorage.getItem('is_logged_in') && !localStorage.getItem('role')) {
                window.location.href = '../../index.php?error=Your not logged in!';
            }

            if (localStorage.getItem('role') !== 'student') {
                window.location.href = '../../index.php?error=You are not a student!';
            }

            // Load profile picture
            const id = localStorage.getItem('id');
            if (id) {
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });

        function subjectRedirect(subject_id, subject) {
            sessionStorage.setItem('subject_id', subject_id);
            sessionStorage.setItem('subject', subject);
            sessionStorage.setItem('type', 'activity');
            window.location.href = 'student-activities.php';
        }

        // Function to escape HTML special characters
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Function to fetch and display subjects
        async function loadSubjects() {
            try {
                const response = await fetch('../../controllers/student/get-subjects.php?id=' + localStorage.getItem('section') + '&student_id=' + localStorage.getItem('id'));

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                // Check if data has the expected structure
                if (!data.subjects || !Array.isArray(data.subjects)) {
                    throw new Error('Invalid data structure received');
                }

                const container = document.getElementById('subject-container');

                // Generate HTML for each subject
                container.innerHTML = data.subjects.map(subject => `
                        <div class="subject-card" onclick="subjectRedirect('${escapeHtml(subject.id)}', '${escapeHtml(subject.grade_level + '-' + subject.subject_name)}')">
                        ${subject.unfinished ? `<div class="level-badge">${subject.unfinished}</div>` : ''}
                            <div class="subject-icon">
                                ${subject.icon}
                            </div>
                            <h3 class="subject-name">${escapeHtml(subject.grade_level + '-' + subject.subject_name)}</h3>
                            <p class="subject-abbr">${escapeHtml(subject.description)}</p>
                            <p class="subject-abbr">${escapeHtml(subject.schedules.day_of_week)}</p>
                        </div>
                    `).join('');

            } catch (error) {
                console.error('Error loading subjects:', error);

                // Show error message to user
                const container = document.getElementById('subject-container');
                if (container) {
                    container.innerHTML = `
                <div class="error-message" style="text-align: center; padding: 2rem; color: #666; width: 100%;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #ff6b6b; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.1rem;">Failed to load subjects. Please try again later.</p>
                    <button onclick="loadSubjects()" style="margin-top: 1rem; padding: 0.5rem 1rem; background: #4a90e2; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Retry
                    </button>
                </div>
            `;
                }
            }
        }

        // Start loading subjects when page is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadSubjects);
        } else {
            loadSubjects(); // DOM already loaded
        }

        // Call Android interface
        if (typeof AndroidBridge !== 'undefined') {
            AndroidBridge.onLoginSuccess(
                localStorage.getItem('role'),
                localStorage.getItem('id'),
                localStorage.getItem('first_name'),
                localStorage.getItem('last_name'),
                localStorage.getItem('section'),
                localStorage.getItem('lrn') || ''
            );
        }
    </script>
</body>

</html>