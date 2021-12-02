    <!-- Header Starts -->
    <header>
        <div class="topNav topNav-admin">
            <div class="topnav-left">
                <h5>Admin Dashboard - Lanka Grocery</h5>
            </div>
            <div class="search-container">
                <div class="form-right">
                    <?php
                    if (isset($_SESSION['admin'])) {
                        echo "
                            <p style='color: #FF9900;'>User View : </p>
                            <button class='btn-tool-tip'>
                                <a href='./index.php'> <i class='fa fa-users-cog'></i></a>
                            </button>
                            ";
                    }
                    ?>
                    <p style="color: #FF9900;">Log Out : </p>
                    <?php
                    // Show login button only if user not logged, else show logout button
                    //  Done by cecking users id on session 
                    if (isset($_SESSION['id'])) {
                        // logout button shown
                        echo "
                                <button class='btn-tool-tip'>
                                    <a href='./logout.php'><i class='fa fa-sign-out'></i></a>
                                </button>
                            ";
                    } else {
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
        <div class="midNavA">
            <!-- nav bar menu -->
            <div></div>
            <form style="margin-left: auto;" class="search-form" action="./shop.php" method="post">
                <input class="inSearch" type="text" name="search">
                <input class="inSearchBtn" type="submit" name="submit" value="Search">
            </form>
        </div>
    </header>
    <!-- Header Ends -->

    <!-- Navigation categories -->
    <div class="navigation-bar navigation-bar-admin">
        <nav class="nav-categories">
            <ul>
                <li><a href="./admin_shop.php"><i class="fas fa-memory"></i> Shop Items</a></li>
                <!-- cart button -->
                <li>
                    <a href="./admin_new_sales.php">
                        <i class="fas fa-cart-plus"></i> Sales To Deliver
                    </a>
                </li>
                <!-- history orders button -->
                <li>
                    <a href="./admin_sales.php">
                        <i class="fas fa-history"></i> All Sales
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Navigation categories Ends-->