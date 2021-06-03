<?php
include '../DataBase/dataBaseFunction.php';
$answerList = $_POST['answerArray'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$dateAndtime = $_POST['selectDate'].' '.$_POST['time'];
$bookedData = db_insert('bookingdata',array('clientname'=>$name,'clientemail'=>$email,'clientnumber'=>$mobile,'bookedtimeanddate'=>$dateAndtime,'EmployeeId'=>1));
$last_id = mysqli_insert_id($connection);
foreach ($answerList as $key => $value) {
	if($value){
	$answerData = db_insert('clientanswer',array('clientid'=>$last_id,'Employeeid'=>1,'questionid'=>$key,'clientans'=>$value));
	}
}
echo 1;
?>