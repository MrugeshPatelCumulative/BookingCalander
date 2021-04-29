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
		let questionCounter = '<?php echo $quCount;?>';
		function addQuestion(){
			questionCounter++;
			$('#save').removeClass('d-none');
			$('#Question').append('<div class="row cont" id="question'+questionCounter+'"><div class="col-3"><lable>question</lable></div><div class="col"><input class="form-control" type="text" name="ques['+questionCounter+']" id="ques'+questionCounter+'" required></div><div class="col-1" onclick=deleteQuestion("question'+questionCounter+'");><i class="fa fa-trash" aria-hidden="true"></i></div></div>');
		}
		function deleteQuestion(DeleteId) {
			var e = document.forms["form1"] ;
			e= e.getElementsByTagName('input');
			$('#'+DeleteId).remove();
			if(e.length == 0){
				$('#save').addClass('d-none');
			}
		}
		function deleteFromDatabase(DeleteId){
			$.ajax({
				dataType: "json",
				type: "POST",
				url: "../ajax/deleteQution.php",
				data: {DeleteId:DeleteId},
				async: false,
				success: function(result) {
					if(result.Status == true){
						var e = document.forms["form1"] ;
						e= e.getElementsByTagName('input');
						$('#'+DeleteId).remove();
						if(e.length == 0){
							$('#save').addClass('d-none');
						}
					}
				}
			});
		}
	</script>
</footer>
</html>