<h2> Log in</h2>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
<form id="formID" method='POST' action='/users/p_login'>

	<!-- Email: <input type='text' name='email'><br>-->
    Email: <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><br><BR>
   <!-- Email: <input type="email" name="email" id="email" data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="Email is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="This is the fall-back error message."/>-->
	Password: <input type='text' name='password'><br>

    <BR>
    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php endif; ?>

	
	<input type='submit' value='Login' >

</form>

