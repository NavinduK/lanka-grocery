<?php
session_start();
// Submit details to the DB 
if (isset($_POST['submit'])) {
    include('dbcon.php');
    $sql = "INSERT INTO history (name, email, phone, product_name, total_price, address, user_id, promo_code)
    VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $_POST['phone'] . "', '" . $_POST['product_name'] . "', '" . $_POST['total_price'] . "', '" . $_POST['address'] . "', '" . $_SESSION['id'] . "', '" . $_POST['promo_code'] . "')";
    
    if ($con->query($sql) === TRUE) {
        // find the newly inserted checkout ID 
        $query = mysqli_query($con, "SELECT LAST_INSERT_ID()");
		$lastID = mysqli_fetch_array($query);
        //clear cart and print receipt
        clear($lastID);
        // Order Confirm email
        $to      = $_POST['email'];
        $subject = "Order Confirmation - Lanka Grocery";
        $message = "Hello ".$_POST['name'].",\n Your order has sent"."\nOrder ID : ".$lastID."\n\nThank You..";
        $headers = 'From: webmaster@lankagrocery.com'       . "\r\n" .
                    'Reply-To: webmaster@lankagrocery.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();


}
?>

<?php

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
    <link rel="stylesheet" href="./Css-Files/form.css">

    <title>Proceed To Checkout</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/navigation.php'); ?>

    <main>
        <div class="usercreateacc">
            <?php
                // let user know what name user logged in
                if (isset($_SESSION['uname'])) {
                    echo "<p>You're Logged as <b>".$_SESSION['uname']."</b></p>";
                }else{
                    // redirect to login if not logged in
                    header('location:login.php?checkout=1');
                }
            ?>
        </div>
        <section class="user-info-sec">
            <h1 class="title">CHECK OUT</h1>
            <div>
                <div>
                    <!-- Get delivery details form -->
                    <form class="user-total-info-cont" action="proceed.php" id="proceed-form" method="POST">
                        <div class="user-personal-info">
                            <h2>Your Information:</h2>
                            <input id="product_name" type="text" name="product_name" hidden>
                            <input id="total_price" type="text" name="total_price" hidden>
                            <input id="promo_code" type="text" name="promo_code" hidden>
                            <div class="form-control">
                                <label for="userfullname">Full Name:</label>
                                <input type="text" id="userfullname" name="name" required>
                                <small></small>
                            </div>
                            <div class="form-control">
                                <label for="userperemail">Email:</label>
                                <input type="email" id="userperemail" name="email" required>
                                <small></small>
                            </div>

                            <div class="form-control">
                                <label for="useraddress">Full Adress:</label>
                                <input type="text" id="useraddress" name="address" required>
                                <small></small>
                            </div>

                            <div class="form-control">
                                <label for="userphone">Phone:</label>
                                <input type="tel" id="userphone" name="phone" required>
                                <small></small>
                            </div>
                            <div>
                                <h2>Card Payment Details (Optional):</h2>
                                <h4>Leave empty for cash on delivery</h2>
                                <div class="form-control">
                                    <label for="userperemail">Card Number:</label>
                                    <input type="cardno" id="cardno" name="email">
                                    <small></small>
                                </div>

                                <div style="display: flex;" class="form-control">
                                    <div >
                                        <label for="exp">Expiry Date:</label>
                                        <input type="text" id="exp" name="exp">
                                        <small></small>
                                    </div>
        
                                    <div>
                                        <label for="cvv">CVV:</label>
                                        <input type="number" id="cvv" name="cvv">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- right side bar containing order details -->
                        <div class="user-orderr-sum">
                            <div class="subTotal">
                                <h1 class="border-h1">Order Summary</h1>
                                <h4>Number Of Items In Cart: <span id="numItem"></span></h4>
                                <h4>Sub Total:</h4>
                                <span class="Total">Rs.0</span>
                                <h4>Delivery Charges:</h4>
                                <span>+ Rs. 200</span>
                                <h4 class="border-h4 ">Offer:</h4>
                                <b><span class="promoValue">Rs.0</span></b>
                                <h4 class="border-h4 ">Grand Total:</h4>
                                <b><span class="grandTotal">Rs.0</span></b>
                                <input type="submit" name="submit" class="Order-placed" value="Checkout"
                                    id="usercheckout">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>


    </main>

    <!-- Include the footer -->
    <?php include('Components/footer.php'); ?>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Custom JS -->
    <script src="./js/script.js"></script>
    <script src="./js/proceed.js"></script>
    <script src="./js/loader.js"></script>
    <?php 
        //clear cart and redirect to receipt
        function clear($lastID)
        {
            echo 
            "<script type='text/javascript'>
                // alert('cleared'); 
                localStorage.removeItem('productsCart');
                localStorage.removeItem('totalCost');
                localStorage.setItem('cartNumbers', 0);
                window.location.href = 'receipt.php?checkOutID=$lastID[0]';
            </script>" ;
        }
    ?>
</body>

</html>