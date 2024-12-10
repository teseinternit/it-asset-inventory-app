<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = "inventory_app";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    echo "Connection failed!";

}
