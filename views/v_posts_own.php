 <?php if($posts): ?>
<strong>My Posts</strong><BR><BR>
 <!-- loop through users posts and let her delete them  -->
 <?php foreach($posts as $post): ?>

	<div id='posts'><?=$post['content']?><a href='/posts/delete/<?=$post['post_id']?>'><BR>Delete Post</a></div><br>

<?php endforeach; ?>
<?php else: ?>
	You do not have any posts yet.
<?php endif; ?>