<?php
include '../DataBase/dataBaseFunction.php';
include 'header.php';
include 'afterLogin.php';
?>
<style type="text/css">
	.row{
		padding-bottom: 2%;
	}
</style>
<div class="container-fluid">
	<div class="middle-formbox maxbox-width">
		<form id="form1" method="POST" action="../ajax/saveQuestion.php">
		<div id="Question">
			<?php
			$selectQuestion = select_where('employequestion',array('EmployeeId'=>1));
			if(!empty($selectQuestion)){
				$i=1;
				foreach ($selectQuestion as $key => $value) {
					?>
					<div class="row cont" id="question<?php echo $i;?>">
						<div class="col-3">
							<lable>question<?php echo $i;?></lable>
						</div>
						<div class="col">
							<input class="form-control" type="text" name="ques[]" id="ques<?php echo $i;?>" required value="<?php echo $value['question'];?>">
						</div>
						<div class="col-1" onclick=deleteQuestion(question<?php echo $i;?>);>
							<i class="fa fa-trash" aria-hidden="true"></i>
						</div>
					</div>
					<?php
					$i++;	
				}
			}
			?>
		</div>
		<div class="row">
			<div class="col">
				<button class="btn btn-success d-none" id="save">Save</button>
			</div>
		</div>
		</form>
		<div class="row">
			<div class="col">
				<button type="button" class="btn btn-info" id="addQuestion" onclick="addQuestion();">+ Add Question</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</body>
<?php
include 'footer.php';
?>