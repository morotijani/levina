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
    require ('inc/left.nav.php');

    $resourcesQuery = "SELECT * FROM levina_products WHERE product_trash = ?";
    $statement = $dbConnection->prepare($resourcesQuery);
    $statement->execute([0]);
    $countResources = $statement->rowCount();
    $resources = $statement->fetchAll(PDO::FETCH_OBJ);


?>

            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <div class="d-flex align-items-center mb-4">
                    <h1 class="h2 mb-0">Resources <span class="fs-base fw-normal text-body-secondary">(<?= count_products(); ?> products)</span></h1>
                    <a class="btn btn-sm btn-outline-primary ms-auto" href="<?= PROOT; ?>app/resources">
                        <i class="ai-rotate-left ms-n1 me-2"></i>
                        Refresh
                    </a>
                </div>
                <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body pb-4">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

                            <!-- Item -->
                            <!-- <div class="col pb-2 pb-sm-3">
                                <div class="card-hover position-relative bg-secondary rounded-1 p-3 mb-4">
                                    <button class="btn btn-icon btn-sm btn-light bg-light border-0 rounded-circle position-absolute top-0 end-0 mt-3 me-3 z-5 opacity-0" type="button" aria-label="Remove">
                                        <i class="ai-show fs-xl text-dark"></i>
                                    </button>
                                    <div class="swiper swiper-nav-onhover" data-swiper-options='{"loop": true, "navigation": {"prevEl": ".btn-prev", "nextEl": ".btn-next"}}'>
                                        <a class="swiper-wrapper" href="<?= PROOT; ?>app/resources/school-management-system">
                                            <div class="swiper-slide p-2 p-xl-4">
                                                <img class="d-block mx-auto" src="<?= PROOT; ?>assets/media/product.jpg" width="226" alt="Product">
                                            </div>
                                        </a>
                                        <button class="btn btn-prev btn-icon btn-sm btn-light bg-light border-0 rounded-circle start-0" type="button" aria-label="Prev">
                                            <i class="ai-chevron-left fs-xl text-nav"></i>
                                        </button>
                                        <button class="btn btn-next btn-icon btn-sm btn-light bg-light border-0 rounded-circle end-0" type="button" aria-label="Next">
                                            <i class="ai-chevron-right fs-xl text-nav"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <h3 class="h6 mb-0">
                                        <a href="<?= PROOT; ?>app/resources/school-management-system">School management system</a>
                                    </h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">₵1006.00</span>
                                    <div class="nav ms-auto" data-bs-toggle="tooltip" data-bs-template="<div class='tooltip fs-xs' role='tooltip'><div class='tooltip-inner bg-light text-body-secondary p-0'></div></div>" data-bs-placement="left" title="Add a lead">
                                        <a class="nav-link fs-lg py-2 px-1" href="#" aria-label="Add a lead">
                                            <i class="ai-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> -->

                            <?php if ($countResources > 0): ?>
                                <?php 
                                    foreach($resources as $resource): 
                                        $product_images = explode(",", $resource->product_image);
                                        // if (count($product_images) == 1) {
                                            $product_image = '
                                                <a class="swiper-wrapper" href="' . PROOT . 'app/resources-details/'.$resource->product_url.'">
                                                    <div class="swiper-slide p-2 p-xl-4">
                                                        <img class="d-block mx-auto" src="' . PROOT . $product_images[0].'" width="" style="height: 226px; width: auto; object-fit: cover; object-position: center;" alt="Product">
                                                    </div>
                                                </a>
                                            ';
                                        // } else {
                                        //     $product_image = '<a class="swiper-wrapper" href="' . PROOT . 'app/resources-details/'.$resource->product_url.'">';
                                        //     foreach ($product_images as $pimg) {
                                        //         $product_image .= '
                                        //             <div class="swiper-slide p-2 p-xl-4">
                                        //                 <img class="d-block mx-auto" src="' . PROOT . $pimg.'" width="226" alt="Product">
                                        //             </div>
                                        //         ';
                                        //     }
                                        //     $product_image .= '</a>';
                                       // }
                                ?>
                                
                            <!-- Item -->
                            <div class="col pb-2 pb-sm-3">
                                <div class="card-hover position-relative bg-secondary rounded-1 p-3 mb-4">
                                    <span class="badge bg-success bg-opacity-10 text-success position-absolute top-0 start-0 mt-3 ms-3"><?= (($resource->product_featured == 1) ? 'Featured' : ''); ?></span>
                                    <button class="btn btn-icon btn-sm btn-light bg-light border-0 rounded-circle position-absolute top-0 end-0 mt-3 me-3 z-5 opacity-0" type="button" aria-label="Remove">
                                        <i class="ai-show fs-xl text-dark"></i>
                                    </button>
                                    <div class="swiper swiper-nav-onhover" data-swiper-options='{"loop": true, "navigation": {"prevEl": ".btn-prev", "nextEl": ".btn-next"}}'>
                                        <?= $product_image; ?>
                                        <!-- <a class="swiper-wrapper" href="shop-single.html">
                                            <div class="swiper-slide p-2 p-xl-4">
                                                <img class="d-block mx-auto" src="<?= PROOT; ?>assets/media/pos.jpeg" width="226" alt="Product">
                                            </div>
                                        </a> -->
                                        <button class="btn btn-prev btn-icon btn-sm btn-light bg-light border-0 rounded-circle start-0" type="button" aria-label="Prev">
                                            <i class="ai-chevron-left fs-xl text-nav"></i>
                                        </button>
                                        <button class="btn btn-next btn-icon btn-sm btn-light bg-light border-0 rounded-circle end-0" type="button" aria-label="Next">
                                            <i class="ai-chevron-right fs-xl text-nav"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <h3 class="h6 mb-0">
                                        <a href="<?= PROOT; ?>app/resources/pos"><?= ucwords($resource->product_name); ?></a>
                                    </h3>
                                    <div class="d-flex ps-2 mt-n1 ms-auto">
                                        <!-- <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color1" value="Dark gray" checked id="color1-1">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color1-1">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #576071;"></span>
                                            </label>
                                        </div>
                                        <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color1" value="Light gray" id="color1-2">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color1-2">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #d5d4d3;"></span>
                                            </label>
                                        </div>
                                        <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color1" value="Blue" id="color1-3">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color1-3">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #a1b7d9;"></span>
                                            </label>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2"><?= money($resource->product_price); ?></span>
                                    <?= (($resource->product_list_price != '') ? '<del class="fs-sm text-body-secondary">' . money($resource->product_list_price) . '</del>': ''); ?>
                                    <div class="nav ms-auto" data-bs-toggle="tooltip" data-bs-template="<div class='tooltip fs-xs' role='tooltip'><div class='tooltip-inner bg-light text-body-secondary p-0'></div></div>" data-bs-placement="left" title="Add a lead">
                                        <a class="nav-link fs-lg py-2 px-1" href="#" aria-label="Add a lead">
                                            <i class="ai-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                                nothing found
                            <?php endif; ?>

                            <!-- Item -->
                            <!-- <div class="col pb-2 pb-sm-3">
                                <div class="card-hover position-relative bg-secondary rounded-1 p-3 mb-4">
                                    <button class="btn btn-icon btn-sm btn-light bg-light border-0 rounded-circle position-absolute top-0 end-0 mt-3 me-3 z-5 opacity-0" type="button" aria-label="Remove">
                                        <i class="ai-show fs-xl text-dark"></i>
                                    </button>
                                    <div class="swiper swiper-nav-onhover" data-swiper-options='{"loop": true, "navigation": {"prevEl": ".btn-prev", "nextEl": ".btn-next"}}'>
                                        <a class="swiper-wrapper" href="shop-single.html">
                                            <div class="swiper-slide p-2 p-xl-4">
                                                <img class="d-block mx-auto" src="<?= PROOT; ?>assets/media/laundry.png" width="226" alt="Product">
                                            </div>
                                        </a>
                                        <button class="btn btn-prev btn-icon btn-sm btn-light bg-light border-0 rounded-circle start-0" type="button" aria-label="Prev">
                                            <i class="ai-chevron-left fs-xl text-nav"></i>
                                        </button>
                                        <button class="btn btn-next btn-icon btn-sm btn-light bg-light border-0 rounded-circle end-0" type="button" aria-label="Next">
                                            <i class="ai-chevron-right fs-xl text-nav"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <h3 class="h6 mb-0">
                                        <a href="shop-single.html">Laundry management system</a>
                                    </h3>
                                    <div class="d-flex ps-2 mt-n1 ms-auto">
                                        <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color2" value="Light gray" checked id="color2-1">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color2-1">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #d5d4d3;"></span>
                                            </label>
                                        </div>
                                        <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color2" value="Dark gray" id="color2-2">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color2-2">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #576071;"></span>
                                            </label>
                                        </div>
                                        <div class="ms-1">
                                            <input class="btn-check" type="radio" name="color2" value="Blue" id="color2-3">
                                            <label class="btn btn-icon btn-xs btn-outline-secondary rounded-circle" for="color2-3">
                                                <span class="d-block rounded-circle" style="width: .625rem; height: .625rem; background-color: #a1b7d9;"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">₵10005.00</span>
                                    <div class="nav ms-auto" data-bs-toggle="tooltip" data-bs-template="<div class='tooltip fs-xs' role='tooltip'><div class='tooltip-inner bg-light text-body-secondary p-0'></div></div>" data-bs-placement="left" title="Add a lead">
                                        <a class="nav-link fs-lg py-2 px-1" href="#" aria-label="Add a lead">
                                            <i class="ai-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
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
