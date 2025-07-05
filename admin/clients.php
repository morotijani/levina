<?php
    require ('../system/DatabaseConnector.php');
    // if (!admin_is_logged_in()) {
    //     admin_login_redirect();
    // }
    include ('includes/header.php');
    include ('includes/left-nav.php');

    // get all clients
    $usersQuery = "
        SELECT *, product_name, user_fullname FROM levina_leads 
        INNER JOIN levina_products 
        ON levina_products.product_id = levina_leads.lead_product 
        INNER JOIN levina_users 
        ON levina_users.user_id = levina_leads.lead_added_by
        WHERE lead_status = ? 
        ORDER BY levina_leads.createdAt DESC
    ";
    $statement = $dbConnection->prepare($usersQuery);
    $statement->execute([0]);
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

                <!-- <h2>Section title</h2>  -->
                <div class="table-responsive small"> 
                    <table class="table table-striped table-bordered table-lg"> 
                        <thead> 
                            <tr> 
                                <th scope="col">#</th> 
                                <th scope="col">Name</th> 
                                <th scope="col">Email</th> 
                                <th scope="col">Company</th> 
                                <th scope="col">Website</th>
                                <th scope="col">Number</th>
                                <th scope="col">Note</th>
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
                                        <td><?= $client->lead_company; ?></td>
                                        <td><?= $client->lead_website; ?></td>
                                        <td><?= $client->lead_number; ?></td>
                                        <td><?= $client->lead_note; ?></td>
                                        <td>
                                            <a href="javascript:;">
                                                <?= ucwords($client->product_name); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:;">
                                                <?= ucwords($client->user_fullname); ?></td>
                                            </a>
                                        <td><?= pretty_date_notime($client->createdAt); ?></td>
                                        <td>
                                            <a href="<?= PROOT; ?>admin/users?edit=<?= $client->user_id; ?>" class="btn btn-sm btn-outline-secondary">Details</a>
                                            <a href="<?= PROOT; ?>admin/users?delete=<?= $client->user_id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No users found</td>
                                </tr>    
                            <?php endif; ?>
                        </tbody> 
                    </table> 
                </div> 


<?php include('includes/footer.php'); ?>
