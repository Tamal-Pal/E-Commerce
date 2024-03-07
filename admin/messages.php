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
        $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
        $delete_message->execute([$delete_id]);
        header('location:messages.php');
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

    <!-- message section starts -->

    <section class="messages">

        <div class="heading">
            <h1>messages</h1>
        </div>

        <div class="box-container">

            <?php
            
                $select_messages = $conn->prepare("SELECT * FROM `messages`");
                $select_messages->execute();
                if($select_messages->rowCount() > 0)
                {
                    while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC))
                    {
            ?>
                        <div class="box">
                            <p> user id : <span><?= $fetch_messages['user_id']; ?></span></p>
                            <p> name : <span><?= $fetch_messages['name']; ?></span></p>
                            <p> number : <span><?= $fetch_messages['number']; ?></span></p>
                            <p> email : <span><?= $fetch_messages['email']; ?></span></p>
                            <p> message : <span><?= $fetch_messages['message']; ?></span></p>
                            <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="custom-btn btn-7" 
                            onclick="return confirm('Delete this Message?');"><span>delete</span></a>
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

    <!-- message section ends -->

    




    <!-- custom js link -->
    <script src="../js/admin_script.js?v=<?= $version?>"></script>
    
</body>
</html>