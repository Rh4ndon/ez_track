<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<?php
$sections = getAllRecords('sections', 'ORDER BY grade_level ASC');
$subjects = getAllRecords('subjects');
$teachers = getAllRecords('teachers');
$schedules = getAllRecords('schedules');
?>

<style>
    body,
    html {
        background: #84a9ff;
    }

    .table-schedule {
        font-size: 0.9rem;
    }

    .table-schedule th {
        text-align: center;
        vertical-align: middle;
    }

    .table-schedule .time-cell {
        background-color: #f8f9fa;
        text-align: center;
        vertical-align: middle;
    }

    .table-schedule .class-cell {
        background-color: #e7f3ff;
        border: 2px solid #b8daff;
        text-align: center;
        vertical-align: middle;
        min-height: 80px;
        position: relative;
    }

    .table-schedule .empty-cell {
        background-color: #f8f9fa;
    }

    .class-info {
        padding: 2px;
        padding-top: 10px;
        /* Space for buttons */
    }

    .subject-name {
        font-size: 0.9rem;
        margin-bottom: 4px;
    }

    .teacher-name {
        font-size: 0.8rem;
        color: #555;
        margin-bottom: 4px;
    }

    .room-time {
        font-size: 0.75rem;
    }

    .subject-icon {
        font-size: 1.2rem;
    }

    .schedule-container {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    h2 {
        color: #333;
        padding-bottom: 10px;
        border-bottom: 2px solid #007bff;
    }

    /* Hide buttons on hover for cleaner look */
    .class-cell:hover .position-absolute {
        opacity: 1;
    }

    .position-absolute {
        opacity: 0.3;
        transition: opacity 0.2s ease;
    }

    .position-absolute:hover {
        opacity: 1;
    }
</style>
<!-- Main Content -->
<main class="main-content">
    <!-- ADD SCHEDULE Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <button class="btn btn-primary py-2" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
            <i class="fa-solid fa-circle-plus"></i>&nbsp; ADD SCHEDULES
        </button>
    </div>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Function to get section schedule with teacher and subject info
    function getSectionSchedule($section_id, $academic_year = '')
    {
        global $conn;

        $sql = "SELECT 
                tsss.*,
                t.first_name AS teacher_first_name,
                t.last_name AS teacher_last_name,
                t.middle_initial AS teacher_middle_initial,
                s.subject_name,
                s.grade_level AS subject_grade,
                s.icon,
                sec.section_name,
                sec.grade_level AS section_grade
            FROM schedules tsss
            JOIN teachers t ON tsss.teacher_id = t.id
            JOIN subjects s ON tsss.subject_id = s.id
            JOIN sections sec ON tsss.section_id = sec.id
            WHERE tsss.section_id = ?";

        if ($academic_year) {
            $sql .= " AND tsss.academic_year = ?";
            $sql .= " ORDER BY FIELD(tsss.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), 
                  tsss.start_time";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'is', $section_id, $academic_year);
        } else {
            $sql .= " ORDER BY FIELD(tsss.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), 
                  tsss.start_time";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $section_id);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $schedule = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $schedule[] = $row;
        }

        return $schedule;
    }

    $time_slots = [];
    for ($hour = 7; $hour <= 17; $hour++) { // 7 AM to 5 PM
        $time_slots[] = sprintf('%02d:00', $hour);
        if ($hour < 17) {
            $time_slots[] = sprintf('%02d:30', $hour);
        }
    }
    // Add 5:30 PM if needed (17:30)
    // Already included in the loop above for hour 17

    // Days of the week
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    foreach ($sections as $section):
        $schedule = getSectionSchedule($section['id']);

        // Group schedule by day and time
        $schedule_grid = [];
        foreach ($schedule as $item) {
            $day = $item['day_of_week'];
            $start = $item['start_time'];
            $end = $item['end_time'];

            // Calculate duration in 30-minute slots
            $start_time = strtotime($start);
            $end_time = strtotime($end);
            $duration = ($end_time - $start_time) / 1800; // 30-minute intervals

            // Find starting slot
            $start_slot = date('H:i', $start_time);

            // Store in grid with all original item data
            if (!isset($schedule_grid[$day])) {
                $schedule_grid[$day] = [];
            }

            $schedule_grid[$day][$start_slot] = array_merge($item, [
                'duration' => $duration, // Number of 30-minute slots
                'start_time' => $start,
                'end_time' => $end
            ]);
        }
    ?>
        <div class="schedule-container mb-5">
            <h2 class="text-center mb-3"><?php echo $section['grade_level']; ?> - <?php echo $section['section_name']; ?></h2>

            <div class="table-responsive">
                <table class="table table-bordered table-schedule">
                    <thead class="table-dark">
                        <tr>
                            <th width="120">Time</th>
                            <?php foreach ($days as $day): ?>
                                <th><?php echo $day; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($time_slots as $time_slot):
                            $display_time = date('g:i A', strtotime($time_slot));
                            $next_slot = date('H:i', strtotime($time_slot . ' +30 minutes'));
                        ?>
                            <tr>
                                <td class="time-cell fw-bold">
                                    <?php echo $display_time; ?>
                                </td>

                                <?php foreach ($days as $day):
                                    $has_class = false;
                                    $class_info = null;

                                    // Check if this time slot has a class
                                    foreach ($schedule_grid[$day] ?? [] as $slot_time => $info) {
                                        $slot_start = strtotime($slot_time);
                                        $slot_end = strtotime($info['end_time']);
                                        $current = strtotime($time_slot);

                                        if ($current >= $slot_start && $current < $slot_end) {
                                            $has_class = true;
                                            $class_info = $info;
                                            break;
                                        }
                                    }

                                    // Check if this is the start of a class (to avoid duplicate cells)
                                    $is_class_start = isset($schedule_grid[$day][$time_slot]);

                                    if ($is_class_start && $class_info):
                                        $rowspan = $class_info['duration'];
                                ?>
                                        <td class="class-cell" rowspan="<?php echo $rowspan; ?>">
                                            <div class="position-relative">
                                                <div class="class-info">
                                                    <div class="subject-name fw-bold">
                                                        <?php echo htmlspecialchars($class_info['icon']); ?> <?php echo htmlspecialchars($class_info['subject_grade']); ?>-<?php echo htmlspecialchars($class_info['subject_name']); ?>
                                                    </div>
                                                    <div class="teacher-name small">
                                                        <?php echo htmlspecialchars($class_info['teacher_last_name'] . ', ' . $class_info['teacher_first_name'] . ' ' . $class_info['teacher_middle_initial']); ?>
                                                    </div>
                                                    <div class="room-time small text-muted">

                                                        <div><?php echo date('g:i A', strtotime($class_info['start_time'])); ?> -
                                                            <?php echo date('g:i A', strtotime($class_info['end_time'])); ?></div>
                                                    </div>
                                                </div>

                                                <!-- Edit and Delete Buttons -->
                                                <div class="position-absolute top-0 end-0 p-2" style="z-index: 10;">
                                                    <button class="btn btn-sm btn-warning me-1"
                                                        onclick="openEditModal(<?= $class_info['id']; ?>, 
                                                                    '<?= addslashes($class_info['subject_name']); ?>', 
                                                                    '<?= $class_info['day_of_week']; ?>', 
                                                                    '<?= $class_info['start_time']; ?>', 
                                                                    '<?= $class_info['end_time']; ?>',
                                                                    <?= $class_info['teacher_id']; ?>,
                                                                    <?= $class_info['subject_id']; ?>,
                                                                    <?= $class_info['section_id']; ?>,
                                                                    event)"
                                                        title="Edit">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="openDeleteModal(<?= $class_info['id']; ?>, 
                                                                    '<?= addslashes($class_info['subject_name']); ?>', 
                                                                    '<?= $class_info['section_grade']; ?>-<?= $class_info['section_name']; ?>',
                                                                    event)"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    <?php elseif (!$has_class): ?>
                                        <td class="empty-cell">
                                            <!-- Empty time slot -->
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Add Schedules</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scheduleForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="teacher" class="form-label">Teacher</label>
                        <select class="form-select" name="teacher" id="teacher" required>
                            <option value="" selected>Select Teacher</option>
                            <?php foreach ($teachers as $teacher) : ?>
                                <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['first_name']; ?> <?php echo $teacher['middle_initial']; ?>. <?php echo $teacher['last_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <select class="form-select" name="subject" id="subject" required>
                            <option value="" selected>Select Subject</option>
                            <?php foreach ($subjects as $subject) : ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['grade_level']; ?>-<?php echo $subject['subject_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section</label>
                        <select class="form-select" name="section" id="section" required>
                            <option value="" selected>Select Section</option>
                            <?php foreach ($sections as $section) : ?>
                                <option value="<?php echo $section['id']; ?>"><?php echo $section['grade_level']; ?>-<?php echo $section['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="day" class="form-label">Day</label>
                        <select class="form-select" name="day" id="day" required>
                            <option value="" selected>Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            min="07:00" max="17:30" value="07:00" required>
                        <div class="form-text">Classes start from 7:00 AM to 5:30 PM</div>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                            min="07:30" max="17:30" value="07:50" required>
                        <div class="form-text">Classes end between 7:30 AM to 5:30 PM</div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editScheduleForm" enctype="multipart/form-data">
                    <input type="hidden" name="schedule_id" id="edit_schedule_id">

                    <div class="mb-3">
                        <label for="edit_teacher" class="form-label">Teacher</label>
                        <select class="form-select" name="teacher" id="edit_teacher" required>
                            <option value="" selected>Select Teacher</option>
                            <?php foreach ($teachers as $teacher) : ?>
                                <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['first_name']; ?> <?php echo $teacher['middle_initial']; ?>. <?php echo $teacher['last_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_subject" class="form-label">Subject</label>
                        <select class="form-select" name="subject" id="edit_subject" required>
                            <option value="" selected>Select Subject</option>
                            <?php foreach ($subjects as $subject) : ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['grade_level']; ?>-<?php echo $subject['subject_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_section" class="form-label">Section</label>
                        <select class="form-select" name="section" id="edit_section" required>
                            <option value="" selected>Select Section</option>
                            <?php foreach ($sections as $section) : ?>
                                <option value="<?php echo $section['id']; ?>"><?php echo $section['grade_level']; ?>-<?php echo $section['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_day" class="form-label">Day</label>
                        <select class="form-select" name="day" id="edit_day" required>
                            <option value="" selected>Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="edit_start_time" name="start_time"
                            min="07:00" max="17:30" required>
                        <div class="form-text">Classes start from 7:00 AM to 5:30 PM</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="edit_end_time" name="end_time"
                            min="07:30" max="17:30" required>
                        <div class="form-text">Classes end between 7:30 AM to 5:30 PM</div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteScheduleModal" tabindex="-1" aria-labelledby="deleteScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteScheduleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_schedule_id">
                <p>Are you sure you want to delete schedule for <strong id="delete_schedule_subject"></strong> in section <strong id="delete_schedule_section"></strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteScheduleId = null;

    // Add Schedule Form
    document.getElementById('scheduleForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/add-schedule.php', {
                method: 'POST',
                body: formData,
                enctype: 'multipart/form-data'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addScheduleModal'));
                    modal.hide();
                    showAlert('Schedule added successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert((data.error || 'Failed to add schedule'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while adding schedule', 'danger');
            });
    });

    // Open Edit Modal - Updated function to match your modal structure
    function openEditModal(id, subject, day_of_week, start_time, end_time, teacher_id, subject_id, section_id, event) {
        event.stopPropagation(); // Prevent any table cell click events

        // Set hidden schedule ID
        document.getElementById('edit_schedule_id').value = id;

        // Set form values
        document.getElementById('edit_teacher').value = teacher_id;
        document.getElementById('edit_subject').value = subject_id;
        document.getElementById('edit_section').value = section_id;
        document.getElementById('edit_day').value = day_of_week;
        document.getElementById('edit_start_time').value = start_time;
        document.getElementById('edit_end_time').value = end_time;

        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editScheduleModal'));
        editModal.show();
    }

    // Edit Schedule Form
    document.getElementById('editScheduleForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/edit-schedule.php', {
                method: 'POST',
                body: formData,
                enctype: 'multipart/form-data'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editScheduleModal'));
                    modal.hide();
                    showAlert('Schedule updated successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert((data.error || 'Failed to update schedule'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while updating schedule', 'danger');
            });
    });

    // Open Delete Modal - Updated function
    function openDeleteModal(id, subject, section_info, event) {
        event.stopPropagation(); // Prevent any table cell click events

        deleteScheduleId = id;
        document.getElementById('delete_schedule_id').value = id;
        document.getElementById('delete_schedule_subject').textContent = subject;
        document.getElementById('delete_schedule_section').textContent = section_info;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteScheduleModal'));
        deleteModal.show();
    }

    // Confirm Delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteScheduleId) return;

        const formData = new FormData();
        formData.append('id', deleteScheduleId);

        fetch('../../controllers/admin/delete-schedule.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteScheduleModal'));
                    modal.hide();
                    showAlert('Schedule deleted successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to delete schedule'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while deleting schedule', 'danger');
            });
    });

    // Function to show alert (you may already have this)
    function showAlert(message, type) {
        // Create alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.minWidth = '300px';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Add to body
        document.body.appendChild(alertDiv);

        // Auto remove after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
</script>

<?php include 'footer.php'; ?>