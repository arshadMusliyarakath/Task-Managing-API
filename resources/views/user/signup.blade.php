
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <form method="post"  id="myForm" action="{{ route('user.do.signup') }}">
          @csrf
          <h1>Signup</h1>
          @if (session()->has('loginFailedMessage'))
              <p class="alert alert-danger">{{ session()->get('loginFailedMessage') }}</p>
          @endif
          <hr>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name='name' required>
          <div class="mb-3">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name='email' required>
          <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" class="form-control" name="pass1" id="pass1" required>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="pass2" id="pass2" required>
            <div class="mt-1" id="passwordMatch"></div>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-right: 10px">Signup</button>
          <a href="{{route('user.login')}}" >I Already have an Account</a>
        </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>

  <style>
body{
  background: #f6f9ff;
}
form {
	margin: 0 auto;
	width: 36%;
	border: 1px solid;
	padding: 40px;
	border-color: rgba(0,0,0,0.1);
	margin-top: 40px;
	border-radius: 10px;
	background: white;
}
  </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
      // Cache the password and confirm password fields
      var password = $("#pass1");
      var confirmPassword = $("#pass2");
      var passwordMatchMessage = $("#passwordMatch");
    
      // Check for password match when the user types
      confirmPassword.on("keyup", function() {
        var passwordValue = password.val();
        var confirmPasswordValue = confirmPassword.val();
        
        if (passwordValue === confirmPasswordValue) {
          passwordMatchMessage.html("Passwords match").css("color", "green");
        } else {
          passwordMatchMessage.html("Passwords do not match").css("color", "red");
        }
      });
    
      // Submit the form
      $("#myForm").submit(function(event) {
        var passwordValue = password.val();
        var confirmPasswordValue = confirmPassword.val();
        
        if (passwordValue !== confirmPasswordValue) {
          passwordMatchMessage.html("Passwords do not match").css("color", "red");
          event.preventDefault(); // Prevent form submission
        }
      });
    });
    </script>




</html>
    
