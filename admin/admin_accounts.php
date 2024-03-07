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
        $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
        $delete_admin->execute([$delete_id]);
        header('location:admin_accounts.php');
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

    <!-- admin account section starts -->

    <section class="accounts">

        <div class="heading">
            <h1>admin accounts</h1>
        </div>

        <div class="box-container">

            <div class="box-r">

                <p>register new admin</p>
                <a href="register_admin.php" class="custom-btn btn-7"><span>register</span></a>

            </div>

            <?php
            
                $select_account = $conn->prepare("SELECT * FROM `admins`");
                $select_account->execute();
                if($select_account->rowCount() > 0)
                {
                    while($fetch_accounts = $select_account->fetch())
                    {
            ?>

                        <div class="box">
                            <p> admin id : <span><?= $fetch_accounts['id']; ?></span></p>
                            <p> username : <span><?= $fetch_accounts['name']; ?></span></p>
                            <div class="flex-btn">
                                <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="custom-btn btn-7" 
                                onclick="return confirm('Delete this Account?');"><span>delete</span></a>
                                <?php
                                
                                    if($fetch_accounts['id'] == $admin_id)
                                    {
                                        echo '<a href="update_profile.php" class="custom-btn btn-7"><span>update</span></a>';
                                    }
                                
                                ?>
                            </div>
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

    <!-- admin account section ends -->

    




    <!-- custom js link -->
    <script src="../js/admin_script.js?v=<?= $version?>"></script>
    
</body>
</html>