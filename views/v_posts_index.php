<?php if($posts): ?>
	<?php foreach($posts as $post): ?>

	<strong><?=$post['first_name']?></strong><BR>
	

	<?=$post['content']?><br><br>
	

<?php endforeach; ?>

	
<?php else: ?>
	You are not Following anyone or there are no posts from users that you are following.
<?php endif; ?>