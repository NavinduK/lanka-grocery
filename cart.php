<?php
    session_start();
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

    <title>Cart</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/navigation.php'); ?>

    <main>
        <section class="addToCart">
            <div class="addtoCart-wraper">
                <h2 class="title">Your Cart</h2>
                <div class="checkout-validation">
                    <!-- Alert to warn cart total must > 3000 -->
                    <i class="fas fa-exclamation-circle"></i> Cart total must be greater than Rs. 300
                </div>
                <div class="addtocart-table">
                    <table>
                        <caption>Order Details</caption>
                        <thead>
                            <tr>
                                <!-- Table headings of cart -->
                                <th>#</th>
                                <th scope="col"></th>
                                <th scope="col" colspan="2">Item Name</th>
                                <th scope="col" colspan="2">Price</th>
                                <th scope="col" colspan="2">Quantity</th>
                                <th scope="col" colspan="2">Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="displayCart">
                            <!-- Add data dynamically -->
                        </tbody>
                    </table>
                    <!-- right ide bar containing order details -->
                    <div class="subTotal">
                        <h1 class="border-h1">Delivery Details</h1>
                        <h4>Sub Total:</h4>
                        <span class="Total">Rs. 0</span>
                        <h4>Delivery Charges:</h4>
                        <span>Rs. 200</span>
                        <h4 class="border-h4 ">Grand Total:</h4>
                        <b><span class="grandTotal">Rs. 0</span></b>
                        <div class="border-h4 " style="display: flex;">
                            <h4 >Offer Code :</h4>
                            <input class="promo" type="text" name="promo" id="promo">
                        </div>
                        <button class="Order-placed" id="proceedToCheck">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Include the footer -->
    <?php include('Components/footer.php'); ?>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Check Out Js -->
    <script src="./js/checkout.js"></script>
    <!-- Custom JS -->
    <script src="./js/script.js"></script>
    <script src="./js/loader.js"></script>

</body>

</html>