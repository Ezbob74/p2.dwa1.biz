<?php if(isset($user)): ?>
    
    <h2>Profile</h2>
 
	First Name: <?=$user['first_name']?><BR><BR>
	Last Name : <?=$user['last_name']?><BR><BR>
	
	Email : <?=$user['email']?><BR><BR>
	
<?php if(isset($error)): ?>
        <div id='error' class='errors'>
            This is an error.
        </div>
        <br>
<?php endif; ?>

<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?>