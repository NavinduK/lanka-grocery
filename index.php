<?php
    session_start();
    include('dbcon.php');
    // select products from db
    $sql = "SELECT * FROM products";
    $result = mysqli_query($con, $sql);
    //Put all selected questions into an array
    $products = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($products, $row);
        }
    }
?>

<!DocType html>
<html lang="en">

<head>
    <meta chaRMet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Fav Icon -->
    <link rel="icon" href="./images/Logo/lanka.png" type="image/x-icon">
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- ICON Link-->
    <script src="https://kit.fontawesome.com/418d14164c.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="./Css-Files/style.css" />
    <!-- Model Styling -->
    <link rel="stylesheet" href="./Css-Files/loader.css">

    <title>Lanka Grocery</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/navigation.php'); ?>
    <!-- Include Slider -->
    <?php include('Components/slider.php'); ?>

    <main>
        <!-- Menu Category -->
        <section  id="menu-section">
            <div class="small-container">
                <h2 class="title">Top Selling Products</h2>
                <div class="row">
                    <!-- Loop the 1st 4 products as top selling products -->
                    <?php 
                        $i = 0;
                        foreach ($products as $row) { 
                    ?>
                    <div class="col-4">
                        <img src=<?php echo $row['imagePath']; ?> alt="products">
                        <h2><?php echo $row['name']; ?></h2>
                        <p>Best Selling Product</p>
                        <a href="./product.php?product=<?php echo ($row['pid']); ?>"><button type="button" class="menu-btn">Buy Now <i
                                    class="fas fa-angle-double-right"></i></button></a>
                    </div>
                    <?php 
                        // stop from 4th iteration
                        $i++;
                        if($i==4) break;
                    } ?>
                </div>
                <!--Done-->
            </div>
        </section>
        <!-- Menu Category End -->

        <!-- Latest Product Feature -->
        <section class="Product-feature">
            <div>
                <h2>Our Latest Grocery Product</h2>
            </div>

            <section style="width: 100%;"  class="latest-product-feature">
                <!-- loop the products fetched to display in home -->
                <?php foreach ($products as $row) { ?>
                    <div class="product-item">
                        <div class="img-wrapper">
                            <img src=<?php echo $row['imagePath']; ?> alt=<?php echo $row['name']; ?>>
                        </div>
                        <div class="product-desc">
                            <h2 class="product-title"><?php echo ($row['name']); ?></h2>
                            <p class="product-price">Rs: <span><?php echo ($row['price']); ?></span>/-</p>
                            <div class="product-btn-container">
                                <a href="./product.php?product=<?php echo ($row['pid']); ?>" target="_blank"
                                    class="product-btn"><i class="fas fa-eye"></i> View</a>
                            </div>
                            <div class="add-container">
                                <a class="product-btn cart-btn" href="./product.php?product=<?php echo ($row['pid']); ?>"><i
                                        class="fas fa-cart-plus"></i> Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </section>
        <!-- Latest Product Feature End -->

    </main>

    <!-- Include the footer -->
    <?php include('Components/footer.php'); ?>

    <!-- Slick Slider -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Slider -->
    <script src="./js/slider.js"></script>
    <script src="./js/loader.js"></script>
    <!-- Custom JS -->
    <script src="./js/script.js"></script>
</body>


</html>