<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<main class="main-content">
    <!-- ADD TEACHER Button -->
    <div class="d-flex justify-content-center mb-4 mt-4">
        <button class="btn btn-primary py-2" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
            <i class="fa-solid fa-circle-plus"></i>&nbsp; ADD TEACHER
        </button>
    </div>

    <div class="teacher-container d-flex flex-wrap justify-content-center gap-4 p-3">
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

        <!-- Second Teacher -->
        <a href="" class="text-decoration-none text-dark teacher-card">
            <div class="card shadow-sm border-0 text-center" style="width: 180px;">
                <div class="card-body p-3">
                    <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                        <img src="https://via.placeholder.com/80" alt="Peony" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h5 class="fw-bold mb-1">Peony</h5>
                    <small class="text-muted">Science</small>
                </div>
            </div>
        </a>

        <!-- Third Teacher -->
        <a href="" class="text-decoration-none text-dark teacher-card">
            <div class="card shadow-sm border-0 text-center" style="width: 180px;">
                <div class="card-body p-3">
                    <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                        <img src="https://via.placeholder.com/80" alt="Yello-wood" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h5 class="fw-bold mb-1">Yello-wood</h5>
                    <small class="text-muted">Literature</small>
                </div>
            </div>
        </a>
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
                <form id="teacherForm">
                    <input type="hidden" id="role" name="role" value="admin">

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


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>