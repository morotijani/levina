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

    // disable user
    if (isset($_GET['disable']) && !empty($_GET['disable'])) {
        $user_id = $_GET['disable'];
        $user = get_user($user_id);

        if ($user->user_id == 1) {
            $flash_user = flash('danger', 'You cannot disable this user');
        }
        
        $disableQuery = "
            UPDATE levina_users 
            SET user_trash = 1 
            WHERE user_id = ?
        ";
        $statement = $dbConnection->prepare($disableQuery);
        $statement->execute([$user_id]);
    }

    // enable user
    if (isset($_GET['enable']) && !empty($_GET['enable'])) {
        $user_id = $_GET['enable'];
        $enableQuery = "
            UPDATE levina_users 
            SET user_trash = 0 
            WHERE user_id = ?
        ";
        $statement = $dbConnection->prepare($enableQuery);
        $statement->execute([$user_id]);
    }

    // get disabled user
    $disabledUsersQuery = "
        SELECT * FROM levina_users 
        WHERE user_trash = ? 
        ORDER BY user_fullname ASC
    ";
    $statement = $dbConnection->prepare($disabledUsersQuery);
    $statement->execute([1]);
    $disabledUsers = $statement->fetchAll(PDO::FETCH_OBJ);
    $disabledUsersCount = $statement->rowCount();


?>
      
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
                    <h1 class="h2">Users</h1> 
                    <div class="btn-toolbar mb-2 mb-md-0"> 
                        <div class="btn-group me-2"> 
                            <a href="<?= PROOT; ?>admin" class="btn btn-sm btn-outline-secondary">Dashboard</a> <a href="<?= PROOT; ?>admin/products?add=1" class="btn btn-sm btn-outline-secondary">Disabled users</a>
                        </div> 
                        <a href="<?= PROOT; ?>admin/products" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1"> 
                            <i class="bi bi-arrow-clockwise"></i>
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
                                            <a href="<?= PROOT; ?>admin/users?disable=<?= $user->user_id; ?>" class="btn btn-sm btn-outline-warning">Disable</a>
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
