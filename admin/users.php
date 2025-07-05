<?php
    require ('../system/DatabaseConnector.php');
    // if (!admin_is_logged_in()) {
    //     admin_login_redirect();
    // }
    include ('includes/header.php');
    include ('includes/left-nav.php');

    // get all user
    $usersQuery = "
        SELECT * FROM levina_users 
        WHERE user_trash = ? 
        ORDER BY user_fullname ASC
    ";
    $statement = $dbConnection->prepare($usersQuery);
    $statement->execute([0]);
    $users = $statement->fetchAll(PDO::FETCH_OBJ);
    $usersCount = $statement->rowCount();

?>
      
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
                    <h1 class="h2">Users</h1> 
                    <div class="btn-toolbar mb-2 mb-md-0"> 
                        <div class="btn-group me-2"> 
                            <a href="<?= PROOT; ?>admin" class="btn btn-sm btn-outline-secondary">Dashboard</a> <a href="<?= PROOT; ?>admin/products?add=1" class="btn btn-sm btn-outline-secondary">Add new product</a>
                        </div> 
                        <a href="<?= PROOT; ?>admin/products" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1"> 
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
                                <th scope="col">Phone</th> 
                                <th scope="col">Joined date</th>
                                <th scope="col">Last login date</th>
                                <th scope="col"></th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if ($usersCount > 0): ?>
                                <?php $i = 1; foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($user->user_fullname); ?></td>
                                        <td><?= $user->user_email; ?></td>
                                        <td><?= $user->user_phone; ?></td>
                                        <td><?= pretty_date_notime($user->user_joined_date); ?></td>
                                        <td><?= pretty_date($user->user_last_login); ?></td>
                                        <td>
                                            <a href="<?= PROOT; ?>admin/users?edit=<?= $user->user_id; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <a href="<?= PROOT; ?>admin/users?delete=<?= $user->user_id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
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
