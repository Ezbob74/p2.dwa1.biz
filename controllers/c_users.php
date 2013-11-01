<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
      //  echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        $this->template->content=View::instance('v_users_signup');

        echo $this->template;
    }

public function p_signup() {

       

        $_POST['created']= Time::now();
        $_POST['password']= sha1(PASSWORD_SALT.$_POST['password']); 
        $_POST['token']= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        //echo "<pre>";
        // print_r($_POST);
        //echo "<pre>";
        
        DB::instance(DB_NAME)->insert_row('users',$_POST);
        Router::redirect('/users/login');
    }


    public function login($error = NULL) {
        
    $this->template->content=View::instance('v_users_login');    

 # Pass data to the view
    $this->template->content->error = $error;

    echo $this->template;


    }

    public function p_login(){

        $_POST['password']=sha1(PASSWORD_SALT.$_POST['password']);

     //   echo "<pre>";
      //  print_r($_POST);
      //  echo "<pre>";

        $q= 'Select token         
          From users            
           WHERE email="'.$_POST['email'].'"
             AND password= "'.$_POST['password'].'"';
         //echo $q;
        $token= DB::instance(DB_NAME)->select_field($q);
        //echo $token;
        #success
        if(!$token){  

           // echo "Success";
            
          Router::redirect("/users/login/error"); 
         }
        #
        else{
           // echo "Failed";
            //echo "Login failed";
            setcookie('token',$token,strtotime('+2 week'),'/');
            Router::redirect('/posts/own');
        }

            
    }

    public function logout() {
        $new_token=sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string()); 
        $data=Array('token'=>$new_token);
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$this->user->user_id);
        setcookie('token','',strtotime('-1 year'),'/');
        Router::redirect('/');

            }

    public function profile($user_name = NULL) {


    if(!$this->user){
       // Router::redirect('/');
        die('Members Only <a href="/users/login">Login</a>');

    }

    $this->template->content=View::instance('v_users_profile');    
    // $content=View::instance('v_users_profile'); 
    $this->template->title= "Profile :: ".$user_name;
    $client_files_head=Array('/css/profile.css','/css/master.css','/js/profile1.js');
    $this->template->client_files_head=Utils::load_client_files($client_files_head);


    $client_files_body=Array('/js/profile2.js');
    $this->template->client_files_body=Utils::load_client_files($client_files_body);

    $this->template->content->user_name=$user_name;
    // $content->user_name=$user_name;

     //$this->template->content=$content;

        
     echo $this->template;


    # Create a new View instance
    # Do *not* include .php with the view name
    //$view = View::instance('v_users_profile');

    # Pass information to the view instance
    ///$view->user_name = $user_name;

    # Render View
    //echo $view;

}

} # end of the class