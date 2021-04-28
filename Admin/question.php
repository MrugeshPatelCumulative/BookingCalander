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
		<div id="Question"></div>
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