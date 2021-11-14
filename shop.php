<?php
    session_start();
    include('dbcon.php');
    // select all products fro db
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Fav Icon -->    
    <link rel="icon" href="./images/Logo/lanka.png" type="image/x-icon">
    <!-- Font Link -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,400;1,500&display=swap"
        rel="stylesheet" />
    <!-- ICON Link-->
    <script src="https://kit.fontawesome.com/418d14164c.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="./Css-Files/style.css">
    <link rel="stylesheet" href="./Css-Files/loader.css">
    <!-- SweetAlert Link -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <title>Shop</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include Navigation bar -->
    <?php include('./Components/navigation.php'); ?>

    <main>

        <h1 class="main-title">Grocery Shop</h1>
        <!-- Products -->
        <div class="product-container">
            <section style="width: 100%;"  class="latest-product-feature">
                <!-- loop the products fetched to display in home -->
                <?php foreach ($products as $row) { ?>
                <div style="margin-left: 3px;" class="product-item">
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
        </div>

    </main>

    <!-- Include Footer -->
    <?php include('./Components/footer.php'); ?>

    <!-- Js file of page -->
    <script src="./js/script.js"></script>
    <script src="./js/loader.js"></script>

</body>

</html>