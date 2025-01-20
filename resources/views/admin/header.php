<?php
session_start();
 include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}

 $user_id = $_SESSION['user_id']; 
 $role = $_SESSION['role']; 

if($role=="admin"){
        $sql = "SELECT * FROM administrators WHERE user_id='$user_id'";
}else if($role=="pelanggan"){
        $sql = "SELECT * FROM customers WHERE user_id='$user_id'";
}else if($role=="teknisi"){
        $sql = "SELECT * FROM technicians WHERE user_id='$user_id'";
}
$result = mysqli_query($conn, $sql);
 $nama='';
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['name'];
    } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grenviro Monitoring</title>
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/template.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="js/chart.js"></script>
  		
  </head>
  <body>
    <div class="container-scroller">
			
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>
              <!--<li class="nav-item dropdown">-->
              <!--  <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">-->
              <!--    <i class="mdi mdi-bell mx-0"></i>-->
              <!--    <span class="count bg-success">2</span>-->
              <!--  </a>-->
              <!--  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">-->
              <!--    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <div class="preview-icon bg-success">-->
              <!--            <i class="mdi mdi-information mx-0"></i>-->
              <!--          </div>-->
              <!--      </div>-->
              <!--      <div class="preview-item-content">-->
              <!--          <h6 class="preview-subject font-weight-normal">Application Error</h6>-->
              <!--          <p class="font-weight-light small-text mb-0 text-muted">-->
              <!--            Just now-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <div class="preview-icon bg-warning">-->
              <!--            <i class="mdi mdi-settings mx-0"></i>-->
              <!--          </div>-->
              <!--      </div>-->
              <!--      <div class="preview-item-content">-->
              <!--          <h6 class="preview-subject font-weight-normal">Settings</h6>-->
              <!--          <p class="font-weight-light small-text mb-0 text-muted">-->
              <!--            Private message-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <div class="preview-icon bg-info">-->
              <!--            <i class="mdi mdi-account-box mx-0"></i>-->
              <!--          </div>-->
              <!--      </div>-->
              <!--      <div class="preview-item-content">-->
              <!--          <h6 class="preview-subject font-weight-normal">New user registration</h6>-->
              <!--          <p class="font-weight-light small-text mb-0 text-muted">-->
              <!--            2 days ago-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--  </div>-->
              <!--</li>-->
              <!--<li class="nav-item dropdown">-->
              <!--  <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">-->
              <!--    <i class="mdi mdi-email mx-0"></i>-->
              <!--    <span class="count bg-primary">4</span>-->
              <!--  </a>-->
              <!--  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">-->
              <!--    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <img src="images/faces/face4.jpg" alt="image" class="profile-pic">-->
              <!--      </div>-->
              <!--      <div class="preview-item-content flex-grow">-->
              <!--          <h6 class="preview-subject ellipsis font-weight-normal">David Grey-->
              <!--          </h6>-->
              <!--          <p class="font-weight-light small-text text-muted mb-0">-->
              <!--            The meeting is cancelled-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <img src="images/faces/face2.jpg" alt="image" class="profile-pic">-->
              <!--      </div>-->
              <!--      <div class="preview-item-content flex-grow">-->
              <!--          <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook-->
              <!--          </h6>-->
              <!--          <p class="font-weight-light small-text text-muted mb-0">-->
              <!--            New product launch-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--    <a class="dropdown-item preview-item">-->
              <!--      <div class="preview-thumbnail">-->
              <!--          <img src="images/faces/face3.jpg" alt="image" class="profile-pic">-->
              <!--      </div>-->
              <!--      <div class="preview-item-content flex-grow">-->
              <!--          <h6 class="preview-subject ellipsis font-weight-normal"> <?php echo $nama ?>-->
              <!--          </h6>-->
              <!--          <p class="font-weight-light small-text text-muted mb-0">-->
              <!--            Upcoming board meeting-->
              <!--          </p>-->
              <!--      </div>-->
              <!--    </a>-->
              <!--  </div>-->
              <!--</li>-->
              <!--<li class="nav-item dropdown">-->
              <!--  <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>-->
              <!--</li>-->
              <!--<li class="nav-item nav-search d-none d-lg-block ms-3">-->
              <!--  <div class="input-group">-->
              <!--      <div class="input-group-prepend">-->
              <!--        <span class="input-group-text" id="search">-->
              <!--          <i class="mdi mdi-magnify"></i>-->
              <!--        </span>-->
              <!--      </div>-->
              <!--      <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">-->
              <!--  </div>-->
              <!--</li>	-->
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.jpeg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.jpeg" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <!--<li class="nav-item dropdown  d-lg-flex d-none">-->
                <!--  <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>-->
                <!--</li>-->
                <!--<li class="nav-item dropdown d-lg-flex d-none">-->
                <!--  <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-bs-toggle="dropdown">-->
                <!--  Reports-->
                <!--  </a>-->
                <!--  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">-->
                <!--      <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>-->
                <!--      <a class="dropdown-item">-->
                <!--        <i class="mdi mdi-file-pdf text-primary"></i>-->
                <!--        Pdf-->
                <!--      </a>-->
                <!--      <a class="dropdown-item">-->
                <!--        <i class="mdi mdi-file-excel text-primary"></i>-->
                <!--        Exel-->
                <!--      </a>-->
                <!--  </div>-->
                <!--</li>-->
                <!--<li class="nav-item dropdown d-lg-flex d-none">-->
                <!--  <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>-->
                <!--</li>-->
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name"><?php echo $nama ?></span>
                    <span class="online-status"></span>
                    <img src="images/faces/face28.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a href="logout.php" class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
                <?php
// Ambil peran pengguna dari sesi atau database

// Fungsi untuk menampilkan navigasi sesuai dengan peran pengguna
function displayNavigation($role) {
    switch ($role) {
        case "admin":
            echo "<ul class='nav page-navigation'>
                     <li class='nav-item'>
                <a class='nav-link' href='/'>
                  <i class='mdi mdi-file-document-box menu-icon'></i>
                  <span class='menu-title'>Dashboard</span>
                </a>
              </li>
              <li class='nav-item'>
                  <a href='historypressure.php' class='nav-link'>
                    <i class='mdi mdi-fire menu-icon'></i>
                    <span class='menu-title'>Pressure</span>
                    <i class='menu-arrow'></i>
                  </a>
                 
              </li>
              <li class='nav-item'>
                  <a href='historytemperature.php' class='nav-link'>
                    <i class='mdi mdi-temperature-celsius menu-icon'></i>
                    <span class='menu-title'>Temperature</span></span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <li class='nav-item'>
                  <a href='pages/charts/chartjs.html' class='nav-link'>
                    <i class='mdi mdi-finance menu-icon'></i>
                    <span class='menu-title'>Prediksi (Coming Soon)</span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <li class='nav-item'>
                  <a href='pages/tables/basic-table.html' class='nav-link'>
                    <i class='mdi mdi-note-text menu-icon'></i>
                    <span class='menu-title'>Catatan</span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <li class='nav-item'>
                  <a href='pages/icons/mdi.html' class='nav-link'>
                    <i class='mdi mdi-emoticon menu-icon'></i>
                    <span class='menu-title'>Pelanggan</span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
                </ul>";
            break;
        case "pelanggan":
           echo "<ul class='nav page-navigation'>
                     <li class='nav-item mx-auto'>
                <a class='nav-link' href='/'>
                  <i class='mdi mdi-file-document-box menu-icon'></i>
                  <span class='menu-title'>Dashboard</span>
                </a>
              </li>
              
                </ul>";
            break;
        case "teknisi":
            echo "<ul class='nav page-navigation'>
                     <li class='nav-item'>
                <a class='nav-link' href='/'>
                  <i class='mdi mdi-file-document-box menu-icon'></i>
                  <span class='menu-title'>Dashboard</span>
                </a>
              </li>
              <li class='nav-item'>
                  <a href='historypressure.php' class='nav-link'>
                    <i class='mdi mdi-fire menu-icon'></i>
                    <span class='menu-title'>Pressure</span>
                    <i class='menu-arrow'></i>
                  </a>
                 
              </li>
              <li class='nav-item'>
                  <a href='historytemperature.php' class='nav-link'>
                    <i class='mdi mdi-temperature-celsius menu-icon'></i>
                    <span class='menu-title'>Temperature</span></span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <li class='nav-item'>
                  <a href='pages/charts/chartjs.html' class='nav-link'>
                    <i class='mdi mdi-finance menu-icon'></i>
                    <span class='menu-title'>Prediksi (Coming Soon)</span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <li class='nav-item'>
                  <a href='pages/tables/basic-table.html' class='nav-link'>
                    <i class='mdi mdi-note-text menu-icon'></i>
                    <span class='menu-title'>Catatan</span>
                    <i class='menu-arrow'></i>
                  </a>
              </li>
              <!--<li class='nav-item'>-->
              <!--    <a href='pages/icons/mdi.html' class='nav-link'>-->
              <!--      <i class='mdi mdi-emoticon menu-icon'></i>-->
              <!--      <span class='menu-title'>Icons</span>-->
              <!--      <i class='menu-arrow'></i>-->
              <!--    </a>-->
              <!--</li>-->
                </ul>";
            break;
        default:
            echo "<p>Peran pengguna tidak valid.</p>";
            break;
    }
}

// Panggil fungsi untuk menampilkan navigasi
displayNavigation($role);
?>
             
            </ul>
        </div>
      </nav>
    </div>
