<?php
require_once'session.php';
  require_once'class.php';
  $db=new db_class(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/mem.css">
    <title>Document</title>
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
                    <a href="#">
                      <i class="fas fa-user"></i>
                    </a>
                    <a href="#">
                      <i class="fas fa-bell"></i>
                    </a>
                    <a href="#">
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
                <a href="dashboard.php" >
                    <span class="icon"><i class="fas fa-chart-line fa-fw"></i></span>
                    <span class="item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" id="members-dropdown" class="active">
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
                <a href="#">
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
                 <h1>Membership Form</h1>
              </div>
              <div class="dashboard-container">
                <div class="container">
    <div class="content-wrapper">
    <h2 style="margin: 40px 0">Personal Infomation</h2>
    <form method="POST" action="mship_process.php" enctype="multipart/form-data">
       <div class="row mt-3">
  <div class="col-md-3" style="margin-bottom: 20px;">
    <div class="input-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
        <label class="custom-file-label" for="inputImage">2x2 picture</label>
      </div>
    </div>
    <div id="uploadStatus" class="upload-status"></div>
    <div id="previewContainer" class="preview-container" style="display: none;">
      <img id="previewImage" class="preview-image" alt="Preview">
      <span id="cancelButton" class="cancel-button">x</span>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-4">
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label for="middleName">Middle Name:</label>
      <input type="text" id="middleName" name="middleName" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" class="form-control" required>
    </div>
    <div class="col-md-1">
      <label for="suffix">Suffix:</label>
      <input type="text" id="suffix" name="suffix" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="contactNumber">Contact Number:</label>
      <input type="text" id="contactNumber" name="contactNumber" class="form-control" required>
    </div>
    <div class="col-md-2">
      <label for="age">Age:</label>
      <input type="number" id="age" name="age" class="form-control" required>
    </div>
    <div class="col-md-2">
      <label for="gender">Gender:</label>
      <select id="gender" name="gender" class="form-control" required>
        <option selected disabled>Gender</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" class="form-control" required>
    </div>
    <div class="col-md-2">
      <label for="zipCode">Zip Code:</label>
      <input type="text" id="zipCode" name="zipCode" class="form-control" required>
    </div>
    <div class="col-md-2">
      <label for="birthday">Birthday:</label>
      <input type="date" id="birthday" name="birthday" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="birthplace">Birthplace:</label>
      <input type="text" id="birthplace" name="birthplace" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="occupation">Occupation:</label>
      <input type="text" id="occupation" name="occupation" class="form-control" required>
    </div>
    <div class="col-md-2">
      <label for="nationality">Nationality:</label>
      <input type="text" id="nationality" name="nationality" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label for="civilStatus">Civil Status:</label>
      <select id="civilStatus" name="civilStatus" class="form-control" required>
        <option selected disabled>Civil Status</option>
        <option>Single</option>
        <option>Married</option>
        <option>Divorced</option>
        <option>Widowed</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="religion">Religion:</label>
      <input type="text" id="religion" name="religion" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="sssNo">SSS No.:</label>
      <input type="text" id="sssNo" name="sssNo" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="gsisNo">GSIS No.:</label>
      <input type="text" id="gsisNo" name="gsisNo" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="tinNo">TIN No.:</label>
      <input type="text" id="tinNo" name="tinNo" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="spouseName">Spouse Name (if applied):</label>
      <input type="text" id="spouseName" name="spouseName" class="form-control">
    </div>
    <div class="col-md-2">
      <label for="spouseBirthdate">Birthdate:</label>
      <input type="date" id="spouseBirthdate" name="spouseBirthdate" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="spouseOccupation">Spouse Occupation:</label>
      <input type="text" id="spouseOccupation" name="spouseOccupation" class="form-control">
    </div>
    <div class="col-md-3">
      <label for="spouseContactNumber">Spouse Contact Number:</label>
      <input type="text" id="spouseContactNumber" name="spouseContactNumber" class="form-control">
    </div>
  </div>
  
<div class="content-wrapper">
  <h3 class="educ" style="margin: 50px 0;">Educational Attainment</h3>
  <div class="row">
    <div class="col-md-4">
      <label for="elementary">Elementary:</label>
      <input type="text" id="elementary" name="elementary" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="elementary-address">Address:</label>
      <input type="text" id="elementary-address" name="elementaryAddress" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="elementary-year">Year Attended:</label>
      <input type="text" id="elementary-year" name="elementaryYear" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="secondary">Secondary School:</label>
      <input type="text" id="secondary" name="secondary" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="secondary-address">Address:</label>
      <input type="text" id="secondary-address" name="secondaryAddress" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="secondary-year">Year Attended:</label>
      <input type="text" id="secondary-year" name="secondaryYear" class="form-control" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="tertiary">Tertiary School:</label>
      <input type="text" id="tertiary" name="tertiary" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="tertiary-address">Address:</label>
      <input type="text" id="tertiary-address" name="tertiaryAddress" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label for="tertiary-year">Year Attended:</label>
      <input type="text" id="tertiary-year" name="tertiaryYear" class="form-control" required>
    </div>
  </div>
</div>
<h3 style="margin: 50px 0;">Beneficiaries</h3>
<div class="row">
  <div class="col-md-4">
    <label for="name1">Name:</label>
    <input type="text" id="name1" name="name1" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="relationship1">Relationship:</label>
    <input type="text" id="relationship1" name="relationship1" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="birthdate1">Birthdate:</label>
    <input type="date" id="birthdate1" name="birthdate1" class="form-control" required>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label for="name2">Name:</label>
    <input type="text" id="name2" name="name2" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="relationship2">Relationship:</label>
    <input type="text" id="relationship2" name="relationship2" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="birthdate2">Birthdate:</label>
    <input type="date" id="birthdate2" name="birthdate2" class="form-control" required>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label for="name3">Name:</label>
    <input type="text" id="name3" name="name3" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="relationship3">Relationship:</label>
    <input type="text" id="relationship3" name="relationship3" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label for="birthdate3">Birthdate:</label>
    <input type="date" id="birthdate3" name="birthdate3" class="form-control" required>
  </div>
</div>
 <div class="scrollable-container">
      <h3>Terms and Conditions</h3>
      <div class="mt-3">
        <p>
          1. Membership Eligibility:<br>
          By submitting this membership form, you confirm that you meet the eligibility criteria set forth by the loan management system.<br>
          You must provide accurate and complete personal information as required in the form.<br>
          The loan management system reserves the right to verify the provided information and reject membership applications that do not meet the eligibility requirements.
        </p>
        <p>
          2. Member Responsibilities:<br>
          As a member, you agree to comply with the rules and regulations of the loan management system.<br>
          You are responsible for maintaining the confidentiality of your membership account information and ensuring its security.<br>
          You will promptly inform the loan management system of any changes to your personal information provided in the membership form.
        </p>
        <p>
          3. Loan Management System Rights and Limitations:<br>
          The loan management system reserves the right to modify or terminate the membership program at any time, without prior notice.<br>
          The system may request additional documents or information to verify your identity and eligibility for loan services.<br>
          The loan management system will handle your personal information in accordance with applicable privacy laws and regulations.
        </p>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="termsCheckbox">
        <label class="form-check-label" for="termsCheckbox">
          I agree to the terms and conditions.
        </label>
      </div>
      </div>
    </div>
     <div class="buttons-row text-right">
  <button type="submit" id="submitBtn" class="btn btn-success submit-btn" name="submit-mem">Submit</button>
</div>

</form>
</div>
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
  <script>
  // Get the file input element
  const imageInput = document.getElementById('image');

  // Get the preview elements
  const previewContainer = document.getElementById('previewContainer');
  const previewImage = document.getElementById('previewImage');
  const cancelButton = document.getElementById('cancelButton');

  // Add an event listener to the file input
  imageInput.addEventListener('change', function() {
    // Get the selected file
    const file = imageInput.files[0];

    // Check if a file is selected
    if (file) {
      // Create a FileReader
      const reader = new FileReader();

      // Set the FileReader to load the selected file
      reader.readAsDataURL(file);

      // When the file is loaded, display the image and cancel button
      reader.onload = function() {
       
        previewImage.src = reader.result;
          previewContainer.style.display = 'block';
        };
      }
  });

  // Add an event listener to the cancel button
  cancelButton.addEventListener('click', function() {
    // Clear the file input and hide the preview container
    imageInput.value = '';
    previewContainer.style.display = 'none';
  });
</script>

  <script>
    $(document).ready(function() {
      // Disable submit button by default
      $('#submitBtn').prop('disabled', true);

      // Check if the checkbox is checked on page load
      if ($('#termsCheckbox').is(':checked')) {
        $('#submitBtn').prop('disabled', false);
      }

      // Toggle submit button state based on checkbox
      $('#termsCheckbox').change(function() {
        if ($(this).is(':checked')) {
          $('#submitBtn').prop('disabled', false);
        } else {
          $('#submitBtn').prop('disabled', true);
        }
      });
    });
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
