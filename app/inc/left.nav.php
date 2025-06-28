    <!-- Page container -->
    <div class="container py-5 mt-4 mt-lg-5 mb-lg-4 my-xl-5">
        <div class="row pt-sm-2 pt-lg-0">

            <!-- Sidebar (offcanvas on sreens < 992px) -->
            <aside class="col-lg-3 pe-lg-4 pe-xl-5 mt-n3">
                <div class="position-lg-sticky top-0">
                    <div class="d-none d-lg-block" style="padding-top: 105px;"></div>
                    <div class="offcanvas-lg offcanvas-start" id="sidebarAccount">
                        <button class="btn-close position-absolute top-0 end-0 mt-3 me-3 d-lg-none" type="button" data-bs-dismiss="offcanvas" data-bs-target="#sidebarAccount" aria-label="Close"></button>
                        <div class="offcanvas-body">
                            <div class="pb-2 pb-lg-0 mb-4 mb-lg-5">
                                <img class="d-block rounded-circle mb-2" src="<?= PROOT . (($user_data['user_profile'] == null) ? 'assets/media/avatar.png' : $user_data['user_profile']); ?>" width="80" style="height: 80px; width: 80px; object-fit: cover; object-position: center;" alt="Hamza Zero">
                                <h3 class="h5 mb-1"><?= ucwords($user_data['user_fullname']); ?>!</h3>
                                <p class="fs-sm text-body-secondary mb-0"><?= $user_data['user_email']; ?></p>
                            </div>
                            <nav class="nav flex-column pb-2 pb-lg-4 mb-3">
                                <h4 class="fs-xs fw-medium text-body-secondary text-uppercase pb-1 mb-2">Account</h4>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/">
                                    <i class="ai-user-check fs-5 opacity-60 me-2"></i>
                                    Overview
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-settings">
                                    <i class="ai-settings fs-5 opacity-60 me-2"></i>
                                    Settings
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-billing">
                                    <i class="ai-wallet fs-5 opacity-60 me-2"></i>
                                    Billing
                                </a>
                            </nav>
                            <nav class="nav flex-column pb-2 pb-lg-4 mb-1">
                                <h4 class="fs-xs fw-medium text-body-secondary text-uppercase pb-1 mb-2">Dashboard</h4>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/resources">
                                    <i class="ai-bulb fs-5 opacity-60 me-2"></i>
                                    Resources
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-referrals">
                                    <i class="ai-target fs-5 opacity-60 me-2"></i>
                                    Referrals
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-earnings">
                                    <i class="ai-activity fs-5 opacity-60 me-2"></i>
                                    Earnings
                                </a>
                            </nav>
                            <nav class="nav flex-column">
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>auth/signout">
                                    <i class="ai-logout fs-5 opacity-60 me-2"></i>
                                    Sign out
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>