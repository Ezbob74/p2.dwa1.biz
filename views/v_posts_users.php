<strong>Follow/Unfollow Users</strong><BR><BR>
<?php foreach($users as $user): ?>

    <!-- Print this user's name with a link to users profile -->
    <a href='/users/profile/<?=$user['email']?>'><?=$user['first_name']?> <?=$user['last_name']?></a>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <?php endif; ?>

    <br><br>

<?php endforeach; ?>
