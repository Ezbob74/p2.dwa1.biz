<h2>Sign Up</h2>

<form method='POST' action='/users/p_signup'>
	First Name <input type='text' name='first_name' required><br>
	Last Name <input type='text' name='last_name' required><br>
	Email <input type='text' name='email' required><br>
	Password <input type='password' name='password' required><br>
<?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Sign-up failed. Please use a different email.
        </div>
        <br>
    <?php endif; ?>
	<input type='submit' value='Sign Up'>

</form>