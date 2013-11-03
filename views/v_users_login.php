<strong> Log in</strong><BR><BR>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    
    <div class="container">
    <form id="formID" method='POST' action='/users/p_login'>

        <label>Email:</label> <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><BR>
   
        <label>Password:</label>  <input type='text' name='password'><br>
    </div>
    
    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Login' >

</form>

