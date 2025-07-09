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

        // check if user is found
        if ($user) {
            if ($user->user_id == 1) {
                $_SEESION['flash_error'] = 'You cannot disable this user!';
                redirect(PROOT . 'admin/users');
            }

            $disableQuery = "
                UPDATE levina_users 
                SET user_trash = 1 
                WHERE user_id = ?
            ";
            $statement = $dbConnection->prepare($disableQuery);
            $statement->execute([$user_id]);
            if ($statement) {
                $_SEESION['flash_success'] = 'User disabled successfully!';
                redirect(PROOT . 'admin/users');
            } else {
                $_SEESION['flash_error'] = 'User not disabled!';
                redirect(PROOT . 'admin/users');
            }
        } else {
            $_SEESION['flash_error'] = 'User not found!';
            redirect(PROOT . 'admin/users');
        }
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
                    <h1 class="h2"><?= (isset($_GET['disabled']) && $_GET['disabled'] == 1) ? 'Disabled' : 'Active'; ?>Users</h1> 
                    <div class="btn-toolbar mb-2 mb-md-0"> 
                        <div class="btn-group me-2"> 
                            <a href="<?= PROOT; ?>admin" class="btn btn-sm btn-outline-secondary">Dashboard</a> <a href="<?= PROOT; ?>admin/users?disabled=1" class="btn btn-sm btn-outline-warning">Disabled users</a>
                        </div> 
                        <a href="<?= PROOT; ?>admin/products" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1"> 
                            <i class="bi bi-arrow-clockwise"></i>
                            Refresh
                        </a> 
                    </div> 
                </div>

                <?php if (isset($_GET['disabled']) && $_GET['disabled'] == 1): ?>
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
                                <?php if ($disabledUsersCount > 0): ?>
                                    <?php $i = 1; foreach ($disabledUsers as $disabledUser): ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= ucwords($disabledUser->user_fullname); ?></td>
                                            <td><?= $disabledUser->user_email; ?></td>
                                            <td><?= $disabledUser->user_phone; ?></td>
                                            <td><?= pretty_date_notime($disabledUser->user_joined_date); ?></td>
                                            <td><?= pretty_date($disabledUser->user_last_login); ?></td>
                                            <td>
                                                <a href="<?= PROOT; ?>admin/users?edit=<?= $disabledUser->user_id; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                                <a href="<?= PROOT; ?>admin/users?disable=<?= $disabledUser->user_id; ?>" class="btn btn-sm btn-outline-warning">Disable</a>
                                            </td>
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">No disabled users found!</td>
                                    </tr>    
                                <?php endif; ?>
                            </tbody> 
                        </table> 
                    </div>
                <?php else: ?>
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
                <?php endif; ?>


<?php include('includes/footer.php'); ?>
