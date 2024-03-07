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
    <title>home</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- custom css file -->
    <link rel="stylesheet" href="css/style.css?v=<?= $version?>">

    <!-- swiper link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <div class="home-bg">

        <section class="swiper home-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-1.png" alt="">
                    </div>
                    <div class="content">
                        <span>upto 50%</span>
                        <h3>latest smartphone</h3>
                        <a href="shop.php" class="custom-btn btn-7"><span>shop now</span></a>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-2.png" alt="">
                    </div>
                    <div class="content">
                        <span>upto 50%</span>
                        <h3>latest watch</h3>
                        <a href="shop.php" class="custom-btn btn-7"><span>shop now</span></a>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-3.png" alt="">
                    </div>
                    <div class="content">
                        <span>upto 50%</span>
                        <h3>latest headphone</h3>
                        <a href="shop.php" class="custom-btn btn-7"><span>shop now</span></a>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-4.png" alt="">
                    </div>
                    <div class="content">
                        <span>upto 50%</span>
                        <h3>latest monitor</h3>
                        <a href="shop.php" class="custom-btn btn-7"><span>shop now</span></a>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>

        </section>

    </div>

    <section class="home-category">

        <div class="seven">
            <h1>shop by category</h1>
        </div>

        <div class="swiper category-slider">

            <div class="swiper-wrapper">

                <a href="category.php?category=laptop" class="slide glass swiper-slide">
                    <img src="images/icon-1.png" alt="">
                    <h3>laptop</h3>
                </a>

                <a href="category.php?category=tv" class="slide glass swiper-slide">
                    <img src="images/icon-2.png" alt="">
                    <h3>TV</h3>
                </a>

                <a href="category.php?category=camera" class="slide glass swiper-slide">
                    <img src="images/icon-3.png" alt="">
                    <h3>camera</h3>
                </a>

                <a href="category.php?category=mouse" class="slide glass swiper-slide">
                    <img src="images/icon-4.png" alt="">
                    <h3>mouse</h3>
                </a>

                <a href="category.php?category=fridge" class="slide glass swiper-slide">
                    <img src="images/icon-5.png" alt="">
                    <h3>fridge</h3>
                </a>

                <a href="category.php?category=washing" class="slide glass swiper-slide">
                    <img src="images/icon-6.png" alt="">
                    <h3>washing machine</h3>
                </a>

                <a href="category.php?category=smartphone" class="slide glass swiper-slide">
                    <img src="images/icon-7.png" alt="">
                    <h3>smartphone</h3>
                </a>

                <a href="category.php?category=watch" class="slide glass swiper-slide">
                    <img src="images/icon-8.png" alt="">
                    <h3>watch</h3>
                </a>

            </div>
            <div class="swiper-pagination"></div>

        </div>

    </section>

    <!-- home category section ends -->

    <!-- home products section starts -->

    <section class="home-products">

        <div class="seven">
            <h1>latest products</h1>
        </div>

        <div class="product-slider">

            <div class="w">

            <!-- <p class="empty"> no products added yet!</p> -->

                <?php 

                    $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
                    $select_products->execute();

                    if($select_products->rowCount() > 0){

                    }
                    else
                    {
                        echo '<p class="empty"> no products added yet!</p>';
                    }
                
                ?>

            </div>

        </div>

    </section>

    <!-- home products section ends -->













    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="js/script.js?v=<?= $version?>"></script>

    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });

        var swiper = new Swiper(".category-slider", {
            loop: true,
            grabCursor: true,
            spaceBetween: 20,
            pagination: {
                // el: ".swiper-pagination",
            },
            breakpoints: {
                640: {
                slidesPerView: 2,
                },
                768: {
                slidesPerView: 3,
                },
                1024: {
                slidesPerView: 4,
                },
            },
        });
    </script>
    
</body>
</html>