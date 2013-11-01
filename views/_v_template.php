<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
    
    			

	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
    <!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  
<div id="main">  
    <nav>
        <menu>
                <a href='/'>Home</a>:: 
                
            <?php if($user): ?>
                <a href='/posts/add'>Add Post</a> :: 
                <a href='/posts/'>View Posts</a> :: 
                <a href='/posts/users'>Follow Users</a> :: 
                <a href='/posts/own'>My Own Posts</a> ::
                <a href='/users/logout'>Logout</a>
            <?php else: ?>
                <a href='/users/signup'>Sign Up</a> :: 
                <a href='/users/login'>Log In</a>
            <?php endif; ?>
        </menu>
    </nav>
    
    <?php if($user): ?>
        You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
    <?php endif; ?>
    
    <br><br>

    <?php if(isset($content)) echo $content; ?>



	<?php if(isset($client_files_body)) echo $client_files_body; ?>

    <!-- JS/CSS File every page -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</div>  
</body>
</html>