<?php if($user): ?>
<!-- Redirect to posts if user is logged in-->
	<?php Router::redirect("/posts/"); ?>
<!-- if user is not logged in show features and welcome-->
<?php else: ?>
	Welcome to MicroBlog. Please sign up or login.<BR><BR>
	<STRONG>Plus one features:</STRONG><BR>
	&bull; Edit and display profile and update password<br>
	&bull; Delete Posts<BR>
	&bull; Reset and email password<BR>
<?php endif; ?>