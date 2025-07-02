<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }
    $title = 'Account Referrals - Lavina - Namibra';
    $body_class = "bg-secondary";
    $playSound = false;
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');

    //
    $sql = "
        SELECT *, levina_leads.createdAt AS ldate FROM levina_leads 
        INNER JOIN  levina_products 
        ON levina_products.product_id = levina_leads.lead_product
        WHERE lead_added_by = ? 
        ORDER BY levina_leads.createdAt DESC
    ";
    $statement = $dbConnection->prepare($sql);
    $statement->execute([$user_id]);
    $row_count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_OBJ);
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

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($row_count > 0): ?>
                                    <?php 
                                        $i = 1; foreach ($rows as $row): 
                                            $status = '';
                                            if ($row->lead_status == 0) {
                                                $status = '<span class="badge bg-danger bg-opacity-10 text-danger">Sent</span>';
                                            } else if ($row->lead_status == 1) {
                                                $status = '<span class="badge bg-warning bg-opacity-10 text-warning">Pending</span>';
                                            } else if ($row->lead_status == 2) {
                                                $status = '<span class="badge bg-success bg-opacity-10 text-success">Accepted</span>';
                                            }
                                    ?>
                                        <tr>
                                            <td><?= ucwords($row->lead_name); ?></td>
                                            <td><?= $row->lead_email; ?></td>
                                            <td><?= ucwords($row->lead_company); ?></td>
                                            <td><?= ucwords($row->product_name); ?></td>
                                            <td><?= money($row->product_price); ?></td>
                                            <td><?= $status; ?></td>
                                            <td><?= pretty_date_notime($row->ldate); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php $i++; endforeach; ?>     
                                <?php else: ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    <!-- Pagination -->
                        <!-- <div class="d-sm-flex align-items-center pt-4 pt-sm-5">
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
                        </div> -->
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