<?php
    require ('../system/DatabaseConnector.php');
    // if (!admin_is_logged_in()) {
    //     admin_login_redirect();
    // }
    include ('includes/header.php');
    include ('includes/left-nav.php'); 

    // delete class_implements
    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $delete_client_id = $_GET['delete'];
        $deleteQuery = "
            DELETE FROM levina_leads 
            WHERE lead_id = ?
        ";
        $statement = $dbConnection->prepare($deleteQuery);
        $statement->execute([$delete_client_id]);
        $deleteCount = $statement->rowCount();
        if ($deleteCount > 0) {
            $_SESSION['flash_success'] = 'Client deleted successfully!';
            redirect(PROOT . 'admin/clients');
        } else {
            $_SESSION['flash_error'] = 'Client not deleted!';
            redirect(PROOT . 'admin/clients');
        }
    }

    // get all clients
    $usersQuery = "
        SELECT * FROM levina_leads 
        INNER JOIN levina_products 
        ON levina_products.product_id = levina_leads.lead_product 
        INNER JOIN levina_users 
        ON levina_users.user_id = levina_leads.lead_added_by
        ORDER BY levina_leads.createdAt DESC
    ";
    $statement = $dbConnection->prepare($usersQuery);
    $statement->execute();
    $clients = $statement->fetchAll(PDO::FETCH_OBJ);
    $clientsCount = $statement->rowCount();

?>
      
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
                    <h1 class="h2">Clients</h1> 
                    <div class="btn-toolbar mb-2 mb-md-0"> 
                        <div class="btn-group me-2"> 
                            <a href="<?= PROOT; ?>admin" class="btn btn-sm btn-outline-secondary">Dashboard</a> <a href="<?= goBack(); ?>" class="btn btn-sm btn-outline-secondary">GO back</a>
                        </div> 
                        <a href="<?= PROOT; ?>admin/clients" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1"> 
                            <svg class="bi" aria-hidden="true"><use xlink:href="#calendar3"></use></svg>
                            Refresh
                        </a> 
                    </div> 
                </div>

                <?php 
                    if (isset($_GET['view']) && !empty($_GET['view'])): 
                        $client_id = $_GET['view'];
                        $clientQuery = "
                            SELECT *, product_name, user_fullname FROM levina_leads 
                            INNER JOIN levina_products 
                            ON levina_products.product_id = levina_leads.lead_product 
                            INNER JOIN levina_users 
                            ON levina_users.user_id = levina_leads.lead_added_by
                            WHERE lead_id = ? 
                            ORDER BY levina_leads.createdAt DESC 
                            LIMIT 1
                        ";
                        $statement = $dbConnection->prepare($clientQuery);
                        $statement->execute([$client_id]);
                        $clientCount = $statement->rowCount();
                        $client = $statement->fetch(PDO::FETCH_OBJ);
                ?>
                <?php 
                    if ($clientCount > 0) { 
                        // update client status to 1
                        $updateQuery = "
                            UPDATE levina_leads
                            SET lead_status = 1
                            WHERE lead_id = :lead_id
                        ";
                        $statement = $dbConnection->prepare($updateQuery);
                        $statement->execute([':lead_id' => $client_id]);
                        $updateCount = $statement->rowCount();
                        if ($updateCount > 0) {
                            $_SESSION['flash_success'] = 'Client status updated to active';
                            redirect(PROOT . 'admin/clients');
                        } else {
                            $_SESSION['flash_error'] = 'Client status not updated';
                            redirect(PROOT . 'admin/clients');
                        }
                ?>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Client Details</h4>
                        <hr>
                        <p class="mb-0">
                            <strong>Name: </strong>
                            <span class="text-success"><?= ucwords($client->lead_name); ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Email: </strong>
                            <span class="text-success"><?= $client->lead_email; ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Company: </strong>
                            <span class="text-success"><?= $client->lead_company; ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Website: </strong>
                            <span class="text-success"><?= $client->lead_website; ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Number: </strong>
                            <span class="text-success"><?= $client->lead_number; ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Note: </strong>
                            <span class="text-success"><?= $client->lead_note; ?></span>
                        </p>
                        <p class="mb-0">
                            <strong>Date: </strong>
                            <span class="text-success"><?= pretty_date_notime($client->createdAt); ?></span>
                        </p>
                    </div>
                    <?php 
                        } else {
                            $_SESSION['flash_error'] = 'Client not found';
                            redirect(PROOT . 'admin/clients');
                        }
                    ?>
                <?php else: ?>
                <!-- <h2>Section title</h2>  -->
                <div class="table-responsive small"> 
                    <table class="table table-striped table-bordered table-lg"> 
                        <thead> 
                            <tr> 
                                <th scope="col">#</th> 
                                <th scope="col">Name</th> 
                                <th scope="col">Email</th> 
                                <th scope="col">Number</th> 
                                <th scope="col">Product</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if ($clientsCount > 0): ?>
                                <?php $i = 1; foreach ($clients as $client): ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($client->lead_name); ?></td>
                                        <td><?= $client->lead_email; ?></td>
                                        <td><?= $client->lead_number; ?></td>
                                        <td>
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#productModal">
                                                <?= ucwords($client->product_name); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#userModal">
                                                <?= ucwords($client->user_fullname); ?></td>
                                            </a>
                                        <td><?= pretty_date_notime($client->createdAt); ?></td>
                                        <td>
                                            <a href="<?= PROOT; ?>admin/clients?view=<?= $client->user_id; ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                            <a href="javascript:;" onclick="deleteClient('<?= $client->client_id; ?>')" class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>

                                    <?php 
                                        // get user primary payment methods
                                        $methodQUery = "
                                            SELECT * FROM levina_payment_methods 
                                            WHERE payment_method_user_id = ? 
                                            AND payment_method_status = ?
                                        ";
                                        $statement = $dbConnection->prepare($methodQUery);
                                        $statement->execute([$client->user_id, 0]);
                                        $methodCount = $statement->rowCount();
                                        $method = $statement->fetch(PDO::FETCH_OBJ);

                                    ?>

                                    <!-- USER MODAL -->
                                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="userModalLabel">User details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><?= ucwords($client->user_fullname); ?></li>
                                                        <li class="list-group-item"><?= $client->user_email; ?></li>
                                                        <li class="list-group-item"><?= $client->user_phone; ?></li>
                                                        <li class="list-group-item"><?= $client->user_address; ?></li>
                                                        <!-- PAYMENT MOTHOD -->
                                                        <li class="list-group-item active" aria-current="true">Payment Methid</li>
                                                        <li class="list-group-item"><?= $method->payment_method_name; ?></li>
                                                        <li class="list-group-item"><?= $method->payment_method_number; ?></li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PRODUCT MODAL -->
                                    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="productModalLabel">Product details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><?= ucwords($client->product_name); ?></li>
                                                        <li class="list-group-item"><?= money($client->product_price); ?></li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No clients found</td>
                                </tr>    
                            <?php endif; ?>
                        </tbody> 
                    </table> 
                </div>
                <?php endif; ?>


<?php include('includes/footer.php'); ?>
<script>
    function deleteClient(id) {
        alert(id);
    }
</script>
