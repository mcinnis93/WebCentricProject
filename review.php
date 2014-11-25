<?php

require("includes/connection.php");
require("includes/review.php");

/* instantiate review object */	
$id = (int)$_GET['id'];
/* query the database */
$sql = "SELECT * FROM AThoughtProject3172.Review, AThoughtProject3172.UserAccount where UserAccount.id = Review.idReviewAuthor and Review.id = $id";
$results = $conn->query($sql);

$sql2 = "SELECT * FROM AThoughtProject3172.Comments, AThoughtProject3172.UserAccount where UserAccount.id = Comments.idCommentAuthor and AThoughtProject3172.Comments.idReview = $id;"
$results2 = $conn->query($sql2);

/* include header */
$title = "Review";
include("includes/header.php");
?>
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
				<div class="div-review">
					<div class="div-newreview">
						<?php
						/* display the results */
						foreach($results as $review)
						{
						$id = $review['id'];
						$reviewauthor = $review['username'];
						$bookname = $review['bookName'];
						$bookauthor = $review['bookAuthor'];
						$bookyear = $review['bookYear'];
						$description = $review['description'];
						$creationDate = $review['creationDate'];
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

						echo"<div class=\"div-reviewcomments\">\n";
							echo"<label>Comments</label>\n";
							foreach($results2 as $comment)
							{
							$comment = $comment['comment'];
							$commentAuthor = $comment['usernaame'];
							$creationDate = $comment['creeationDate'];
							echo"<div class=\"div-coment\">\n";
								echo"<div class=\"div-authorcomment\">\n";
									echo"<label>$commentAuthor</label>\n";
								echo"</div>\n";
								echo"<div class=\"div-textdate\">\n";
									echo"<p>$creationDate</p>\n";
								echo"</div>\n";
								echo"<div class=\"div-comment\">\n";
								echo"$comment\n";
								echo"</div>\n";
							echo"</div>\n";
							}
						echo"</div>\n";
						?>
					</div>
				</div>
			</div>
		</div>
<?php
/* include footer */
include("includes/footer.php");
?>
