<?php
// connection strings
$con = mysqli_connect("localhost:3306","root","navinduk","shopping");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
