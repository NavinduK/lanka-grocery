    <!-- Header Starts -->
    <header>
        <div class="topNav">
            <div class="topnav-left">
                <h5>Welcome To Lanka Grocery</h5>
            </div>
            <div class="search-container">
                <div class="form-right">
                    <p style="color: #FF9900;">User area : </p>
                    <?php 
                    // Show login button only if user not logged, else show logout button
                    //  Done by cecking users id on session 
                        if(isset($_SESSION['id'])){
                            // logout button shown
                            echo "
                                <button class='btn-tool-tip'>
                                    <a href='./logout.php'><i class='fa fa-sign-out'></i></a>
                                </button>
                            ";
                        }else{
                            // login button shown
                            echo "
                                <button class='btn-tool-tip'>
                                    <a href='./Login.php'>
                                        <i class='fas fa-user-circle'></i></a>
                                </button>
                            ";
                        }

                    ?>
                </div>
            </div>
        </div>
        <div class="midNav">
            <!-- nav bar menu -->
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./contact.php">Contact Us</a></li>
            </ul>

            <i class="fas fa-baRM"></i>

        </div>

    </header>
    <!-- Header Ends -->

    <!-- Navigation categories -->
    <div class="navigation-bar">
        <nav class="nav-categories">
            <ul>
                <li><a href="./shop.php"><i class="fas fa-memory"></i> Grocery Shop</a></li>
                <!-- cart button -->
                <li class="add-to-cart">
                    <a href="./cart.php">
                        <span class="span-cart">0</span>
                        <i class="fas fa-cart-plus"></i> My Cart
                    </a>
                </li>
                <!-- history orders button -->
                <li>
                    <a href="./history.php">
                        <i class="fas fa-history"></i> My Orders
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Navigation categories Ends-->