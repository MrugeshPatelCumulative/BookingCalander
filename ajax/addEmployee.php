<?php
include '../DataBase/dataBaseFunction.php';
$employeeid  = $_POST['employeeid'];
$Image  = $_POST['imgLogo'];
$Name  = $_POST['name'];
$Mobile  = $_POST['mobile'];
$Title  = $_POST['title'];
$startTime  = $_POST['startTime'];
$endTime  = $_POST['endTime'];
$Duration  = $_POST['Duration'];
$Discription  = $_POST['editor'];
// ,'EmployeeWorkingDay'=>,'EmployeeImage'=> ,
$table = 'employeedata';
$where = array('EmployeeId'=>1);
$set = array('EmployeeName'=>$Name,'EmployeeServiceTitle'=>$Title ,'EmployeeNumber'=>$Mobile,'EmployeeStartTime'=>$startTime ,'EmployeeEndTime'=>$endTime  ,'Duration'=>$Duration ,'Description'=>$Discription);
if(!empty($Image)){
	$data = $_POST['empLogo'];
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);
	$Path = $_SERVER['DOCUMENT_ROOT'].'/Mrugesh/BookingCalander/image/'.time().'.png';
	file_put_contents($Path,$data);
	$filePath = '../image/'.time().'.png';
	$set['EmployeeImage'] = $filePath;
}
// print_r("StoreLocation: ".$Path);
// print_r('<br>');
// print_r("In database: ".$filePath);
// exit;
db_update($table,$set,$where);
header('Location: ../Admin/dashbord.php');
?>