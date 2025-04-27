<?php
session_start();
$username = $_SESSION['username'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hospital Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style> 
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: url('https://images.unsplash.com/photo-1588776814546-ec7e5e4c9aa2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(8px);
      border-radius: 20px;
      padding: 40px;
      margin: 30px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 600px;
      text-align: center;
      transition: all 0.3s ease-in-out;
    }

    header {
      width: 100%;
      padding: 25px 0;
      background: linear-gradient(135deg, #0077b6, #023e8a);
      color: white;
      text-align: center;
      font-size: 36px;
      font-weight: 700;
      position: relative;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .logout-btn {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
    }

    .logout-btn a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      background: linear-gradient(135deg, #ff4d4d, #c0392b);
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .logout-btn a:hover {
      background: linear-gradient(135deg, #c0392b, #ff4d4d);
    }

    .welcome {
      margin: 20px 0;
      font-size: 24px;
      font-weight: 600;
      color: #2c3e50;
    }

    nav {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-top: 30px;
    }

    .nav-btn {
      padding: 15px 20px;
      background: linear-gradient(135deg, #00b4d8, #0077b6);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 20px;
      text-decoration: none;
      font-weight: 700;
      transition: 0.3s ease;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    }

    .nav-btn:hover {
      background: linear-gradient(135deg, #0077b6, #00b4d8);
      transform: translateY(-3px);
    }

    footer {
      margin-top: auto;
      padding: 15px;
      width: 100%;
      text-align: center;
      background: linear-gradient(135deg, #0077b6, #023e8a);
      color: white;
      font-size: 14px;
      font-weight: 500;
      backdrop-filter: blur(10px);
      box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.2);
    }

    a {
      color: #0077b6;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    Hospital Management System
    <?php if ($username): ?>
      <div class="logout-btn">
        <a href="logout.php">Logout</a>
      </div>
    <?php endif; ?>
  </header>

  <div class="overlay">
    <div class="welcome">
      <?php if ($username): ?>
        Welcome, <?= htmlspecialchars($username) ?>!
      <?php else: ?>
        Welcome Guest. Please <a href="login.php">Login</a> or <a href="signup.php">Signup</a>.
      <?php endif; ?>
    </div>

    <nav>
      <a class="nav-btn" href="patients/view.php">Manage Patients</a>
      <a class="nav-btn" href="doctors/view.php">Manage Doctors</a>
      <a class="nav-btn" href="appointments/view.php">Appointments</a>
    </nav>
  </div>

  <footer>
    &copy; 2025 Hospital Management System
  </footer>

</body>
</html>