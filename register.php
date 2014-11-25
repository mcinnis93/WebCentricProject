<?php
/* include database connections and user class */
require('includes/connection.php');

$errors = array();

/* don't let a logged in user register */
if($user->is_logged_in())
{
	$errors[] = "<p class='error'>You already have an account</p>";
}

/* process a form if required */
if(!empty($_POST) )
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordConfirmed = $_POST['passwordconfirm'];
	$email = $_POST['email'];
	
	$user->register($username, $password,$passwordConfirmed, $email, $errors);
}

/* Set the title for the web page */
$title = "Register";
$page = basename(__FILE__);

/* Include header */
include('includes/header.php');

?>





	<div class="div-background">
			<?php
			/* Include navigation*/
			include("includes/navigation.php");
			?>
			<div class="div-content">
				<div class="div-information">
					<div class="div-login">
					
					<?php 
					/* Print out any errors */
					foreach($errors as $error)
					{
						echo $error;
					}
					
					
					/* Check if registration was successful */
					if(empty($errors) && $user->is_logged_in())  { ?>
						<p>Registration was successful!</p>
					<?php } else if ($user->is_logged_in()){ ?>
						
					<?php } else { ?>
					<form class="form-signin" role="form" action="register.php" method="post">
							<h2 class="form-signin-heading" style="text-align:center">Create new account</h2>
							<br>
							<label for="inputUsername" class="sr-only">Username</label>
							<input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
							<br>
							<label for="inputEmail" class="sr-only">Email address</label>
							<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
							<br>
							<label for="inputPassword" class="sr-only">Password</label>
							<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
							<br>
							<label for="inputPasswordConfirm" class="sr-only">ConfirmPassword</label>
							<input name="passwordconfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confirm Password" required>
							<br>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
					</form>
					<?php } ?>
					</div>
				</div>
			</div>
			<div class="div-footer">
				®A Thought - 2014
			</div>
		</div>
<?php
include('includes/footer.php')
?>
