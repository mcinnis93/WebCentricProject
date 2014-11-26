<?php
require("includes/connection.php");
require("includes/review.php");
/* instantiate review object */	
$id = (int)$_GET['id'];
	/* query the database */
	$sql = "SELECT * FROM Review, UserAccount where UserAccount.id = Review.idReviewAuthor and Review.id = $id";
	$results = $conn->query($sql);

$reviewDB = new Review($conn);


$errors = array();
/* check for form submissions */
if(!empty($_POST))
{
	
	
	$idreview = (int)$_GET['id'];
	if($user->is_logged_in())
	{
		$successful = $reviewDB->add_comment($_POST['commentText'],$idreview,  $user, $errors);
		if($successful)
			header("Location:review.php?id=".$idreview);
	}else
	{
		$errors[] = "<p class=\"error\">Must be logged in to create a review</p>";
	}
}

/* include header */
$title = "Perform Search";
include("includes/header.php");
?>
  <body>
	<div class="div-background">
		
			<?php
			include("includes/navigation.php");
			?>
			<div class="div-content">
				<div class="div-review">
					<div class="div-newreview">
						<?php
						/* display the erorrs */
						foreach($errors as $error) echo $error;
						/* display the results */
						foreach($results as $review)
						{
						$idreview = $review['id'];
						$reviewauthor = $review['username'];
						$bookname = $review['bookName'];
						$bookauthor = $review['bookAuthor'];
						$bookyear = $review['bookYear'];
						$description = $review['description'];
						}
						
						echo"<h2 class=\"form-signin-heading\" style=\"text-align:center\">Review</h2>\n";
						echo"<br>\n";
						echo"<div class=\"div-reviewbookname\">\n";
							echo"<div class=\"div-booknamereview\">\n";
								 echo"<label class=\"text-reviewname\">$bookname</label>\n";
							echo"</div>\n";
							echo"<div class=\"div-authornamereview\">\n";
								echo"<label class=\"text-authornamereview\">$bookauthor</label>\n";
							echo"</div>\n";
							echo"<div class=\"div-authorbookreview\">\n";
								echo"<label class=\"text-authornamereview\">Created by: $reviewauthor</label>\n";
							echo"</div>\n";
						echo"</div>	\n";

						echo"<div class=\"div-reviewinformation\">\n";
							echo"<p>$description</p>\n";
						echo"</div>\n";
						?>
						<?php if($user->is_logged_in()){?>
						<form class="form-signin" role="form" action="newcomment.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; ?>" method="post">
							<label class="form-signin-heading" style="margin-top:2%;" >Create Comment</label>
							<div class="div-newcomment">
								<label for="inputNewComment" class="sr-only">Review</label>
								<textarea name="commentText" class="review-textbox" id="comment" name="" placeholder="Review"></textarea>
							</div>
							<br>
							<div class="div-buttonreview">
							<button class="btn btn-lg btn-primary btn button-position" type="submit">Submit</button>
							</div>	
						</form>
						<?php } 
						else{?>
						<div class="div-loginerror">
							<label>You must be logged in to create a comment</label>
							<a href="login.php">Click to login</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
			
<?php
/* include footer */
include("includes/footer.php");
?>
