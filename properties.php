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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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

/* Properties Content Page Styles */
.properties-content {
    padding: 20px;
    background-color: #fff;
}

.filter-section {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-bar {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.filter-dropdown {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.properties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.property-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.property-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.property-info {
    padding: 15px;
    text-align: left;
}

.property-info h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.property-info p {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.property-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.btn {
    padding: 8px 12px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover,
.btn-success:hover,
.btn-danger:hover {
    opacity: 0.9;
}

/* Responsive Layout */
@media (max-width: 768px) {
    .properties-grid {
        grid-template-columns: 1fr;
    }

    .filter-section {
        flex-direction: column;
    }
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

        <h3 class="card-title fw-semibold"> Property Listings</h3>
        <br>
        <br>

        <p class="card-description fw-normal">  A great plateform to buy your properties without any agent or commisions. </p>


    
        </div>

        <br>
        


        <div class="properties-content">
    <!-- Search and Filter Section -->
    <div class="filter-section">
        <input type="text" class="search-bar" placeholder="Search properties...">
        <select class="filter-dropdown">
            <option value="all">All Types</option>
            <option value="apartment">Apartment</option>
            <option value="house">House</option>
            <option value="commercial">Commercial</option>
        </select>
        <button class="btn btn-primary">Search</button>
    </div>


    <br>

    <div>
      <h2>Featured Properties</h2>
    </div>
    <br>

    <!-- Properties Grid Section -->
    <div class="properties-grid">
        <!-- Property Card -->
        <div class="property-card">
            <img src="./asset/imgs/property-1.jpg" alt="Property Image" class="property-img">
            <div class="property-info">
                <h3>Luxury Apartment</h3>
                <p>3 Beds • 2 Baths • 1,500 sqft</p>
                <p>Location: New York City</p>
                <div class="property-actions">
                    <button class="btn btn-primary"> View Details</button>
                   
                </div>
            </div>
        </div>

        <!-- Example Property Card 2 -->
        <div class="property-card">
            <img src="./asset/imgs/property-2.jpg" alt="Property Image" class="property-img">
            <div class="property-info">
                <h3>Modern House</h3>
                <p>4 Beds • 3 Baths • 2,000 sqft</p>
                <p>Location: Los Angeles</p>
                <div class="property-actions">
                <button class="btn btn-primary"> View Details</button>

                </div>
            </div>
        </div>

        <!-- Example Property Card 3 -->
        <div class="property-card">
            <img src="./asset/imgs/property-3.jpg" alt="Property Image" class="property-img">
            <div class="property-info">
                <h3>Commercial Office</h3>
                <p>1,800 sqft • Prime Location</p>
                <p>Location: San Francisco</p>
                <div class="property-actions">
                <button class="btn btn-primary"> View Details</button>

                </div>
            </div>
        </div>
    </div>
</div>




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