<?php
include '../DataBase/dataBaseFunction.php';
$quwstions = $_POST['ques'];
foreach ($quwstions as $key => $value) {
	$getQuestion = select_where_and('employequestion',array('id'=>$key,'EmployeeId'=>1));
	if(empty($getQuestion)){
		db_insert('employequestion',array('question'=>$value,'EmployeeId'=>1));
	}
	else{
		db_update('employequestion',array('question'=>$value),array('id'=>$key));
	}
}
header('Location: ../Admin/question.php');
?>