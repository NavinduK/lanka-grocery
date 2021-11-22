<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:index.php');
}
include('dbcon.php');

// get all sold items
$query         = mysqli_query($con, "SELECT * FROM history ORDER BY id DESC");
$num_row     = mysqli_num_rows($query);

// push the found items to an array of items
$items = array();
if ($num_row > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($items, $row);
    }
    $sumDelivered = mysqli_query($con, "SELECT SUM(total_price) FROM history where delivered=1")->fetch_array();
    $sumDelivered = $sumDelivered[0];
    $sumNotDelivered = mysqli_query($con, "SELECT SUM(total_price) FROM history where delivered=0")->fetch_array();
    $sumNotDelivered = $sumNotDelivered[0];
    $sum = $sumNotDelivered + $sumDelivered;
} else {
    // show user no items ordered past
    $notfound = 1;
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

    <title>Sales</title>
</head>

<body>
    <!-- Include navigation bar -->
    <?php include('Components/admin_navigation.php'); ?>

    <main>
        <section class="user-info-sec">
            <h1 class="title">Sales Report</h1>
            <div>
                <div>
                    <div class="user-total-info-cont">
                        <!-- Print No items if not fund -->
                        <?php if (isset($notfound)) { ?>
                            <div style="height: 100px;">
                                No Sales Arrived.
                            </div>
                            <!-- else print the item table -->
                        <?php } else { ?>
                            <div style="display: block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">Checkout No.</th>
                                            <th scope="col" colspan="2">Items</th>
                                            <th scope="col" colspan="2">Total</th>
                                            <th scope="col" colspan="2">Status</th>
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
                                                <td data-label='Item Name' colspan='2'>" . $item['id'] . "</td>
                                                <td data-label='Item Name' colspan='2'>" . $data . "</td>
                                                <td data-label='Quantity' colspan='2'>Rs. " . $item['total_price'] . "/-</td>
                                            ";
                                            if ($item['delivered'] == 1) {
                                                echo "
                                                <td data-label='Item Name' colspan='2'>Delivered</td>    
                                            ";
                                            } else {
                                                echo "
                                                <td data-label='Item Name' colspan='2'>Not Delivered</td>
                                            ";
                                            }
                                            echo "
                                            <td data-label='Quantity' colspan='2'><a target='_balnk' href='./receipt.php?checkOutID=" . $item['id'] . "'>Details <i class='fa fa-external-link'></i></a></td>
                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div style="color:red; width: 100%; height: 100px; text-align:center">
                                    Earning of sales delivered : Rs.<?php echo $sumDelivered; ?></br>
                                    Earning of sales Not delivered : Rs.<?php echo $sumNotDelivered; ?></br>
                                    Total Earning : Rs.<?php echo $sum; ?>
                                </div>
                            </div>
                        <?php } ?>
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