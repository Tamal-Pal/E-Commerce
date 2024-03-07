<?php

    include 'components/connect.php';
    include 'config.php';

    session_start();

    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id'];
    }
    else
    {
        $user_id = '';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quick view</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- custom css file -->
    <link rel="stylesheet" href="css/style.css?v=<?= $version?>">
</head>
<body>

    <?php include 'components/user_header.php'; ?>













    <?php include 'components/footer.php'; ?>

    <script src="js/script.js?v=<?= $version?>"></script>
    
</body>
</html>