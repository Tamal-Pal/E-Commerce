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

<nav class="sidebar close">
        <header class="header1">
            <div class="image-text">
                <span class="image">
                    <img src="images/ecart1-1.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">ECart</span>
                    <span class="profession">Shopping App</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <?php
                
                    $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                    $count_wishlist_items->execute([$user_id]);
                    $total_wishlist_items = $count_wishlist_items->rowCount();

                    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_items = $count_cart_items->rowCount();
            
                ?>

                <li class="search-box">
                    <a href="search_page.php">
                        <i class='bx bx-search icon'></i>
                        <input type="text" placeholder="Search...">
                    </a>
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="home.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="about.php">
                            <i class='bx bx-user-circle icon' ></i>
                            <span class="text nav-text">About</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="wishlist.php">
                            <i class='bx bx-heart icon' ></i>
                            <span class="text nav-text">Wishlist (<?= $total_wishlist_items; ?>)</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="cart.php">
                            <i class='bx bx-cart-alt icon'></i>
                            <span class="text nav-text">Cart (<?= $total_cart_items; ?>)</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="contact.php">
                            <i class='fa-regular fa-address-book icon' ></i>
                            <span class="text nav-text">Contact</span>
                        </a>
                    </li>

                    <!-- <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li> -->

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

<header class="header">

    <section class="flex">

        <a href="home.php" class="logo"><span>E</span>Cart</a>

        <nav class="navbar">
            <a href="home.php" class="effect-underline wrapper">home</a></div>
            <a href="about.php" class="effect-underline wrapper">about</a></div>
            <a href="orders.php" class="effect-underline wrapper">orders</a></div>
            <a href="shop.php" class="effect-underline wrapper">shop</a></div>
            <a href="contact.php" class="effect-underline wrapper">contact</a></div>
        </nav>

        <div class="icons">
            <?php
            
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_items = $count_wishlist_items->rowCount();

                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_items = $count_cart_items->rowCount();
            
            ?>
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php"><i class="fas fa-search"></i></a>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_items; ?>)</span></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0)
                {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="update_profile.php" class="custom-btn btn-7"><span>update profile</span></a>

                    <div class="flex-btn">
                        <a href="admin_login.php" class="custom-btn btn-7"><span>login</span></a>
                        <a href="register_admin.php" class="custom-btn btn-7"><span>register</span></a>
                    </div>

                    <a href="../components/admin_logout.php" class="custom-btn btn-7"><span>logout</span></a>
            <?php
                }
                else
                {
            ?>
                    <p>Please login first!</p>
                    <div class="flex-btn">
                        <a href="admin_login.php" class="custom-btn btn-7"><span>login</span></a>
                        <a href="register_admin.php" class="custom-btn btn-7"><span>register</span></a>
                    </div>
            <?php
                }
            ?>
        </div>

    </section>

</header>