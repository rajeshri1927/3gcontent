<!-- Main Header -->
  @include('admin.layouts.header')
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <!-- <img src="assets/images/logo.png" alt="" class="img-fluid mb-4"> -->
        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">Sign in</h4>
                        <hr>
                        <form autocomplete="off" method="POST" action="{{ url('/admin/authenticate') }}">
                            @csrf
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
                            <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                            </div>
                            <button type="submit" id="signin" class="btn btn-block btn-primary mb-4">Sign in</button>
                        </form>
                        <hr>
                        <p class="mb-2 text-muted">Forgot password? <a href="#" class="f-w-400">Reset</a></p>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="{{ url('/admin/registration') }}" class="f-w-400">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->
<script>
    $(document).ready(function(){
        $(document).on("click", "#signin", function(){
            var err = 0;
			if($("#Email").val() == ''){
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
				var formData = new FormData();
				formData.append('_token', _accessToken);
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
					url: base_url + "/admin/authenticate",
					type: 'post',
					data: formData,
					success: function (result) {
						if (result){
							window.location.href = base_url+'/admin/dashboard';
						}
					}
				}); */
			}
        });

        $(document).on("keyup","#Email, #Password",function(){
			$(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
		});
    });
</script>
