<?php
/* include database connections and user class */
require('includes/connection.php');


/* Set the title for the web page */
$title = "Register";
$page = basename(__FILE__);

$errors = array();
$success = false;
/* process a form if required */
if(!empty($_POST) && $user->is_logged_in() == false)
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$success = $user->login($email,$password, $errors);
}else if($user->is_logged_in())
{
	$errors[] = "<p class='error'>You are already logged in</p>";
}

/* include header */
include("includes/header.php");

?>

  <body>
	<div class="div-background">
<?php
/* Include navigation*/
include("includes/navigation.php");
?>
			<div class="div-content">
				<div class="div-information">
					<div class="div-login">
					<?php
					/* display errors */
					foreach($errors as $error)
					{
						echo $error;
					}
					/* If user is already signed in, don't display the sign up form */
					if(!$user->is_logged_in()) {
					?>
					<form class="form-signin" role="form" action="login.php" method="post">
							<h2 class="form-signin-heading" style="text-align:center">Please sign in</h2>
							<br>
							<label for="inputEmail" class="sr-only">Email address</label>
							<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
							<br>
							<label for="inputPassword" class="sr-only">Password</label>
							<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
							<div class="checkbox">
							  <label>
								<input type="checkbox" value="remember-me"> Remember me
							  </label>
							  <label style="margin-left:40%;">
								<a href="resetpassword.php"> Forgot password</a>
							  </label>
							</div>
							<br>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
					<?php
					}else if ($success) {
						echo "<p>Logged in successfully</p>";
						echo "<a href=\"home.php\">Return to home page</a> ";
					}
					?>
					</div>
				</div>
			</div>
			<div class="div-footer">
				®A Thought - 2014
			</div>
		</div>

<?php
include("includes/footer.php");
?>

