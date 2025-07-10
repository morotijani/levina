            
            </main>

        </div> 
    </div>  

    <?= $flash_user; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" class="astro-vvvwv3sm"></script>
    <script src="<?= PROOT; ?>admin/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous" class="astro-vvvwv3sm"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= PROOT; ?>admin/dist/js/dashboard.js" class="astro-vvvwv3sm"></script>

    <script>
		// Fade out messages 
		$("#temporary").fadeOut(10000);

		// Show flash message
        <?php if (isset($_SESSION['flash_success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $_SESSION['flash_success']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
        <?php if (isset($_SESSION['flash_error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= $_SESSION['flash_error']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    </script>
    
</body> 
</html>
