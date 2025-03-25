<?php
//The main use this page is it will connect to the mysql database. Using this connection we can insert, update, select or delete the records...
//mysqli_connect function used to connect database to MySQL. Here Localhost is the Servername, root is the user name and Growmore_database is the name of the database.
$con=mysqli_connect("localhost","root","","GrowMore_database");
echo mysqli_connect_error();  //mysqli_connect_error function displays error from server
?>
