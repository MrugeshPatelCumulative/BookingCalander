<?php
include '../DataBase/dataBaseFunction.php';
include 'header.php';
?>
<style type="text/css">
	.row{
		padding: 1%;
	}
	.img{
		max-width:180px;
	}
	input[type=file]
	{
		padding:10px;
		background:#2d2d2d;
	}
	#blah{
		width: 200px;
		height: 200px;
	}
</style>
<?php
include 'afterLogin.php';
?>
<div class="container-fluid">
	<?php
	$EmployeeData = select_all('employeedata');
	$EmployeeId = '';
	$EmployeeImage = '';
	$EmployeeName = '';
	$EmployeeNumber = '';
	$EmployeeServiceTitle = '';
	$EmployeeStartTime = '';
	$EmployeeEndTime = '';
	$Duration = '';
	$Description = '';
	$EmployeeWorkingDay = '';
	if(!empty($EmployeeData)){
		$EmployeeId = $EmployeeData[0]['EmployeeId'];
		$EmployeeImage = $EmployeeData[0]['EmployeeImage'];
		$EmployeeName = $EmployeeData[0]['EmployeeName'];
		$EmployeeNumber = $EmployeeData[0]['EmployeeNumber'];
		$EmployeeServiceTitle = $EmployeeData[0]['EmployeeServiceTitle'];
		$EmployeeStartTime = $EmployeeData[0]['EmployeeStartTime'];
		$EmployeeEndTime = $EmployeeData[0]['EmployeeEndTime'];
		$Duration = $EmployeeData[0]['Duration'];
		$Description = $EmployeeData[0]['Description'];
		$EmployeeWorkingDay = $EmployeeData[0]['EmployeeWorkingDay'];
	}
	?>
	<form method="POST" action="../ajax/addEmployee.php">
		<input type="hidden" name="employeeid" id="employeeid" value="<?php echo $EmployeeId;?>">
		<input type="hidden" name="empLogo" id="empLogo">
		<div class="middle-formbox maxbox-width">
			<div class="row">
				<div class="col">
					<input type='file' name="imgLogo" id="imgLogo" onchange="readURL(this);" />
					<img id="blah" name="img" src="<?php echo $EmployeeImage;?>" alt="your image" />
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Full Name</label>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="text" name="name" id="name" value="<?php echo $EmployeeName;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Mobile</label>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="text" name="mobile" id="mobile"value="<?php echo $EmployeeNumber;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Service Title</label>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="text" name="title" id="title" value="<?php echo $EmployeeServiceTitle;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Service Start Time</label>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="time" name="startTime" id="startTime" value="<?php echo $EmployeeStartTime;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<lable>Service End Time</lable>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="time" name="endTime" id="endTime" value="<?php echo $EmployeeEndTime;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Session Duration</label>
				</div>
				<div class="col-5">
					<input class="form-control form-control-user" type="text" name="Duration" id="Duration" value="<?php echo $Duration;?>" required>
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Description About Session</label>
				</div>
				<div class="col-9">
					<textarea id="editor" name="editor"><?php echo $Description;?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<button class="btn btn-success">Save</button>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>
</body>
<?php
include 'footer.php';
?>