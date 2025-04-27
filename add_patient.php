<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "HospitalManagement";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $dob = $_POST['DateOfBirth'];
    $gender = $_POST['Gender'];
    $address = $_POST['Address'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $emergencyName = $_POST['EmergencyContactName'];
    $emergencyPhone = $_POST['EmergencyContactPhone'];

    $sql = "INSERT INTO Patients (FirstName, LastName, DateOfBirth, Gender, Address, PhoneNumber, Email, EmergencyContactName, EmergencyContactPhone) 
            VALUES ('$firstName', '$lastName', '$dob', '$gender', '$address', '$phone', '$email', '$emergencyName', '$emergencyPhone')";

    if ($conn->query($sql) === TRUE) {
        echo "New patient added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 50%;
            margin: 40px auto;
            background-color: #f9f9f9;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
        }
        label, input, select {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Patient</h2>
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="FirstName" required>

        <label>Last Name:</label>
        <input type="text" name="LastName" required>

        <label>Date of Birth:</label>
        <input type="date" name="DateOfBirth" required>

        <label>Gender:</label>
        <select name="Gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Address:</label>
        <input type="text" name="Address" required>

        <label>Phone Number:</label>
        <input type="text" name="PhoneNumber" required>

        <label>Email:</label>
        <input type="email" name="Email">

        <label>Emergency Contact Name:</label>
        <input type="text" name="EmergencyContactName">

        <label>Emergency Contact Phone:</label>
        <input type="text" name="EmergencyContactPhone">

        <input type="submit" value="Add Patient">
    </form>
</div>

</body>
</html>