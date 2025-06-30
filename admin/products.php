<?php
    require ('../system/DatabaseConnector.php');
    // if (!admin_is_logged_in()) {
    //     admin_login_redirect();
    // }
    include ('includes/header.php');
    include ('includes/left-nav.php');

     // Declaring variables on post form
    $message = '';
    $product_name = ((isset($_POST['product_name']) && !empty($_POST['product_name']))?sanitize($_POST['product_name']):'');
    $product_list_price = ((isset($_POST['product_list_price']) && !empty($_POST['product_list_price']))?sanitize($_POST['product_list_price']):'');
    $product_price = ((isset($_POST['product_price']) && !empty($_POST['product_price']))?sanitize($_POST['product_price']):'');
    $product_description = ((isset($_POST['product_description']) && !empty($_POST['product_description']))?$_POST['product_description']:'');
    $product_image = '';
    $image_name = '';
    $product_added_by = 1;// $admin_id;
    $product_url = php_url_slug($product_name);

    // Fetch Product details on edit
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $edit_id = sanitize($edit_id);

        $editQ = "
            SELECT * FROM levina_products 
            WHERE product_id = :product_id 
            LIMIT 1";
        $statement = $dbConnection->prepare($editQ);
        $statement->execute(
            [
                ':product_id'   => $edit_id
            ]
        );
        $result_edit = $statement->fetchAll();

        foreach ($result_edit as $row) {
            // Delete uploaded product image for change
            if (isset($_GET['delete_image']) && !empty($_GET['delete_image'])) {

                $product_img = $_GET['pp'];
                $imgi = $_GET['delete_image'] - 1;
                $images = explode(',', $row['product_image']);

                $image_url = $_SERVER['DOCUMENT_ROOT'] . $images[$imgi];

                // delete from directory
                unlink($image_url);
                // remove from thie images array
                unset($images[$imgi]);

                $imageString = implode(",", $images);

                $update = "
                    UPDATE levina_products 
                    SET product_image = :product_image 
                    WHERE product_id =  :product_id
                ";
                $statement = $dbConnection->prepare($update);
                $statement->execute(
                    [
                        ':product_image'    => $imageString,
                        ':product_id'       => $edit_id
                    ]
                );
                echo '
                        <script>window.location = "'.PROOT.'admin/products?edit='.$edit_id.'";</script>
                    ';
            }

            $product_name = ((isset($_POST['product_name']) && $_POST['product_name'] != '') ?sanitize($_POST['product_name']) : $row['product_name']);
            
            $product_list_price = ((isset($_POST['product_list_price']))?sanitize($_POST['product_list_price']):$row['product_list_price']);
            $product_price = ((isset($_POST['product_price']) && $_POST['product_price'] != '')?sanitize($_POST['product_price']):$row['product_price']);
            $product_description = ((isset($_POST['product_description']) && $_POST['product_description'] != '')?$_POST['product_description']:$row['product_description']);
            $product_sizes = ((isset($_POST['product_sizes']) && $_POST['product_sizes'] != '')?$_POST['product_sizes']:$row['product_sizes']);
            $product_image = (($row['product_image'] != '')?$row['product_image']:'');
            $product_added_by = $row['product_added_by'];
            $product_url = php_url_slug($product_name);
        }
    }

    if (!empty($product_sizes)) {
        // code.
        $sizeString = $product_sizes;
        $sizeString = rtrim($sizeString, ',');
        $sizesArray = explode(",", $sizeString);

        $sArray = array();
        $qArray = array();
        $tArray = array();
        foreach ($sizesArray as $ss) {
            // code...ss (sizes string)
            $s = explode(":", $ss);
            $sArray[] = $s[0];
            $qArray[] = $s[1];
            $tArray[] = $s[2];
        }
    } else {
        $sizesArray = array();
        $sizeString = $sizesArray;
    }

    // ADD PRODUCT
    if (isset($_POST['submit_product'])) {
        
        $productQuery = "
            SELECT * FROM levina_products 
            WHERE product_name = '" . $_POST['product_name'] . "'
        ";
        if (isset($_GET['edit']) && !empty($_GET['edit'])) {
            $productQuery = "
                SELECT * FROM levina_products 
                WHERE product_name = '" . sanitize($_POST['product_name']) . "' 
                AND product_id != '" . $_GET['edit'] . "'
            ";
        }
        $statement = $dbConnection->prepare($productQuery);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $message = '<div class="alert alert-danger">'.$product_name.' already exists.</div>';
        } else {
            $insert_image_name = $product_image;
            $image_name = [];
            $photoCount = - 1;
            if (isset($_FILES)) {
            // if ($_FILES['product_image']['name'] != '') {
                $photoCount = (!empty($_FILES)) ? count($_FILES["product_image"]["name"]) : -1;
            }
            if ($photoCount > 0) {
                for ($count=0; $count < $photoCount; $count++) {
                    $image_test = explode(".", $_FILES["product_image"]["name"][$count]);
                    $image_extension = end($image_test);
                    $new_image_name = md5(microtime()) . '.' . $image_extension;

                    $dbpath = 'assets/media/product-images/' . $new_image_name;
                    $location = BASEURL . 'assets/media/product-images/' . $new_image_name;
                    move_uploaded_file($_FILES["product_image"]["tmp_name"][$count], $location);
                    
                    if (isset($_POST['uploaded_image'.$count]) && $_POST['uploaded_image'.$count] != '') {
                        unlink($_POST['uploaded_image'.$count]);
                    }

                    $image_names[] = $dbpath;
                }
                $insert_image_name = implode(",", $image_names);
            }

            if (empty($message)) {
                $data = array(
                        ':product_name'         => $product_name,
                        ':product_list_price'   => $product_list_price,
                        ':product_price'        => $product_price,
                        ':product_image'        => $insert_image_name,
                        ':product_description'  => $product_description,
                        ':product_added_by'     => $product_added_by,
                        ':product_url'          => $product_url
                );
                if (isset($_GET['edit']) && !empty($_GET['edit'])) {
                    $dataOne = array(
                        ':product_id' => $edit_id
                    );
                    $mergeData = array_merge($data, $dataOne);
                    $updateQ = "
                        UPDATE levina_products 
                        SET product_name = :product_name, product_list_price = :product_list_price, product_price = :product_price, product_image = :product_image, product_description = :product_description, product_added_by = :product_added_by, product_url = :product_url  
                        WHERE product_id = :product_id";
                    $statement = $dbConnection->prepare($updateQ);
                    $resultQ = $statement->execute($mergeData);
                    if (isset($resultQ)) {
                      $_SESSION['flash_success'] = ucwords($row["product_name"]) .' successfully Updated!';
                     redirect(PROOT . 'admin/products');
                    }
                } else {
                    
                    $query = "
                        INSERT INTO `levina_products`(`product_name`, `product_list_price`, `product_price`, `product_image`, `product_description`, `product_added_by`, `product_url`) 
                        VALUES (:product_name, :product_list_price, :product_price, :product_image, :product_description, :product_added_by, :product_url)
                    ";
                    $statement = $dbConnection->prepare($query);
                    $result = $statement->execute($data);
                    if (isset($result)) {
                        $_SESSION['flash_success'] = 'Product successfully Added!';
                        redirect(PROOT . 'admin/products');
                    }
                }
            } else {
                $message;
            }

        }
    }

    // DELETE PRODUCT TEMPORARY
    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_id = sanitize($delete_id);

        $query = "
            UPDATE levina_products 
            SET product_trash = :product_trash 
            WHERE product_id = :product_id
        ";
        $statement = $dbConnection->prepare($query);
        $statement->execute(array(
            ':product_trash'    => 1,
            ':product_id'       => $delete_id
        ));
        $_SESSION['flash_success'] = 'Product has been temporary <span class="bg-info">DELETED</span>';
        echo '<script>window.location = "'.PROOT.'admin/products"</script>';
    }

    // DELETE A PRODUCT PERMANENTLY
    if (isset($_GET['permanent_delete']) && !empty($_GET['permanent_delete'])) {
        $permanent_delete = $_GET['permanent_delete'];
        $permanent_delete = sanitize($permanent_delete);

        $uploaded_product_picture_location = BASEURL . $_GET['upload_product_image_name'];
        $DEL = unlink($uploaded_product_picture_location);

        if ($DEL) {
            $query = "
                DELETE FROM levina_products 
                WHERE product_id = :product_id
            ";
            $statement = $dbConnection->prepare($query);
            $statement->execute([
                ':product_id'   => $permanent_delete
            ]);
            $_SESSION['flash_success'] = 'Product permanently <span class="bg-info">DELETED</span>';
            echo '<script>window.location = "'.PROOT.'admin/products?achived_products"</script>';
        }
    }

    // RESTORE PRODUCT
    if (isset($_GET['restore']) && !empty($_GET['restore'])) {
        $restore_id = $_GET['restore'];
        $restore_id = sanitize($restore_id);

        $query = "
            UPDATE levina_products 
            SET product_trash = :product_trash 
            WHERE product_id = :product_id
        ";
        $statement = $dbConnection->prepare($query);
        $statement->execute([
            ':product_trash'    => 0,
            ':product_id'    => $restore_id
        ]);
        $_SESSION['flash_success'] = 'Product successfully <span class="bg-info">Restored</span>';
        echo '<script>window.location = "'.PROOT.'admin/products"</script>';
    }

    // Feature/un-feature a product
    if (isset($_GET['featured'])) {
        $product_id = $_GET['id'];
        $featured = $_GET['featured'];

        $query = "
            UPDATE levina_products 
            SET product_featured = :product_featured 
            WHERE product_id = :product_id
        ";
        $statement = $dbConnection->prepare($query);
        $result = $statement->execute(
            [
                ':product_featured'     => $featured,
                ':product_id'           => $product_id
            ]
        );

        if ($result) {
            if ($featured == 1) {
                $subscribers = "
                    SELECT * FROM mifo_subscription
                ";
                $statement = $dbConnection->prepare($subscribers);
                $statement->execute();
                $subscribers_result = $statement->fetchAll();
                $subscribers_count = $statement->fetchAll();
                if ($subscribers_count > 0) {

                    foreach ($subscribers_result as $subscriber) {
                    
                        $to = $subscriber['subscription_email'];
                        $subject = "Products Subscription.";
                        $body = "
                            <h3>Dear
                                {$to},</h3>
                                <p>
                                    A new product has been featured on Gary Pie Spices Shop. Click this
                                    <a href=\"http://sites.local/mifo/shop/products/{$product_id}\" target=\"_blank\">link</a> to view it if interested.
                                </p>
                                <p>
                                Sincerely, <br>
                                Gary Pie Spices.
                            </p>
                        ";
                        $mail_result = send_email($to, $to, $subject, $body);
                        if ($mail_result) {
                            redirect(PROOT . 'admin/products');
                        } else {
                            $_SESSION['flash_error'] = "Message could not be sent... check you internet connectivity and try again";
                            redirect(PROOT . 'admin/products');
                        }
                    }
                }
            }
        }
    }

?>
      
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
                    <h1 class="h2">Products</h1> 
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
                <?php if (isset($_GET['add']) || (isset($_GET['edit']) && !empty($_GET['edit']))): ?>
                <form method="POST" action="products.php?<?= ((isset($_GET['edit']))?'edit='.$edit_id : 'add=1'); ?>" enctype="multipart/form-data" id="product_form">
                <?= $message; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" value="<?= $product_name; ?>" required>
                            <div class="form-text">Enter product name in the field. Example School Management System.</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="product_list_price" class="form-label">List Price</label>
                            <input type="text" class="form-control" name="product_list_price" id="product_list_price" value="<?= $product_list_price; ?>">
                            <div class="form-text">Key in product list price. Numbers only. it will show this way(eg. <del>12.99</del>) for users</div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="text" class="form-control" name="product_price" id="product_price" value="<?= $product_price; ?>" required>
                            <div class="form-text">Key in product price. Numbers only.</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description</label>
                    <textarea name="product_description" id="product_description" rows="9" class="form-control" required><?= $product_description; ?></textarea>
                    <div class="form-text">Type in product description.</div>
                </div>
                <?php 
                    if($product_image != ''):
                        $imgi = 1;
                        $product_images = explode(",", $product_image);
                        foreach ($product_images as $pimage) {
                            // code...
                ?>
                <div class="mb-3">
                    <label>Product Image</label><br>
                    <img src="<?= PROOT . $pimage; ?>" class="img-fluid img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                    <a href="<?= PROOT; ?>admin/products?dpp=1&edit=<?= $edit_id; ?>&delete_image=<?= $imgi; ?>" class="badge bg-danger text-decoration-none">Change Image</a>
                </div>
                <?php $imgi++; } ?>
                <?php else: ?>
                <div class="mb-3">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" class="form-control form-control-sm" id="product_image" name="product_image[]" required multiple>
                    <div class="form-text">Click to upload product image.</div>
                    <span id="upload_file"></span>
                </div>
                <?php endif; ?>
                <input type="hidden" name="uploaded_product_picture" id="uploaded_product_picture" value="<?= $product_image; ?>">
                <button type="submit" name="submit_product" id="submit_product" class="btn btn-sm btn-primary mb-3"><?= (isset($_GET['edit']))? 'Update': 'Add'; ?> <span data-feather="<?= (isset($_GET['edit']))? 'check' : 'plus'; ?>"></span></button>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?= PROOT; ?>admin/products" class="text-dark text-decoration-underline">Cancel</a>
            </form>
            <?php else: ?>

                <h2>Section title</h2> 
                <div class="table-responsive small"> 
                    <table class="table table-striped table-sm"> 
                        <thead> 
                            <tr> 
                                <th scope="col">#</th> 
                                <th scope="col">Header</th> 
                                <th scope="col">Header</th> 
                                <th scope="col">Header</th> 
                                <th scope="col">Header</th> 
                            </tr> 
                        </thead> 
                        <tbody> 
                            <tr> 
                                <td>1,001</td> <td>random</td> <td>data</td> <td>placeholder</td> <td>text</td> </tr> <tr> <td>1,002</td> <td>placeholder</td> <td>irrelevant</td> <td>visual</td> <td>layout</td> </tr> <tr> <td>1,003</td> <td>data</td> <td>rich</td> <td>dashboard</td> <td>tabular</td> </tr> <tr> <td>1,003</td> <td>information</td> <td>placeholder</td> <td>illustrative</td> <td>data</td> </tr> <tr> <td>1,004</td> <td>text</td> <td>random</td> <td>layout</td> <td>dashboard</td> </tr> <tr> <td>1,005</td> <td>dashboard</td> <td>irrelevant</td> <td>text</td> <td>placeholder</td> </tr> <tr> <td>1,006</td> <td>dashboard</td> <td>illustrative</td> <td>rich</td> <td>data</td> </tr> <tr> <td>1,007</td> <td>placeholder</td> <td>tabular</td> <td>information</td> <td>irrelevant</td> </tr> <tr> <td>1,008</td> <td>random</td> <td>data</td> <td>placeholder</td> <td>text</td> </tr> <tr> <td>1,009</td> <td>placeholder</td> <td>irrelevant</td> <td>visual</td> <td>layout</td> </tr> <tr> <td>1,010</td> <td>data</td> <td>rich</td> <td>dashboard</td> <td>tabular</td> </tr> <tr> <td>1,011</td> <td>information</td> <td>placeholder</td> <td>illustrative</td> <td>data</td> </tr> <tr> <td>1,012</td> <td>text</td> <td>placeholder</td> <td>layout</td> <td>dashboard</td> </tr> <tr> <td>1,013</td> <td>dashboard</td> <td>irrelevant</td> <td>text</td> <td>visual</td> </tr> <tr> <td>1,014</td> <td>dashboard</td> <td>illustrative</td> <td>rich</td> <td>data</td> </tr> <tr> <td>1,015</td> <td>random</td> <td>tabular</td> <td>information</td> <td>text</td> </tr> 
                        </tbody> 
                    </table> 
                </div> 
                <?php endif; ?>


<?php include('includes/footer.php'); ?>
    <script src="https://cdn.tiny.cloud/1/87lq0a69wq228bimapgxuc63s4akao59p3y5jhz37x50zpjk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({ 
        selector: 'textarea',
        setup: function (editor) {
            editor.on('change', function (e) {
                editor.save();
            });
        }
    });
</script>