<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = "localhost";               // Usually localhost
$user = "root";                    // Default for XAMPP
$password = "";                    // Blank by default
$database = "HospitalManagement";  // Your schema name

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>