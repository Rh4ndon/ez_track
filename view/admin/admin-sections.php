<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<main class="main-content">
    <!-- ADD SECTION Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <button class="btn btn-primary py-2" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addSectionModal">
            <i class="fa-solid fa-circle-plus"></i>&nbsp; ADD SECTION
        </button>
    </div>

    <div class="section-container d-flex flex-wrap align-items-center justify-content-center gap-4 p-3">
        <?php
        $sections = getAllRecords('sections');
        foreach ($sections as $section):
        ?>
            <div class="card shadow-sm border-0 position-relative" style="width: 200px; height: 100px;">
                <!-- Edit Button -->
                <button class="btn btn-warning btn-sm position-absolute top-0 start-0 m-1 edit-btn"
                    onclick="openEditModal('<?php echo $section['id']; ?>', '<?php echo addslashes($section['grade_level']); ?>', '<?php echo addslashes($section['section_name']); ?>', event)"
                    style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%; opacity: 0.8; transition: opacity 0.2s; color: white;">
                    <i class="fas fa-edit fa-xs"></i>
                </button>

                <!-- Delete Button -->
                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-btn"
                    onclick="openDeleteModal('<?php echo $section['id']; ?>', '<?php echo addslashes($section['grade_level'] . '-' . $section['section_name']); ?>', event)"
                    style="z-index: 10; width: 28px; height: 28px; padding: 0; border-radius: 50%; opacity: 0.8; transition: opacity 0.2s;">
                    <i class="fas fa-trash fa-xs"></i>
                </button>

                <a href="javascript:void(0);" onclick="navigateToSection('<?php echo $section['id']; ?>')" class="text-decoration-none text-dark h-100 d-block">
                    <div class="card-body text-center d-flex flex-column justify-content-center h-100">
                        <h3 class="fw-bold m-0"><?php echo $section['grade_level'] . '-' . $section['section_name']; ?></h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</main>

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSectionForm">
                    <input type="hidden" id="role" name="role" value="admin">
                    <div class="mb-3">
                        <label for="grade_level" class="form-label">Grade Level</label>
                        <input type="number" class="form-control" id="grade_level" name="grade_level" min="7" max="10" placeholder="Enter grade level" required>
                    </div>
                    <div class="mb-3">
                        <label for="section_name" class="form-label">Section Name</label>
                        <input type="text" class="form-control" id="section_name" name="section_name" placeholder="Enter section name" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSectionForm">
                    <input type="hidden" id="edit_section_id" name="id">
                    <div class="mb-3">
                        <label for="edit_grade_level" class="form-label">Grade Level</label>
                        <input type="number" class="form-control" id="edit_grade_level" name="grade_level" min="7" max="10" placeholder="Enter grade level" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_section_name" class="form-label">Section Name</label>
                        <input type="text" class="form-control" id="edit_section_name" name="section_name" placeholder="Enter section name" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Section Modal -->
<div class="modal fade" id="deleteSectionModal" tabindex="-1" aria-hidden="true">
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
    // Add Section Form
    document.getElementById('addSectionForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/add-section.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addSectionModal'));
                    modal.hide();

                    // Show success message
                    showAlert('Section added successfully!', 'success');

                    // Reload page after delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to add section'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while adding section', 'danger');
            });
    });

    // Edit Section Form
    document.getElementById('editSectionForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('../../controllers/admin/edit-section.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editSectionModal'));
                    modal.hide();

                    // Show success message
                    showAlert('Section updated successfully!', 'success');

                    // Reload page after delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showAlert('Error: ' + (data.message || 'Failed to update section'), 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while updating section', 'danger');
            });
    });

    // Global variables
    let sectionToDelete = null;

    function navigateToSection(sectionId) {
        localStorage.setItem('section_id', sectionId);
        window.location.href = 'admin-section-details.php';
    }

    // Edit Modal Functions
    function openEditModal(sectionId, gradeLevel, sectionName, event) {
        event.stopPropagation();
        event.preventDefault();

        // Fill form with current data
        document.getElementById('edit_section_id').value = sectionId;
        document.getElementById('edit_grade_level').value = gradeLevel;
        document.getElementById('edit_section_name').value = sectionName;

        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editSectionModal'));
        editModal.show();
    }

    // Delete Modal Functions
    function openDeleteModal(sectionId, sectionName, event) {
        event.stopPropagation();
        event.preventDefault();

        // Store the section ID for later use
        sectionToDelete = sectionId;

        // Update modal content with section name
        document.getElementById('modalBody').innerHTML =
            `Are you sure you want to delete section <strong>${sectionName}</strong>? This action cannot be undone.`;

        // Show the modal using Bootstrap
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteSectionModal'));
        deleteModal.show();
    }

    // Handle delete confirmation button click
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!sectionToDelete) return;

        console.log('Deleting section ID:', sectionToDelete);

        // AJAX request to delete the section
        fetch('../../controllers/admin/delete-section.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + sectionToDelete
            })
            .then(response => response.json())
            .then(data => {
                // Hide the modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteSectionModal'));
                deleteModal.hide();

                if (data.success) {
                    // Show success message
                    showAlert('Section deleted successfully!', 'success');
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
                showAlert('An error occurred while deleting the section', 'danger');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteSectionModal'));
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