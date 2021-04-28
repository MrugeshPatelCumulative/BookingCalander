<?php

include '../DataBase/dataBaseFunction.php';
$password = $_POST['newPassword'];
if(!empty($password)){
	db_update('admindata',array('AdminPassword'=>$password),array('AdminId'=>1));
	unset($_SESSION['Admin']);
}
header('Location: ../Admin/index.php');
?>