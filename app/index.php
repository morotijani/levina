<?php
    
    require ('../system/DatabaseConnector.php');
    $title = 'Dashboard - Lavina - Namibra';
    $body_class = "bg-secondary";
    require ('../system/inc/head.php');
?>

    <!-- Page wrapper -->
    <main class="page-wrapper">

        <!-- Navbar. Remove 'fixed-top' class to make the navigation bar scrollable with the page -->
        <header class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <!-- Navbar brand (Logo) -->
                <a class="navbar-brand pe-sm-3" href="index.html">
                    <img src="<?= PROOT; ?>assets/media/logo/logo.png" width="35" height="32" class="img-fluid flex-shrink-0 me-2" />
                    <!-- <span class="text-primary flex-shrink-0 me-2">
                        <svg width="35" height="32" viewBox="0 0 36 33" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M35.6,29c-1.1,3.4-5.4,4.4-7.9,1.9c-2.3-2.2-6.1-3.7-9.4-3.7c-3.1,0-7.5,1.8-10,4.1c-2.2,2-5.8,1.5-7.3-1.1c-1-1.8-1.2-4.1,0-6.2l0.6-1.1l0,0c0.6-0.7,4.4-5.2,12.5-5.7c0.5,1.8,2,3.1,3.9,3.1c2.2,0,4.1-1.9,4.1-4.2s-1.8-4.2-4.1-4.2c-2,0-3.6,1.4-4,3.3H7.7c-0.8,0-1.3-0.9-0.9-1.6l5.6-9.8c2.5-4.5,8.8-4.5,11.3,0L35.1,24C36,25.7,36.1,27.5,35.6,29z"></path>
                        </svg>
                    </span> -->
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
                                <img class="d-block rounded-circle mb-2" src="<?= PROOT; ?>assets/media/avatar.png" width="80" alt="Hamza Zero">
                                <h3 class="h5 mb-1">Hamza Zero</h3>
                                <p class="fs-sm text-body-secondary mb-0">zero@lavina.com</p>
                            </div>
                            <nav class="nav flex-column pb-2 pb-lg-4 mb-3">
                                <h4 class="fs-xs fw-medium text-body-secondary text-uppercase pb-1 mb-2">Account</h4>
                                <a class="nav-link fw-semibold py-2 px-0 active" href="<?= PROOT; ?>app/">
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
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-referrals">
                                    <i class="ai-cart fs-5 opacity-60 me-2"></i>
                                    Referrals
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="<?= PROOT; ?>app/account-earnings">
                                    <i class="ai-activity fs-5 opacity-60 me-2"></i>
                                    Earnings
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0" href="account-favorites.html">
                                    <i class="ai-heart fs-5 opacity-60 me-2"></i>
                                    Favorites
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
                    email@example.com
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
                    <td class="border-0 text-dark fw-medium py-1 ps-3">Female</td>
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
              <p class="mb-0">314 Robinson Lane,<br>Wilmington, DE 19805,<br>USA</p>
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
