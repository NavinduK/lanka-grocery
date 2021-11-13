<?php
    session_start();
    include('dbcon.php');
    
    // take the logged user's id and find user's past orders in db
    $uid = $_SESSION['id'];
    $query 		= mysqli_query($con, "SELECT * FROM history where user_id = $uid");
    $num_row 	= mysqli_num_rows($query);

    // push the found items to an array of items
    $items = array();
    if ($num_row > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($items, $row);
        }
    }else{
        // show user no items ordered past
        $notfound=1;
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

    <title>Previous Orders</title>
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
                    // redirect to logout if not logged in
                    header('location:login.php');
                }
            ?>
        </div>
        <section class="user-info-sec">
            <h1 class="title">Previous Orders</h1>
            <div>
                <div>
                    <div class="user-total-info-cont">
                        <!-- Print No items if not fund -->
                        <?php if(isset($notfound)){ ?>
                        <div style="height: 100px;">
                            No Items Previously orderd.
                        </div>
                        <!-- else print the item table -->
                        <?php }else{ ?>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Checkout No.</th>
                                    <th scope="col" colspan="2">Items</th>
                                    <th scope="col" colspan="2">Total</th>
                                    <th scope="col" colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody class="displayCart">
                                <?php
                                        // loop the items array to print table rows
                                        foreach ($items as $item) {
                                            $data = implode("<br/>", explode(",", $item['product_name']));
                                            $data = implode(" - ", explode(":", $data));
                                            echo "
                                            <tr class='receiptTR'>
                                                <td data-label='Item Name' colspan='2'>".$item['id']."</td>
                                                <td data-label='Item Name' colspan='2'>".$data."</td>
                                                <td data-label='Quantity' colspan='2'>".$item['total_price']."/-Rs</td>
                                                <td data-label='Quantity' colspan='2'><a target='_balnk' href='./receipt.php?checkOutID=".$item['id']."'>Receipt <i class='fa fa-external-link'></i></a></td>
                                            </tr>
                                            ";
                                        }
                                    ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>

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
    <script src="./js/loader.js"></script>
</body>

</html>