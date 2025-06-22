<?php
    
    require ('../system/DatabaseConnector.php');
    $title = 'Account Referrals - Lavina - Namibra';
    $body_class = "bg-secondary";
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');
?>
            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <div class="d-flex align-items-center mb-4">
                    <h1 class="h2 mb-0">Referrals</h1>
                    <select class="form-select ms-auto" style="max-width: 200px;">
                        <option value="All tme">For all time</option>
                        <option value="Last week">Last week</option>
                        <option value="Last month">Last month</option>
                        <option value="Last month">Last month</option>
                        <option value="In progress">In progress</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
                <div class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body pb-4">

                        <!-- Orders accordion -->
                        <div class="accordion accordion-alt accordion-orders" id="orders">

                            <!-- Order -->
                            <div class="accordion-item border-top mb-0">
                                <div class="accordion-header">
                                    <a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderOne" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderOne">
                                        <div class="d-flex justify-content-between w-100" style="max-width: 440px;">
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary">#78A6431D409</div>
                                                <span class="badge bg-info bg-opacity-10 text-info fs-xs">In progress</span>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="d-none d-sm-block fs-sm text-body-secondary mb-2">Order date</div>
                                                <div class="d-sm-none fs-sm text-body-secondary mb-2">Date</div>
                                                <div class="fs-sm fw-medium text-dark">Jan 27, 2023</div>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                <div class="fs-sm fw-medium text-dark">$16.00</div>
                                            </div>
                                        </div>
                                        <div class="accordion-button-img d-none d-sm-flex ms-auto">
                                            <div class="mx-1">
                                                <img src="<?= PROOT; ?>assets/media/product.jpg" width="48" alt="Product">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="accordion-collapse collapse" id="orderOne" data-bs-parent="#orders">
                                    <div class="accordion-body">
                                        <div class="table-responsive pt-1">
                                            <table class="table align-middle w-100" style="min-width: 450px;">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-0 py-1 px-0">
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-inline-block flex-shrink-0 bg-secondary rounded-1 p-md-2 p-lg-3" href="shop-single.html">
                                                                    <img src="<?= PROOT; ?>assets/media/product.jpg" width="110" alt="Product">
                                                                </a>
                                                                <div class="ps-3 ps-sm-4">
                                                                    <h4 class="h6 mb-2">
                                                                        <a href="shop-single.html">Candle in concrete bowl</a>
                                                                    </h4>
                                                                    <div class="text-body-secondary fs-sm me-3">Color: <span class="text-dark fw-medium">Gray night</span></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Quantity</div>
                                                            <div class="fs-sm fw-medium text-dark">1</div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Price</div>
                                                            <div class="fs-sm fw-medium text-dark">$16</div>
                                                        </td>
                                                        <td class="border-0 text-end py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                            <div class="fs-sm fw-medium text-dark">$16</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="bg-secondary rounded-1 p-4 my-2">
                                            <div class="row">
                                                <div class="col-sm-5 col-md-3 col-lg-4 mb-3 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Payment:</div>
                                                    <div class="fs-sm">Upon the delivery</div>
                                                    <a class="btn btn-link py-1 px-0 mt-2" href="#">
                                                        <i class="ai-time me-2 ms-n1"></i>
                                                        Order history
                                                    </a>
                                                </div>
                                                <div class="col-sm-7 col-md-5 mb-4 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Delivery address:</div>
                                                    <div class="fs-sm">401 Magnetic Drive Unit 2,<br>Toronto, Ontario, M3J 3H9, Canada</div>
                                                </div>
                                                <div class="col-md-4 col-lg-3 text-md-end">
                                                    <button class="btn btn-sm btn-outline-primary w-100 w-md-auto" type="button">
                                                        <i class="ai-star me-2 ms-n1"></i>
                                                        Leave a review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <!-- Order -->
                            <div class="accordion-item border-top border-bottom mb-0">
                                <div class="accordion-header">
                                    <a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed" href="#orderFour" data-bs-toggle="collapse" aria-expanded="false" aria-controls="orderFour">
                                        <div class="d-flex justify-content-between w-100" style="max-width: 440px;">
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary">#502TR872W2</div>
                                                <span class="badge bg-primary bg-opacity-10 text-primary fs-xs">Delivered</span>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="d-none d-sm-block fs-sm text-body-secondary mb-2">Order date</div>
                                                <div class="d-sm-none fs-sm text-body-secondary mb-2">Date</div>
                                                <div class="fs-sm fw-medium text-dark">May 11, 2023</div>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                <div class="fs-sm fw-medium text-dark">$17.00</div>
                                            </div>
                                        </div>
                                        <div class="accordion-button-img d-none d-sm-flex ms-auto">
                                            <div class="mx-1">
                                                <img src="<?= PROOT; ?>assets/media/product.jpg" width="48" alt="Product">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="accordion-collapse collapse" id="orderFour" data-bs-parent="#orders">
                                    <div class="accordion-body">
                                        <div class="table-responsive pt-1">
                                            <table class="table align-middle w-100" style="min-width: 450px;">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-0 py-1 px-0">
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-inline-block flex-shrink-0 bg-secondary rounded-1 p-md-2 p-lg-3" href="shop-single.html">
                                                                    <img src="<?= PROOT; ?>assets/media/product.jpg" width="110" alt="Product">
                                                                </a>
                                                                <div class="ps-3 ps-sm-4">
                                                                    <h4 class="h6 mb-2">
                                                                        <a href="shop-single.html">Dispenser for soap</a>
                                                                    </h4>
                                                                    <div class="text-body-secondary fs-sm me-3">Color: <span class="text-dark fw-medium">White marble</span></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Quantity</div>
                                                            <div class="fs-sm fw-medium text-dark">1</div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Price</div>
                                                            <div class="fs-sm fw-medium text-dark">$17</div>
                                                        </td>
                                                        <td class="border-0 text-end py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                            <div class="fs-sm fw-medium text-dark">$17</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="bg-secondary rounded-1 p-4 my-2">
                                            <div class="row">
                                                <div class="col-sm-5 col-md-3 col-lg-4 mb-3 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Payment:</div>
                                                    <div class="fs-sm">Upon the delivery</div>
                                                    <a class="btn btn-link py-1 px-0 mt-2" href="#">
                                                        <i class="ai-time me-2 ms-n1"></i>
                                                        Order history
                                                    </a>
                                                </div>
                                                <div class="col-sm-7 col-md-5 mb-4 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Delivery address:</div>
                                                    <div class="fs-sm">401 Magnetic Drive Unit 2,<br>Toronto, Ontario, M3J 3H9, Canada</div>
                                                </div>
                                                <div class="col-md-4 col-lg-3 text-md-end">
                                                    <button class="btn btn-sm btn-outline-primary w-100 w-md-auto" type="button">
                                                        <i class="ai-star me-2 ms-n1"></i>
                                                        Leave a review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Pagination -->
                        <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
                            <nav class="order-sm-2 ms-sm-auto mb-4 mb-sm-0" aria-label="Orders pagination">
                                <ul class="pagination pagination-sm justify-content-center">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">1<span class="visually-hidden">(current)</span></span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                </ul>
                            </nav>
                            <button class="btn btn-primary w-100 w-sm-auto order-sm-1 ms-sm-auto me-sm-n5" type="button">Load more orders</button>
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