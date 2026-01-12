<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<?php
$sections = getAllRecords('sections');
$teachers = getAllRecords('teachers');
?>

<!-- Main Content -->
<main class="main-content">
    <!-- ADD TEACHER Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <button class="btn btn-primary py-2" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
            <i class="fa-solid fa-circle-plus"></i>&nbsp; ADD TEACHER
        </button>
    </div>

    <div class="teacher-container d-flex flex-wrap justify-content-center gap-4 p-3">

        <!-- Teacher Cards -->
        <?php foreach ($teachers as $teacher):
            $section_handled = getRecord('sections', 'id = "' . $teacher['section_handled'] . '"');
        ?>

            <div class="card shadow-sm border-0 text-center position-relative" style="width: 180px;">
                <!-- Action Buttons -->
                <div class="position-absolute top-0 end-0 p-2" style="z-index: 10;">
                    <button class="btn btn-sm btn-warning me-1" onclick="openEditModal(<?= htmlspecialchars(json_encode($teacher)); ?>, <?= htmlspecialchars(json_encode($section_handled)); ?>)" title="Edit">
                        <i class="fa-solid fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="openDeleteModal(<?= $teacher['id']; ?>, '<?= addslashes($teacher['first_name'] . ' ' . $teacher['last_name']); ?>')" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <div class="card-body p-3">
                    <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                        <img src="../uploads/teachers/<?= $teacher['photo']; ?>" alt="<?= $teacher['first_name']; ?>" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h5 class="fw-bold mb-1"><?= $teacher['first_name']; ?> <?= $teacher['middle_initial']; ?>. <?= $teacher['last_name']; ?></h5>
                    <small class="text-muted"><?= $section_handled['grade_level']; ?>-<?= $section_handled['section_name']; ?></small>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

</main>

<!-- Add Teacher Modal -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="teacherForm" enctype="multipart/form-data">
                    <input type="hidden" id="role" name="role" value="admin">

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter teacher first name" required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter teacher last name" required>
                    </div>

                    <div class="mb-3">
                        <label for="middle_initial" class="form-label">Middle Initial</label>
                        <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Enter teacher middle initial" maxlength="2" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter teacher email" required>
                    </div>

                    <div class="mb-3">
                        <label for="section" class="form-label">Section Handled</label>
                        <select class="form-select" name="section_handled" id="section_handled" required>
                            <option value="" disabled selected>Select Section</option>
                            <?php foreach ($sections as $section) : ?>
                                <option value="<?php echo $section['id']; ?>"><?php echo $section['grade_level']; ?>-<?php echo $section['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Teacher Modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTeacherForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_teacher_id" name="id">

                    <div class="mb-3">
                        <label for="edit_photo" class="form-label">Photo (Leave empty to keep current)</label>
                        <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                        <small class="text-muted">Current photo will be kept if not changed</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="Enter teacher first name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="Enter teacher last name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                        <input type="text" class="form-control" id="edit_middle_initial" name="middle_initial" placeholder="Enter teacher middle initial" maxlength="2" required>
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
                        <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter teacher email" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_section_handled" class="form-label">Section Handled</label>
                        <select class="form-select" name="section_handled" id="edit_section_handled" required>
                            <option value="" disabled>Select Section</option>
                            <?php foreach ($sections as $section) : ?>
                                <option value="<?php echo $section['id']; ?>"><?php echo $section['grade_level']; ?>-<?php echo $section['section_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password (Leave empty to keep current)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" class="form-control" id="edit_password" name="password" placeholder="Enter teacher password">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTeacherModal" tabindex="-1" aria-labelledby="deleteTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTeacherModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete teacher <strong id="deleteTeacherName"></strong>?</p>
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
    let deleteTeacherId = null;

    // Add Teacher Form
    document.getElementById('teacherForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/add-teacher.php', {
                method: 'POST',
                body: formData,
                enctype: 'multipart/form-data'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addTeacherModal'));
                    modal.hide();
                    showAlert('Teacher added successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert((data.error || 'Failed to add teacher'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while adding teacher', 'danger');
            });
    });

    // Open Edit Modal
    function openEditModal(teacher, section) {
        document.getElementById('edit_teacher_id').value = teacher.id;
        document.getElementById('edit_first_name').value = teacher.first_name;
        document.getElementById('edit_last_name').value = teacher.last_name;
        document.getElementById('edit_middle_initial').value = teacher.middle_initial;
        document.getElementById('edit_email').value = teacher.email;
        document.getElementById('edit_section_handled').value = teacher.section_handled;
        document.getElementById('edit_gender').value = teacher.gender;

        const editModal = new bootstrap.Modal(document.getElementById('editTeacherModal'));
        editModal.show();
    }

    // Edit Teacher Form
    document.getElementById('editTeacherForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/edit-teacher.php', {
                method: 'POST',
                body: formData,
                enctype: 'multipart/form-data'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editTeacherModal'));
                    modal.hide();
                    showAlert('Teacher updated successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert((data.error || 'Failed to update teacher'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while updating teacher', 'danger');
            });
    });

    // Open Delete Modal
    function openDeleteModal(id, name) {
        deleteTeacherId = id;
        document.getElementById('deleteTeacherName').textContent = name;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteTeacherModal'));
        deleteModal.show();
    }

    // Confirm Delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteTeacherId) return;

        const formData = new FormData();
        formData.append('id', deleteTeacherId);

        fetch('../../controllers/admin/delete-teacher.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteTeacherModal'));
                    modal.hide();
                    showAlert('Teacher deleted successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to delete teacher'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while deleting teacher', 'danger');
            });
    });
</script>

<?php include 'footer.php'; ?>