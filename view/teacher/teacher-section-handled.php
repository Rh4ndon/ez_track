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
            flex-direction: column;
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
                font-size: 25px;
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
                font-size: 25px;
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


        .nav-back {
            color: white;
            font-size: 24px;
            text-decoration: none;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        /* Dropdown Sections */
        .students-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .student-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .student-header {
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .student-name {
            font-weight: 600;
            color: #333;
            margin: 0;
            font-size: 1rem;
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.75rem;
        }

        .activity-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 6px;
        }

        .activity-label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .activities-grid {
                grid-template-columns: repeat(5, 1fr);
                gap: 0.5rem;
            }

            .student-card {
                padding: 0.75rem;
            }

            .activity-item {
                padding: 0.4rem;
            }

            .activity-label {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .activities-grid {
                grid-template-columns: repeat(5, 1fr);
            }

            .page-title {
                font-size: 1.25rem;
            }

            .student-name {
                font-size: 0.9rem;
            }
        }

        #subjects-container {
            display: flex;
            flex-direction: column;
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
            <div id="section-name"></div>
            <span style="font-size:15px;" id="nav-title">Performance Task</span>
        </div>

        <div class="dropdown"></div>
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

    <!-- Main Content -->
    <main class="main-content">

        <!-- Table of activities with each cell is checkbox -->
        <h6 class="page-title" id="page-title">Activities List</h6>

        <div id="subjects-container"></div>





    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../js/show-alert.js"></script>
    <script>
        console.log(sessionStorage.getItem('section_name'));
        console.log(sessionStorage.getItem('section_id'));
        console.log(sessionStorage.getItem('type'));
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('section-name').textContent = sessionStorage.getItem('section_name');
            fetch(`../../controllers/teacher/get-section-handled-data.php?section_id=${sessionStorage.getItem('section_id')}&type=${sessionStorage.getItem('type')}`)
                .then(response => response.json())
                .then(data => {
                    data.subjects.forEach(subject => {
                        // Create button for each subject
                        const button = `<button class="btn btn-primary mb-3" type="button" 
                data-bs-toggle="collapse" data-bs-target="#subject-${subject.subject_id}" 
                aria-expanded="false">
                ${subject.display_name} <i class="fas fa-chevron-down"></i>
            </button>`;

                        // Create container for each subject
                        let subjectHTML = `<div class="collapse" id="subject-${subject.subject_id}">
                <div class="profile-container">
                    <h1 class="page-title">${subject.display_name}</h1>
                    <div class="students-container">`;

                        // Add each student
                        subject.students.forEach(student => {
                            let studentHTML = `<div class="student-card">
                    <div class="student-header">
                        <h5 class="student-name">${student.name}</h5>
                    </div>
                    <div class="activities-grid">`;

                            // Add each activity checkbox
                            student.activities.forEach(activity => {
                                studentHTML += `<div class="activity-item">
                        <span class="activity-label">${activity.activity_name}</span>
                        <input type="checkbox" class="form-check-input" 
                            ${activity.progress === '1' ? 'checked' : ''}
                            data-student-id="${student.id}"
                            data-activity-id="${activity.activity_id}" disabled>
                    </div>`;
                            });

                            studentHTML += `</div></div>`;
                            subjectHTML += studentHTML;
                        });

                        subjectHTML += `</div></div></div>`;

                        // Append to container
                        document.getElementById('subjects-container').innerHTML += button + subjectHTML;
                    });
                });

            switch (sessionStorage.getItem('type')) {
                case 'activity':
                    document.getElementById('page-title').textContent = 'Activities List';
                    document.getElementById('nav-title').textContent = 'ACTIVITIES';
                    break;
                case 'performance':
                    document.getElementById('page-title').textContent = 'Performance List';
                    document.getElementById('nav-title').textContent = 'PERFORMANCE TASKS';
                    break;
                case 'quiz':
                    document.getElementById('page-title').textContent = 'Quizzes List';
                    document.getElementById('nav-title').textContent = 'QUIZZES';
                    break;
                case 'exam':
                    document.getElementById('page-title').textContent = 'Exams List';
                    document.getElementById('nav-title').textContent = 'EXAMS';
                    break;
                default:
                    break;
            }
        });

        function changeTitle(type) {
            sessionStorage.setItem('type', type);
            window.location.reload();
        }
    </script>

</body>

</html>