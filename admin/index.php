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
        LIMIT 10
    ";
    $statement = $dbConnection->prepare($usersQuery);
    $statement->execute([0]);
    $clients = $statement->fetchAll(PDO::FETCH_OBJ);
    $clientsCount = $statement->rowCount();

?>
    
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
                    <h1 class="h2">Dashboard</h1> 
                    <div class="btn-toolbar mb-2 mb-md-0"> 
                        <div class="btn-group me-2"> 
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button> <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div> 
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1"> 
                            <svg class="bi" aria-hidden="true"><use xlink:href="#calendar3"></use></svg>
                            This week
                        </button> 
                    </div> 
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Number of Clients</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= get_number_of_clients(); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Number of Users</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= get_number_of_users(); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Number of Projects</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= get_number_of_products(); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>  -->
                <hr>
                <h2>List clients</h2> 
                <div class="table-responsive small"> 
                    <table class="table table-striped table-sm"> 
                        <thead> 
                            <tr> 
                                <th scope="col">#</th> 
                                <th scope="col">Name</th> 
                                <th scope="col">Product</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if ($clientsCount > 0) : ?>
                                <?php foreach ($clients as $key => $client) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= ucwords($client->user_fullname); ?></td>
                                        <td><?= ucwords($client->product_name); ?></td>
                                        <td><?= ucwords($client->user_fullname); ?></td>
                                        <td><?= pretty_date($client->createdAt); ?></td>
                                        <td>
                                            <a href="<?= PROOT; ?>admin/clients?view=<?= $client->lead_id; ?>" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No clients found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody> 
                    </table> 
                </div> 

<?php include('includes/footer.php'); ?>
