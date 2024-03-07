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

<header class="header">

    <section class="flex">

        <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="dashboard.php" class="effect-underline wrapper">home</a></div>
            <a href="products.php" class="effect-underline wrapper">products</a>
            <a href="placed_orders.php" class="effect-underline wrapper">orders</a>
            <a href="admin_accounts.php" class="effect-underline wrapper">admin</a>
            <a href="users_accounts.php" class="effect-underline wrapper">users</a>
            <a href="messages.php" class="effect-underline wrapper">messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            
                $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            
            ?>

            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="custom-btn btn-7"><span>update profile</span></a>

            <div class="flex-btn">
                <a href="admin_login.php" class="custom-btn btn-7"><span>login</span></a>
                <a href="register_admin.php" class="custom-btn btn-7"><span>register</span></a>
            </div>

            <a href="../components/admin_logout.php" class="custom-btn btn-7"><span>logout</span></a>
        </div>

    </section>

</header>