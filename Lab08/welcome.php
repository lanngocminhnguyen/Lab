<?php
session_start();

include 'header.inc';

if (isset($_SESSION['user'])) {
    echo "Welcome, " . $_SESSION['user'];
} else {
    header('Location: login.php');
}

include 'footer.inc';

?>