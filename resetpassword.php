<?php

require("includes/connection.php");

/* include header */
$title = "Reset Password";
include("includes/header.php");
?>

  <body>
	<div class="div-background">
			<?php
			/* include nav */
			include("includes/navigation.php");
			?>
			<div class="div-content">
				<div class="div-information">
					<div class="div-login">
					<form class="form-signin" role="form">
        <h2 class="form-signin-heading" style="text-align:center">Password Reset</h2>
		<br>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		<br>
		<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
</form>
						
					</div>
				</div>
			</div>
			<div class="div-footer">
				®A Thought - 2014
			</div>
		</div>
<?php
/* include footer */
include("includes/footer.php");
?>
