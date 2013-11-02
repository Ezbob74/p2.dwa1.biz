<h2>Sign Up</h2>
 <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
<form id="formID" method='POST' action='/users/p_signup'>
	First Name <input class="validate[custom[onlyLetterSp]]" type='text' name='first_name' required><BR><BR>
	Last Name <input class="validate[custom[onlyLetterSp]]" type='text' name='last_name' required><BR><BR>
	
	Email <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><BR><BR>
	Password <input type='password' name='password' required><BR><BR>
<?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Sign-up failed. Please use a different email.
        </div>
        <br>
    <?php endif; ?>
	<input type='submit' value='Sign Up'>

</form>