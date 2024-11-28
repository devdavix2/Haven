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



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Haven - Userdashboard</title>
  <link rel="shortcut icon" type="image/png" href="./asset/imgs/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

</head>
<style>
    /* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

</style>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <br>
            <br>
          <div>

          <h3> <img src="./asset/imgs/favicon.png" alt="">HAVEN</h3>
        </div>
          <br>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
          <hr>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <li class="sidebar-item">
              <a class="sidebar-link" href="home.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>


            <!-- Messages Link -->
<li class="sidebar-item">
  <a class="sidebar-link" href="messages.php" aria-expanded="false">
    <span>
      <i class="bi bi-chat-dots-fill"></i> <!-- Bootstrap icon for messages -->
    </span>
    <span class="hide-menu">Messages</span>
  </a>
</li>

<!-- Appointments Link -->
<li class="sidebar-item">
  <a class="sidebar-link" href="appointments.php" aria-expanded="false">
    <span>
      <i class="bi bi-calendar-check-fill"></i> <!-- Bootstrap icon for appointments -->
    </span>
    <span class="hide-menu">Appointments</span>
  </a>
</li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="profile.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Profile</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="properties.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Properties</span>
              </a>
            </li>
      
            <li class="sidebar-item">
              <a class="sidebar-link" href="payments.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu">Payments</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="settings.php" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Settings</span>
              </a>
            </li>
        
          <hr>

          <li class="sidebar-item">
              <a class="sidebar-link" href="logout.php" aria-expanded="false">
                <span>
                  <i class="ti ti-arrow-right"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>


        
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
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
            
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="profile.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="properties.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-cards fs-6"></i>
                      <p class="mb-0 fs-3"> Properties</p>
                    </a>
                    <a href="settings.php" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-settings fs-6"></i>
                      <p class="mb-0 fs-3"> Settings</p>
                    </a>
                    <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      
      <!--  Header End -->
      <div class="container-fluid">
      <br>
      <div class="row">

        <h3 class="card-title fw-semibold"> Appointments  </h3>

        <div class="container my-5">
        <!-- Page Heading -->
        <h2 class="text-center mb-4">Appointments</h2>

        <!-- Scheduled Appointments -->
        <div class="appointment-card">
            <h4>Upcoming Appointments</h4>
            <div class="card p-4">
                <table class="table table-striped appointments-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Property</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-11-15</td>
                            <td>10:00 AM</td>
                            <td>Property A</td>
                            <td><span class="appointment-status status-confirmed">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>2024-11-18</td>
                            <td>2:00 PM</td>
                            <td>Property B</td>
                            <td><span class="appointment-status status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>2024-11-22</td>
                            <td>11:30 AM</td>
                            <td>Property C</td>
                            <td><span class="appointment-status status-canceled">Canceled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Schedule New Appointment -->
        <div class="card p-4 appointment-card">
            <h4>Schedule a New Appointment</h4>
            <form action="schedule_appointment.php" method="post">
                <div class="mb-3">
                    <label for="appointment_date" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                </div>
                <div class="mb-3">
                    <label for="appointment_time" class="form-label">Appointment Time</label>
                    <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                </div>
                <div class="mb-3">
                    <label for="property" class="form-label">Property</label>
                    <select class="form-select" id="property" name="property" required>
                        <option value="Property A">Property A</option>
                        <option value="Property B">Property B</option>
                        <option value="Property C">Property C</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Schedule Appointment</button>
            </form>
        </div>
    </div>

    
        </div>

        <br>

        
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="./assets/js/dashboard.js"></script>
</body>

</html>