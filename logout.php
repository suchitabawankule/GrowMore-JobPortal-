<?php
//This page created to logout Admin, Employee and student account.
session_start(); //This Function which allows user to create session variable.
session_destroy(); //this function clears all session variable data.
echo "<script>window.location='index.php';</script>"; //After clearing session variable data the page redirects to index page.
?>