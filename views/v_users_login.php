<h2> Log in</h2>

<form method='POST' action='/users/p_login'>

	Email: <input type='text' name='email'><br>
	Password: <input type='text' name='password'><br>
    <BR>
    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php $error= NULL;
    		endif; ?>

	
	<input type='submit' value='Login' >

</form>

