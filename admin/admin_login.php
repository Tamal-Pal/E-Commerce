<?php

    include '../components/connect.php';

    session_start();

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);
        
        if($select_admin->rowCount() > 0)
        {
            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            header('location:dashboard.php');
        }
        else
        {
            $message[] = 'incorrect username or password!';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdnjs link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

    <?php
    
        if(isset($message))
        {
            foreach($message as $message)
            {
                echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
            }
        }
    
    ?>

    <!-- admin login form section starts -->

    <section class="form_container">

        <form action="" method="POST">
            <h3>login now</h3>
            <p>default username = <span>admin</span> & password = <span>111</span></p>
            <div class="input-group">
                <input type="text" name="name" maxlength="20" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <label for="">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="pass" maxlength="20" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <label for="">Password</label>
            </div>
            <!-- <input type="text" name="name" maxlength="20" required placeholder = "enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" maxlength="20" required placeholder = "enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')"> -->
            <input type="submit" value="login now" name="submit" class="btn_login">
            <!-- <button class="btn">login</button> -->

            <!-- <button class="custom-btn btn-7"><span>Read More</span></button> -->
        </form>

    </section>

    <!-- admin login form section ends -->
    
</body>
</html>