<?php
include '../DataBase/dataBaseFunction.php';
require_once 'header.php';
if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
  include 'afterLogin.php';
}
else{
  include 'login.php';
}
require_once 'footer.php';
?>