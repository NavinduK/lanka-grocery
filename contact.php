<?php
// Submit inquiry details entered by user to the DB 
    session_start();
    if (isset($_POST['submit'])) {
    include('dbcon.php');
    // query to insert data to inquiry
    $sql = "INSERT INTO inquiry (name, email, subject, message)
    VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $_POST['subject'] . "', '" . $_POST['message'] . "')";
    
    // run query and redirect to home if done
    if ($con->query($sql) === TRUE) {
        header("location:index.php"); ;
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="./Css-Files/style.css" />
    <!-- Model Styling -->
    <link rel="stylesheet" href="./Css-Files/loader.css">


    <title>Contact Us</title>
</head>

<body>
    <div id="loader"></div>

    <!-- Include navigation bar -->
    <?php include('Components/navigation.php'); ?>

    <main class="contact-section">
        <section class="contactUs-heading">
            <h1>CONNECT WITH US</h1>
            <h2>Contact us if you have any queries. We would be delighted to entertain your questions 24/7. Feel free to
                Email/Call or Contact us via social media!!</h2>
        </section>
        <div class="contact-wrapper">
            <!-- Contact form -->
            <form action="contact.php" method="POST">
                <div class="page-division">
                    <div class="contact-divs">
                        <div class="inputs">
                            <label for="name">Name</label>
                            <input required type="text" name="name" placehoder="Enter your Name" maxlength="20">
                        </div>
                        <div class="inputs">
                            <label for="email">Email</label>
                            <input required type="email" name="email" placehoder="Enter your Email">
                        </div>
                        <div class="inputs"> <label for="subject">Subject</label>
                            <input required type="text" name="subject" placehoder="Enter the subject">
                        </div>
                        <div class="inputs">
                            <label for="message">Message</label>
                            <textarea required name="message"></textarea>
                        </div>

                        <input class="submit-btn" name="submit" type="submit" value="Submit">

                    </div>
                    <!-- contact phone -->
                    <div class="contact-divs">
                        <h2>Call us now</h2>
                        <a class="call-btn" href="tel:03-55998282">
                            <i class="fa fa-phone-alt"></i>011-123-1234</a>

                    </div>
                </div>
            </form>
        </div>
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