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

// Fetch doctor data
$sql = "SELECT * FROM Doctors WHERE DoctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctorID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Doctor not found.");
}

$doctor = $result->fetch_assoc();

// Update if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $specialization = $_POST['Specialization'];
    $phone = $_POST['PhoneNumber'];

    $update = "UPDATE Doctors SET FirstName=?, LastName=?, Specialization=?, PhoneNumber=? WHERE DoctorID=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssi", $firstName, $lastName, $specialization, $phone, $doctorID);

    if ($stmt->execute()) {
        header("Location: view.php"); // Redirect back to doctors view
        exit;
    } else {
        echo "Error updating doctor: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Doctor</title>
<style>
    form { width: 50%; margin: 30px auto; }
    label { display: block; margin: 10px 0 5px; }
    input { width: 100%; padding: 8px; }
    button { margin-top: 15px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; }
</style>
</head>
<body>

<h2 align="center">Edit Doctor</h2>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="FirstName" value="<?php echo htmlspecialchars($doctor['FirstName']); ?>" required>

    <label>Last Name:</label>
    <input type="text" name="LastName" value="<?php echo htmlspecialchars($doctor['LastName']); ?>" required>

    <label>Specialization:</label>
    <input type="text" name="Specialization" value="<?php echo htmlspecialchars($doctor['Specialization']); ?>" required>

    <label>Phone Number:</label>
    <input type="text" name="PhoneNumber" value="<?php echo htmlspecialchars($doctor['PhoneNumber']); ?>" required>

    <button type="submit">Update Doctor</button>
</form>

</body>
</html>