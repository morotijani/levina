<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }
    $title = 'Account Earnings - Lavina - Namibra';
    $body_class = "bg-secondary";    
    $playSound = false;
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');
?>
            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <div class="d-sm-flex align-items-center mb-4">
                    <h1 class="h2 mb-4 mb-sm-0 me-4">Your earnings</h1>
                    <div class="d-flex ms-auto">
                        <button class="btn btn-secondary me-3 me-sm-4" type="button">
                            <i class="ai-download me-2 ms-n1"></i>
                            Download
                        </button>
                        <select class="form-select">
                            <option value="Last week">Last week</option>
                            <option value="Last month">Last month</option>
                            <option value="Last 3 months">Last 3 months</option>
                            <option value="Last 6 months">Last 6 months</option>
                            <option value="Last year">Last year</option>
                        </select>
                    </div>
                </div>
                <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <!-- Stats -->
                        <div class="row g-3 g-xl-4">
                            <div class="col-md-4 col-sm-6">
                                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                                    <h2 class="h6 pb-2 mb-1">Earnings (before taxes)</h2>
                                    <div class="h2 text-primary mb-2">₵842.00</div>
                                    <p class="fs-sm text-body-secondary mb-0">Sales 8/1/2023 - 8/15/2023</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                                    <h2 class="h6 pb-2 mb-1">Your balance</h2>
                                    <div class="h2 text-primary mb-2">₵735.00</div>
                                    <p class="fs-sm text-body-secondary mb-0">To be paid on 8/15/2023</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="h-100 bg-secondary rounded-3 text-center p-4">
                                    <h2 class="h6 pb-2 mb-1">Lifetime earnings</h2>
                                    <div class="h2 text-primary mb-2">₵9,156.74</div>
                                    <p class="fs-sm text-body-secondary mb-0">Based on list price</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
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