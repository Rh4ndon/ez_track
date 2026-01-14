<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="../js/show-alert.js"></script>
<script>
    function toggleMenu() {
        const sideMenu = document.getElementById('sideMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        sideMenu.classList.toggle('open');
        menuOverlay.classList.toggle('show');
    }

    function closeMenu() {
        const sideMenu = document.getElementById('sideMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        sideMenu.classList.remove('open');
        menuOverlay.classList.remove('show');
    }

    function logout() {
        localStorage.clear();
        window.location.href = '../../controllers/logout.php?role=admin';
    }

    // Close menu when clicking on menu items (for mobile)
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                closeMenu();
            }
        });
    });

    // Close menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });

    if (!localStorage.getItem('is_logged_in') && !localStorage.getItem('role')) {
        window.location.href = 'index.php?error=Your not logged in!';
    }

    if (localStorage.getItem('role') !== 'admin') {
        window.location.href = '../../index.php?error=You are not an admin!';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Remove section_id from localStorage
        localStorage.removeItem('section_id');
    })

    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = event.currentTarget.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    }
</script>
</body>

</html>