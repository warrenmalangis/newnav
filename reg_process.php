<?php
session_start();
date_default_timezone_set('Asia/Manila');


// initializing variables
$firstName = "";
$lastName = "";
$middleName = "";
$address = "";
$username = "";
$email = "";
$sex = "";
$birthDate = "";
$password = "";
$confirmPassword = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'loanms_db');
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$createTableQuery = "CREATE TABLE IF NOT EXISTS registration (
    reg_id INT AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    middle_name VARCHAR(255),
    address VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    sex VARCHAR(10) NOT NULL,
    birth_date DATE NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_date DATE NOT NULL,
    registration_time TIME NOT NULL
)";

// Execute the create table query
if (!mysqli_query($db, $createTableQuery)) {
  echo "Error creating table: " . mysqli_error($db);
}

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $firstName = mysqli_real_escape_string($db, $_POST['first-name']);
  $lastName = mysqli_real_escape_string($db, $_POST['last-name']);
  $middleName = mysqli_real_escape_string($db, $_POST['middle-name']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $sex = mysqli_real_escape_string($db, $_POST['sex']);
  $birthYear = mysqli_real_escape_string($db, $_POST['year']);
  $birthMonth = mysqli_real_escape_string($db, $_POST['month']);
  $birthDay = mysqli_real_escape_string($db, $_POST['day']);
  $password = mysqli_real_escape_string($db, $_POST['new-password']);
  $confirmPassword = mysqli_real_escape_string($db, $_POST['confirm-password']);

  if ($birthYear === 'Year' || $birthMonth === 'Month' || $birthDay === 'Day') {
    header('location: registration.php?error=birthdate');
    exit();
  } else {
    $birthDate = $birthYear . "-" . $birthMonth . "-" . $birthDay;
  }
  if ($sex == "Choose...") {
    header('location: registration.php?error=sex');
    exit();
  }
  if ($password != $confirmPassword) {
    header('location: registration.php?error=password_mismatch');
    exit();
  }

  // check the database to make sure a user does not already exist with the same username or email
  $user_check_query = "SELECT * FROM registration WHERE username='$username' OR email='$email' OR first_name='$firstName' OR last_name='$lastName' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      header('location: registration.php?error=username_exists');
      exit();
    }
    if ($user['email'] === $email) {
      header('location: registration.php?error=email_exists');
      exit();
    }
    if ($user['first_name'] === $firstName && $user['last_name'] === $lastName) {
      header('location: registration.php?error=name_exists');
      exit();
    }
  }

  // Finally, register the user if there are no errors in the form
  if (count($errors) == 0) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $registrationDate = date("Y-m-d");
    $registrationTime = date("H:i:s");

    $insertQuery = "INSERT INTO registration (last_name, first_name, middle_name, address, username, email, sex, birth_date, password, registration_date, registration_time) 
                    VALUES ('$lastName', '$firstName', '$middleName', '$address', '$username', '$email', '$sex', '$birthDate', '$hashedPassword', '$registrationDate', '$registrationTime')";
    if (mysqli_query($db, $insertQuery)) {
      // Get the inserted member's ID
      $regId = mysqli_insert_id($db);

      // Insert member data into users table
      $insertUsersQuery = "INSERT INTO users (name, email, username, role, password) 
                           VALUES ('$firstName $lastName', '$email', '$username', 'Member', '$hashedPassword')";
      mysqli_query($db, $insertUsersQuery);

  $registrationData = [
  'firstName' => $firstName,
  'middleName' => $middleName,
  'lastName' => $lastName,
  'email' => $email,
  'sex' => $sex,
  'address' => $address
];

$_SESSION['registration_data'] = $registrationData;


      $_SESSION['success'] = "You are now registered and can log in";
      header('location: index.php');
      exit();
    } else {
      header('location: registration.php?error=registration');
      exit();
    }
  }
}


$username = '';
$password = '';

?>

