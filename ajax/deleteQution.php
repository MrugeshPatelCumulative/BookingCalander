<?php
include '../DataBase/dataBaseFunction.php';
$id = $_POST['DeleteId'];
$id = explode("_",$id);
$delete = db_delete('employequestion',array('id'=>$id[1]));
if($delete == 1){
	$ans = array('Status' => true);
}
else{
	$ans = array('Status' => false);
}
	echo json_encode($ans)
?>