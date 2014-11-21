<div class="div-header">
	<div class="div-logo">
		<a class="a-link" href="home.html">A Thought</a>
	</div>
	<div class="div-buttons">
		<div class="div-btn">
			<a class="a-link" href="newreview.html">Create Review</a> 
		</div>
		<?php
		if(!$user->is_logged_in()) {
		?>
			<div class="div-btn">
				<a class="a-link" href="register.html">Register</a> 
			</div>
			<div class="div-btn">
				<a class="a-link" href="login.html">Login</a> 
			</div>
		<?php } else { ?>
			<div class="div-btn">
				<a class="a-link" href="logout.php?page=<?php echo (isset($page) ? $page : "index.php");  ?>">Logout</a> 
			</div>
			<div class="div-btn">	 
			</div>
		<?php } ?>
	</div>
</div>
