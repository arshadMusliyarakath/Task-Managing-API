
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        
      <form method="post" action="{{ route('user.do.login') }}">
        @if (session()->has('signupSuccess'))
            <p class="alert alert-success">{{ session()->get('signupSuccess')}}</p>
        @endif
          @csrf
          <h1>Login</h1>
          @if (session()->has('loginFailedMessage'))
              <p class="alert alert-danger">{{ session()->get('loginFailedMessage') }}</p>
          @endif
          <hr>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name='email'>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <button type="submit" class="btn btn-primary" style="margin-right: 10px">Submit</button>
          <a href="{{route('user.signup')}}" >I don't have Account</a>
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
</html>
    
