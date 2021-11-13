<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./Css-Files/login.css">
</head>

<body>
	<div class="form-wrapper">
		<!-- login form -->
		<form action="#" method="post">
			<h3>Login here</h3>

			<div class="form-item">
				<input type="text" name="user" required="required" placeholder="Email" autofocus required></input>
			</div>

			<div class="form-item">
				<input type="password" name="pass" required="required" placeholder="Password" required></input>
			</div>

			<p style="text-align: center;">
				<a style="color: #ce5271;" href="./register.php">Reset Password</a>
			</p>

			<div class="button-panel">
				<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
			</div>

			<div class="form-item">
				<p style="text-align: center;">Not Registered? :
					<a style="color: #ce5271;" href="./register.php">Register Now</a>
				</p>
			</div>
		</form>
		<?php
		// fire when user pressed login
		if (isset($_POST['login'])) {
			// get user name and password by mysql injecting
			$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);

			//run query to check user password exist
			$query 		= mysqli_query($con, "SELECT * FROM users WHERE  password='$password' and username='$username'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);

			// check user exist, if found any matching result
			if ($num_row > 0) {
				// set the users sessions id,name,username
				$_SESSION['id'] = $row['user_id'];
				$_SESSION['uname'] = $row['username'];
				$_SESSION['name'] = $row['name'];
				// if the login page requested from checkout page, redirect again to it else to home
				if (isset($_GET['checkout'])) {
					header('location:proceed.php');
				} else
					header('location:index.php');
			} else {
				echo 'Invalid Username and Password Combination';
			}
		}
		?>

	</div>

</body>

</html>