<?php if($user): ?>

	Hello <?=$user->first_name;?>

<?php else: ?>
	Welcome to MicroBlog. Please sign up or login.<BR><BR>
	<STRONG>Plus one features:</STRONG><BR>
	&bull; Edit and display profile and update password<br>
	&bull; Delete Posts<BR>
	&bull; Reset and email password<BR>
<?php endif; ?>