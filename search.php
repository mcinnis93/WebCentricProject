<?php

require("includes/connection.php");
require("includes/review.php");

/* get needed params */
if(isset($_GET['searchString']))
	$search_string = $_GET['searchString'];
else
	$search_string = '';

if(isset($_GET['genre']))
	$genre = $_GET['genre'];
else
	$genre = null;

/* instantiate review object */	
$reviewDB = new Review($conn);

/* query the database */
$results = $reviewDB->search_reviews($search_string, $genre);

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
			<div class="div-content" >
				<div class="div-information" >
					<div class="div-search">
					<form class="form-signin" role="form" action="search.php" method="get">
						<div class="search-textbox">
							<label for="inputSearch" class="sr-only">Search</label>
							<input name="searchString" type="text" id="inputsearch" class="form-control" placeholder="Search" style="height:44px;" autofocus>
						</div>
						<div class="search-button">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Search</button>
						</div>
					</form>
						
					</div>
					
					<div class="div-reviews">
						<h2> Results Found</h2>
					
						<?php
						
						/* display the results */
						foreach($results as $review)
						{
							$id = $review['id'];
							$bookname = $review['bookName'];
							$bookauthor = $review['bookAuthor'];
							$bookyear = $review['bookYear'];
							$description = $review['LEFT(description, 150)'];
							if(strlen($description) >= 150) $description = $description."...";
							
							$creationDate = $review['creationDate'];
							$idGenre = $review['idCateogry'];
							
							echo "<div class=\"div-reviewcontent\">";
							
							echo "<div class=\"div-bookname\">";
							echo "<p class=\"text-bookname\">$bookname</p>";
							echo "</div>";
							
							echo "<div class=\"div-bookauthor\">";
							echo "<p class=\"text-bookname\">$bookauthor</p>";
							echo "</div>";
							
							echo "<div class=\"div-reviewinfo\">";
							echo "<p class=\"text-review\">$description</p>";
							echo "</div>";
							
							echo "</div>";
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
