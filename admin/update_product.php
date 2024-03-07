<?php

    include '../components/connect.php';
    include '../config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id))
    {
        header('location:admin_login.php');
    };

    if(isset($_POST['update']))
    {
        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $details = $_POST['details'];
        $details = filter_var($details, FILTER_SANITIZE_STRING);

        $update_product = $conn->prepare("UPDATE `products` SET name = ?, details = ?, price = ? WHERE id = ?");
        $update_product->execute([$name, $details, $price, $pid]);

        $message[] = 'product updated!';

        $old_image_01 = $_POST['old_image_01'];
        $image_01 = $_FILES['image_01']['name'];
        $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
        $image_01_size = $_FILES['image_01']['size'];
        $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
        $image_01_folder = '../uploaded_img/'.$image_01; 
        
        if(!empty($image_01))
        {
            if($image_01_size > 2000000 )
            {
                $message[] = 'image size is too large';
            }
            else
            {
                $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
                $update_image_01->execute([$image_01, $pid]);
                move_uploaded_file($image_01_tmp_name, $image_01_folder);
                unlink('../uploaded_img/'.$old_image_01);
                $message[] = 'image 01 updated!';
            }
        }

        $old_image_02 = $_POST['old_image_02'];
        $image_02 = $_FILES['image_02']['name'];
        $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
        $image_02_size = $_FILES['image_02']['size'];
        $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
        $image_02_folder = '../uploaded_img/'.$image_02; 
        
        if(!empty($image_02))
        {
            if($image_02_size > 2000000 )
            {
                $message[] = 'image size is too large';
            }
            else
            {
                $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
                $update_image_02->execute([$image_02, $pid]);
                move_uploaded_file($image_02_tmp_name, $image_02_folder);
                unlink('../uploaded_img/'.$old_image_02);
                $message[] = 'image 02 updated!';
            }
        }

        $old_image_03 = $_POST['old_image_03'];
        $image_03 = $_FILES['image_03']['name'];
        $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
        $image_03_size = $_FILES['image_03']['size'];
        $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
        $image_03_folder = '../uploaded_img/'.$image_03;

        if(!empty($image_03))
        {
            if($image_03_size > 2000000 )
            {
                $message[] = 'image size is too large';
            }
            else
            {
                $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
                $update_image_03->execute([$image_03, $pid]);
                move_uploaded_file($image_03_tmp_name, $image_03_folder);
                unlink('../uploaded_img/'.$old_image_03);
                $message[] = 'image 03 updated!';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

    <!-- font awesome cdnjs link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="../css/admin_style.css?v=<?= $version?>">
</head>
<body>

    <?php include '../components/admin_header.php' ?>

    <!-- update product section starts -->

    <section class="update-product">

        <div class="heading">
            <h1>update product</h1>
        </div>

        <?php
            
            $update_id = $_GET['update'];
            $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $show_products->execute([$update_id]);

            if($show_products->rowCount() > 0 )
            {
                while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC))
                {
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
            <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
            <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
            <div class="image-container">
                <div class="main-image">
                    <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                </div>
                <div class="sub-images">
                    <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                    <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                    <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
                </div>
                <h3>updata Name</h3>
                <div class="input-group">
                    <input type="text" required class="box" name="name" maxlength="100" value="<?= $fetch_products['name']; ?>"
                    placeholder="Enter Product Name">
                </div>
                <h3>updata Price</h3>
                <div class="input-group">
                        <input type="number" min="0" max="9999999999" required class="box" name="price"
                        maxlength="100" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>"
                        placeholder="Enter Product Price">
                </div>
                <h3>updata Details</h3>
                <div class="input-group">
                    <textarea name="details" class="box" required maxlength="500" cols="30" 
                    placeholder="Enter product details" rows="10"><?= $fetch_products['details']; ?></textarea>
                </div>
                <h3>updata image 01</h3>
                <div class="input-group">
                    <input type="file" class="box" name="image_01" accept="image/jpg,
                    image/jpeg, image/png, image/webp">
                </div>
                <h3>updata image 02</h3>
                <div class="input-group">
                    <input type="file" class="box" name="image_02" accept="image/jpg,
                    image/jpeg, image/png, image/webp">
                </div>
                <h3>updata image 03</h3>
                <div class="input-group">
                    <input type="file" class="box" name="image_03" accept="image/jpg,
                    image/jpeg, image/png, image/webp">
                </div>

                <input type="submit" value="update" name="update" class="btn_login">
                <a href="products.php" class="custom-btn btn-7"><span>go back</span></a>
            </div>
        </form>

        <?php
                }
            }
                else
                {
                    echo '<p class="empty">no product added yet!</p>';
                }
            
        ?>

    </section>

    <!-- update product section ends -->

    




    <!-- custom js link -->
    <script src="../js/admin_script.js?v=<?= $version?>"></script>
    
</body>
</html>