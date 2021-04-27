<footer>
  	<script src="../js/jquery-3.6.0.min.js"></script>
  	<script src="../js/bootstrap.bundle.min.js"></script>
  	<script src="../js/sb-admin-2.min.js"></script>
  	<script src="../js/ckeditor.js"></script>
	<script type="text/javascript">
		$('#CheckAdmin').on('click',function(){
			$('.adminError').html('');
			var countForAdminError = 0;
			let AdminId = $('#AdminId').val();
			let AdminPassword = $('#AdminPassword').val();
			if(AdminId == ''){
				countForAdminError = 1;
				$('#AdminId').after('<div class="adminError text-danger"><span>Please Enter Id First.</span></div>');
			}
			if(AdminPassword == ''){
				countForAdminError = 1;
				$('#AdminPassword').after('<div class="adminError text-danger"><span>Please Enter Password First.</span></div>');
			}
			if(countForAdminError == 1){
				return false;
			}
			$.ajax({
				dataType: "json",
				type: "POST",
				url: "../ajax/CheckAdminData.php",
				data: {AdminId:AdminId,AdminPassword:AdminPassword},
				async: false,
				success: function(result) {
					if(result.Status == true){
						url = 'dashbord.php';
						window.location.href = url;
					}
				}
			});
		});
     	function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    $('#empLogo').attr('value', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        ClassicEditor.create( document.querySelector('#editor'), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			// console.error(err.stack);
		});
	</script>
</footer>
</html>