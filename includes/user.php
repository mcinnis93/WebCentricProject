<?php
/* Contains method to easily authenticate a user with an account
 * 
 * */
class User{
	
	private $conn;
	
	/* initialize with pointer to database connection */
	function __construct($conn)
	{
		
		$this->conn = $conn;
	}
	
	/* Takes a username and password and verifies it with the data in 
	 * the database.
	 * Returns true if login was successful, false otherwise
	 * 
	 * */
	public function login($email, $password, &$errors)
	{
		if(empty($email))
		{
			$errors[] = "<p class='error'>Must supply an email</p>";
		}
		
		if(empty($password))
		{
			$errors[] = "<p class='error'>Invalid password</p>";
		}
		
		/* Retrieve correct password for given username */
		$correct_pass = $this->get_hashed_password($email);
		if(empty($correct_pass))
		{
			$errors[] = "<p class='error'>Given email is not registered</p>";
		}
		
		if(!empty($errors))
		{
			return false;
		}
		
		/* compare given password with correct password in database*/
		if ($this->hash_local_password($password) === $correct_pass)
		{
			$_SESSION['loggedin'] = true;
			
			/* set up user attributes */
			$_SESSION['email'] = $email;
			return true;
		}
		
		$errors[] = "<p class='error'>Incorrect password</p>";
		
		return false;
		
	}
	
	/* Retrieves the hashed password that corresponds to the given email
	 * 
	 * */
	private function get_hashed_password($email)
	{
		try{
			$query = $this->conn->prepare("SELECT password FROM UserAccount WHERE email= :email");
			$query->execute(array('email' => $email));
			
			$row = $query->fetch();
			return	 $row['password'];
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
		return "";
	}
	
	/* Hashes the password using 
	 * 
	 * */
	 private function hash_local_password($password)
	 {
		 return $password;
	 }
	 
	 /* checks if the user is logged in 
	  * Returns true if user is logged in, false otherwise
	  * */
	 public function is_logged_in()
	 {
		 return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
	 }
	 
	 /* logs out the user */
	 public function logout()
	 {
		session_destroy(); 
     }
     
     /* Takes a username and password and attempts to create a user account in the database
      * returns true if registration was successful, false otherwise
      * $errors value contains a list of errors that occured during the registration
      * */
     public function register($username, $password, $passwordconfirm, $email, &$errors)
     {
		 $errors = array();
		 $time = time();
		 
		 /* check for valid username */
		 if(strlen($username) < 4) {
			 $errors[] = "<p class='error'>Username must be at least 4 characters long</p>";
		 }
		 /* check for invalid passwords */
		 if(strlen($password) < 5) {
			 $errors[] = "<p class='error'>Password must be at least 5 characters</p>";
	     }
	     
	     /* check for password being unequal */
	     if($password !== $passwordconfirm){
			$errors[] = "<p class='error'>Passwords were not equal</p>";
		 }
	     
		 /* verify that username is available */
		 if(!$this->check_for_user_name_avail($username)){  
			 $errors[] = "<p>Username is already in use</p>";
	     }
	     
	     /* verify that the email is available */
		 if(!$this->check_for_user_name_avail($email)){  
			 $errors[] = "<p>Email is already in use</p>";
	     }
	     
	     if(!empty($errors))
	     {
			 return false;
		 }
	     /* insert into the database*/
	     try{
			/* get max id*/
			$query = $this->conn->prepare("SELECT MAX(id) FROM UserAccount");
			$query->execute();
			$row = $query->fetch();
			$id = $row['MAX(id)'] + 1;
			
			/* prepare insert statement */
			$query = $this->conn->prepare("INSERT INTO UserAccount (id, username, password, email, creationDate) values (:id, :username, :password, :email, CURRENT_TIMESTAMP");
			$query->execute(array('username' => $username, 'password' => $password, 'email' => $email, 'id' => $id));
					
			/* Try to log in if registration was successful */
			$this->login($username, $password, $errors);
			return true;
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
		
	     return false;
     }
     
     /* Queries the database and checks if an account name is already in use 
      * returns true if username is available, false if it's already in use
      * */
     private function check_for_user_name_avail($username)
     {
		 try{
			$query = $this->conn->prepare("SELECT username FROM UserAccount WHERE username= :username");
			$query->execute(array('username' => $username));
			
			$row = $query->fetch();
			if(empty($row['username']) || $row['username'] === '')
			{
				return true;
			}
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
		return false;
     }
     
     /* Queries the database and checks if an email is already in use 
      * returns true if email is available, false if it's already in use
      * */
     private function check_for_user_name_avail_email($email)
     {
		 try{
			$query = $this->conn->prepare("SELECT email FROM UserAccount WHERE email= :email");
			$query->execute(array('email' => $email));
			
			$row = $query->fetch();
			if(empty($row['email']) || $row['email'] === '')
			{
				return true;
			}
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
		return false;
     }
     
     /* retrieves the user that is associated with the given id*/
	public function get_user_from_id($id)
	{
		try{
			$query = $this->conn->prepare("SELECT * FROM UserAccount WHERE id=:id");
			$query->execute(array('id' => $id));
			
			$row = $query->fetch();
			return $row;
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
	/* Retrieves the id associated with the current user
	 * returns null if not logged in
	 * */
	public function get_user_id()
	{
		/* do nothing if not logged in */
		if($this->is_logged_in() == false) return null;
		
		try{
			$query = $this->conn->prepare("SELECT id FROM UserAccount WHERE email= :email");
			$query->execute(array('email' => $_SESSION['email']));
			
			$row = $query->fetch();
			return $row['id'];
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
}
?>
