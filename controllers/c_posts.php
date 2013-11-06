<?php 
# This is the posts controller

class posts_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        // If user is not logged in redirect them to login
    	if(!$this->user){
            die('Members Only Click here to <a href="/users/login">Login</a>');
    	}
    } 

    # this function is to to view the add posts    
	public function add() {

		$this->template->content = View::instance("v_posts_add");
        $this->template->title= APP_NAME. " :: Add Post ";
        // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);
		echo $this->template;

	}

    #    this function is to add posts   
	public function p_add(){
        # looks for urls and make them links , also strip tags    
		$_POST['content']=strip_tags($_POST['content']);
        $_POST['content'] = Utils::make_urls_links($_POST['content']);
        $_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
        
        # insert the post
		DB::instance(DB_NAME)->insert('posts',$_POST);
	
         Router::redirect('/posts/own/');   
	}
    # View the users followed posts
	public function index(){

		 # Set up the View
        $this->template->content = View::instance('v_posts_index');
        $this->template->title   = APP_NAME. " :: All Posts";

        # Query posts and users to get with posts the users have posted and current user is following 
        $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name,
            users.email
            FROM posts
            INNER JOIN users_users 
                ON posts.user_id = users_users.user_id_followed
            INNER JOIN users 
                ON posts.user_id = users.user_id
            WHERE users_users.user_id = '.$this->user->user_id.'
            AND posts.user_id  !='.$this->user->user_id ;
       
        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render the View
        echo $this->template;

	}
# This function shows users own posts
    public function own(){

         # Set up the View
        $this->template->content = View::instance('v_posts_own');
        $this->template->title   = APP_NAME. " :: My Posts";

        # Query posts of the user
        $q = 'SELECT 
            posts.post_id,
            posts.content,
            posts.created,
            posts.user_id AS post_user_id
          
        FROM posts
        WHERE posts.user_id  ='.$this->user->user_id ;
        //echo $q;

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render the View
        echo $this->template;


    }
    # show list of users and whether they are being followed or not
	public function users() {
        # Set up the View
        $this->template->content = View::instance("v_posts_users");
        $this->template->title   = APP_NAME. " :: Users";

        # Build the query to get all the users excluding the user
        $q = "SELECT *
            FROM users 
            WHERE user_id!=".$this->user->user_id;

        # Execute the query to get all the users. 
        # Store the result array in the variable $users
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Build the query to figure out what connections does this user already have? 
        # I.e. who are they following
        
        $q ="SELECT * 
                FROM users_users
                WHERE user_id = ".$this->user->user_id;

        # Execute this query with the select_array method
        # select_array will return our results in an array and use the "users_id_followed" field as the index.
        # This will come in handy when we get to the view
        # Store our results (an array) in the variable $connections
        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

        # Pass data (users and connections) to the view
        $this->template->content->users       = $users;
        $this->template->content->connections = $connections;

        # Render the view
        echo $this->template;
}
    # follow user
	public function follow($user_id_followed) {

        # Prepare the data array to be inserted
        $data = Array(
           "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
        );

        # Do the insert
        DB::instance(DB_NAME)->insert('users_users', $data);

        # Send them back
        Router::redirect("/posts/users");

}
 # unfollow user
    public function unfollow($user_id_followed) {

        # Delete this connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

        # Send them back
        Router::redirect("/posts/users");

}
 # delete posts
    public function delete($posts_id) {

        # Delete users own posts only
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND post_id = '.$posts_id;
        DB::instance(DB_NAME)->delete('posts', $where_condition);

        # Send them back to users own post list
        Router::redirect("/posts/own");

}


}