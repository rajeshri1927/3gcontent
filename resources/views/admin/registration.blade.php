<!-- Main Header -->
  @include('admin.layouts.header')
<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<!-- <img src="assets/images/logo.png" alt="" class="img-fluid mb-4"> -->
		<div class="card borderless">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="f-w-400">Sign up</h4>
						<hr>
						<form autocomplete="off" id="signUpFrm" method="POST" action="{{ url('/admin/storeuser') }}">
							@csrf
							<div class="form-group mb-3">
								<input type="text" class="form-control formField" id="Username" name="username" placeholder="Username">
								<input type="hidden" class="custom-control-input" id="nonceVal" value="{{ $nonceVal }}">
								@if ($errors->has('name'))
                                	<span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
							</div>
							<div class="form-group mb-3">
								<input type="text" class="form-control formField" id="Email" name="email" placeholder="Email address">
								@if ($errors->has('email'))
                                	<span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
							</div>
							<div class="form-group mb-4">
								<input type="password" class="form-control formField" id="Password" name="password" placeholder="Password">
								@if ($errors->has('password'))
                                	<span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
							</div>
							<div class="custom-control custom-checkbox  text-left mb-4 mt-2">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Send me the <a href="#!"> Newsletter</a> weekly.</label>
							</div>
							<button type="button" id="signup" class="btn btn-primary btn-block mb-4">Sign up</button>
						</form>
						<hr>
						<p class="mb-2">Already have an account? <a href="{{ url('/admin') }}" class="f-w-400">Sign in</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signup ] end -->
<script>
	$(document).ready(function(){ // Registration form validation
		$(document).on("click", "#signup", function(){
			var err = 0;
			var email = $('#Email').val();
			if($("#Username").val() == ''){
				err = 1;
			} else if(email == ''){
				err = 1;
			} else if($("#Password").val() == ''){
				err = 1;
			}

			if(err == 1){
				// alert("Please fill the required fields");
				$(".text-danger").hide();
				$('.formField').filter(function() {
					return this.value == ''
				}).css('border','1px solid #e60000'); //#495057
				return false;
			} else {
				if (IsEmail(email) === false){
					$(".text-danger").hide();
					$('#Email').css('border','1px solid #e60000');
					return false;
				} else {
					$("#signUpFrm").submit();
					var formData = new FormData();
					formData.append('_token', _accessToken);
					formData.append('username', $("#Username").val());
					formData.append('email', $("#Email").val());
					formData.append('password', $("#Password").val());
					
					/* var formDataArray = [];
					formData.forEach(function(value, key) {
						formDataArray.push({ name: key, value: value });
					});
					var serializedFormData = $.param(formDataArray);			
					let nonceValue = $("#nonceVal").val();
					let encryption = new Encryption();
					let jsonString = JSON.stringify(serializedFormData);            
					let form_data = encryption.encrypt(jsonString, nonceValue); */
					
					/* $.ajax({
						cache: false,
						contentType: false,
						processData: false,
						url: base_url + "/admin/storeuser",
						type: 'post',
						data: formData,
						success: function (result) {
							if (result){
								window.location.href = base_url+'/admin';
							}
						}
					}); */
				}
			}
		});

		$(document).on("keyup","#Username, #Email, #Password",function(){
			$(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
			$(".text-danger").hide();
		});
	});

	function IsEmail(email) {
            const regex =
/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            }
            else {
                return true;
            }
        }
</script>