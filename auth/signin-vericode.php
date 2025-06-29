<?php
    
    require ('../system/DatabaseConnector.php');
    if (user_is_logged_in()) {
        redirect(PROOT . 'app/');
    }
    $title = 'Account - Verify Signin | ';
    $body_class = "";
    require ('../system/inc/head.php');

    $code = issetElse($_SESSION, 'LVNLC', 0);
    $errors = '';
	if ($_POST) {

	}

?>
<link rel="stylesheet" href="https://prium.github.io/phoenix/v1.23.0/assets/css/theme.min.css">

    <!-- Page wrapper -->
    <main class="page-wrapper">
        <div class="d-flex flex-column align-items-center position-relative h-100 px-3 pt-5">

            <!-- Home button -->
            <a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 z-2 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="<?= PROOT; ?>app" data-bs-toggle="tooltip" data-bs-placement="left" title="Back to home" aria-label="Back to home">
                <i class="ai-home"></i>
            </a>

            <!-- Content -->
            <div class="mt-auto" style="max-width: 700px;">
                <h1 class="pt-3 pb-2 pb-lg-3">Enter the verification code</h1>
                <p class="pb-2">An email containing a 6-digit verification code has been sent to the email address - exa*********.com
                <P class="fs-10 mb-5">Don’t have access? <a href="#!">Use another method</a></P>
                <div class="card border-0 bg-primary" data-bs-theme="dark">
                    <form class="card-body verification-form" method="POST" data-2fa-form="data-2fa-form">
						<?= $errors; ?>
                        <div class="mb-4">
                            <div class="position-relative">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <input class="form-control px-2 text-center" type="number" />
                                <input class="form-control px-2 text-center" type="number" />
                                <input class="form-control px-2 text-center" type="number" />
                                <span>-</span>
                                <input class="form-control px-2 text-center" type="number" />
                                <input class="form-control px-2 text-center" type="number" />
                                <input class="form-control px-2 text-center" type="number" />
                            </div>
                            <div class="form-check text-start mb-4">
                                <input class="form-check-input" id="2fa-checkbox" type="checkbox" />
                                <label for="2fa-checkbox">Don’t ask again on this device</label>
                            </div>
                            <!-- <div class="position-relative">
                                <i class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y text-light opacity-80 ms-3"></i>
                                <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" id="email" name="email" required>
                            </div> -->
                            </div>
                        <!-- div to show reCAPTCHA -->
                            <button class="btn btn-light" type="submit" disabled="disabled">Verify</button>
                            <div class="mt-2">
                                <a class="fs-xs small text-secondary" href="#!">Didn’t receive the code? </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Copyright -->
                <p class="nav w-100 fs-sm pt-5 mt-auto mb-5" style="max-width: 700px;">
                    <span class="text-body-secondary">&copy; All rights reserved. Made by</span>
                    <a class="nav-link d-inline-block p-0 ms-1" href="https://nambra.io/" target="_blank" rel="noopener">Namibra Inc.</a>
                </p>
            </div>
        </div>

<script src="https://prium.github.io/phoenix/v1.23.0/vendors/popper/popper.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/vendors/anchorjs/anchor.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/vendors/lodash/lodash.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/vendors/is/is.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/vendors/list.js/list.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/vendors/dayjs/dayjs.min.js"></script>
<script src="https://prium.github.io/phoenix/v1.23.0/assets/js/phoenix.js"></script>
<?php require('../system/inc/footer.php'); ?>
