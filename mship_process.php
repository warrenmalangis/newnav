<?php
date_default_timezone_set('Asia/Manila');
require_once 'class.php';
session_start();

$age = $_SESSION['age'];

if (isset($_POST['submit-mem'])) {

    // Connect to the database
    $db = new db_class();

    // Retrieve all input values from the form
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $suffix = $_POST['suffix'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $contactNumber = $_POST['contactNumber'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $zipCode = $_POST['zipCode'];
    $birthday = $_POST['birthday'];
    $birthplace = $_POST['birthplace'];
    $occupation = $_POST['occupation'];
    $nationality = $_POST['nationality'];
    $civilStatus = $_POST['civilStatus'];
    $religion = $_POST['religion'];
    $sssNo = $_POST['sssNo'];
    $gsisNo = $_POST['gsisNo'];
    $tinNo = $_POST['tinNo'];
    $spouseName = $_POST['spouseName'];
    $spouseBirthdate = $_POST['spouseBirthdate'];
    $spouseOccupation = $_POST['spouseOccupation'];
    $spouseContactNumber = $_POST['spouseContactNumber'];
    $elementary = $_POST['elementary'];
    $elementaryAddress = $_POST['elementaryAddress'];
    $elementaryYear = $_POST['elementaryYear'];
    $secondary = $_POST['secondary'];
    $secondaryAddress = $_POST['secondaryAddress'];
    $secondaryYear = $_POST['secondaryYear'];
    $tertiary = $_POST['tertiary'];
    $tertiaryAddress = $_POST['tertiaryAddress'];
    $tertiaryYear = $_POST['tertiaryYear'];
    $name1 = $_POST['name1'];
    $relationship1 = $_POST['relationship1'];
    $birthdate1 = $_POST['birthdate1'];
    $name2 = $_POST['name2'];
    $relationship2 = $_POST['relationship2'];
    $birthdate2 = $_POST['birthdate2'];
    $name3 = $_POST['name3'];
    $relationship3 = $_POST['relationship3'];
    $birthdate3 = $_POST['birthdate3'];

    $timestamp = strtotime($birthday);
    $targetDir = 'uploads/';
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $isImage = getimagesize($_FILES['image']['tmp_name']);
    if ($isImage !== false) {
        $uniqueName = uniqid() . '.' . $imageFileType;
        $uploadedFilePath = $targetDir . $uniqueName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFilePath)) {
            // Image uploaded successfully

            // Retrieve the user_id from the session
            $user_info = $_SESSION['user_id'];

            // Call the function to insert data into the database
            $insertData = $db->addMembership($user_info, $firstName, $middleName, $lastName, $suffix, $email, $contactNumber, $age, $gender, $address, $zipCode, $birthday, $birthplace, $occupation, $nationality, $civilStatus, $religion, $sssNo, $gsisNo, $tinNo, $spouseName, $spouseBirthdate, $spouseOccupation, $spouseContactNumber, $uploadedFilePath, $elementary, $elementaryAddress, $elementaryYear, $secondary, $secondaryAddress, $secondaryYear, $tertiary, $tertiaryAddress, $tertiaryYear, $name1, $relationship1, $birthdate1, $name2, $relationship2, $birthdate2, $name3, $relationship3, $birthdate3);

           

            if ($insertData) {
    // Retrieve the user_info from the session
    $user_info = $_SESSION['user_id'];

    // Call the function to retrieve membership data
    $membershipData = $db->getMembershipData($user_info);

$_SESSION['address'] = $_POST['address'];
$_SESSION['zipCode'] = $_POST['zipCode'];
$_SESSION['birthPlace'] = $_POST['birthPlace'];
$_SESSION['nationality'] = $_POST['nationality'];
$_SESSION['civilStatus'] = $_POST['civilStatus'];
$_SESSION['tin'] = $_POST['tin'];
$_SESSION['gsis'] = $_POST['gsis'];
$_SESSION['sss'] = $_POST['sss'];

    if ($membershipData) {
        // Display the membership data or use it as needed
        var_dump($membershipData); // Example: Dumping the data to the screen
    } else {
        // Error occurred while retrieving membership data
        echo "<script>alert('Error retrieving membership data.')</script>";
    }

    echo "<script>alert('Data inserted successfully.')</script>";
    echo "<script>window.location='dashboard.php'</script>";
} else {
    // Error occurred while inserting data
    echo "<script>alert('Error inserting data.')</script>";
    echo "<script>window.location='membership_form.php?error'</script>";
}
}
}
?>
