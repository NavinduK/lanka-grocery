<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="./Css-Files/login.css">
</head>

<body>
    <div class="form-wrapper">
        <!-- login form -->
        <form action="#" method="post">
            <h3>Register here</h3>

            <div class="form-item">
                <input type="text" name="uname" required="required" placeholder="Name" autofocus required></input>
            </div>

            <div class="form-item">
                <input type="email" name="email" required="required" placeholder="Email" autofocus required></input>
            </div>

            <div class="form-item">
                <input type="password" name="pass" required="required" placeholder="Password" required></input>
            </div>

            <div class="button-panel">
                <input type="submit" class="button" title="Register" name="register" value="Register"></input>
            </div>

            <div class="form-item">
				<p style="text-align: center;">Already Registered? :
					<a style="color: #ce5271;" href="./Login.php">Login here</a>
				</p>
			</div>
        </form>
        <?php
	// fire when user pressed register
	if (isset($_POST['register']))
		{
			// get user name and password by mysql injecting
			$uname = mysqli_real_escape_string($con, $_POST['uname']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			
			//run query to check user password exist
            $sql = "INSERT INTO users (name, username, password)
                VALUES ('" . $uname . "', '" . $email . "', '" . $password . "')";
			$query 		= mysqli_query($con, $sql);
			
            header('location:login.php');
			
		}
  ?>

    </div>

</body>

</html>