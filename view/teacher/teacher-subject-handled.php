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

        .activity-item {
            width: 100%;
        }

        .activity-item .card {
            border-radius: 8px;
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
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <a href="teacher-sections.php" class="nav-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <div class="nav-center">
            <div id="subject-name"></div>
            <span style="font-size:15px;" id="nav-title">ACTIVITIES</span>
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

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addActivityModal">
            Add Activity <i class="fas fa-circle-plus"></i>
        </button>

        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#activityListContainer" aria-expanded="false" aria-controls="activityListContainer">
            Activity List <i class="fas fa-chevron-down"></i>
        </button>
        <div class="activities-container collapse" id="activityListContainer">
            <h6 class="page-title" id="page-title">Activities List</h6>
            <div id="activityList">
                <!-- Activities will be loaded here -->
            </div>
        </div>


        <!-- Table of activities with each cell is checkbox -->
        <div id="section-data">

        </div>




    </main>

    <!-- Add activity modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Direction for adding activity -->
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">How to add activity</h4>
                        <p>1. Fill out the form below.</p>
                        <p>2. Click "Add Activity" button.</p>
                        <p>3. The activity will be added to all <strong>Sections</strong> with the same <strong>Subject</strong>.</p>
                    </div>
                    <form id="addActivityForm">
                        <div class="mb-3">
                            <label for="activity_name" class="form-label">Activity Name</label>
                            <input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Enter activity name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="activity">Activity</option>
                                <option value="quiz">Quiz</option>
                                <option value="performance">Performance Task</option>
                                <option value="exam">Exam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Enter deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Total Grade</label>
                            <input type="number" class="form-control" id="grade" name="grade" placeholder="Enter grade" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Add Activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit activity Modal -->
    <div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActivityModalLabel">Add Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editActivityForm">
                        <input type="hidden" id="edit_activity_id" name="activity_id">
                        <div class="mb-3">
                            <label for="activity_name" class="form-label">Activity Name</label>
                            <input type="text" class="form-control" id="edit_activity_name" name="activity_name" placeholder="Enter activity name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="edit_type" name="type" required>
                                <option value="activity">Activity</option>
                                <option value="quiz">Quiz</option>
                                <option value="performance">Performance Task</option>
                                <option value="exam">Exam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="edit_deadline" name="deadline" placeholder="Enter deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Total Grade</label>
                            <input type="number" class="form-control" id="edit_grade" name="grade" placeholder="Enter grade" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Section Modal -->
    <div class="modal fade" id="deleteActivityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../js/show-alert.js"></script>
    <script>
        // Global variables
        let activityToDelete = null;

        document.getElementById('addActivityForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.append('subject_id', sessionStorage.getItem('subject_id'));
            formData.append('teacher_id', localStorage.getItem('id'));

            fetch('../../controllers/teacher/add-activity.php', {
                    method: 'POST',
                    body: formData,
                    enctype: 'multipart/form-data'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addActivityModal'));
                        modal.hide();
                        showAlert('Activity added successfully!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        showAlert((data.error || 'Failed to add activity'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while adding activity', 'danger');
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('subject-name').textContent = sessionStorage.getItem('subject_name');

            fetch('../../controllers/teacher/get-activities.php?subject_id=' + sessionStorage.getItem('subject_id') + '&type=' + sessionStorage.getItem('type'))
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        const container = document.querySelector('#activityList');
                        data.activities.forEach(activity => {
                            const activityItem = document.createElement('div');
                            activityItem.className = 'activity-item mb-3';
                            activityItem.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1 me-3">
                                        <h6 class="card-title mb-1">${activity.activity_name}</h6>
                                        <p class="card-text mb-1">
                                            <small class="text-muted">${activity.subject_name}</small>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted small me-2">Due: ${activity.deadline}</span>
                                            <span class="badge bg-info">${activity.total_grade} pts</span>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-warning btn-sm me-1"
                                            onclick="openEditModal('${activity.id}', '${activity.activity_name}', '${activity.deadline}', '${activity.type}', '${activity.total_grade}', event)"
                                            style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%; color: white;">
                                            <i class="fas fa-edit fa-xs"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="openDeleteModal(${activity.id}, '${activity.activity_name}', event)"
                                            style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%;">
                                            <i class="fas fa-trash fa-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                            container.appendChild(activityItem);
                        });
                    } else {
                        console.error('Error:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            fetch('../../controllers/teacher/get-subject-handled-data.php?subject_id=' + sessionStorage.getItem('subject_id') + '&type=' + sessionStorage.getItem('type'))
                .then(response => response.json())
                .then(data => {
                    data.subjects.forEach(section => {
                        // Create section button
                        const button = `<button class="btn btn-primary" type="button" 
                data-bs-toggle="collapse" data-bs-target="#section-${section.section_id}" 
                aria-expanded="false">
                ${section.section_name} <i class="fas fa-chevron-down"></i>
            </button>`;

                        // Create section container
                        let sectionHTML = `<div class="collapse" id="section-${section.section_id}">
                <div class="profile-container">
                    <h1 class="page-title">${section.section_name}</h1>
                    <div class="students-container">`;

                        // Add each student
                        section.students.forEach(student => {
                            let studentHTML = `<div class="student-card">
                    <div class="student-header">
                        <h5 class="student-name">${student.name}</h5>
                    </div>
                    <div class="activities-grid">`;

                            // Add each activity
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
                            sectionHTML += studentHTML;
                        });

                        sectionHTML += `</div></div></div>`;

                        // Append to your container
                        document.getElementById('section-data').innerHTML += button + sectionHTML;
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

        function openDeleteModal(activityId, activityName, event) {
            event.stopPropagation();
            event.preventDefault();

            // Store the activity ID for later use
            activityToDelete = activityId;

            // Update modal content with activity name
            document.getElementById('modalBody').innerHTML =
                `Are you sure you want to delete activity <strong>${activityName}</strong>? This action cannot be undone.`;

            // Show the modal using Bootstrap
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteActivityModal'));
            deleteModal.show();
        }

        // Handle delete confirmation button click
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (!activityToDelete) return;

            console.log('Deleting activity ID:', activityToDelete);

            // AJAX request to delete the activity
            fetch('../../controllers/teacher/delete-activity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + activityToDelete
                })
                .then(response => response.json())
                .then(data => {
                    // Hide the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteActivityModal'));
                    deleteModal.hide();

                    if (data.success) {
                        // Show success message
                        showAlert('Activity deleted successfully!', 'success');
                        // Remove the deleted card from the page after a short delay
                        setTimeout(() => {
                            window.location.reload(); // Reload to refresh the list
                        }, 1000);
                    } else {
                        showAlert('Error: ' + data.message, 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while deleting the activity', 'danger');
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteActivityModal'));
                    deleteModal.hide();
                });
        });

        function openEditModal(activityId, activityName, deadline, type, totalGrade, event) {
            event.stopPropagation();
            event.preventDefault();


            // Fill form with current data
            document.getElementById('edit_activity_id').value = activityId;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_activity_name').value = activityName;
            const deadlineDate = new Date(deadline);
            const year = deadlineDate.getFullYear();
            const month = String(deadlineDate.getMonth() + 1).padStart(2, '0');
            const day = String(deadlineDate.getDate()).padStart(2, '0');
            const deadlineDateString = `${year}-${month}-${day}`; // Format: YYYY-MM-DD

            // If you need MM/DD/YYYY format:
            const deadlineDateStringFormatted = `${month}/${day}/${year}`;
            document.getElementById('edit_deadline').value = deadlineDateString;
            document.getElementById('edit_grade').value = totalGrade;

            // Show the modal
            const editModal = new bootstrap.Modal(document.getElementById('editActivityModal'));
            editModal.show();
        }

        document.getElementById('editActivityForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.append('subject_id', sessionStorage.getItem('subject_id'));
            formData.append('teacher_id', localStorage.getItem('id'));

            fetch('../../controllers/teacher/edit-activity.php', {
                    method: 'POST',
                    body: formData,
                    enctype: 'multipart/form-data'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success === true) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editActivityModal'));
                        modal.hide();
                        showAlert('Activity edited successfully!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        showAlert((data.error || 'Failed to edit activity'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while editing activity', 'danger');
                });
        });

        function changeTitle(type) {
            sessionStorage.setItem('type', type);
            window.location.reload();
        }
    </script>

</body>

</html>