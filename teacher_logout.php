<?php
session_start();
unset($_SESSION['valid1']);
header("Location:login.php");
?>
