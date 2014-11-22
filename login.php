<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>
	<link rel="stylesheet" type="text/css" href="css/home.css" />
    <!-- Bootstrap core CSS -->
    

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
	<div class="div-background">
			<div class="div-header">
				<div class="div-logo">
					<a class="a-link" href="home.html">A Thought</a>
				</div>
				<div class="div-buttons">
					<div class="div-btn">
						<a class="a-link" href="newreview.html">Create Review</a> 
					</div>
					<div class="div-btn">
						<a class="a-link" href="register.html">Register</a> 
					</div>
					<div class="div-btn">
						<a class="a-link" href="login.html">Login</a> 
					</div>
				</div>
			</div>
			<div class="div-content">
				<div class="div-information">
					<div class="div-login">
					<form class="form-signin" role="form">
        <h2 class="form-signin-heading" style="text-align:center">Please sign in</h2>
		<br>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		<br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
		  <label style="margin-left:40%;">
            <a href="resetpassword.html"> Forgot password</a>
          </label>
        </div>
		<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
						
					</div>
				</div>
			</div>
			<div class="div-footer">
				®A Thought - 2014
			</div>
		</div>
  </body>
</html>
