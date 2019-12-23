<?php
session_start();

$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "clinic"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, or were given, to access your database
$dbpass = ""; // the password that you created, or were given, to access your database

$dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
OR die('Could not connect to database' .
mysqli_connect_error());

?>