<?php
    
    require ('../system/DatabaseConnector.php');
    if (user_is_logged_in()) {
        redirect(PROOT . 'app/');
    }
    $title = 'Account - Verify Email | ';
    $body_class = "";
    require ('../system/inc/head.php');

    if (isset($_GET['vericode'])) {

        $vericode = sanitize($_GET['vericode']);
        $success = false;
        $msg = "Something has gone wrong or your account is already verified.";
        if($vericode) {
            $sql = "
                SELECT * FROM levina_users 
                WHERE user_verified = 0 
                AND user_vericode = :user_vericode 
                LIMIT 1
            ";
            $statement = $dbConnection->prepare($sql);
            $statement->execute([':user_vericode' => $vericode]);
            $users = $statement->fetchAll();
            if (count($users) == 1) {
                $user = $users[0];
            } else {
                $_SESSION['flash_error'] = 'Something went wrong, please try again.';
                redirect(PROOT . 'auth');
            }
            
            $sql = "
                UPDATE levina_users 
                SET user_verified = 1 
                WHERE user_id = :user_id";
            $statement = $dbConnection->prepare($sql);
            $success = $statement->execute([':user_id' => $user["user_id"]]);

            if ($success) {
                $name = ucwords($user["user_fullname"]);
                $to = $user['user_email'];
                $subject = "Confirmed & Ready ✔!";
                $body = "
                    <h3>Hello {$name},</h3>
                    <p>Your signup is complete. Discover bold, trendy styles only at Garyie.com.</p>
                    <p>Your style journey starts here. Stay tuned for the latest collections and special deals.</p>
                    <p>Log in <a href='https://sites.local/levina/auth/signin'>here</a></p>
                    <br>
                    <br>
                    Best regards,
                    <br>
                    - Leviana, Namibra Inc. 🤞
                ";
                send_email($name, $to, $subject, $body);

                $msg = "Your account has been verified! Please log in.";
            }
            
        }
        
    } else {
        redirect(PROOT . 'auth/signout');
    }


?>

    <!-- Page wrapper -->
    <main class="page-wrapper">
        <div class="d-flex flex-column align-items-center position-relative h-100 px-3 pt-5">

            <!-- Home button -->
            <a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 z-2 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="<?= PROOT; ?>app" data-bs-toggle="tooltip" data-bs-placement="left" title="Back to home" aria-label="Back to home">
                <i class="ai-home"></i>
            </a>

            <!-- Content -->
            <div class="mt-auto" style="max-width: 700px;">
                <h1 class="pt-3 pb-2 pb-lg-3">Email Verification</h1>
                <p class="pb-2">You must verify your account before logging in. Verify your account in three easy steps. This helps to keep your new password secure.
                <small class="fs-6 fst-italic">If you did not receive the verification email you may request a new verification email below.</small></p>
                <ul class="list-unstyled pb-2 pb-lg-0 mb-4 mb-lg-5">
                    <li class="d-flex mb-2">
                        <span class="text-primary fw-semibold me-2">1.</span>
                        Fill in your email address below.
                    </li>
                    <li class="d-flex mb-2">
                        <span class="text-primary fw-semibold me-2">2.</span>
                        We'll email you a temporary code (Please check your inbox and spam folders).
                    </li>
                    <li class="d-flex mb-2">
                        <span class="text-primary fw-semibold me-2">3.</span>
                        Use the code to change your password on our secure website.
                    </li>
                </ul>
                <div class="card border-0 bg-primary" data-bs-theme="dark">
                    <?= $msg; ?>
                    <a href="<?= PROOT; ?>auth/signin">Sign in</a>
                </div>
            </div>

            <!-- Copyright -->
            <p class="nav w-100 fs-sm pt-5 mt-auto mb-5" style="max-width: 700px;">
                <span class="text-body-secondary">&copy; All rights reserved. Made by</span>
                <a class="nav-link d-inline-block p-0 ms-1" href="https://nambra.io/" target="_blank" rel="noopener">Namibra Inc.</a>
            </p>
        </div>
    </div>

<!-- Google reCAPTCHA CDN -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php require('../system/inc/footer.php'); ?>