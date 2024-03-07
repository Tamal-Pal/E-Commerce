<?php

    include '../components/connect.php';
    include '../config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id))
    {
        header('location:admin_login.php');
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

    <section class="dashboard">

        <div class="heading">
            <h1>dashboard</h1>
        </div>
        <!-- <h1 class="heading">dashboard</h1> -->

        <div class="box-container">

            <div class="box">
                <h3>Welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update_profile.php" class="custom-btn btn-7"><span>update profile</span></a>
            </div>

            <div class="box">
                <?php
                
                    $total_pendings = 0;
                    $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_pendings->execute(['pending']);

                    while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC))
                    {
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                    
                ?>

                <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
                <p>total pending</p>
                <a href="placed_orders.php" class="custom-btn btn-7"><span>see orders</span></a>
            </div>

            <div class="box">
                <?php
                
                    $total_completes = 0;
                    $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_completes->execute(['completed']);

                    while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC))
                    {
                        $total_completes += $fetch_completes['total_price'];
                    }
                    
                ?>

                <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
                <p>total completes</p>
                <a href="placed_orders.php" class="custom-btn btn-7"><span>see orders</span></a>
            </div>

            <div class="box">
                <?php
                
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    $number_of_orders = $select_orders->rowCount();
                
                ?>

                <h3><?= $number_of_orders; ?></h3>
                <p>total orders</p>
                <a href="placed_orders.php" class="custom-btn btn-7"><span>see orders</span></a>
            </div>

            <div class="box">
                <?php
                
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount();
                
                ?>

                <h3><?= $number_of_products; ?></h3>
                <p>products added</p>
                <a href="products.php" class="custom-btn btn-7"><span>see products</span></a>
            </div>

            <div class="box">
                <?php
                
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $number_of_users = $select_users->rowCount();
                
                ?>

                <h3><?= $number_of_users; ?></h3>
                <p>users accounts</p>
                <a href="users_accounts.php" class="custom-btn btn-7"><span>see accounts</span></a>
            </div>

            <div class="box">
                <?php
                
                    $select_admins = $conn->prepare("SELECT * FROM `admins`");
                    $select_admins->execute();
                    $number_of_admins = $select_admins->rowCount();
                
                ?>

                <h3><?= $number_of_admins; ?></h3>
                <p>admins accounts</p>
                <a href="admins_accounts.php" class="custom-btn btn-7"><span>see accounts</span></a>
            </div>
            
            <div class="box">
                <?php
                
                    $select_messages = $conn->prepare("SELECT * FROM `messages`");
                    $select_messages->execute();
                    $number_of_messages = $select_messages->rowCount();
                
                ?>

                <h3><?= $number_of_messages; ?></h3>
                <p>total messages</p>
                <a href="messages.php" class="custom-btn btn-7"><span>see messages</span></a>
            </div>

        </div>

        

    </section>

    




    <!-- custom js link -->
    <script src="../js/admin_script.js?v=<?= $version?>"></script>
    
</body>
</html>