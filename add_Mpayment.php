<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Manila');
require_once 'class.php';
session_start();
$user_info = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $db = new db_class();
    $membershipFee = $_POST["membership_fee"];
    $initialShare = $_POST["initial_share"];
    $orNumber = $_POST["or_number"];
$user_info = $_SESSION['user_id'];
    $result = $db->addMemPayment($user_info, $membershipFee, $initialShare, $orNumber);
    
    if ($result) {
        echo "Payment details added successfully.";
        header("location: dashboard.php");
    } else {
        echo "Error: Failed to add payment details.";
    }
}


?>