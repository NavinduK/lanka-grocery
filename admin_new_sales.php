<?php
    session_start();
    include('dbcon.php');
    if (!isset($_SESSION['admin'])) {
        header('location:index.php');
    }
    if (isset($_GET['delivered'])) {
        $delid = $_GET['delivered'];
        $sql1 = "UPDATE history
            SET delivered= 1
            WHERE id = $delid";
        mysqli_query($con,$sql1);

    }
    
    // get all sold items
    $query 		= mysqli_query($con, "SELECT * FROM history where delivered=0 ORDER BY id DESC");
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

    <title>Sales</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/admin_navigation.php'); ?>

    <main>
        <section class="user-info-sec">
            <h1 class="title">New Sales - Not Deliver</h1>
            <div>
                <div>
                    <div class="user-total-info-cont">
                        <!-- Print No items if not fund -->
                        <?php if(isset($notfound)){ ?>
                        <div style="height: 100px;">
                            No New Sales Arrived.
                        </div>
                        <!-- else print the item table -->
                        <?php }else{ ?>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Checkout No.</th>
                                    <th scope="col" colspan="2">Items</th>
                                    <th scope="col" colspan="2">User Name</th>
                                    <th scope="col" colspan="2">User adress</th>
                                    <th scope="col" colspan="2">Phone</th>
                                    <th scope="col" colspan="2">Deliver</th>
                                    <th scope="col" colspan="2">Details</th>
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
                                                <td data-label='Item Name' colspan='2'>".$item['name']."</td>
                                                <td data-label='Item Name' colspan='2'>".$item['address']."</td>
                                                <td data-label='Item Name' colspan='2'>".$item['phone']."</td>
                                                <td data-label='Quantity' colspan='2'><a style='color:#ce5271' href='./admin_new_sales.php?delivered=".$item['id']."'>Mark As Delivered</a></td>
                                                <td data-label='Quantity' colspan='2'><a target='_balnk' href='./admin_order_data.php?checkOutID=".$item['id']."'>Details <i class='fa fa-external-link'></i></a></td>
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

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Custom JS -->
    <script src="./js/script.js"></script>
    <script src="./js/loader.js"></script>
</body>

</html>