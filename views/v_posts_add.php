<!--add posts view allowing posting of size 140 chars -->
<strong>Add a new post</strong><BR><BR>
<script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
<form id='formID' method='post' action='/posts/p_add'>

	<textarea class="validate[required,maxSize[140]] text-input" name='content' rows="4" cols="50" required></textarea>

	<input type='Submit' value='Add new post'>
 	<input type='reset' value='Reset'> 
</form>

