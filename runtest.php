<?php
session_start();
$membershipData = $_SESSION['membershipData'];

// Access the membership data and display information
if (!empty($membershipData)) {
    $firstName = $membershipData['personal_info']['firstName'];
    $lastName = $membershipData['personal_info']['lastName'];
    $email = $membershipData['personal_info']['email'];
    // Display other relevant fields
    
    echo "First Name: " . $firstName . "<br>";
    echo "Last Name: " . $lastName . "<br>";
    echo "Email: " . $email . "<br>";
    // Display other fields
}
?>
