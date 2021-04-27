<?php
include '../DataBase/dataBaseFunction.php';
$AdminId = $_POST['AdminId'];
$AdminPassword = $_POST['AdminPassword'];
$returnData = select_where_and('admindata',array('AdminName'=>$AdminId,'AdminPassword'=>$AdminPassword));
if(!empty($returnData)){
	$_SESSION['Admin'] = $returnData;
	$ans = array('Status' => true);
}else{
	$ans = array('Status' => false);
}
echo json_encode($ans);
?>