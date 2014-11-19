<?php
/* Contains method to easily authenticate a user with an account
 * 
 * */
class User{
	
	private $conn;
	
	/* initialize with pointer to database connection */
	function __construct($conn)
	{
		$this->$conn = $conn;
	}
	
	/* Takes a username and password and verifies it with the data in 
	 * the database.
	 * Returns true if login was successful, false otherwise
	 * 
	 * */
	public function login($username, $password)
	{
		/* Retrieve correct password for given username */
		$correct_pass = $this->get_hashed_password($username);
		
		/* compare given password with correct password in database*/
		if ($this->hash_local_password($password) === $correct_pass)
		{
			$_SESSION['loggedin'] = true;
			return true;
		}
		
		
		return false;
		
	}
	
	/* Retrieves the hashed password that corresponds to the given username
	 * 
	 * */
	private function get_hashed_password($username)
	{
		try{
			$query = $this->$conn->prepare("SELECT password FROM UserAccount WHERE username= :username");
			$query->execute(array('username' => $username));
			
			$row = $query->fetch();
			return $row['password'];
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
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
	 private function is_logged_in()
	 {
		 if(isset(['loggedin']) && $_SESSION['loggedin'] == true)
		 {
			 return true;
		 }
		 return false;
	 }
	 
	 /* logs out the user */
	 private function logout()
	 {
		session_destroy(); 
     }
	
}
?>
