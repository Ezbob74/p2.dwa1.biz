<strong> Forgot Password? Enter your email and a new password will be emailed to you.</strong><BR><BR>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    
    <div class="container">
    <form id="formID" method='POST' action='/users/p_emailpassword'>

        <label>Email:</label> <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" required/><BR>
           
    </div>
    
    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Send failed. Please contact support.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Email Password' >

</form>