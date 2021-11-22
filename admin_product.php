<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:index.php');
}

include('dbcon.php');
$pid =  $_GET['product'];
// Submit details to the DB 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $sql1 = "UPDATE products Set name=$name, desc=$desc, price=$price, availability=$availability Where pid = $pid";
}

// fetch product by the pid got in the get request
$query         = mysqli_query($con, "SELECT * FROM products WHERE  pid = $pid");
$product        = mysqli_fetch_array($query);
$num_row     = mysqli_num_rows($query);
// redirect 404 not found error if product not found 
if (!$num_row > 0) {
    // 404 notfound if no result
    header('location:404.html');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Fav Icon -->
    <link rel="icon" href="./images/Logo/lanka.png" type="image/x-icon">

    <!-- ICON Link-->
    <script src="https://kit.fontawesome.com/418d14164c.js" crossorigin="anonymous"></script>
    <!-- FontAwsome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,400;1,500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="./Css-Files/form.css">
    <link rel="stylesheet" href="./Css-Files/style.css" />

    <title><?php echo ($product['name']); ?></title>
</head>

<body>
    <!-- Include Navigation bar -->
    <?php include('Components/admin_navigation.php'); ?>

    <main>
        <!-- Insert the data fetched above to the web page -->
        <section class="product-details">
            <div class="product-image ">
                <img src=<?php echo ($product['imagePath']); ?> alt=<?php echo ($product['name']); ?> class="detail-view" style="display: none;">
                <div class="detail-view" style="background-image: url(<?php echo ($product['imagePath']); ?>);"></div>
            </div>
            <div id="product-data" class="product-description">
                <small>NEW</small>
                <h2><?php echo ($product['name']); ?></h2>
                <p class="prod-short-desc">
                    <?php echo ($product['desc']); ?>
                </p>
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-alt"></i>
                </div>
                <p class="product-price">Rs: <span><?php echo ($product['price']); ?></span>/-</p>
                <p class="available"><b>Availability:</b> <?php echo ($product['availability']); ?></p>
                <div class="qty-btn">
                    <button onclick="updateForm()" id="update-btn" class="update-btn">Update Details</button>
                </div>
            </div>
            <form method="post" action="#" id="update-form" class="product-description">
                <div class="form-control">
                    <label for="iname">Item Name:</label>
                    <input value="<?php echo ($product['name']); ?>" type="text" id="iname" name="name" required>
                    <small></small>
                </div>
                <div class="form-control">
                    <label for="desc">Item Details:</label>
                    <input value=" <?php echo ($product['desc']); ?>" type="text" id="desc" name="desc" required>
                    <small></small>
                </div>

                <div class="form-control">
                    <label for="price">Price:</label>
                    <input value="<?php echo ($product['price']); ?>" type="number" id="price" name="price" required>
                    <small></small>
                </div>

                <div class="form-control">
                    <label for="userphone">Availability:</label>
                    <select id="avl" name="availability" required>
                        <option selected value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                    <small></small>
                </div>
                <input type="submit" name="submit" class="Order-placed" value="Update">
            </form>
        </section>
    </main>

    <script src="./js/script.js"></script>
    <script src="./js/productDetail.js"></script>
</body>

</html>