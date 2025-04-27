<?php
// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$database = "HospitalManagement";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Correct: check 'id' not 'PatientID'
if (!isset($_GET['id'])) {
    die("No Patient ID provided.");
}

$patientID = intval($_GET['id']);

// Delete patient
$sql = "DELETE FROM Patients WHERE PatientID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patientID);

if ($stmt->execute()) {
    header("Location: view.php"); // Go back to list
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>