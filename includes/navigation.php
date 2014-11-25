<div class="div-header">
	<div class="div-logo">
		<a class="a-link" href="home.php">A Thought</a>
	</div>
	<div class="div-buttons">
		<div class="div-btn">
			<a class="a-link" href="newreview.php">Create Review</a> 
		</div>
		<?php
		if(!$user->is_logged_in()) {
		?>
			<div class="div-btn">
				<a class="a-link" style="margin-left:30%;" href="register.php">Register</a> 
			</div>
			<div class="div-btn">
				<a class="a-link" href="login.php">Login</a> 
			</div>
		<?php } else { ?>
			<div class="div-btn">
				<a class="a-link" href="logout.php?page=<?php echo (isset($page) ? $page : "home.php");  ?>">Logout</a> 
			</div>
			<div class="div-btn">	 
			</div>
		<?php } ?>
	</div>
</div>
