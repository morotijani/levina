<?php
    
    require ('../system/DatabaseConnector.php');
    if (user_is_logged_in()) {
        redirect(PROOT . 'app/');
    }
    $title = 'Account - Sign In | ';
    $body_class = "";
    require ('../system/inc/head.php');

    $email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
    $email = trim($email);
    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) :'');
    $password = trim($password);
    $errors = '';
    if (isset($_POST['submit_login'])) {

        // Storing google recaptcha response
        // in $recaptcha variable
        $recaptcha = $_POST['g-recaptcha-response'];
    
        // Hitting request to the URL, Google will
        // respond with success or error scenario
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . RECAPTCHA_SITE_KEY_SECRETE . '&response=' . $recaptcha;
    
        // Making request to verify captcha
        $response = file_get_contents($url);
    
        // Response return by google is in
        // JSON format, so we have to parse
        // that json
        $response = json_decode($response);
    
        // Checking, if response is true or not
        if ($response->success == true) {
        
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $errors = '<div class="alert alert-danger" role="alert">You must provide email and password</div>';
            }
    
            $query = "
                SELECT * FROM levina_users 
                WHERE user_email = :user_email 
                LIMIT 1
            ";
            $statement = $dbConnection->prepare($query);
            $statement->execute(
                array(
                    ':user_email' => $email
                )
            );
            // $rows = $statement->fetchALl();
            // $row = $rows[0] ?? $rows;
            if ($statement->rowCount() < 1) {
                $errors = '<div class="alert alert-danger" role="alert">That email does\'nt exist in our database!</div>';
            } else {
                foreach ($statement->fetchAll() as $row) {
                    if ($row['user_verified'] != 1) {
                        redirect(PROOT . 'auth/resend-vericode');
                    } else {
                        $code = rand(100000, 999999); // Or use a more secure generator
                        $_SESSION['LVNLC'] = $code;

                        $name = ucwords($row['user_fullname']);
                        $to = $email;
                        $subject = "Sign in code 👨‍💻.";
                        $body = "
                            <h3>
                                {$name},</h3>
                                <p>
                                    Your sign in code is: <strong>{$code}</strong>
                                    <br><br>
                                    Best regards,
                                    <br>
                                    - Leviana, Namibra Inc. 🤞
                                </p>
                        ";
                        $mail_result = send_email($name, $to, $subject, $body);
                        if ($mail_result) {
                            $_SESSION['flash_success'] = 'Sign in code sent to your email 👨‍💻.';
                            redirect(PROOT . 'auth/signin-vericode');
                        } else {
                            $errors = '<div class="alert alert-danger" role="alert">Error sending email!</div>';
                        }
                        // if (!password_verify($password, $row['user_password'])) {
                        //     $errors = '<div class="alert alert-danger" role="alert">User cannot be found!</div>';
                        // } else {
                        //     if (!empty($errors)) {
                        //         $errors;
                        //     } else {
                        //         if ($row['user_trash'] == 0) {
                        //             $user_id = $row['user_id'];
                        //             userLogin($user_id);
                        //         } else {
                        //             $errors = '<div class="alert alert-danger" role="alert">User account Terminated!</div>';
                        //         }
                        //     }
                        // }
                    }
                }
            }
    
        } else {
            $errors = '<div class="alert alert-danger" role="alert">Error in Google reCAPTACHA!</div>';
        }
    }
    

?>

    <!-- Page wrapper -->
    <main class="page-wrapper">
        <div class="d-lg-flex position-relative h-100">

        <!-- Home button -->
        <a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="<?= PROOT; ?>index" data-bs-toggle="tooltip" data-bs-placement="left" title="Back to home" aria-label="Back to home">
            <i class="ai-home"></i>
        </a>

        <!-- Sign in form -->
        <div class="d-flex flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">
            <div class="w-100 mt-auto" style="max-width: 526px;">
                <h1>Sign in to Levina</h1>
                <p class="pb-3 mb-3 mb-lg-4">Don't have an account yet?&nbsp;&nbsp;<a href="<?= PROOT; ?>auth/signup">Register here!</a></p>
                <form class="needs-validation" method="POST" novalidate>
                    <?= $errors; ?>
                    <div class="pb-3 mb-3">
                        <div class="position-relative">
                            <i class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            <input class="form-control form-control-lg ps-5" type="email" name="email" id="email" placeholder="Email address" value="<?= $email; ?>" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <!-- <div class="position-relative">
                            <i class="ai-lock-closed fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            <div class="password-toggle">
                                <input class="form-control form-control-lg ps-5" type="password" name="password" id="password" placeholder="Password" value="<?= $password; ?>" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div> -->
                    </div>
                    <!-- div to show reCAPTCHA -->
                    <div class="g-recaptcha mb-3" data-sitekey="<?= RECAPTCHA_KEY; ?>"></div>
                    <!-- <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                        <div class="form-check my-1">
                            <input class="form-check-input" type="checkbox" id="keep-signedin">
                            <label class="form-check-label ms-1" for="keep-signedin">Keep me signed in</label>
                        </div>
                        <a class="fs-sm fw-semibold text-decoration-none my-1" href="<?= PROOT; ?>password-recovery">Forgot password?</a>
                    </div> -->
                    <button class="btn btn-lg btn-primary w-100 mb-4" name="submit_login" id="submit" type="submit">Sign in</button>
                </form>
            </div>

            <!-- Copyright -->
            <p class="nav w-100 fs-sm pt-5 mt-auto mb-5" style="max-width: 526px;"><span class="text-body-secondary">&copy; All rights reserved. Made by</span><a class="nav-link d-inline-block p-0 ms-1" href="https://namibra.io/" target="_blank" rel="noopener">Namibra Inc.</a></p>
            </div>

            <!-- Cover image -->
            <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" style="background-image: url(<?= PROOT; ?>assets/media/cover.jpg);"></div>
        </div>

    <!-- Google reCAPTCHA CDN -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php require('../system/inc/footer.php'); ?>
