<?php
session_start();
include_once 'config.php';

$error = ''; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("SELECT user_id, password, role FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password, $role);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email; // Store email in session
                $_SESSION['role'] = $role;

                // Redirect based on role
                header('Location: ' . ($role === 'admin' ? 'admin_dashboard.php' : 'home.php'));
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email.";
        }
        
        // Close the statement
        $stmt->close();
    } else {
        $error = "Invalid email format.";
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven Real Estate - Login</title>
    <link rel="shortcut icon" type="image/png" href="./asset/imgs/favicon.png" />

    <style>
        /* Reset and Box Sizing */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.link{ 


    text-decoration:none;
}

body, html {
    height: 100%;
    font-family: Arial, sans-serif;
}

/* Full-screen Background */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('./asset/imgs/welcome-banner.png') no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

/* Dark Overlay with Blur Effect */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    z-index: 1;
}

/* Form Container */
.form-section {
    position: relative;
    z-index: 2;
    background-color: hsl(224, 100%, 68%);
    padding: 40px;
    border-radius: 15px;
    width: 350px;
    text-align: center;
    color: white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

/* Logo Section */
.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

.logo-container img {
    width: 50px;
    height: auto;
    margin-bottom: 10px;
}

.logo-container h3 {
    font-size: 28px;
    margin: 0;
}

/* Heading */
h3 {
    font-size: 24px;
    color: white;
    margin-bottom: 20px;
}

/* Error Message */
.error {
    color: #ff4c4c;
    margin-bottom: 15px;
    font-size: 14px;
}

/* Form Input Fields */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid hsl(224, 100%, 80%);
    border-radius: 5px;
    background-color: #f9f9f9;
    font-size: 14px;
    color: #333;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: hsl(224, 100%, 60%);
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: white;
    color: hsl(224, 100%, 68%);
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: hsl(224, 100%, 80%);
    color: white;
}

/* Register Link */
a {
    color: white;
    text-decoration: none;
    display: block;
    margin-top: 15px;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}

/* Overlay Text */
.overlay-text {
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    text-align: center;
    z-index: 2;
}

.overlay-text h1 {
    font-size: 48px;
    margin-bottom: 10px;
}

.overlay-text p {
    font-size: 18px;
}

/* Responsive Layout */
@media (max-width: 768px) {
    .form-section {
        width: 90%;
        padding: 20px;
    }

    .logo-container img {
        width: 40px;
    }

    .logo-container h3 {
        font-size: 24px;
    }

    h3 {
        font-size: 20px;
    }

    .overlay-text h1 {
        font-size: 32px;
    }

    .overlay-text p {
        font-size: 14px;
    }
}

    </style>
        
</head>
<body>
    <!-- Form Section -->
    <div class="form-section">
        <!-- Logo Section -->
        <div class="logo-container">
            <a  class="link" href="index.html">
            <img src="./asset/imgs/logo.png" alt="Haven Logo" class="logo-img">
            <h1 class="logo-text">HAVEN</h1>
</a>
        </div>
        <p> Find Your Dream Home </p>
        <br>
        <br>

        <h3>Login </h3>

        <!-- Display Error Message if Any -->
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <input type="submit" value="Login" class="submit-btn">
        </form>

        <!-- Register Link -->
        <p class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </p>
    </div>
</body>

</html>
