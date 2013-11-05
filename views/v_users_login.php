<strong> Log in</strong><BR><BR>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    
    <div class="container">
    <form id="formID" method='POST' action='/users/p_login'>

        <label>Email:</label> <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" required/><BR>
   
        <label>Password:</label>  <input type='password' name='password' required><br><BR>
    </div>
    
    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Login failed. Please check your email and password. <a href='/users/emailpassword'>Forgot password?</a>
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Login' >
    <input type='reset' value='Reset'> 
</form>

