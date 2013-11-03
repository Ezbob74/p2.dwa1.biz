<strong>Sign Up</strong><BR><BR>
    
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    <div class="container">

    <form id="formID" method='POST' action='/users/p_signup'>
	   First Name: <input class="validate[custom[onlyLetterSp]]" type='text' name='first_name' required><BR>
	   Last Name: <input class="validate[custom[onlyLetterSp]]" type='text' name='last_name' required><BR>
	   Email: <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><BR>
	   Password: <input type='password' name='password' required><BR><BR>
    </div>
       
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Sign-up failed. Please use a different email.
        </div>
        <br>
    <?php endif; ?>
	<input type='submit' value='Sign Up'>

</form>