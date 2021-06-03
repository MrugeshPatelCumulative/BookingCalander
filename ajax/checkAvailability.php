<?php
include '../DataBase/dataBaseFunction.php';
$spendTime = [];
if(isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['id']) && !empty($_POST['id'])){
	$date = $_POST['date'];
	$id = $_POST['id'];
	$getDate = select_custom("SELECT * FROM `bookingdata` WHERE `EmployeeId`=$id and DATE(`bookedtimeanddate`) = ?",array($date));
	if(!empty($getDate)){
		foreach($getDate as $time){
			$timestamp = $time['bookedtimeanddate'];
			$splitTimeStamp = explode(" ",$timestamp);
			array_push($spendTime,$splitTimeStamp[1]);
		}
		$ans = array('status'=>true,'fillTime'=>$spendTime);
	}else{
		$ans = array('status'=>false);
	}
	echo json_encode($ans);
}
?>