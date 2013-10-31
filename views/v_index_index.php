<?php if($user): ?>

	Hello <?=$user->first_name;?>

<?php else: ?>
	Welcome to MicroBlog. Please sign up or login.
<?php endif; ?>