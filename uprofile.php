<?php
require_once'session.php';
  require_once'class.php';

 $user_data = $db->get_user_data($user_id);

 $personal_info = $user_data['user_info'];
 // $spouse = $db-> get_user_data($user_id);
 // $primary_educ = $db-> get_user_data($user_id);
 // $secondary_educ = $db-> get_user_data($user_id);
 // $tertiary_educ = $db-> get_user_data($user_id);
 // $beneficiaries = $db-> get_user_data($user_id);
  $db=new db_class(); 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Web Page Template</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false" aria-label="Toggle Sidebar" onclick="toggleSidebar(event)">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-brand">
        <img src="images/logo.png" alt="logo-image" class="logo">
        <a href="#">Loan Management System</a>
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle Navigation" onclick="toggleTopNav(event)">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="top-nav-icons">
              <div class="top-nav-icon">
                <i class="fas fa-user"></i>
              </div>
              <div class="top-nav-icon" id="notificationIcon">
  <i class="fas fa-bell"></i>
  <div id="notificationCount" class="notification-count"></div>
  <div id="notificationDropdown" class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notificationIcon">
    <a class="dropdown-item disabled" href="#">No notifications</a>
  </div>
</div>


              <div class="top-nav-icon" id="logoutIcon">
                <i class="fas fa-sign-out-alt"></i>
                <span class="top-nav-text">Logout</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 sidebar" id="sidebarNav">
  <div class="sidebar-sticky">
    <div class="admin-container text-center">
      <img src="images/user_logo.png" alt="Admin Image" class="admin-image">
      <div class="admin-name"><?php echo $_SESSION['name']; ?></div>
      <div class="admin-role"><?php echo $_SESSION['role']; ?></div>
    </div>
    <ul class="nav flex-column sidebar-menu">
      <li class="nav-item sidelist">
        <a class="nav-link side active" href="#" >
          <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item sidelist">
        <a class="nav-link side" href="#" data-toggle="collapse" data-target="#membersDropdown" aria-expanded="false" aria-controls="membersDropdown">
          <span class="icon"><i class="fas fa-users"></i></span>
          Members
          <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
        </a>
        <ul class="nav flex-column ml-3 collapse" id="membersDropdown">
          <li class="nav-item sidelist">
            <a class="nav-link" href="#">View Members</a>
          </li>
          <li class="nav-item sidelist">
            <a class="nav-link" href="#">Add Member</a>
          </li>
        </ul>
      </li>
       <li class="nav-item sidelist">
        <a class="nav-link side" href="#">
          <span class="icon"><i class="fas fa-coins"></i></span>
          Loans
        </a>
      </li>
      <li class="nav-item sidelist">
        <a class="nav-link side" href="#">
          <span class="icon"><i class="fas fa-money-bill-wave"></i></span>
          Cashflow
        </a>
      </li>
      <li class="nav-item sidelist">
        <a class="nav-link side" href="#" data-toggle="collapse" data-target="#reportsDropdown" aria-expanded="false" aria-controls="reportsDropdown">
          <span class="icon"><i class="fas fa-chart-pie"></i></span>
          Reports
          <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
        </a>
        <ul class="nav flex-column ml-3 collapse" id="reportsDropdown">
          <li class="nav-item sidelist">
            <a class="nav-link side" href="#">Sales Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link side" href="#">Financial Report</a>
          </li>
        </ul>
      </li>
      <li class="nav-item sidelist">
        <a class="nav-link side" href="#">
          <span class="icon"><i class="fas fa-cogs"></i></span>
          Settings
        </a>
      </li>
    </ul>
  </div>
</nav>

  
<main class="col-md-10 ml-sm-auto">
   <div class="container">
    <div class="paper-folder">
      <div class="container-profile">


        <div class="row">
          <div class="col-md-3">
            <img src="images/logo.png" alt="Profile Picture" class="img-fluid rounded-circle">
          </div>
          <div class="col-md-3">
            <h4>Name</h4>
            <div class="row">
              <div class="col">
                <p class="profile_text">Age:<?php echo $personal_info['user_info']; ?></p>
              </div>
              <div class="col">
                <p class="profile_text">Male</p>
              </div>
              <div class="col">
                <p class="profile_text"></p>
              </div>
            </div>
            <div class="row">
  				<div class="col">
    				<p class="profile_side">
      				<i class="far fa-calendar-alt"></i> Member since:
    				</p>
  				</div>
            </div>
          </div>
          <div class="col-md-3 phone" style="justify-content: center; align-items: center;">
            <i class="fas fa-phone telephone"></i>
            <span class="profile_cl">0987654321</span>
          </div>
          <div class="col-md-3 mail">
            <i class="fas fa-envelope gmail"></i>
            <span class="profile_cl"></span>
          </div>
        </div>
      </div>
    </div>

 <div class="container_tab">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="loan-history-tab" data-toggle="tab" href="#loan-history" role="tab" aria-controls="loan-history" aria-selected="false">Loan History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="credit-score-tab" data-toggle="tab" href="#credit-score" role="tab" aria-controls="credit-score" aria-selected="false">Credit Score</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="share-capital-tab" data-toggle="tab" href="#share-capital" role="tab" aria-controls="share-capital" aria-selected="false">Share Capital Ledger</a>
      </li>
    </ul>

<?php echo $_SESSION['user_id']; ?>
      <div class="tab-content">
      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row second_row">
            <div class="col-sm-4">
              <h5 class="person_info">Personal Information</h5>
              <p class="text-left">Address:</p>
              <p class="text-left">Zip Code:</p>
              <p class="text-left">Birth Place:</p>
              <p class="text-left">Nationality:</p>
              <p class="text-left">Civil Status:</p>
              <p class="text-left">TIN:</p>
              <p class="text-left">GSIS:</p>
              <p class="text-left">SSS:</p><br/>
            </div>
            <div class="col-sm-4">
              <h5 class="person_info">Educational Background</h5>
              <p class="text-left">College:</p>
              <p class="text-left">Address:</p>
              <p class="text-left">Year Attended:</p><br/>
              <p class="text-left">High School:</p>
              <p class="text-left">Address:</p>
              <p class="text-left">Year Attended:</p><br/>
              <p class="text-left">Elementary:</p>
              <p class="text-left">Address:</p>
              <p class="text-left">Year Attended:</p><br/>
            </div>
            <div class="col-sm-4">
              <h5 class="person_info">Employment Background</h5>
              <p class="text-left">Occupation:</p>
              <p class="text-left">Emplyer:</p>
              <p class="text-left">Work Address:</p>
              <p class="text-left">Salary (Monthly):</p>
              <p class="text-left">Date Employed:</p><br/>
              <h5 class="person_info">Beneficiaries</h5>
              <p class="text-left">Name:</p>
              <p class="text-left">Relationship:</p>
              <p class="text-left">Birthday</p><br/>
              <p class="text-left">Name:</p>
              <p class="text-left">Relationship:</p>
              <p class="text-left">Birthday</p><br/>
              <p class="text-left">Name:</p>
              <p class="text-left">Relationship:</p>
              <p class="text-left">Birthday</p><br/>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="loan-history" role="tabpanel" aria-labelledby="loan-history-tab">
        <h3>Loan History</h3>
        <p>This is the loan history tab content.</p>
      </div>
      <div class="tab-pane fade" id="credit-score" role="tabpanel" aria-labelledby="credit-score-tab">
        <h3>Credit Score</h3>
        <p>This is the credit score tab content.</p>
      </div>
      <div class="tab-pane fade" id="share-capital" role="tabpanel" aria-labelledby="share-capital-tab">
        <h3>Share Capital Ledger</h3>
        <p>This is the share capital ledger tab content.</p>
      </div>
    </div>
  </div>
      </div>
    </div>
</main>



    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- HTML -->
<!-- HTML -->
<!-- HTML -->
<div id="logoutModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <h3>LOGOUT?</h3>
      <p>Are you sure you want to log out?</p>
    </div>
    <div class="modal-footer">
      <button id="logoutConfirmBtn">Yes</button>
      <button id="logoutCancelBtn">No</button>
    </div>
  </div>
</div>



<script>
  // JavaScript
// JavaScript
const logoutIcon = document.getElementById('logoutIcon');
const logoutModal = document.getElementById('logoutModal');
const logoutConfirmBtn = document.getElementById('logoutConfirmBtn');
const logoutCancelBtn = document.getElementById('logoutCancelBtn');
const closeModalBtn = document.querySelector('.close');

logoutIcon.addEventListener('click', () => {
  logoutModal.style.display = 'block';
});

closeModalBtn.addEventListener('click', () => {
  logoutModal.style.display = 'none';
});

logoutConfirmBtn.addEventListener('click', () => {
  window.location.href = 'indes.html';
});

logoutCancelBtn.addEventListener('click', () => {
  logoutModal.style.display = 'none';
});

</script>
  <script>
    // Example code for updating the notification count
var notificationCount = 5; // Replace with the actual count received from the backend

// Update the notification count in the DOM
var notificationCountElement = document.getElementById('notificationCount');
notificationCountElement.textContent = notificationCount;
notificationCountElement.style.display = notificationCount > 0 ? 'block' : 'none';

  </script>
  <script>
  function toggleSidebar(event) {
    event.stopPropagation();
    var sidebar = document.getElementById('sidebarNav');
    sidebar.classList.toggle('show');
  }

  function toggleTopNav(event) {
    event.stopPropagation();
    var topNav = document.getElementById('topNav');
    topNav.classList.toggle('show');
  }

  function toggleDropdown(event, dropdownId) {
    event.preventDefault();
    event.stopPropagation();
    var dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('show');
  }

  // Close navigation when clicking outside of it
  window.addEventListener('click', function(event) {
    var sidebar = document.getElementById('sidebarNav');
    var sidebarToggler = document.querySelector('.navbar-toggler-left');
    var topNav = document.getElementById('topNav');
    var topNavToggler = document.querySelector('.navbar-toggler-right');

    if (event.target !== sidebar && !sidebar.contains(event.target) && event.target !== sidebarToggler) {
      sidebar.classList.remove('show');
    }

    if (event.target !== topNav && !topNav.contains(event.target) && event.target !== topNavToggler) {
      topNav.classList.remove('show');
    }
  });

  // Toggle notification dropdown
  document.getElementById('notificationIcon').addEventListener('click', function(event) {
    toggleDropdown(event, 'notificationDropdown');
  });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
