<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<?php
$sections = getAllRecords('sections');
?>

<!-- Main Content -->
<main class="main-content">
    <!-- ADD SECTION Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <div class="btn btn-primary py-2" style="width: 200px;" id="sectionName">

        </div>
    </div>

    <div id="section-container" class="teacher-container d-flex flex-wrap justify-content-center gap-4 p-3">
        <!-- First Teacher -->
        <a href="" class="text-decoration-none text-dark teacher-card">
            <div class="card shadow-sm border-0 text-center" style="width: 180px;">
                <div class="card-body p-3">
                    <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                        <img src="https://via.placeholder.com/80" alt="Larry" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h5 class="fw-bold mb-1">Larry</h5>
                    <small class="text-muted">Mathematics</small>
                </div>
            </div>
        </a>


    </div>

</main>


<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_student_id" name="id">

                    <div class="mb-3">
                        <label for="edit_photo" class="form-label">Photo (Leave empty to keep current)</label>
                        <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                        <small class="text-muted">Current photo will be kept if not changed</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="Enter student first name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="Enter student last name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                        <input type="text" class="form-control" id="edit_middle_initial" name="middle_initial" placeholder="Enter student middle initial" maxlength="2" required>
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
                        <label for="edit_section" class="form-label">Section</label>
                        <select class="form-select" name="section" id="edit_section">
                            <option value="" selected>Select None</option>
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
                            <input type="password" class="form-control" id="edit_password" name="password" placeholder="Enter student password">
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
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStudentModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete student <strong id="deleteStudentName"></strong>?</p>
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
    document.addEventListener('DOMContentLoaded', function() {
        fetch('../../controllers/admin/get-section-details.php?id=' + sessionStorage.getItem('section_id'))
            .then(response => response.json())
            .then(data => {
                document.getElementById('sectionName').textContent = data.section_name;
                document.getElementById('section-container').innerHTML = '';

                data.students.forEach(student => {
                    const studentCard = document.createElement('a');
                    studentCard.href = '';
                    studentCard.classList.add('text-decoration-none', 'text-dark', 'teacher-card');
                    studentCard.setAttribute('href', 'javascript:void(0);');
                    studentCard.innerHTML = `
                        <div class="card shadow-sm border-0 text-center" style="width: 250px;">

                        <div class="position-absolute top-0 end-0 p-2" style="z-index: 10;">
                            <button class="btn btn-sm btn-warning me-1" onclick="openEditModal( ${student.id}, '${student.first_name}', '${student.middle_initial}', '${student.last_name}', '${student.gender}', '${student.section_id}', event)" title="Edit">
                                <i class="fa-solid fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteModal(${student.id}, '${student.first_name} ${student.last_name}', event)" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        
                            <div class="card-body p-3">
                                <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="../uploads/students/${student.photo}" class="w-100 h-100 object-fit-cover">
                                </div>
                                <h5 class="fw-bold mb-1">${student.last_name}, ${student.first_name} ${student.middle_initial}</h5>
                                <small class="text-muted">${student.email}</small>
                                <br>
                                <small class="text-muted">Gender: ${student.gender}</small>
                            </div>
                        </div>
                    `;
                    document.getElementById('section-container').appendChild(studentCard);
                });

            })
            .catch(error => {
                console.error('Error:', error);
            });

    })


    // Open Edit Modal
    function openEditModal(id, first_name, middle_initial, last_name, gender, section) {
        document.getElementById('edit_student_id').value = id;
        document.getElementById('edit_first_name').value = first_name;
        document.getElementById('edit_middle_initial').value = middle_initial;
        document.getElementById('edit_last_name').value = last_name;
        document.getElementById('edit_section').value = section;
        document.getElementById('edit_gender').value = gender;

        const editModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
        editModal.show();
    }

    // Edit Student Form
    document.getElementById('editStudentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/edit-student.php', {
                method: 'POST',
                body: formData,
                enctype: 'multipart/form-data'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editStudentModal'));
                    modal.hide();
                    showAlert('Student updated successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert((data.error || 'Failed to update student'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while updating student', 'danger');
            });
    });

    // Open Delete Modal
    function openDeleteModal(id, name) {
        deleteStudentId = id;
        document.getElementById('deleteStudentName').textContent = name;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteStudentModal'));
        deleteModal.show();
    }

    // Confirm Delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteStudentId) return;

        const formData = new FormData();
        formData.append('id', deleteStudentId);

        fetch('../../controllers/admin/delete-student.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteStudentModal'));
                    modal.hide();
                    showAlert('Student deleted successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to delete student'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while deleting student', 'danger');
            });
    });
</script>
<?php include 'footer.php'; ?>