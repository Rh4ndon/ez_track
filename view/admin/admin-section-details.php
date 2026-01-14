<?php include 'header.php'; ?>

<?php include 'top-nav.php'; ?>

<?php include 'sidebar.php'; ?>

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
                            <div class="card-body p-3">
                                <div class="teacher-avatar mx-auto mb-3 rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="../uploads/students/${student.photo}" class="w-100 h-100 object-fit-cover">
                                </div>
                                <h5 class="fw-bold mb-1">${student.last_name}, ${student.first_name} ${student.middle_initial}.</h5>
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
</script>
<?php include 'footer.php'; ?>