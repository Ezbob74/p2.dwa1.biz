<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js" type="text/javascript"></script>
    <!--<script src="/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery-1.8.2.min.js" type="text/javascript">
    </script><link rel="stylesheet" href="/css/template.css" type="text/css"/>-->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
    <!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  

<div id="header">MicroBlog
    </div>
<div id="top">
    <a class="nav-link" href='/'>Home</a>:: 
               
            <?php if($user): ?>
                <a class="nav-link"  href='/posts/add'>Add Post</a> :: 
                <a class="nav-link" href='/posts/'>View Posts</a> :: 
                <a class="nav-link" href='/posts/users'>Follow Users</a> :: 
                <a class="nav-link" href='/posts/own'>My Own Posts</a> ::
                 <a class="nav-link" href='/users/editprofile'>Edit Profile</a> :: 
                <a class="nav-link" href='/users/logout'>Logout</a>
            <?php else: ?>
                <a class="nav-link" href='/users/signup'>Sign Up</a> :: 
                <a class="nav-link" href='/users/login'>Log In</a>
            <?php endif; ?><BR>
            <?php if($user): ?>
                You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
            <?php endif; ?>
    </div>

<div id="center">
    <?php if(isset($content)) echo $content; ?>
</div>


<div id="footer">Project 2 :: Dynamic Web Applications :: Harvard Extension school ::  Babak Mansouri
    </div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>

    <!-- JS/CSS File every page -->
    
</div>  
</body>
</html>