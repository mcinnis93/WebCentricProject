
<?php

require("includes/connection.php");

/* include header */
$title = "Perform Search";
include("includes/header.php");
?>

  <body>
	<div class="div-background">
			<?php
			/* include nav */
			include("includes/navigation.php");
			?>
			<div class="div-content">
				<div class="div-review">
					<div class="div-newreview">
					<form class="form-signin" role="form">
						<h2 class="form-signin-heading" style="text-align:center">New Review</h2>
						<br>
						<div class="div-textbox">
							<label for="inputBookName" class="sr-only">Book Name</label>
							<input type="email" id="inputBookName" class="form-control" placeholder="Book Name" required autofocus>
						</div>	
						
						<br>
						<div class="div-textbox">
							<label for="inputPassword" class="sr-only">Book Author</label>
							<input type="password" id="inputBookAuthor" class="form-control" placeholder="Book Author" required>
						</div>
						<br>
						<div class="div-textboxreview">
							<label for="inputReview" class="sr-only">Review</label>
							<textarea class="review-textbox" id="review" name="" placeholder="Review"></textarea>
						</div>
						<br>
						<br>
						<div class="div-buttonreview">
							<button class="btn btn-lg btn-primary btn button-position" type="submit">Submit</button>
						</div>	
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
