<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username already taken.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hash')");
            if ($insert) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Error in registration.";
            }
        }
    }
}
?><!DOCTYPE html><html>
<head>
    <title>Signup - Hospital Management</title>
    <style>
        body {
            background: #f2f6fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .signup-box {
            width: 380px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        h2 {
            text-align: center;
            color: #28a745;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #1e7e34;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .link {
            text-align: center;
            margin-top: 12px;
        }
        .link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body><div class="signup-box">
    <h2>Create Account</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" required />
        </div>
        <button type="submit">Register</button>
        <div class="link">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </form>
</div></body>
</html>