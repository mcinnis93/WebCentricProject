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
$title = "Search Reviews";
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
						<h3>Browse by genre</h3><br>
						<?php
						$genres = $reviewDB->get_genre_list();
						/* print genre list */
						foreach($genres as $genre)
						{
							echo "<a href='search.php?searchString=".$search_string."&genre=".$genre['id']."'>".$genre['description']."</a> ";
						}
						?>
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
							
							
							echo "<div class=\"div-reviewcontent\">\n";
							echo "<a style=\"display:block;\" href=\"review.php?id=".$id."\" >\n";
							echo "<div class=\"div-bookname\">\n";
							echo "<p class=\"text-bookname\">$bookname</p>\n";
							echo "</div>\n";
							echo "</a>\n";
							
							echo "<div class=\"div-bookauthor\">\n";
							echo "<p class=\"text-bookname\">$bookauthor</p>\n";
							echo "</div>\n";
							
							echo "<div class=\"div-reviewinfo\">\n";
							echo "<p class=\"text-review\">$description</p>\n";
							echo "</div>\n";
							echo "</div>\n";
							
							
						}
						
						?>
					</div>
				</div>
				
				
			</div>
		</div>


<?php
/* include footer */
include("includes/footer.php");
?>
