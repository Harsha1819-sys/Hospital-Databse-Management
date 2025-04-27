<?php
include '../includes/db.php';
include '../includes/header.php';

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patient_id'];
    $doctorID = $_POST['doctor_id'];
    $appointmentDate = $_POST['appointment_date'];
    $reason = $_POST['reason'];

    $insert = "INSERT INTO Appointments (PatientID, DoctorID, AppointmentDate, Reason)
               VALUES ('$patientID', '$doctorID', '$appointmentDate', '$reason')";
    if (mysqli_query($conn, $insert)) {
        echo "<div class='success-msg'>Appointment added successfully.</div>";
    } else {
        echo "<div class='error-msg'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #023e8a;
            margin-bottom: 20px;
            font-size: 32px;
        }
        form {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        label {
            font-weight: 600;
            color: #0077b6;
            margin-bottom: 6px;
            display: block;
            font-size: 16px;
        }
        input[type="number"],
        input[type="datetime-local"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }
        input[type="number"]:focus,
        input[type="datetime-local"]:focus,
        input[type="text"]:focus {
            border-color: #00b4d8;
            box-shadow: 0 0 8px rgba(0, 180, 216, 0.4);
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            transform: scale(1.05);
        }
        .success-msg, .error-msg {
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }
        .success-msg {
            background: #d4edda;
            color: #155724;
        }
        .error-msg {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<h2>Add Appointment</h2>

<form method="post" action="">
    <label>Patient ID:</label>
    <input type="number" name="patient_id" required>

    <label>Doctor ID:</label>
    <input type="number" name="doctor_id" required>

    <label>Appointment Date:</label>
    <input type="datetime-local" name="appointment_date" required>

    <label>Reason:</label>
    <input type="text" name="reason" required>

    <input type="submit" value="Add Appointment">
</form>

<?php include '../includes/footer.php'; ?>
</body>
</html>