<?php
$conn = new mysqli("localhost", "root", "", "HospitalManagement");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM Doctors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Doctors</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; }
        h2 { text-align: center; background: #006699; color: white; padding: 15px; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border-bottom: 1px solid #ccc; text-align: center; }
        th { background: #3399cc; color: white; }
        tr:hover { background-color: #f1f1f1; }
        a.button { padding: 5px 10px; margin: 2px; background-color: #4CAF50; color: white; border-radius: 5px; text-decoration: none; }
        a.delete { background-color: red; }
        a.back { margin: 20px; display: block; text-align: center; color: #006699; font-weight: bold; }
        #searchInput {
            width: 300px;
            padding: 8px;
            margin: 20px auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h2>Doctor Records</h2>

<div style="text-align: center; margin: 20px;">
    <a href="add_doctor.php" class="button" style="background-color: #4CAF50; padding: 10px 20px; text-decoration: none; border-radius: 5px;">+ Add New Doctor</a>
</div>

<!-- Search Bar -->
<input type="text" id="searchInput" onkeyup="searchDoctors()" placeholder="Search for doctors...">

<table id="doctorsTable">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['DoctorID']}</td>
                    <td>{$row['FirstName']}</td>
                    <td>{$row['LastName']}</td>
                    <td>{$row['Specialization']}</td>
                    <td>{$row['PhoneNumber']}</td>
                    <td>{$row['Email']}</td>
                    <td>
                        <a href='edit_doctor.php?id={$row['DoctorID']}' class='button'>Edit</a>
                        <a href='delete_doctor.php?id={$row['DoctorID']}' class='button delete' onclick=\"return confirm('Are you sure you want to delete this doctor?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No doctors found</td></tr>";
    }
    ?>
</table>

<a class="back" href="index.php">&larr; Back to Home</a>

<!-- Search Script -->
<script>
function searchDoctors() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("doctorsTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Skip header row
        tr[i].style.display = "none"; // Hide all initially
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length - 1; j++) { // Skip the 'Actions' column
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break; // Show row if match found
                }
            }
        }
    }
}
</script>

</body>
</html>

<?php $conn->close(); ?>