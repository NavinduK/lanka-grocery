<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:index.php');
}

include('dbcon.php');
if (isset($_GET['delete'])) {
    $delid = $_GET['delete'];
    $sql1 = "DELETE FROM products WHERE pid = $delid";
    mysqli_query($con, $sql1);
}

// Submit item add details to the DB 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];

    // manage image file
    $img =  $_FILES['imgf']['name']; //Get the file name
    $img_location = $_FILES['imgf']['tmp_name'];
    $img_folder = "images/product-images/";

    echo "running | " . $name . " | " . $desc . " | " . $price;
    $sql = "INSERT INTO products (`name`, `desc`, `price`, `availability`, `imagePath`)
                VALUES ('" . $name . "', '" . $desc . "', '" . $price . "', '" . "In Stock" . "', '" . $img_folder.preg_replace('/\s+/', '_', $img). "')";
    $query         = mysqli_query($con, $sql);
    // serve file
    if(move_uploaded_file($img_location,$img_folder.preg_replace('/\s+/', '_', $img))){
        //Done
    }else{
        header('location:404.html');
    }
}

if(isset($_POST["search"])){
    $search_value=$_POST["search"];
    $sql = "select * from products where name like '%$search_value%'";
    $result = mysqli_query($con, $sql);
    //Put all selected questions into an array
    $products = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($products, $row);
        }
    }
}
else{
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,400;1,500&display=swap" rel="stylesheet" />
    <!-- ICON Link-->
    <script src="https://kit.fontawesome.com/418d14164c.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="./Css-Files/style.css">
    <link rel="stylesheet" href="./Css-Files/form.css">
    <link rel="stylesheet" href="./Css-Files/loader.css">
    <!-- SweetAlert Link -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <title>Shop</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include Navigation bar -->
    <?php include('./Components/admin_navigation.php'); ?>

    <main>

        <h1 class="main-title">Grocery Shop</h1>
        <div style="text-align: center;">
            <button onclick="addForm()" id="add-btn" class="add-btn">Add New Product</button>
        </div>

        <!-- Add new Form -->
        <form enctype="multipart/form-data" method="post" action="#" id="add-form" class="add-form">
            <div class="form-control form-control-add">
                <label for="iname">Item Name:</label>
                <input type="text" id="iname" name="name" required>
                <small></small>
            </div>
            <div class="form-control form-control-add">
                <label for="desc">Item Details:</label>
                <input type="text" id="desc" name="desc" required>
                <small></small>
            </div>

            <div class="form-control form-control-add">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
                <small></small>
            </div>

            <div class="form-control form-control-add">
                <label for="imgf">Image:</label>
                <input type="file" id="imgf" name="imgf">
                <small></small>
            </div>
            <input type="submit" name="submit" class="add-item" value="Add Item">
        </form>

        <!-- Products -->
        <div class="product-container">
            <section style="width: 100%;" class="latest-product-feature">
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
                                <a href="./admin_product.php?product=<?php echo ($row['pid']); ?>" target="_blank" class="product-btn"><i class="fas fa-eye"></i> View & Edit</a>
                            </div>
                            <div class="add-container">
                                <a class="product-btn cart-btn" href="./admin_shop.php?delete=<?php echo ($row['pid']); ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </div>

    </main>

    <!-- Js file of page -->
    <script src="./js/script.js"></script>
    <script src="./js/loader.js"></script>
    <script src="./js/productDetail.js"></script>

</body>

</html>