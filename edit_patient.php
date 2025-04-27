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

// Check if PatientID is given
if (!isset($_GET['PatientID'])) {
    die("No patient ID provided.");
}

$patientID = intval($_GET['PatientID']);

// Fetch patient data
$sql = "SELECT * FROM Patients WHERE PatientID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patientID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Patient not found.");
}

$patient = $result->fetch_assoc();

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $dob = $_POST['DateOfBirth'];
    $gender = $_POST['Gender'];
    $phone = $_POST['PhoneNumber'];

    $update = "UPDATE Patients SET FirstName=?, LastName=?, DateOfBirth=?, Gender=?, PhoneNumber=? WHERE PatientID=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("sssssi", $firstName, $lastName, $dob, $gender, $phone, $patientID);

    if ($stmt->execute()) {
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Patient</title>
<style>
    form { width: 50%; margin: 30px auto; }
    label { display: block; margin: 10px 0 5px; }
    input, select { width: 100%; padding: 8px; }
    button { margin-top: 15px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; }
</style>
</head>
<body>

<h2 align="center">Edit Patient</h2>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="FirstName" value="<?php echo htmlspecialchars($patient['FirstName']); ?>" required>

    <label>Last Name:</label>
    <input type="text" name="LastName" value="<?php echo htmlspecialchars($patient['LastName']); ?>" required>

    <label>Date of Birth:</label>
    <input type="date" name="DateOfBirth" value="<?php echo $patient['DateOfBirth']; ?>" required>

    <label>Gender:</label>
    <select name="Gender" required>
        <option value="Male" <?php if ($patient['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($patient['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
        <option value="Other" <?php if ($patient['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
    </select>

    <label>Phone Number:</label>
    <input type="text" name="PhoneNumber" value="<?php echo htmlspecialchars($patient['PhoneNumber']); ?>" required>

    <button type="submit">Update Patient</button>
</form>

</body>
</html>