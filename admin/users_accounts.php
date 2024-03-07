<?php

    include '../components/connect.php';
    include '../config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id))
    {
        header('location:admin_login.php');
    }

    if(isset($_GET['delete']))
    {
        $delete_id = $_GET['delete'];
        $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_users->execute([$delete_id]);
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_id]);
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart->execute([$delete_id]);
        $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
        $delete_wishlist->execute([$delete_id]);
        $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
        $delete_messages->execute([$delete_id]);
        header('location:users_accounts.php');
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

    <!-- user account section starts -->

    <section class="accounts">

        <div class="heading">
            <h1>user accounts</h1>
        </div>

        <div class="box-container">

            <?php
            
                $select_account = $conn->prepare("SELECT * FROM `users`");
                $select_account->execute();
                if($select_account->rowCount() > 0)
                {
                    while($fetch_accounts = $select_account->fetch())
                    {
            ?>

                        <div class="box">
                            <p> user id : <span><?= $fetch_accounts['id']; ?></span></p>
                            <p> username : <span><?= $fetch_accounts['name']; ?></span></p>
                            <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="custom-btn btn-7" 
                            onclick="return confirm('Delete this Account?');"><span>delete</span></a>
                        </div>
                        
            <?php
                    }
                }
                else
                {
                    echo '<p class="empty">no accounts available</p>';
                }
            
            ?>
        </div>


    </section>

    <!-- user account section ends -->

    




    <!-- custom js link -->
    <script src="../js/admin_script.js?v=<?= $version?>"></script>
    
</body>
</html>