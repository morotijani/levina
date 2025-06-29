<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }

    unset($_SESSION['LVNLC']);
    unset($_SESSION['LVE']);

    $title = 'Dashboard - Lavina - Namibra';
    $body_class = "bg-secondary";

    // Check if sound should play
    $playSound = false;
    if (!isset($_SESSION['sound_played'])) {
        $_SESSION['sound_played'] = true;
        $playSound = true;
    }
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');

?>
            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <h1 class="h2 mb-4">Overview</h1>

                <!-- Basic info -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-user text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Basic info</h2>
                            <a class="btn btn-sm btn-secondary ms-auto" href="account-settings.html">
                                <i class="ai-edit ms-n1 me-2"></i>
                                Edit info
                            </a>
                        </div>
                        <div class="d-md-flex align-items-center">
                            <div class="d-sm-flex align-items-center">
                                <div class="rounded-circle bg-size-cover bg-position-center flex-shrink-0" style="width: 80px; height: 80px; background-image: url(<?= PROOT; ?>assets/media/avatar.png);"></div>
                                <div class="pt-3 pt-sm-0 ps-sm-3">
                                    <h3 class="h5 mb-2">Hamza Zero<i class="ai-circle-check-filled fs-base text-success ms-2"></i></h3>
                                    <div class="text-body-secondary fw-medium d-flex flex-wrap flex-sm-nowrap align-iteems-center">
                                        <div class="d-flex align-items-center me-3">
                                            <i class="ai-mail me-1"></i>
                                            <?= $user_data['user_email']; ?>
                                        </div>
                                        <div class="d-flex align-items-center text-nowrap">
                                            <i class="ai-map-pin me-1"></i>
                                            GH, ₵
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 pt-3 pt-md-0 ms-md-auto" style="max-width: 212px;">
                                <div class="d-flex justify-content-between fs-sm pb-1 mb-2">
                                    Profile completion
                                    <strong class="ms-2">62%</strong>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row py-4 mb-2 mb-sm-3">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 text-body-secondary py-1 px-0">Phone</td>
                                            <td class="border-0 text-dark fw-medium py-1 ps-3">+233 234 567 890</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 text-body-secondary py-1 px-0">Language</td>
                                            <td class="border-0 text-dark fw-medium py-1 ps-3">English</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 text-body-secondary py-1 px-0">Gender</td>
                                            <td class="border-0 text-dark fw-medium py-1 ps-3">Male</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 text-body-secondary py-1 px-0">Communication</td>
                                            <td class="border-0 text-dark fw-medium py-1 ps-3">Mobile, email</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 d-md-flex justify-content-end">
                                <div class="w-100 border rounded-3 p-4" style="max-width: 212px;">
                                    <img class="d-block mb-2" src="<?= PROOT; ?>assets/media/gift-icon.svg" width="24" alt="Gift icon">
                                    <h4 class="h5 lh-base mb-0">123 bonuses</h4>
                                    <p class="fs-sm text-body-secondary mb-0">1 bonus = ₵1</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info d-flex mb-0" role="alert">
                            <i class="ai-circle-info fs-xl"></i>
                            <div class="ps-2">Fill in the information 100% to receive more suitable offers.<a class="alert-link ms-1" href="account-settings.html">Go to settings!</a></div>
                        </div>
                    </div>
                </section>

                <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                    <!-- Address -->
                    <section class="col">
                        <div class="card h-100 border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-1 mb-lg-2">
                                    <i class="ai-map-pin text-primary lead pe-1 me-2"></i>
                                    <h2 class="h4 mb-0">Address</h2>
                                    <a class="btn btn-sm btn-secondary ms-auto" href="account-settings.html">
                                    <i class="ai-edit ms-n1 me-2"></i>
                                    Edit info
                                    </a>
                                </div>
                                <div class="d-flex align-items-center pb-1 mb-2">
                                    <h3 class="h6 mb-0 me-3">Shipping address</h3>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Primary</span>
                                </div>
                                <p class="mb-0">Kumasi,<br>Airport, rounadbout, Street<br>Boukrom</p>
                                <div class="d-flex align-items-center pt-4 pb-1 my-2">
                                    <h3 class="h6 mb-0 me-3">Billing address 1</h3>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Primary</span>
                                </div>
                                <p class="mb-0">Kumasi Dekeyemso St,<br>Moshiezongo, First station,<br>GH</p>
                            </div>
                        </div>
                    </section>

                    <!-- Billing -->
                    <section class="col">
                        <div class="card h-100 border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-1 mb-lg-2">
                                    <i class="ai-wallet text-primary lead pe-1 me-2"></i>
                                    <h2 class="h4 mb-0">Billing</h2>
                                    <a class="btn btn-sm btn-secondary ms-auto" href="account-billing.html">
                                        <i class="ai-edit ms-n1 me-2"></i>
                                        Edit info
                                    </a>
                                </div>
                                <div class="d-flex align-items-center pb-1 mb-2">
                                    <h3 class="h6 mb-0 me-3">Hamza Zero</h3>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Primary</span>
                                </div>
                                <div class="d-flex align-items-center pb-4 mb-2 mb-sm-3">
                                    <svg width="52" height="42" viewBox="0 0 52 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.6402 28.2865H18.5199L21.095 12.7244H25.2157L22.6402 28.2865ZM15.0536 12.7244L11.1255 23.4281L10.6607 21.1232L10.6611 21.124L9.27467 14.1256C9.27467 14.1256 9.10703 12.7244 7.32014 12.7244H0.8262L0.75 12.9879C0.75 12.9879 2.73586 13.3942 5.05996 14.7666L8.63967 28.2869H12.9327L19.488 12.7244H15.0536ZM47.4619 28.2865H51.2453L47.9466 12.7239H44.6345C43.105 12.7239 42.7324 13.8837 42.7324 13.8837L36.5873 28.2865H40.8825L41.7414 25.9749H46.9793L47.4619 28.2865ZM42.928 22.7817L45.093 16.9579L46.3109 22.7817H42.928ZM36.9095 16.4667L37.4975 13.1248C37.4975 13.1248 35.6831 12.4463 33.7916 12.4463C31.7469 12.4463 26.8913 13.3251 26.8913 17.5982C26.8913 21.6186 32.5902 21.6685 32.5902 23.7803C32.5902 25.8921 27.4785 25.5137 25.7915 24.182L25.1789 27.6763C25.1789 27.6763 27.0187 28.555 29.8296 28.555C32.6414 28.555 36.8832 27.1234 36.8832 23.2271C36.8832 19.1808 31.1331 18.8041 31.1331 17.0449C31.1335 15.2853 35.1463 15.5113 36.9095 16.4667Z" fill="#2566AF"/>
                                    <path d="M10.6611 22.1235L9.2747 15.1251C9.2747 15.1251 9.10705 13.7239 7.32016 13.7239H0.8262L0.75 13.9874C0.75 13.9874 3.87125 14.6235 6.86507 17.0066C9.72766 19.2845 10.6611 22.1235 10.6611 22.1235Z" fill="#E6A540"/>
                                    </svg>
                                    <div class="ps-3 fs-sm">
                                        <div class="text-dark">Visa •••• 9016</div>
                                        <div class="text-body-secondary">Debit - Expires 03/24</div>
                                    </div>
                                </div>
                                <div class="alert alert-danger d-flex mb-0">
                                    <i class="ai-octagon-alert fs-xl me-2"></i>
                                    <p class="mb-0">Your primary credit card expired on 01/04/2023. Please add a new card or update this one.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Orders -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-cart text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Referrals</h2>
                            <a class="btn btn-sm btn-secondary ms-auto" href="<?= PROOT; ?>app/account-referals">View all</a>
                        </div>

                        <!-- Orders accordion -->
                        <div class="accordion accordion-alt accordion-orders" id="orders">
                            lorem  
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
<?php if ($playSound): ?>
    <script>
        function playWelcomeSound() {
            const username = <?php echo json_encode($user_data['user_fullname']); ?>;
            const msg = new SpeechSynthesisUtterance(`Levina welcome you, ${username}!`);
            msg.pitch = 1;
            msg.rate = 1;
            msg.lang = 'en-US';
            speechSynthesis.speak(msg);

            $('.page-loading').removeClass('active')
        }
    </script>
<?php endif; ?>
