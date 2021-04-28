<?php
include '../DataBase/dataBaseFunction.php';
$oldpassword = $_POST['oldPassword'];
$password = $_POST['newPassword'];
$repassword = $_POST['renewPassword'];
if(!empty($oldpassword)){
	$checkPassword = select_where_and('admindata',array('AdminId '=>1,'AdminPassword'=>$oldpassword));
	if(!empty($checkPassword)){
		if(!empty($password) && ($password == $repassword)){
			db_update('admindata',array('AdminPassword'=>$password),array('AdminId'=>1));
			unset($_SESSION['Admin']);
		}
	}
}
header('Location: ../Admin/index.php');
?>