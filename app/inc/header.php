
    <!-- Page wrapper -->
    <main class="page-wrapper">

        <!-- Navbar. Remove 'fixed-top' class to make the navigation bar scrollable with the page -->
        <header class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <!-- Navbar brand (Logo) -->
                <a class="navbar-brand pe-sm-3" href="index.html">
                    <img src="<?= PROOT; ?>assets/media/logo/logo.png" width="35" height="32" class="img-fluid flex-shrink-0 me-2" />
                    Lavina
                </a>

                <!-- Theme switcher -->
                <div class="form-check form-switch mode-switch order-lg-2 me-3 me-lg-4 ms-auto" data-bs-toggle="mode">
                    <input class="form-check-input" type="checkbox" id="theme-mode">
                    <label class="form-check-label" for="theme-mode">
                        <i class="ai-sun fs-lg"></i>
                    </label>
                    <label class="form-check-label" for="theme-mode">
                        <i class="ai-moon fs-lg"></i>
                    </label>
                </div>

            <!-- User signed in state. Account dropdown on screens > 576px -->
            <div class="dropdown nav d-none d-sm-block order-lg-3">
                <a class="nav-link d-flex align-items-center p-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="border rounded-circle" src="<?= PROOT; ?>assets/media/avatar.png" width="48" alt="Hamza Zero">
                    <div class="ps-2">
                        <div class="fs-xs lh-1 opacity-60">Hello,</div>
                        <div class="fs-sm dropdown-toggle">Zero</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end my-1">
                    <h6 class="dropdown-header fs-xs fw-medium text-body-secondary text-uppercase pb-1">Account</h6>
                    <a class="dropdown-item" href="<?= PROOT; ?>app/">
                        <i class="ai-user-check fs-lg opacity-70 me-2"></i>
                        Overview
                    </a>
                    <a class="dropdown-item" href="<?= PROOT; ?>app/account-settings">
                        <i class="ai-settings fs-lg opacity-70 me-2"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="<?= PROOT; ?>app/account-billing">
                        <i class="ai-wallet fs-base opacity-70 me-2 mt-n1"></i>
                        Billing
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header fs-xs fw-medium text-body-secondary text-uppercase pb-1">Dashboard</h6>
                    <a class="dropdown-item" href="<?= PROOT; ?>app/account-referrals">
                        <i class="ai-cart fs-lg opacity-70 me-2"></i>
                        Referrals
                    </a>
                    <a class="dropdown-item" href="<?= PROOT; ?>app/account-earnings">
                        <i class="ai-activity fs-lg opacity-70 me-2"></i>
                        Earnings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= PROOT; ?>auth/signout">
                        <i class="ai-logout fs-lg opacity-70 me-2"></i>
                        Sign out
                    </a>
                </div>
            </div>

            <!-- Mobile menu toggler (Hamburger) -->
            <button class="navbar-toggler ms-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar collapse (Main navigation) -->
            <nav class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-nav-scroll me-auto" style="--ar-scroll-height: 520px;">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PROOT; ?>app">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PROOT; ?>app/resources">Resources</a>
                    </li>

                    <!-- User signed in state. Account dropdown on screens > 576px -->
                    <li class="nav-item dropdown d-sm-none border-top mt-2 pt-2">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="border rounded-circle" src="<?= PROOT; ?>assets/media/avatar.png" width="48" alt="Hamza Zero">
                            <div class="ps-2">
                                <div class="fs-xs lh-1 opacity-60">Hello,</div>
                                <div class="fs-sm dropdown-toggle">Zero</div>
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <h6 class="dropdown-header fs-xs fw-medium text-body-secondary text-uppercase pb-1">Account</h6>
                            <a class="dropdown-item" href="<?= PROOT; ?>app/">
                                <i class="ai-user-check fs-lg opacity-70 me-2"></i>
                                Overview
                            </a>
                            <a class="dropdown-item" href="<?= PROOT; ?>app/account-settings">
                                <i class="ai-settings fs-lg opacity-70 me-2"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="<?= PROOT; ?>app/account-billing">
                                <i class="ai-wallet fs-base opacity-70 me-2 mt-n1"></i>
                                Billing
                            </a>
                            <h6 class="dropdown-header fs-xs fw-medium text-body-secondary text-uppercase pt-3 pb-1">Dashboard</h6>
                            <a class="dropdown-item" href="<?= PROOT; ?>app/account-referrals">
                                <i class="ai-cart fs-lg opacity-70 me-2"></i>
                                Referrals
                            </a>
                            <a class="dropdown-item" href="<?= PROOT; ?>app/account-earnings">
                                <i class="ai-activity fs-lg opacity-70 me-2"></i>
                                Earnings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= PROOT; ?>auth/signout">
                                <i class="ai-logout fs-lg opacity-70 me-2"></i>
                                Sign out
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>