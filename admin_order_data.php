<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location:index.php');
    }
    include('dbcon.php');
    // get the checkout id from the http get
    $cid = $_GET['checkOutID'];
    // select the relevent checkout data from db
    $query 		= mysqli_query($con, "SELECT * FROM history where id = $cid");
    $num_row 	= mysqli_num_rows($query);
    
    // set result if found, or 404 error in not found
    if($num_row>0){
        $result = mysqli_fetch_array($query);
    }else{
        header('location:404.html');
    }
    $con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav Icon -->
    <link rel="icon" href="./images/Logo/lanka.png" type="image/x-icon">
    <!-- FontAwsome Link -->
    <script src="https://kit.fontawesome.com/418d14164c.js" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Css File -->
    <link rel="stylesheet" href="./Css-Files/style.css">
    <link rel="stylesheet" href="./Css-Files/addTocart.css">
    <!-- Model Styling -->
    <link rel="stylesheet" href="./Css-Files/loader.css">
    <link rel="stylesheet" href="./Css-Files/proceed.css">

    <title>Details</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/admin_navigation.php'); ?>

    <main>
        <div class="usercreateacc">
            <?php
                // let user know what name user logged in
                if (isset($_SESSION['uname'])) {
                    echo "<p>You're Logged as <b>".$_SESSION['uname']."</b></p>";
                }else{
                    // redirect to login if not logged in
                    header('location:login.php');
                }
            ?>
        </div>
        <section class="user-info-sec">
            <h1 class="title">Order Details</h1>
            <div>

                <div>
                    <div class="user-total-info-cont receiptView">
                        <!-- item info table -->
                        <table class="receiptList">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Item Name</th>
                                    <th scope="col" colspan="2">Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="displayCart">
                                <?php 
                                // print items and their quantity by splitting the items string from db
                                    $products = explode(',', $result['product_name']); 
                                    // loop the products array to print rows
                                    foreach ($products as $item) {
                                        $row = explode(':', $item);
                                        echo "
                                            <tr class='receiptTR'>
                                                <td data-label='Item Name' colspan='2'>$row[0]</td>
                                                <td data-label='Quantity' colspan='2'>$row[1]</td>
                                            </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>

                        <!-- right side bar containing order details -->
                        <div class="user-orderr-sum">
                            <div class="subTotal">
                                <h1 class="border-h1">Order Summary</h1>
                                <h4>Checkout No. : <span id="numItem"><?php echo $result['id'] ?></span></h4>
                                <h4>Name :</h4>
                                <span class="Total"> <?php echo $result['name'] ?></span>
                                <h4>Delivery Address :</h4>
                                <span> <?php echo $result['address'] ?></span>
                                <div style="display: flex;">
                                <?php if(strlen($result['promo_code']) >= 3){ ?>
                                    <div style="margin-right: 40px;">
                                        <h4>Promo Code:</h4>
                                        <b> <span class="grandTotal"><?php echo $result['promo_code'] ?></span></b>
                                    </div>
                                <?php } ?>

                                    <div>
                                        <h4>Grand Total:</h4>
                                        <b> <span class="grandTotal"><?php echo $result['total_price'] ?>/- Rs</span></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Custom JS -->
    <script src="./js/script.js"></script>
    <script src="./js/loader.js"></script>
</body>

</html>