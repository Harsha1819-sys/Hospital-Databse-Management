<?php include '../includes/header.php'; ?>
<div class="container mt-4">
  <h2>Add Doctor</h2>
  <form method="POST">
    <input type="text" name="name" class="form-control" placeholder="Doctor Name">
    <button type="submit" class="btn btn-primary mt-2">Add</button>
  </form>
</div>
<?php include '../includes/footer.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO patients (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    header("Location: view.php");
  }?>