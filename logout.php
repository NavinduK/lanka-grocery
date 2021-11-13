<?php
    // remove the user session on logout
    session_start();
    session_destroy();
    // redirect to home
    header('location:index.php');
?>