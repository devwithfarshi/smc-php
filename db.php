<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name="smc";

// Create connection
$db_con = new mysqli($servername, $username, $password,$db_name);

// Check connection
if ($db_con->connect_error) {
  die("Connection failed: " . $db_con->connect_error);
}