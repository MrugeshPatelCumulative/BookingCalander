<?php
include '../DataBase/dataBaseFunction.php';
include 'header.php';
include 'afterLogin.php';
?>
<div class="container-fluid">
	<form action="../ajax/ChangePassword.php" method="POST">
		<div class="middle-formbox maxbox-width">
			<div class="row">
				<div class="col-3">
					<label>Enter Old Password</label>
				</div>
				<div class="col-5">
					<input type="password" name="oldPassword" id="oldPassword" required="">
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>Enter New Password</label>
				</div>
				<div class="col-5">
					<input type="password" name="newPassword" id="newPassword" required="">
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label>ReEnter New Password</label>
				</div>
				<div class="col-5">
					<input type="password" name="renewPassword" id="renewPassword" required="">
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button class="btn btn-primary">
						Change Password
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