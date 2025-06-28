<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }
    $title = 'Account Settings - Lavina - Namibra';
    $body_class = "bg-secondary";
    $playSound = false;
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');

    $fullname = ((isset($_POST['fullname']) && !empty($_POST['fullname'])) ? sanitize($_POST['fullname']) : $user_data['user_fullname']);
    $email = ((isset($_POST['email']) && !empty($_POST['email'])) ? sanitize($_POST['email']) : $user_data['user_email']);
    $phone = ((isset($_POST['phone']) && !empty($_POST['phone'])) ? sanitize($_POST['phone']) : $user_data['user_phone']);
    $country = ((isset($_POST['country']) && !empty($_POST['country'])) ? sanitize($_POST['country']) : $user_data['user_country']);
    $currency = ((isset($_POST['currency']) && !empty($_POST['currency'])) ? sanitize($_POST['currency']) : $user_data['user_currency']);
    $bio = ((isset($_POST['bio']) && !empty($_POST['bio'])) ? sanitize($_POST['bio']) : $user_data['user_bio']);
    $gender = ((isset($_POST['gender']) && !empty($_POST['gender'])) ? sanitize($_POST['gender']) : $user_data['user_gender']);
    $comemail = ((isset($_POST['com-email']) && !empty($_POST['com-email'])) ? sanitize($_POST['com-email']) : $user_data['user_comm_email']);
    $comphone = ((isset($_POST['com-phone']) && !empty($_POST['com-phone'])) ? sanitize($_POST['com-phone']) : $user_data['user_comm_phone']);

    if (isset($_POST['saveSettings'])) {
        $comemail = 0;
        $comphone = 0;

        if (!empty($comemail) || $comemail != '') {
            $comemail = 1;
            $comphone = ((!isset($_POST['com-phone'])) ? null : 'email');
        }

        if (!empty($comphone) || $comphone != '') {
            $comphone = 1;
            $comemail = ((!isset($_POST['com-email'])) ? null : 'phone');
        }

        $sql = "
            UPDATE levina_users SET user_fullname = ?, user_email = ?, user_phone = ?, user_country = ?, user_currency = ?, user_bio = ?, user_gender = ?, user_comm_email = ?, user_comm_phone = ? 
            WHERE user_id = ?
        ";
        $statement = $dbConnection->prepare($sql);
        $result = $statement->execute([$fullname, $email, $phone, $country, $currency, $bio, $gender, $comemail, $comphone, $user_id]); 
        if (isset($result)) {
            $_SESSION['flash_success'] = 'Profile settings updated 👌!';
            redirect(PROOT . 'app/account-settings');
        }
    }
?>
            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <h1 class="h2 mb-4">Settings</h1>

                <!-- Basic info -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-user text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Basic info</h2>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="dropdown">
                                <a class="d-flex flex-column justify-content-end position-relative overflow-hidden rounded-circle bg-size-cover bg-position-center flex-shrink-0" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="width: 80px; height: 80px; background-image: url(<?= PROOT; ?>assets/media/avatar.png);" aria-label="Upload picture">
                                    <span class="d-block text-light text-center lh-1 pb-1" style="background-color: rgba(0,0,0,.5)">
                                        <i class="ai-camera"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu my-1">
                                    <a class="dropdown-item fw-normal" href="#">
                                        <i class="ai-camera fs-base opacity-70 me-2"></i>
                                        Upload new photo
                                    </a>
                                    <a class="dropdown-item text-danger fw-normal" href="#">
                                        <i class="ai-trash fs-base me-2"></i>
                                        Delete photo
                                    </a>
                                </div>
                            </div>
                            <div class="ps-3">
                                <h3 class="h6 mb-1">Profile picture</h3>
                                <p class="fs-sm text-body-secondary mb-0">PNG or JPG no bigger than 1000px wide and tall.</p>
                            </div>
                        </div>
                        <form class="needs-validation" method="POST" novalidate>
                            <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                                <div class="col-12">
                                    <label class="form-label" for="fn">Full name</label>
                                    <input class="form-control" type="text" name="fullname" value="<?= $fullname; ?>" id="fn" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">Email address</label>
                                    <input class="form-control" type="email" name="email" value="<?= $email; ?>" id="email" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="phone">Phone <span class="text-body-secondary">(optional)</span></label>
                                    <input class="form-control" type="tel" data-format='{"numericOnly": true, "delimiters": ["+233 ", " ", " "], "blocks": [0, 3, 3, 2]}' placeholder="+233 ___ ___ __" id="phone" name="phone" value="<?= $phone; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="country">Country</label>
                                    <input class="form-control" id="country" name="country" value="<?= $country; ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="currency">Currency</label>
                                    <select class="form-select" name="currency" id="currency" required>
                                        <option value="" selected disabled>Select currency</option>
                                        <option value="ghs" <?= (($currency == 'ghs') ? 'selected' : ''); ?>>₵ GHS</option>
                                        <option value="usd" <?= (($currency == 'usd') ? 'selected' : ''); ?>>$ USD</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="bio">Bio</label>
                                    <textarea class="form-control" rows="5" placeholder="Add a bio" id="bio" name="bio"><?= $bio; ?></textarea>
                                </div>
                                <div class="col-12 d-sm-flex align-items-center pt-sm-2 pt-md-3">
                                    <div class="form-label text-body-secondary mb-2 mb-sm-0 me-sm-4">Gender:</div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" name="gender" <?= (($gender == 'Male') ? 'checked' : ''); ?> value="Male" id="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" name="gender" value="Female" <?= (($gender == 'Female') ? 'checked' : ''); ?> id="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" name="gender" value="Other" <?= (($gender == 'Other') ? 'checked' : ''); ?> id="other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <div class="col-12 d-sm-flex align-items-center">
                                    <div class="form-label text-body-secondary mb-2 mb-sm-0 me-sm-4">Communication:</div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="checkbox" name="com-email" value="email" <?= (($comemail == 'email') ? 'checked' : ''); ?> id="c-email">
                                        <label class="form-check-label" for="c-email">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="checkbox" name="com-phone" value="phone" <?= (($comphone == 'phone') ? 'checked' : ''); ?> id="c-phone">
                                        <label class="form-check-label" for="c-phone">Phone</label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end pt-3">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                    <button class="btn btn-primary ms-3"  type="submit" name="saveSettings">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Password -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-lock-closed text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Password change</h2>
                        </div>
                        <div class="row align-items-center g-3 g-sm-4 pb-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="current-pass">Current password</label>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" value="hidden@password" id="current-pass">
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a class="d-inline-block fs-sm fw-semibold text-decoration-none mt-sm-4" href="account-password-recovery.html">Forgot password?</a>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="new-pass">New password</label>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" id="new-pass">
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="confirm-pass">Confirm new password</label>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" id="confirm-pass">
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info d-flex my-3 my-sm-4">
                            <i class="ai-circle-info fs-xl me-2"></i>
                            <p class="mb-0">Password must be minimum 8 characters long - the more, the better.</p>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <button class="btn btn-secondary" type="button">Cancel</button>
                            <button class="btn btn-primary ms-3" type="button">Save changes</button>
                        </div>
                    </div>
                </section>

                <!-- Notifications -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-bell text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Notifications</h2>
                            <button class="btn btn-sm btn-outline-secondary ms-auto" type="button" data-bs-toggle="checkbox" data-bs-target="#checkboxList">Toggle all</button>
                        </div>
                        <div id="checkboxList">
                            <div class="form-check form-switch d-flex pb-md-2 mb-4">
                                <input class="form-check-input flex-shrink-0" type="checkbox" checked id="product-sold">
                                <label class="form-check-label ps-3 ps-sm-4" for="product-sold">
                                    <span class="h6 d-block mb-2">Product sold notifications</span>
                                    <span class="fs-sm text-body-secondary">Send an email when someone purchased one of my products</span>
                                </label>
                            </div>
                            <div class="form-check form-switch d-flex pb-md-2 mb-4">
                                <input class="form-check-input flex-shrink-0" type="checkbox" checked id="product-update">
                                <label class="form-check-label ps-3 ps-sm-4" for="product-update">
                                    <span class="h6 d-block mb-2">Product update notifications</span>
                                    <span class="fs-sm text-body-secondary">Send an email when a product I've purchased is updated</span>
                                </label>
                            </div>
                            <div class="form-check form-switch d-flex pb-md-2 mb-4">
                                <input class="form-check-input flex-shrink-0" type="checkbox" checked id="product-review">
                                <label class="form-check-label ps-3 ps-sm-4" for="product-review">
                                    <span class="h6 d-block mb-2">Product review notifications</span>
                                    <span class="fs-sm text-body-secondary">Send an email when someone leaves a review with his/her rating</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex">
                            <input class="form-check-input flex-shrink-0" type="checkbox" disabled id="daily-summary">
                            <label class="form-check-label opacity-100 ps-3 ps-sm-4" for="daily-summary">
                                <span class="h6 text-body-secondary d-block mb-2">Daily summary emails<span class="badge bg-danger bg-opacity-10 text-danger ms-3">Only for premium</span></span>
                                <span class="fs-sm text-body-secondary">Send an email when someone leaves a review with his/her rating</span>
                            </label>
                        </div>
                    </div>
                </section>

                <!-- Delete account -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-trash text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Delete account</h2>
                        </div>
                        <div class="alert alert-warning d-flex mb-4">
                            <i class="ai-triangle-alert fs-xl me-2"></i>
                            <p class="mb-0">When you delete your account, your public profile will be deactivated immediately. If you change your mind before the 14 days are up, sign in with your email and password, and we'll send a link to reactivate account. <a href="#" class="alert-link">Learn more</a></p>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirm">
                            <label class="form-check-label text-dark fw-medium" for="confirm">Yes, I want to delete my account</label>
                        </div>
                        <div class="d-flex flex-column flex-sm-row justify-content-end pt-4 mt-sm-2 mt-md-3">
                            <button class="btn btn-danger" type="button">
                                <i class="ai-trash ms-n1 me-2"></i>
                                Delete account
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Divider for dark mode only -->
    <hr class="d-none d-dark-mode-block">

    <!-- Sidebar toggle button -->
    <button class="d-lg-none btn btn-sm fs-sm btn-primary w-100 rounded-0 fixed-bottom" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAccount">
        <i class="ai-menu me-2"></i>
        Account menu
    </button>

<?php require('../system/inc/footer.php'); ?>