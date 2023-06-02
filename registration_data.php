<?php
require_once('reg_process.php');

// Check if registration data is present in session
if (isset($_SESSION['registration_data'])) {
  // Retrieve the registration data
  $registrationData = $_SESSION['registration_data'];

  // Assign the data to variables
  $firstName = $registrationData['first_name'];
  $lastName = $registrationData['last_name'];
  $middleName = $registrationData['middle_name'];
  $address = $registrationData['address'];
  $username = $registrationData['username'];
  $email = $registrationData['email'];
  $sex = $registrationData['sex'];
  $birthYear = $registrationData['birth_year'];
  $birthMonth = $registrationData['birth_month'];
  $birthDay = $registrationData['birth_day'];

  // Clear the registration data from session
  unset($_SESSION['registration_data']);
} else {
  // Initialize the variables if no registration data is present
  $firstName = "";
  $lastName = "";
  $middleName = "";
  $address = "";
  $username = "";
  $email = "";
  $sex = "";
  $birthYear = "";
  $birthMonth = "";
  $birthDay = "";
}
?>