<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct(); 
 
    } 

    public function index() {
        if(!$this->user){
           die('Members Only <a href="/users/login">Login</a>');
        }   
        echo "This is the index page";
    }

    public function signup($error = NULL) {
        $this->template->content=View::instance('v_users_signup');

        $this->template->title= APP_NAME. " :: Sign up";
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css');

        $this->template->client_files_head=Utils::load_client_files($client_files_head);
        # error checking passed to view
        $this->template->content->error = $error;
        echo $this->template;
    }

    // this is the function that processes the signup 
    public function p_signup() {

        $q= 'Select email         
          From users            
           WHERE email="'.$_POST['email'].'"';
                  //echo $q;
        $emailexists= DB::instance(DB_NAME)->select_field($q);
        //echo $token;
        #success
        if($emailexists){  

           // echo "";
            Router::redirect("/users/signup/error"); 
          
         }
         #requires all fields to be entered if java script is disabled
        elseif (!$_POST['email'] OR !$_POST['last_name'] OR !$_POST['first_name'] OR !$_POST['password']) {
           Router::redirect("/users/signup/error2"); 
        }
        else{
           
            $_POST['created']= Time::now();
            $_POST['password']= sha1(PASSWORD_SALT.$_POST['password']); 
            $_POST['token']= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        //echo "<pre>";
        // print_r($_POST);
        //echo "<pre>";
        
            DB::instance(DB_NAME)->insert_row('users',$_POST);
            Router::redirect('/users/login');
        }

        
    }


    public function login($error = NULL) {
        
    $this->template->content=View::instance('v_users_login');    
    $this->template->title= APP_NAME. " :: Login";
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);    
 # Pass data to the view
    $this->template->content->error = $error;

    echo $this->template;


    }
    public function emailpassword($error = NULL) {
        
    $this->template->content=View::instance('v_users_emailpassword');    
    $this->template->title= APP_NAME. " :: Login";
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);    
    # Pass data to the view
    $this->template->content->error = $error;

    echo $this->template;


    }
    public function p_login(){

      # if javascript is disabled this checks if user enters email and password to login
      if (!$_POST['email'] OR !$_POST['password']) {
           Router::redirect("/users/login/error"); 
        }
      else {  
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
            Router::redirect('/posts/');
        }
        }  # end if first else   
    }
    public function p_emailpassword(){

      # if javascript is disabled this checks if user enters email and password to login
      if (!$_POST['email']) {
           Router::redirect("/users/emailpassword/error"); 
        }
      else {  


  
        $q= 'Select user_id         
          From users            
           WHERE email="'.$_POST['email'].'"';
         //echo $q;
        $user_id= DB::instance(DB_NAME)->select_field($q);
        
        #email doesnt exists
        if(!$user_id){  
             
          Router::redirect("/users/emailpassword/error1"); 
         }
        # email exists , email the password
        else{
              $password=Utils::generate_random_string(8); 
              $new_password=sha1(PASSWORD_SALT.$password);
              $new_modified= Time::now();

              $data=Array('modified'=>$new_modified,
                         'password'=>$new_password             
                         );
              $success= DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$user_id); 
         
            
            $to[]    = Array("name" => $_POST['email'], "email" => $_POST['email']);
            $from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
            $subject = "Password reset message from ".APP_NAME;        

            #$body = View::instance('v_email_template');
            $body = "This is the password: ".$password ;
          # Send email
           $sent = Email::send($to, $from, $subject, $body, FALSE, '');
          # IF EMAIL IS SENT  and password update is successful proceed to login           
           if($sent AND $success)
            Router::redirect('/users/login');
          # else error out
           else
            Router::redirect('/users/emailpassword/error2');
        }
        }  # end if first else   
    }
    public function update(){

        if(!$this->user){
        //Router::redirect('/');
       die('Members Only <a href="/users/login">Login</a>');

        }   
        $new_modified= Time::now();
        $new_password= sha1(PASSWORD_SALT.$_POST['password']); 
        #$new_first_name=$_POST['first_name']

        $data=Array('modified'=>$new_modified,
                    'password'=>$new_password,
                    'first_name'=>$_POST['first_name'],
                    'last_name'=>$_POST['last_name'],
                    'email'=>$_POST['email']
                    );
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$this->user->user_id);
            Router::redirect('/posts/');
        
          
    }
    public function logout() {

        if(!$this->user){
        //Router::redirect('/');
          die('Members Only <a href="/users/login">Login</a>');
        } 

        $new_token=sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string()); 
        $data=Array('token'=>$new_token);
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$this->user->user_id);
        setcookie('token','',strtotime('-1 year'),'/');
        Router::redirect('/');

            }
    // this function let the user view other users profiles
    public function profile($user_name = NULL) {


    if(!$this->user){
        //Router::redirect('/');
       die('Members Only <a href="/users/login">Login</a>');

    }

    $this->template->content=View::instance('v_users_profile');    
    // $content=View::instance('v_users_profile'); 
    $this->template->title= APP_NAME. " :: Profile :: ".$user_name;
   
   $q= 'Select *         
          From users            
           WHERE email="'.$user_name.'"';
        // echo $q;
        $user= DB::instance(DB_NAME)->select_row($q);

    $this->template->content->user=$user;
    // $this->template->content->first_name=$first_name;
    // $content->user_name=$user_name;

     //$this->template->content=$content;

    # Render View    
     echo $this->template;

    
  }
  // This function is to edit users profile 
  public function editprofile() {

    if(!$this->user){
       // Router::redirect('/');
        die('Members Only <a href="/users/login">Login</a>');

    }
  # Create a new View instance
    $this->template->content=View::instance('v_users_editprofile');    
  # Page title  
    $this->template->title= APP_NAME. ":: Edit Profile";
  //  $this->template->title= "Profile :: ".$user_name;
    $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
    $this->template->client_files_head=Utils::load_client_files($client_files_head);


    $client_files_body=Array('/js/profile2.js');
    $this->template->client_files_body=Utils::load_client_files($client_files_body);
  
  # Pass information to the view instance
  //  $this->template->content->user_name=$user_name;
       # Render View  
     echo $this->template;

 

  }


} # end of the class