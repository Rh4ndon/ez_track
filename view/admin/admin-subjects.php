<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<main class="main-content">
    <!-- ADD SUBJECT Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <button class="btn btn-primary py-2" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            <i class="fa-solid fa-circle-plus"></i>&nbsp; ADD SUBJECT
        </button>
    </div>

    <div class="subject-container d-flex flex-wrap align-items-center justify-content-center gap-4 p-3">
        <?php
        $subjects = getAllRecords('subjects', 'ORDER BY grade_level ASC');
        foreach ($subjects as $subject):
        ?>
            <div class="card shadow-sm border-0 position-relative" style="width: 250px; height: 100px;">
                <!-- Edit Button -->
                <button class="btn btn-warning btn-sm position-absolute top-0 start-0 m-1 edit-btn"
                    onclick="openEditModal('<?php echo $subject['id']; ?>', '<?php echo addslashes($subject['grade_level']); ?>', '<?php echo addslashes($subject['subject_name']); ?>', '<?php echo addslashes($subject['description']); ?>', '<?php echo addslashes($subject['icon']); ?>', event)"
                    style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%; opacity: 0.8; transition: opacity 0.2s; color: white;">
                    <i class="fas fa-edit fa-xs"></i>
                </button>

                <!-- Delete Button -->
                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-btn"
                    onclick="openDeleteModal('<?php echo $subject['id']; ?>', '<?php echo addslashes($subject['grade_level'] . '-' . $subject['subject_name']); ?>', event)"
                    style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%; opacity: 0.8; transition: opacity 0.2s;">
                    <i class="fas fa-trash fa-xs"></i>
                </button>

                <a href="javascript:void(0);" class="text-decoration-none text-dark h-100 d-block">
                    <div class="card-body text-center d-flex flex-column justify-content-center h-100">
                        <h3 class="fw-bold m-0"><?php echo $subject['icon']; ?> <?php echo $subject['grade_level'] . '-' . $subject['subject_name']; ?></h3><br>
                        <p class="m-0"><?php echo $subject['description']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</main>

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubjectForm">
                    <input type="hidden" id="role" name="role" value="admin">
                    <div class="mb-3">
                        <label for="grade_level" class="form-label">Grade Level</label>
                        <input type="number" class="form-control" id="grade_level" name="grade_level" min="7" max="10" placeholder="Enter grade level" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter subject name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter subject name" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <select class="form-select" name="icon" id="icon" required>
                            <option value="" disabled selected>Select Emoji Icon</option>
                            <option value="📝">📝 Pencil</option>
                            <option value="🔧">🔧 Tools</option>
                            <option value="🎵">🎵 Music</option>
                            <option value="🧪">🧪 Flask (Science)</option>
                            <option value="📚">📚 Book</option>
                            <option value="🧮">🧮 Calculator</option>
                            <option value="🤝">🤝 Helping Hands</option>
                            <option value="🌐">🌐 Language/Globe</option>
                            <option value="🗺️">🗺️ Asia Globe</option>
                            <option value="⭐">⭐ Special/Asterisk</option>
                            <option value="✂️">✂️ Scissors</option>
                            <option value="💾">💾 Floppy Disk</option>
                            <option value="📖">📖 English/Reading</option>
                            <option value="🔬">🔬 Microscope (Science)</option>
                            <option value="🎨">🎨 Arts</option>
                            <option value="⚽">⚽ PE/Sports</option>
                            <option value="🏥">🏥 Health</option>
                            <option value="💻">💻 Technology</option>
                            <option value="🍳">🍳 Livelihood/Cooking</option>
                            <option value="🧮">🧮 Math</option>
                            <option value="❤️">❤️ Values (ESP)</option>
                            <option value="🇵🇭">🇵🇭 Filipino</option>
                            <option value="🏛️">🏛️ History (AP)</option>
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

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSubjectForm">
                    <input type="hidden" id="edit_subject_id" name="id">
                    <div class="mb-3">
                        <label for="edit_grade_level" class="form-label">Grade Level</label>
                        <input type="number" class="form-control" id="edit_grade_level" name="grade_level" min="7" max="10" placeholder="Enter grade level" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_subject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="edit_subject_name" name="subject_name" placeholder="Enter subject name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" placeholder="Enter subject name" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <select class="form-select" name="icon" id="edit_icon" required>
                            <option value="" disabled selected>Select Emoji Icon</option>
                            <option value="📝">📝 Pencil</option>
                            <option value="🔧">🔧 Tools</option>
                            <option value="🎵">🎵 Music</option>
                            <option value="🧪">🧪 Flask (Science)</option>
                            <option value="📚">📚 Book</option>
                            <option value="🧮">🧮 Calculator</option>
                            <option value="🤝">🤝 Helping Hands</option>
                            <option value="🌐">🌐 Language/Globe</option>
                            <option value="🗺️">🗺️ Asia Globe</option>
                            <option value="⭐">⭐ Special/Asterisk</option>
                            <option value="✂️">✂️ Scissors</option>
                            <option value="💾">💾 Floppy Disk</option>
                            <option value="📖">📖 English/Reading</option>
                            <option value="🔬">🔬 Microscope (Science)</option>
                            <option value="🎨">🎨 Arts</option>
                            <option value="⚽">⚽ PE/Sports</option>
                            <option value="🏥">🏥 Health</option>
                            <option value="💻">💻 Technology</option>
                            <option value="🍳">🍳 Livelihood/Cooking</option>
                            <option value="🧮">🧮 Math</option>
                            <option value="❤️">❤️ Values (ESP)</option>
                            <option value="🇵🇭">🇵🇭 Filipino</option>
                            <option value="🏛️">🏛️ History (AP)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Subject Modal -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-hidden="true">
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

<script>
    // Add Subject Form
    document.getElementById('addSubjectForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/add-subject.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addSubjectModal'));
                    modal.hide();

                    // Show success message
                    showAlert('Subject added successfully!', 'success');

                    // Reload page after delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to add subject'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while adding subject', 'danger');
            });
    });

    // Edit Subject Form
    document.getElementById('editSubjectForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/edit-subject.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editSubjectModal'));
                    modal.hide();

                    // Show success message
                    showAlert('Subject updated successfully!', 'success');

                    // Reload page after delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to update subject'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while updating subject', 'danger');
            });
    });

    // Global variables
    let subjectToDelete = null;


    // Edit Modal Functions
    function openEditModal(subjectId, gradeLevel, subjectName, description, icon, event) {
        event.stopPropagation();
        event.preventDefault();

        // Fill form with current data
        document.getElementById('edit_subject_id').value = subjectId;
        document.getElementById('edit_grade_level').value = gradeLevel;
        document.getElementById('edit_subject_name').value = subjectName;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_icon').value = icon;
        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editSubjectModal'));
        editModal.show();
    }

    // Delete Modal Functions
    function openDeleteModal(subjectId, subjectName, event) {
        event.stopPropagation();
        event.preventDefault();

        // Store the subject ID for later use
        subjectToDelete = subjectId;

        // Update modal content with subject name
        document.getElementById('modalBody').innerHTML =
            `Are you sure you want to delete subject <strong>${subjectName}</strong>? This action cannot be undone.`;

        // Show the modal using Bootstrap
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteSubjectModal'));
        deleteModal.show();
    }

    // Handle delete confirmation button click
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!subjectToDelete) return;

        console.log('Deleting subject ID:', subjectToDelete);

        // AJAX request to delete the subject
        fetch('../../controllers/admin/delete-subject.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + subjectToDelete
            })
            .then(response => response.json())
            .then(data => {
                // Hide the modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteSubjectModal'));
                deleteModal.hide();

                if (data.success) {
                    // Show success message
                    showAlert('Subject deleted successfully!', 'success');
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
                showAlert('An error occurred while deleting the subject', 'danger');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteSubjectModal'));
                deleteModal.hide();
            });
    });


    // Optional: Add hover effect for buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('mouseenter', () => btn.style.opacity = '1');
            btn.addEventListener('mouseleave', () => btn.style.opacity = '0.8');
        });

        // Edit buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('mouseenter', () => btn.style.opacity = '1');
            btn.addEventListener('mouseleave', () => btn.style.opacity = '0.8');
        });
    });
</script>

<?php include 'footer.php'; ?>