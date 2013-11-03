<?php if($user): ?>

	Hello <?=$user->first_name;?>

<?php else: ?>
	Welcome to MicroBlog. Please sign up or login.<BR><BR>
	<STRONG>Plus one features:</STRONG><BR>
	Edit and display profile and update password<br>
	Delete Posts<BR>

<?php endif; ?>