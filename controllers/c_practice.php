<?php
class practice_controller extends base_controller {

	
	public function test_db(){
		//$q= 'INSERT INTO users
		//	SET first_name="Albert", last_name="Einstein"';
		/*
		$q='UPDATE users SET email="Albert@aol.com" Where first_name="Albert"';

		echo $q;
		DB::instance(DB_NAME)->query($q);	
		*/
	/*$data    = Array('first_name' => 'Albert', 
					 'last_name' => 'Einstein',
					 'email'=>'alber@gmail.com'
					);
	$user_id = DB::instance(DB_NAME)->insert('users', $data);
	echo $user_id;
*/
	$q = 'SELECT email
		FROM users
		WHERE user_id=9';

		echo DB::instance(DB_NAME)->select_field($q);
}


public function test3() {

   $_POST['first_name'] = 'Albert';
//	$_POST=DB::instance(DB_NAME)->sanitize($_POST));
	$q = 'SELECT email
		FROM users
		WHERE user_id="'.$_POST['first_name'].'"';
echo $q;
//		echo DB::instance(DB_NAME)->select_field($q);

}

	public function test1() {
		
		$imageobj = new Image('http://placekitten.com/2000/2000'); 
		$imageobj->resize(1000,1000);
		$imageobj->display();
	}

	public function test2() {
		echo APP_PATH."<br>";
		echo DOC_ROOT."<br>";

		echo Time::now();	#static

		
	}

}


?>