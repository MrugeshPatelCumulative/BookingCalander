<?php
include '../DataBase/dataBaseFunction.php';
include 'header.php';
include 'afterLogin.php';
unset($_SESSION['Admin']);
header('Location: index.php');
include 'footer.php';
?>