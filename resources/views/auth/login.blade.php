<!doctype html>
<html lang="en">
  <head>
  	<title>Login 03</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('assets/login/css/style.css')}}">
    

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Tech Crypto Faucet</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="alert alert-danger alert-dismissible fade show" id="notification__" style="display: none;">
							<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
							  <i class="nc-icon nc-simple-remove"></i>
							</button>
							<span><b> Danger - </b> This is a regular notification made with ".alert-danger"</span>
						  </div>
		      	<div class="d-flex">
		      		<div class="w-100">
		      			<h3 class="mb-4">Login</h3>
		      		</div>
							<div class="w-100">
								<p class="social-media d-flex justify-content-end">
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
								</p>
							</div>
		      	</div>
						<form id="loginform" class="login-form">
              @csrf
		      		<div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input type="email" name="email" class="form-control rounded-left" placeholder="Email" required>
		      		</div>
	            <div class="form-group">
	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
	              <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
	            </div>
	            <div class="form-group d-flex align-items-center">
	            	<div class="w-100">
	            		<label class="checkbox-wrap checkbox-primary mb-0">Remember
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-100 d-flex justify-content-end">
		            	<a onclick="submitLogin();" id="submitBtn"  class="btn btn-primary rounded submit">Login</a>
	            	</div>
	            </div>
	            <div class="form-group mt-4">
					<div class="w-100 text-center">
						<p class="mb-1">Don't have an account? <a href="#">Sign Up</a></p>
						<p><a href="#">Forgot Password</a></p>
					</div>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('assets/login/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/login/js/popper.js')}}"></script>
  <script src="{{asset('assets/login/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/login/js/main.js')}}"></script>
  <script>
    function submitLogin(){
      event.preventDefault();
      document.getElementById('submitBtn').setAttribute("class", "")
      document.getElementById('submitBtn').text = "Checking..."

	  let notification__ = document.getElementById('notification__');

      var formData = new FormData(document.getElementById('loginform'));// yourForm: form selector        
      $.ajax({
          type: "POST",
          url: "auth/login",// where you wanna post
          data: formData,
          processData: false,
          contentType: false,
          error: function(jqXHR, textStatus, errorMessage) {
              console.log(errorMessage); // Optional
              document.getElementById('submitBtn').setAttribute("class", "btn btn-primary rounded submit")
			  document.getElementById('submitBtn').text = "Login"
          },
          success: function(data) {
            
			let jsonData = JSON.parse(JSON.stringify(data));
			
			console.log(jsonData)
			if (jsonData.status == "error"){
				notification__.setAttribute("style", "display: block;")
				notification__.setAttribute("class", "alert alert-danger fade show")
				notification__.innerHTML  = "<b> Error - </b> " + jsonData.message
				document.getElementById('submitBtn').setAttribute("class", "btn btn-primary rounded submit")
			  	document.getElementById('submitBtn').text = "Login"
			}
			else if (jsonData.status == "success"){
				notification__.setAttribute("style", "display: block;")
				notification__.setAttribute("class", "alert alert-success fade show")
				notification__.innerHTML  = "<b> Success - </b> Logged in, redirecting to Dashboard..."
				
				setTimeout(function() {
					window.location.replace(jsonData.redirector);
				}, 1200)

			  	document.getElementById('submitBtn').text = "Login success!"	
			}else{
				notification__.setAttribute("style", "display: block;")
				notification__.setAttribute("class", "alert alert-danger fade show")
				notification__.innerHTML  = "<b> Error - </b> " + jsonData.message
			}
			

            //.getElementById('submitBtn').setAttribute("class", "btn btn-primary rounded submit")
			
          } 
      });
    }
  </script>
	</body>
</html>

