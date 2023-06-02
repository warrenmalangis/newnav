<?php
require_once'session.php';
	require_once'class.php';
	$db=new db_class(); 

    $memberCounts = $db->getMemberGenderCounts();

// Extract the values from the returned array
$totalMembers = $memberCounts['totalMembers'];
$maleCount = $memberCounts['maleCount'];
$femaleCount = $memberCounts['femaleCount'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include jQuery and Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Document</title>
<!--     
    <style>
/* Adjust the styles of the dropdown content */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff; /* Adjust to match the background color of the list container */
  min-width: 200px; /* Adjust the width as needed */
  padding: 10px;
  border: 1px solid #ccc; /* Adjust the border color and style as needed */
  border-top: none;
  z-index: 1;
}

/* Show the dropdown content when the anchor is hovered or clicked */
#members-dropdown:hover + .dropdown-content,
#members-dropdown:focus + .dropdown-content {
  display: block;
}

/* Adjust the styles of the dropdown items */
.dropdown-content a {
  display: block;
  padding: 5px 10px;
  color: #333; /* Adjust the text color of the dropdown items */
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: #f5f5f5; /* Adjust the background color when hovering over the dropdown items */
}

    </style> -->
</head>
<body>

    <div class="wrapper">
        <!--Top menu -->
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
                <div class="top_navbar_icons">
                    <a href="mem_profile.php">
                      <i class="fas fa-user"></i>
                     
                    </a>
                    <a><button type="button" class="btn btn-link btn-lg text-white" data-toggle="modal" data-target="#notificationModal">
  <i class="fas fa-bell"></i>
        </button></a>

                    <a href="logout.php">
                      <i class="fas fa-sign-out-alt"></i>
                      <span>Exit</span>
                    </a>
                  </div>
            </div>

        </div>

        <div class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="Loan Management System">
                <h2>LOAN MANAGEMENT SYSTEM</h2>
              </div>
              <div class="profile">
    <img src="images/admin-logo.png" alt="profile_picture">

     <h5><?php echo $_SESSION['name']; ?></h5>
      <p><?php echo $_SESSION['role']; ?></p> 

</div>

        <ul>
            <li>
                <a href="#" class="active">
                    <span class="icon"><i class="fas fa-chart-line fa-fw"></i></span>
                    <span class="item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="membership_form.php" id="members-dropdown">
                  <span class="icon"><i class="fas fa-users fa-fw"></i></span>
                  <span class="item">Members</span>
                  <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
                </a>
                <div class="dropdown-content">
                  <a href="#"><i class="fas fa-user"></i> Add member</a>
                  <a href="#"><i class="fas fa-search"></i> Search members</a>
                  <a href="#"><i class="fas fa-list"></i> List members</a>
                </div>
              </li>
            <li>
                <a href="membership_form.php">
                    <span class="icon"><i class="fas fa-coins fa-fw"></i></span>
                    <span class="item">Loans</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-money-bill-wave fa-fw"></i></span>
                    <span class="item">Cashflow</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-file-alt fa-fw"></i></span>
                    <span class="item">Reports</span>
                    <span class="dropdown-icon"><i class="fas fa-caret-down"></i></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-cog fa-fw"></i></span>
                    <span class="item">Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <div class='dashboard-app'>
    <div class='dashboard-content'>
        <div class='container'>
           <div class='card'>
              <div class='card-header'>
                 <h1>Dashboard</h1>
              </div>
              <div class="dashboard-container">
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-users"></i></div>
                   <div class="title">Total Members: <?php echo $totalMembers; ?>
                    <p>Male: <?php echo $maleCount; ?></p>
                    <p>Female: <?php echo $femaleCount; ?></p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-user-check"></i></div>
                   <div class="title">Active Member<p>4</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
                   <div class="title">Open Loans<p>3</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-hand-holding"></i></div>
                   <div class="title">Loans to be Collected<p>19, 800</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
                   <div class="title">Delinquent Loans<p>0</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-coins"></i></div>
                   <div class="title">Fines to be Collected<p>0.00</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                   <div class="title">On-hand Cash<p>85, 000.00</p></div>
               </div>
               <div class="dashboard-item">
                   <div class="icon"><i class="fas fa-university"></i></div>
                   <div class="title">In-bank Cash<p>40, 000.00</p></div>
                   </div>
                   </div>
                   </div>
           </div>
        </div>
     </div>
    </div>
    <!-- Place this code just before the script tag that redirects to the dashboard -->
<div id="loading-overlay">
  <div class="spinner"></div>
</div>

<!-- Modal for Notifications -->
<div id="notificationModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your notification content here -->
        <p>You have new notifications!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
  /* Add this CSS for transition effect */
  .modal {
    animation: slideInTop 0.3s ease-out;
  }

  @keyframes slideInTop {
     from {
      transform: translateY(-100%);
    }
    to {
      transform: translateY(0);
    }
  }
  #notificationModal.modal {
    top: 0;
    right: 0;
    margin: 0;
  }

  #notificationModal .modal-dialog {
    max-width: 300px;
  }
</style>

  <script>
  // Add this script after the loading overlay HTML

  // Show the loading overlay when the page starts loading
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loading-overlay').style.display = 'flex';
  });

  // Hide the loading overlay after the dashboard page is fully loaded
  window.addEventListener('load', function () {
    document.getElementById('loading-overlay').style.display = 'none';
  });
</script>
  <script>
// Add this JavaScript code to the bottom of your <body> tag or in an external .js file

var hamburger = document.querySelector(".hamburger");
var body = document.querySelector("body");
var sidebar = document.querySelector(".sidebar");

hamburger.addEventListener("click", function() {
  body.classList.toggle("active");
});

window.addEventListener("resize", function() {
  if (window.innerWidth >= 992) {
    body.classList.remove("active");
  } else {
    body.classList.add("active");
  }
});

// Check initial viewport width on page load
if (window.innerWidth >= 992) {
  body.classList.remove("active");
} else {
  body.classList.add("active");
}


  </script>
<!--   <script >
// Add this JavaScript code to the bottom of your <body> tag or in an external .js file

// Get the dropdown anchor element
var dropdown = document.getElementById("members-dropdown");

// Get the dropdown content element
var dropdownContent = document.querySelector("#members-dropdown + .dropdown-content");

// Get the parent ul element
var parentList = dropdown.parentElement.parentElement;

// Get the list items after the dropdown
var listItems = Array.from(parentList.children).slice(Array.from(parentList.children).indexOf(dropdown.parentElement) + 1);

// Add click event listener to the dropdown
dropdown.addEventListener("click", function(e) {
  e.preventDefault();
  // Toggle the display of the dropdown content
  dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";

  // Position the dropdown content below the dropdown anchor
  var dropdownRect = dropdown.getBoundingClientRect();
  dropdownContent.style.left = dropdownRect.left + "px";
  dropdownContent.style.top = dropdownRect.bottom + "px";

  // Adjust the position of the following list items
  var heightDifference = dropdownContent.offsetHeight - dropdown.parentElement.offsetHeight;
  listItems.forEach(function(item) {
    item.style.transform = "translateY(" + heightDifference + "px)";
  });
});

// Close the dropdown when clicking outside of it
window.addEventListener("click", function(event) {
  if (!dropdown.contains(event.target) && event.target !== dropdownContent) {
    dropdownContent.style.display = "none";
    // Reset the position of the following list items
    listItems.forEach(function(item) {
      item.style.transform = "translateY(0)";
    });
  }
});

// Close the dropdown when resizing the window
window.addEventListener("resize", function() {
  dropdownContent.style.display = "none";
  // Reset the position of the following list items
  listItems.forEach(function(item) {
    item.style.transform = "translateY(0)";
  });
});

  </script> -->

</body>
</html>
