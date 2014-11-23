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
			<div class="div-content" >
				<div class="div-information" >
					<div class="div-search">
					<form class="form-signin" role="form">
						<div class="search-textbox">
							<label for="inputSearch" class="sr-only">Search</label>
							<input type="text" id="inputsearch" class="form-control" placeholder="Search" style="height:44px;" autofocus>
						</div>
						<div class="search-button">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Search</button>
						</div>
					</form>
						
					</div>
					
					<div class="div-reviews">
						<h2> Recently Added Reviews</h2>
						<div class="div-reviewcontent">
							<div class="div-bookname">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-bookauthor">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-reviewinfo">
								<p class="text-review">Book Name</p>
							</div>
						</div>
						<div class="div-reviewcontent">
							<div class="div-bookname">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-bookauthor">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-reviewinfo">
								<p class="text-review">Book Name</p>
							</div>
						</div>
						<div class="div-reviewcontent">
							<div class="div-bookname">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-bookauthor">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-reviewinfo">
								<p class="text-review">Book Name</p>
							</div>
						</div>
						<div class="div-reviewcontent">
							<div class="div-bookname">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-bookauthor">
								<p class="text-bookname">Book Name</p>
							</div>
							<div class="div-reviewinfo">
								<p class="text-review">Book Name</p>
							</div>
						</div>
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
