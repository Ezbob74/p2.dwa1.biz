<?php if($user): ?>

	<?php Router::redirect("/posts/own"); ?>

<?php else: ?>
	Welcome to MicroBlog. Please sign up or login.<BR><BR>
	<STRONG>Plus one features:</STRONG><BR>
	&bull; Edit and display profile and update password<br>
	&bull; Delete Posts<BR>
	&bull; Reset and email password<BR>
<?php endif; ?>