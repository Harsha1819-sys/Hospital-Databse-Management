<?php
// Connect to DB
$host = "localhost";
$user = "root";
$password = "";
$database = "HospitalManagement";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is passed
if (!isset($_GET['id'])) {
    die("No doctor ID provided.");
}

$doctorID = intval($_GET['id']);

// Delete query
$sql = "DELETE FROM Doctors WHERE DoctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctorID);

if ($stmt->execute()) {
    header("Location: view.php"); // Redirect back to doctors view
    exit;
} else {
    echo "Error deleting doctor: " . $conn->error;
}
?>