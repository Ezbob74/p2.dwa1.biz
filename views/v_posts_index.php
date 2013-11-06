<?php if($posts): ?>
<strong>Posts you are following</strong><BR><BR>
	 <!-- Show posts and display a link to users profile -->
	<?php foreach($posts as $post): ?>

	<div id='posts'><strong><a href='/users/profile/<?=$post['email']?>'><?=$post['first_name']?></a></strong><BR>

	<?=$post['content']?></div><br><br>
	

<?php endforeach; ?>
	
<?php else: ?>
	You are not Following anyone or there are no posts from users that you are following.
<?php endif; ?>