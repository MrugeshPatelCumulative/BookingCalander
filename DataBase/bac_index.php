<?php
include 'dataBase.php';
include 'header.php';
if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
  include 'body.php';
}
else{
  include 'login.php';
}
include 'footer.php';
?>