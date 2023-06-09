<!DOCTYPE html>
<html>
<head>
  <title>Web Page Template</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
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
      <img src="images/nikki.png" alt="Admin Image" class="admin-image">
      <div class="admin-name">Nikki Minay</div>
      <div class="admin-role">Member</div>
    </div>
    <ul class="nav flex-column sidebar-menu">
      <li class=" sidelist">
        <a class=" side active" href="#" >
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
   <div class="exp-wrapper">
  <div class="container">
    <div class="text-head">
      Expenses
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-row align-items-center">
          <div class="col">
            <label for="expenseType" class="right-align">Expense Type:</label>
          </div>
          <div class="col">
            <select class="form-control expenseDrop" id="expenseType">
              <option value="Loan Payment">Loan Payment</option>
              <option value="Interest Payment">Interest Payment</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-row align-items-center">
          <div class="col">
            <label for="amount" class="right-align">Amount:</label>
          </div>
          <div class="col">
            <input type="text" class="form-control" id="amount" placeholder="Enter amount" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-row align-items-center">
          <div class="col">
            <label for="date" class="right-align">Date:</label>
          </div>
          <div class="col">
            <input type="date" class="form-control expDate" id="date" />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-row align-items-center">
          <div class="col">
            <label for="voucherNumber" class="right-align">Voucher Number:</label>
          </div>
          <div class="col">
            <input type="text" class="form-control" id="voucherNumber" placeholder="Enter voucher number" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-row align-items-center">
          <div class="col">
            <label for="receipt" class="right-align">Receipt:</label>
          </div>
          <div class="col">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="receipt" onchange="readURL(this)">
                <label class="custom-file-label" for="receipt">Browse</label>
              </div>
            </div>
            <div id="attachmentContainer" style="display: none;">
              <img id="imagePreview" class="attached-image" src="" alt="Attached Image">
              <span class="remove-attachment" onclick="removeAttachment()">&#10006;</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-row">
          <div class="col text-right">
            <button type="button" class="btn btn-add">Add</button>
          </div>
        </div>
      </div>
    </div>
     <hr>
    <div class="text-center">
      <div class="search-container">
  <i class="search-icon fas fa-search"></i>
  <input type="text" class="search-input" placeholder="Search">
</div>

    </div>
     <div class="table-container">
    <table class="table">
      <thead>
        <tr>
          <th class="column-sec">Column 1</th>
          <th class="column-sec">Column 2</th>
          <th class="column-sec">Column 3</th>
          <th class="column-sec">Column 4</th>
          <th class="column-sec">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Value 1</td>
          <td>Value 2</td>
          <td>Value 3</td>
          <td>Value 4</td>
          <td class=""></td>
        </tr>
        <tr>
          <td>Value 1</td>
          <td>Value 2</td>
          <td>Value 3</td>
          <td>Value 4</td>
          <td class=""></td>
        </tr>
        <tr>
          <td>Value 1</td>
          <td>Value 2</td>
          <td>Value 3</td>
          <td>Value 4</td>
          <td class=""></td>
        </tr>
        <tr>
          <td colspan="4" class="text-center total-sec">Total</td>
          <td class="total-column"></td>
        </tr>
      </tbody>
    </table>
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

</body>
</html>
