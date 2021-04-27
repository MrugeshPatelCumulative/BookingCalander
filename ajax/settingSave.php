<?php
include '../DataBase/dataBaseFunction.php';
$weekName = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
$FinalDays = [];
$empArray = [];

$color = $_POST['primaryColor'];
$OnDay = $_POST['Wname'];
$is_queation = $_POST['questionCheckbox'];
if(empty($is_queation)){
	$is_queation = 0;
}

if(!empty($OnDay)){
for ($i=0; $i < 7; $i++) { 
	if(in_array($weekName[$i],$OnDay)){
		$FinalDays[$weekName[$i]] = 1;
	}
	else{
		$FinalDays[$weekName[$i]] = 0;
	}
}
$week = json_encode($FinalDays);
}
if(!empty($color)){
	db_update('admindata',array('primaryColor'=>$color),array('AdminId'=>1));
}
if(!empty($OnDay) || !empty($is_queation)){
	if(!empty($OnDay)){
		$empArray['EmployeeWorkingDay'] = $week;
	}
	if(!empty($is_queation)){
		$empArray['is_question'] = $is_queation;
	}
	$update = "UPDATE `employeedata` SET `EmployeeWorkingDay`='".$week."' , `is_question` = '".$is_queation."' WHERE EmployeeId = 1";
	$test = mysqli_query($connection,$update);
	// db_update('employeedata',$empArray,array('EmployeeId'=>1));
}
header('Location: ../Admin/setting.php');
?>