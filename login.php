<?php
require_once 'class.php';
session_start();

if (isset($_POST['login_user'])) {
    $db = new db_class();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_info = $db->login_user($username, $password);

    if ($user_info['count'] > 0) {
        $_SESSION['user_id'] = $user_info['user_id'];
        $_SESSION['name'] = $user_info['name'];
        $_SESSION['count'] = $user_info['count'];
        $_SESSION['role'] = $user_info['role'];

        unset($_SESSION['message']);
        echo "<script>alert('Login Successful')</script>";
        
        // Redirect to the appropriate dashboard based on the user's role
        if ($user_info['role'] === 'Member') {
            echo "<script>window.location='dashboard.php'</script>";
        } elseif ($user_info['role'] === 'Admin') {
            echo "<script>window.location='admin-dashboard.php'</script>";
        } elseif ($user_info['role'] === 'Board') {
            echo "<script>window.location='board_dashboard.php'</script>";
        }
    } else {
        $_SESSION['message'] = "Invalid Username or Password";

        echo "<script>window.location='index.php?username+password=invalid'</script>";
    }
}
?>
