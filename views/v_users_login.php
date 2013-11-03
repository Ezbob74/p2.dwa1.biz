<strong> Log in</strong><BR><BR>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
<form id="formID" method='POST' action='/users/p_login'>

    Email: <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><br><BR>
   
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

