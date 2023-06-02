<?php
session_start();
require_once 'class.php';

$userId = $_SESSION['user_id']; // Retrieve the user ID from the session

// Connect to the database
$db = new db_class();

// Query the members table to fetch the member details for the user
$memberDetails = $db->displayMembershipDetails($userId);

if ($memberDetails) {
  // Member details fetched successfully

  // Display the member details on the page
  echo "First Name: " . $memberDetails['firstName'] . "<br>";
  echo "Last Name: " . $memberDetails['lastName'] . "<br>";
  echo "Email: " . $memberDetails['email'] . "<br>";
  // ... display other member details

} else {
  // Error occurred or no member details found
  echo "Member details not found.";
}
?>