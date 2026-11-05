<?php 
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$token = $_POST['token'];

if ($username == 'NgocMinh' && $password == 'password123' && $token === 'abc123') {
    $_SESSION['user'] = $username;
    header('Location: welcome.php');
} else {
    echo "Invalid login. <a href='login.php'>Try again</a>";
}
?>
