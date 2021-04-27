<?php
$weekName = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
include '../DataBase/dataBaseFunction.php';
include 'header.php';
include 'afterLogin.php';
?>
<div class="container-fluid">
	<form action="../ajax/settingSave.php" method="POST">
	<div class="middle-formbox maxbox-width">
		<div class="row">
			<div class="col-3">
				<label>Primary Color</label>
			</div>
			<div class="col-5">
				<?php
					$adminData = select_where('admindata',array('AdminId' => 1));
				?>
				<input type="Color" name="primaryColor" id="primaryColor"  value="<?php if(!empty($adminData)) echo $adminData[0]['primaryColor'];?>">
			</div>
		</div>
		<?php
		 	$EmpData = select_where('employeedata',array('EmployeeId' => 1));
		 	$question = 0;
		 	if(!empty($EmpData)){
		 		$question = $EmpData[0]['is_question'];
		 		$WeekData = $EmpData[0]['EmployeeWorkingDay'];
		 		$WeekData = json_decode($WeekData);
		 	}
		?>
		<div class="row">
			<div class="col-3">
				<label>Enable Question</label>
			</div>
			<div class="col-5">
				<input type="checkbox" name="questionCheckbox" id="questionCheckbox" value="<?php echo $question;?>" <?php if($question == 1) echo 'checked'; ?>> 
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<label>Booking Off Day</label>
			</div>
			<div class="col-5">
				<?php
				for ($i=0; $i < 7; $i++) {
					$weekFullName = $weekName[$i];
					$check = $WeekData->$weekFullName;
					?>
						<div class="row">
							<div class="col">
								<label><?php echo $weekFullName;?></label>
							</div>
							<div class="col">
								<input type="checkbox" name="Wname[]" value="<?php echo $weekFullName;?>" <?php if($check == 1) echo 'checked';?>>
							</div>
						</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="row">  
			<div class="col">
				<button class="btn btn-success"> 
					Save
				</button>
			</div>
		</div>
	</div>
</form>
</div>
</div>
</div>
</body>
<?php
include 'footer.php';
?>