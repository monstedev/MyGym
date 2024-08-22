<?php
require 'config/constants.php';

// connect to the database

$connection = new mysqli(DB__HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_errno($connection)) {
    die(mysqli_error($connection));
}