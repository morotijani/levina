<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }
    $title = 'Resources - Lavina - Namibra';
    $body_class = "bg-secondary";
    $playSound = false;
    require ('../system/inc/head.php');
    require ('inc/header.php');

    if (isset($_GET['url']) && !empty($_GET['url'])) {
        $url = sanitize($_GET['url']);

        $sql = "
            SELECT * FROM levina_products 
            WHERE product_url = ? 
            AND product_trash = ?
        ";
        $statement = $dbConnection->prepare($sql);
        $statement->execute([$url, 0]);

        if ($statement->rowCount() > 0) {
            $rows = $statement->fetchAll(PDO::FETCH_OBJ);
            $row = $rows[0];
        }
    } else {
        redirect(PROOT . 'app/resources');
    }

?>

    <link rel="stylesheet" media="screen" href="<?= PROOT; ?>assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" media="screen" href="<?= PROOT; ?>assets/css/lightgallery-bundle.min.css">

            <!-- Add new address modal -->
            <div class="modal fade" id="addAddress" data-bs-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h4 class="modal-title">Add new address</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body needs-validation pt-0" novalidate>
                            <div class="alert alert-warning d-flex mb-4">
                                <i class="ai-triangle-alert fs-xl me-2"></i>
                                <p class="mb-0">Updating your address may affect your <a href="#" class="alert-link">Tax Location</a></p>
                            </div>
                            <div class="row row-cols-1 row-cols-lg-2 g-4 pb-2 pb-sm-3 mb-4">
                                <div class="col">
                                    <label class="form-label" for="country">Country</label>
                                    <select class="form-select" required id="country">
                                        <option value="" disabled selected>Select a country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="city">City</label>
                                    <select class="form-select" required id="city">
                                        <option value="" disabled selected>Select a city</option>
                                        <option value="Sydney">Sydney</option>
                                        <option value="Brussels">Brussels</option>
                                        <option value="Toronto">Toronto</option>
                                        <option value="Copenhagen">Copenhagen</option>
                                        <option value="New York">New York</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="state">State</label>
                                    <select class="form-select" required id="state">
                                        <option value="" disabled selected>Select a state</option>
                                        <option value="Arizona">Arizona</option>
                                        <option value="California">California</option>
                                        <option value="Florida">Florida</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Texas">Texas</option>
                                        <option value="Virginia">Virginia</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="address1">Address line 1</label>
                                    <input class="form-control" type="text" required id="address1">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="address2">Address line 2</label>
                                    <input class="form-control" type="text" id="address2">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="postcode">Post code</label>
                                    <input class="form-control" type="text" data-format="{&quot;delimiter&quot;: &quot;-&quot;, &quot;blocks&quot;: [3, 4], &quot;uppercase&quot;: true}" placeholder="XXX-XXXX" id="postcode">
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="set-primary">
                                    <label class="form-check-label text-dark fw-medium" for="set-primary">Set as primary billing address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row">
                                <button class="btn btn-secondary mb-3 mb-sm-0" type="reset" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary ms-sm-3" type="submit">Add lead</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  -->

            <!-- Product gallery + Details + Options -->
            <section class="container py-5 mt-5 mb-sm-2 mb-lg-3 mb-xl-4 mb-xxl-5">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="pt-lg-3 pb-2 pb-md-4 breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= PROOT; ?>app/">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= PROOT; ?>app/resources">Resources</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ucwords($row->product_name); ?></li>
                    </ol>
                </nav>

                <!-- Title + price shown on screens < 768px -->
                <h2 class="h1 d-md-none"><?= ucwords($row->product_name); ?></h2>
                <div class="d-flex d-md-none align-items-center pb-3 mb-3">
                    <div class="h3 mb-0 me-3"><?= money($row->product_price); ?></div>
                    <?php if ($row->product_list_price != ''): ?>
                    <del class="fs-5 fw-medium text-body-secondary me-3"><?= $row->product_list_price; ?></del>
                    <?php endif; ?>
                    <?php if ($row->product_featured): ?>
                    <span class="badge bg-danger bg-opacity-10 text-danger d-md-none">Featured</span>
                    <?php endif; ?>
                </div>

                <div class="row pb-sm-1 pb-md-4">

                    <!-- Gallery -->
                    <div class="col-md-6 gallery mb-3 mb-md-0">

                    <?php 
                        // Convert string to array
                        $imageArray = explode(',', $row->product_image);

                        // Get the first image
                        $firstImage = $imageArray[0];

                        // Get the rest of the images
                        $remainingImages = array_slice($imageArray, 1);

                    ?>

                        <!-- Item -->
                        <a class="d-block gallery-item card-hover zoom-effect mb-4" href="<?= PROOT . $firstImage; ?>">
                            <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                                <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
                            </div>
                            <div class="zoom-effect-wrapper rounded-1">
                                <div class="zoom-effect-img bg-secondary p-4">
                                <img class="d-block mx-auto" src="<?= PROOT . $firstImage; ?>" width="562" alt="<?= ucwords($row->product_name); ?> #1">
                                </div>
                            </div>
                        </a>

                        <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">

                        <!-- Item -->
                        <?php foreach ($imageArray as $img): ?>
                        <div class="col">
                            <a class="d-block gallery-item card-hover zoom-effect" href="<?= PROOT . $img; ?>">
                                <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                                    <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
                                </div>
                                <div class="zoom-effect-wrapper rounded-1">
                                    <div class="zoom-effect-img bg-secondary p-4">
                                    <img class="d-block mx-auto" src="<?= PROOT . $img; ?>" width="226" alt="<?= ucwords($row->product_name); ?> #2">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Product details -->
                <div class="col-md-6 col-xl-5 offset-xl-1">
                    <div class="d-none d-md-block" style="margin-top: -90px;"></div>
                    <div class="position-md-sticky top-0 ps-md-4 ps-lg-5 ps-xl-0">
                        <div class="d-none d-md-block" style="padding-top: 90px;"></div>
                        <div class="d-flex align-items-center pt-3 py-3">
                            <?php if ($row->product_featured == 1): ?>
                            <span class="badge bg-danger bg-opacity-10 text-danger d-none d-md-inline-block me-4">Featured</span>
                            <?php endif; ?>
                            <span class="fs-sm"><?= $row->product_id; ?></span>
                        </div>
                        <h1 class="d-none d-md-inline-block pb-1 mb-2"><?= ucwords($row->product_name); ?></h1>
                        <p class="fs-sm mb-4"><?= $row->product_description; ?></p>
                        <div class="d-none d-md-flex align-items-center pb-3 mb-3">
                            <div class="h3 mb-0 me-3"><?= money($row->product_price); ?></div>
                            <?php if ($row->product_list_price != '0.00'): ?>
                            <del class="fs-5 fw-medium text-body-secondary"><?= money($row->product_list_price); ?></del>
                            <?php endif; ?>
                        </div>

                        <!-- Action buttons -->
                        <div class="d-sm-flex d-md-block d-lg-flex py-4 py-md-5 my-3 my-md-0 mt-lg-0 mb-lg-4">
                            <div class="d-flex align-items-center">
                                <a href="#addAddress" data-bs-toggle="modal" class="btn btn-lg btn-primary w-100 w-lg-auto me-2" type="button"><i class="bi bi-person-add me-2 ms-n1"></i>Add lead</a>
                                <div class="nav">
                                    <a class="nav-link fs-3 px-3" href="#" data-bs-toggle="tooltip" title="Add to likes" aria-label="Like">
                                        <i class="ai-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Sharing -->
                        <div class="d-flex align-items-center">
                            <h4 class="h6 me-4">Share product:</h4>
                            <a class="btn btn-secondary btn-icon btn-sm btn-telegram rounded-circle me-3 mb-3" href="#" aria-label="Telegram">
                                <i class="ai-telegram"></i>
                            </a>
                            <a class="btn btn-secondary btn-icon btn-sm btn-instagram rounded-circle me-3 mb-3" href="#" aria-label="Instagram">
                                <i class="ai-instagram"></i>
                            </a>
                            <a class="btn btn-secondary btn-icon btn-sm btn-facebook rounded-circle mb-3" href="#" aria-label="Facebook">
                                <i class="ai-facebook"></i>
                            </a>
                        </div>
                    </div>
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

    <script src="<?= PROOT; ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/lightgallery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/lg-fullscreen.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/lg-zoom.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/lg-thumbnail.min.js"></script>
<?php require('../system/inc/footer.php'); ?>
