<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzTrack Dashboard - Subjects</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            padding: 30px 20px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }





        /* Responsive adjustments */
        @media (max-width: 768px) {


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

        .section-link {
            display: inline-block;
            text-decoration: none;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            min-width: 200px;
            text-align: center;
        }

        .section-link:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
            color: white;
            text-decoration: none;
        }

        .section-link .card {
            background: transparent;
            border: none;
            box-shadow: none;
            width: 100%;
            height: auto;
        }

        .section-link .card-body {
            padding: 0;
        }

        .section-link h3 {
            color: white;
            margin: 0;
            font-size: inherit;
            font-weight: inherit;
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <a href="teacher-profile.php" class="text-decoration-none">
            <img src="../uploads/sample.webp" id="profile-pic" alt="Profile" class="profile-pic">
        </a>

        <div class="nav-center">
            SECTIONS
        </div>

        <div style="width: 40px;"></div> <!-- Spacer for balance -->
    </nav>

    <!-- Main Content -->
    <main class="main-content">



        <div class="section-container d-flex flex-wrap align-items-center justify-content-center gap-4 p-3">

            <!-- First Section -->
            <a href="teacher-activities.html" class="text-decoration-none text-dark section-link">
                <div class="card shadow-sm border-0" style="width: 150px; height: 50px;">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h1 class="fw-bold text-white m-0">10-Larry</h1>
                    </div>
                </div>
            </a>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for subject cards
        document.addEventListener('DOMContentLoaded', function() {
            const subjectCards = document.querySelectorAll('.subject-card');

            subjectCards.forEach((card, index) => {
                // Add delay based on index for staggered animation
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate__animated', 'animate__fadeInUp');
            });

            // Load profile picture
            const id = localStorage.getItem('id');
            if (id) {
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    </script>
</body>

</html>