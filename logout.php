<?php
session_start();
unset($_SESSION['role']);
unset($_SESSION['username']);
session_destroy();
header('Location: '.'index.php');
?>