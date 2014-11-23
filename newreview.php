
<?php

require("includes/connection.php");
require("includes/review.php");
$reviewDB = new Review($conn);
$errors = array();
/* check for form submissions */
if(!empty($_POST))
{
	if($user->is_logged_in())
	{
		$successful = $reviewDB->add_review($_POST['bookName'], $_POST['bookAuthor'], $_POST['reviewText'], $_POST['bookGenre'],  $user, $errors);
	}else
	{
		$errors[] = "<p class=\"error\">Must be logged in to create a review</p>";
	}
}
print_r($_POST);

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
					<?php
					foreach($errors as $error)
					{
						echo $error;
					}
					
					/* if a form was submitted, display whether it was successful */ 
					if(isset($successful))
					{
						if($successful)
						{
							echo "Review was successfully submitted!";
						}else
						{
						}
					}else{
					?>
					<form class="form-signin" role="form" action="newreview.php" method="post">
						<h2 class="form-signin-heading" style="text-align:center">New Review</h2>
						<br>
						<div class="div-textbox">
							<label for="inputBookName" class="sr-only">Book Name</label>
							<input name="bookName" type="text" id="inputBookName" class="form-control" placeholder="Book Name" required autofocus>
						</div>	
						
						<br>
						<div class="div-textbox">
							<label for="inputBookAuthor" class="sr-only">Book Author</label>
							<input name="bookAuthor" type="text" id="inputBookAuthor" class="form-control" placeholder="Book Author" required>
						</div>
						<br>
						<div class="div-textbox">
							<select name="bookGenre">
							<option value="0">Genre</option>
							<?php
							/* print list of categories */
							$categories = $reviewDB->get_genre_list();
							foreach($categories as $category)
							{
								echo "<option value=\"".$category['id'] ."\">".$category['description']."</option>";
							}
							?>
							</select>
						</div>
						<br>
						<div class="div-textboxreview">
							<label for="inputReview" class="sr-only">Review</label>
							<textarea name="reviewText" class="review-textbox" id="review" name="" placeholder="Review"></textarea>
						</div>
						<br>
						<br>
						<div class="div-buttonreview">
							<button class="btn btn-lg btn-primary btn button-position" type="submit">Submit</button>
						</div>	
					</form>	
					<?php
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
/* include footer */
include("includes/footer.php");
?>
