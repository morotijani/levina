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

            <!-- Product gallery + Details + Options -->
            <section class="container py-5 mt-5 mb-sm-2 mb-lg-3 mb-xl-4 mb-xxl-5">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="pt-lg-3 pb-2 pb-md-4 breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="shop-catalog.html">Resources</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ucwords($row->product_name); ?></li>
                    </ol>
                </nav>

                    <!-- Title + price shown on screens < 768px -->
                    <h2 class="h1 d-md-none">Scented candle</h2>
                    <div class="d-flex d-md-none align-items-center pb-3 mb-3">
                    <div class="h3 mb-0 me-3">$14.00</div>
                    <del class="fs-5 fw-medium text-body-secondary me-3">$19.00</del>
                    <span class="badge bg-danger bg-opacity-10 text-danger d-md-none">Sale</span>
                    </div>

            <div class="row pb-sm-1 pb-md-4">

          <!-- Gallery -->
          <div class="col-md-6 gallery mb-3 mb-md-0">

            <!-- Item -->
            <a class="d-block gallery-item card-hover zoom-effect mb-4" href="assets/img/shop/single/gallery/01.png">
              <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
              </div>
              <div class="zoom-effect-wrapper rounded-1">
                <div class="zoom-effect-img bg-secondary p-4">
                  <img class="d-block mx-auto" src="assets/img/shop/single/gallery/01.png" width="562" alt="Candle image #1">
                </div>
              </div>
            </a>

            <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">

              <!-- Item -->
              <div class="col">
                <a class="d-block gallery-item card-hover zoom-effect" href="assets/img/shop/single/gallery/01.png">
                  <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                    <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
                  </div>
                  <div class="zoom-effect-wrapper rounded-1">
                    <div class="zoom-effect-img bg-secondary p-4">
                      <img class="d-block mx-auto" src="assets/img/shop/single/gallery/th01.png" width="226" alt="Candle image #2">
                    </div>
                  </div>
                </a>
              </div>

              <!-- Item -->
              <div class="col">
                <a class="d-block gallery-item card-hover zoom-effect" href="assets/img/shop/single/gallery/02.png">
                  <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                    <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
                  </div>
                  <div class="zoom-effect-wrapper rounded-1">
                    <div class="zoom-effect-img bg-secondary p-4">
                      <img class="d-block mx-auto" src="assets/img/shop/single/gallery/th02.png" width="226" alt="Candle image #3">
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <!-- Item -->
            <a class="d-block gallery-item card-hover zoom-effect" href="assets/img/shop/single/gallery/03.png">
              <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 rounded-1 overflow-hidden z-2 opacity-0">
                <i class="ai-zoom-in fs-2 text-white position-relative z-2"></i>
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-20"></div>
              </div>
              <div class="zoom-effect-wrapper rounded-1">
                <div class="zoom-effect-img bg-secondary p-4">
                  <img class="d-block mx-auto" src="assets/img/shop/single/gallery/03.png" width="460" alt="Candle image #4">
                </div>
              </div>
            </a>
          </div>

          <!-- Product details -->
          <div class="col-md-6 col-xl-5 offset-xl-1">
            <div class="d-none d-md-block" style="margin-top: -90px;"></div>
            <div class="position-md-sticky top-0 ps-md-4 ps-lg-5 ps-xl-0">
              <div class="d-none d-md-block" style="padding-top: 90px;"></div>
              <div class="d-flex align-items-center pt-3 py-3">
                <span class="badge bg-danger bg-opacity-10 text-danger d-none d-md-inline-block me-4">Sale</span>
                <span class="fs-sm">V00273124</span>
              </div>
              <h1 class="d-none d-md-inline-block pb-1 mb-2">Scented candle</h1>
              <p class="fs-sm mb-4">Find aute irure reprehenderit in voluptate velit esse cillum dolore eu fugiatnulla pariatur neque congue aliqua dolor do amet sint ovar velit.</p>
              <div class="d-none d-md-flex align-items-center pb-3 mb-3">
                <div class="h3 mb-0 me-3">$14.00</div>
                <del class="fs-5 fw-medium text-body-secondary">$19.00</del>
              </div>

              <!-- Color button selector -->
              <div class="h6">
                Color:<span class="text-body-secondary fw-normal ms-1" id="colorOption">Gray concrete</span>
              </div>
              <div class="d-flex pb-3">
                <div class="me-2 mb-2">
                  <input class="btn-check" type="radio" name="color" data-binded-label="colorOption" value="Gray concrete" checked id="color1">
                  <label class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" for="color1">
                    <span class="d-block bg-size-cover bg-position-center rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #c0c0c0; background-image: url(../assets/img/shop/pattern/marble.jpg);"></span>
                  </label>
                </div>
                <div class="me-2 mb-2">
                  <input class="btn-check" type="radio" name="color" data-binded-label="colorOption" value="Soft beige" id="color2">
                  <label class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" for="color2">
                    <span class="d-block rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #d9c9a1;"></span>
                  </label>
                </div>
                <div class="me-2 mb-2">
                  <input class="btn-check" type="radio" name="color" data-binded-label="colorOption" value="Bluish sky" id="color3">
                  <label class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" for="color3">
                    <span class="d-block rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #a1b7d9;"></span>
                  </label>
                </div>
                <div class="me-2 mb-2">
                  <input class="btn-check" type="radio" name="color" data-binded-label="colorOption" value="Green grass" id="color4">
                  <label class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" for="color4">
                    <span class="d-block rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #74947d;"></span>
                  </label>
                </div>
                <div class="me-2 mb-2">
                  <input class="btn-check" type="radio" name="color" data-binded-label="colorOption" value="Woody brown" id="color5">
                  <label class="btn btn-icon btn-sm btn-outline-secondary rounded-circle" for="color5">
                    <span class="d-block bg-size-cover bg-position-center rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #af8352; background-image: url(../assets/img/shop/pattern/wood.jpg);"></span>
                  </label>
                </div>
              </div>

              <!-- Weight button selector -->
              <div class="h6">Weight</div>
              <div class="d-flex">
                <div class="me-3">
                  <input class="btn-check" type="radio" name="weight" value="140 g" checked id="weight1">
                  <label class="btn btn-outline-secondary px-2" for="weight1">
                    <span class="mx-1">140 g</span>
                  </label>
                </div>
                <div class="me-3">
                  <input class="btn-check" type="radio" name="weight" value="260 g" id="weight2">
                  <label class="btn btn-outline-secondary px-2" for="weight2">
                    <span class="mx-1">260 g</span>
                  </label>
                </div>
                <div class="me-3">
                  <input class="btn-check" type="radio" name="weight" value="440 g" id="weight3">
                  <label class="btn btn-outline-secondary px-2" for="weight3">
                    <span class="mx-1">440 g</span>
                  </label>
                </div>
              </div>

              <!-- Action buttons -->
              <div class="d-sm-flex d-md-block d-lg-flex py-4 py-md-5 my-3 my-md-0 mt-lg-0 mb-lg-4">
                <div class="count-input bg-gray rounded-3 me-4 mb-3 mb-sm-0 mb-md-3 mb-lg-0">
                  <button class="btn btn-icon btn-lg fs-xl" type="button" data-decrement>-</button>
                  <input class="form-control" type="number" value="1" readonly>
                  <button class="btn btn-icon btn-lg fs-xl" type="button" data-increment>+</button>
                </div>
                <div class="d-flex align-items-center">
                  <button class="btn btn-lg btn-primary w-100 w-lg-auto me-2" type="button"><i class="ai-cart me-2 ms-n1"></i>Add to cart</button>
                  <div class="nav">
                    <a class="nav-link fs-3 px-3" href="#" data-bs-toggle="tooltip" title="Add to Favorites" aria-label="Add to Favorites">
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

<?php require('../system/inc/footer.php'); ?>
