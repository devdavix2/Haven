<?php
session_start();
include_once 'config.php';

// Check if the user is logged in and has the role 'user'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit();
}

// Fetch user data
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="dashboard.css" />
    

    <title> Dhomes - User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
</head>
<body>
<nav>
    <!-- Your navigation code -->
    <nav>
      <div class="menu-items">
        <ul class="nav-links">
          <li class="navlogo">
            <a href="user_dashboard.php">
              <img class="dashboard-logo" src="monexus.png" alt="home" />
            </a>
          </li>
          <li>
            <a href="user_dashboard.php">
              <img class="dashboard-icon" src="./icons/home.svg" alt="home" />
              <span class="link-name">Dashboard</span> 
            </a>
          </li>
          <li>
            <a href="properties.php">
              <img class="dashboard-icon" src="./icons/person.svg" alt="person" />
              <span class="link-name"> Properties</span>
            </a>
          </li>
      
          <li>
            <a href="payments.php">
              <img class="dashboard-icon" src="./icons/download.svg" alt="deposit" />
              <span class="link-name">Paymennts</span>
            </a>
          </li>
          <li>
            <a href="settings.php">
              <img class="dashboard-icon" src="./icons/wallet.svg" alt="withdrawal" />
              <span class="link-name">Settings</span>
            </a>
          </li>

          <li>
                <a href="support.php">
              <img class="dashboard-icon" src="./icons/chat.svg" alt="support" />
              <span class="link-name">Support</span>
            </a>
          </li>
        </ul>
        <br>
        <ul class="logout-mode">
          <li>
            <a href="logout.php">
              <img class="dashboard-icon" src="./icons/exit.svg" alt="logout" />
              <span class="link-name">Logout</span>
            </a>
          </li>
          <li class="mode">
            <div class="mode-toggle"></div>
          </li>
        </ul>
      </div>
    </nav>
</nav>



<section class="dashboard">

      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->


</section>


</body>
</html>
