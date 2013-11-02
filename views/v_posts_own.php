<?php foreach($posts as $post): ?>

	<?=$post['content']?><a href='/posts/delete/<?=$post['post_id']?>'>Delete Post</a><br><br>

<?php endforeach; ?>