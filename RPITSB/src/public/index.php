<?php
    require 'connect_db.php';
    $stmt = $pdo->prepare("SELECT * FROM tbl_category ORDER BY createdAt DESC");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include 'header.php';
    include 'tableLayout.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.get('update') === 'success') {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Category information has been saved successfully.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000, // Auto-closes after 2 seconds
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown' // Uses SweetAlert's built-in animation
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });

                // Clean the URL so the alert doesn't show again on refresh
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
<?php
    include 'footer.php';