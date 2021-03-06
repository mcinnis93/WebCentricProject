<?php
/* class to control methods for manipulating reviews */

Class Review{
	
	private $conn;
	
	/* initialize with pointer to database connection */
	function __construct($conn)
	{
		
		$this->conn = $conn;
	}
	
	/* Adds a review to the database 
	 * Updates given error array with any errors that have occured
	 * Return true if successful, false otherwise
	 * */
	public function add_review($book_name, $book_author, $review_text, $book_year, $genre ,$user, &$errors)
	{
		//check for empty title
		if(empty($book_name)) $errors[] = "Review must have a book title";
		//check for empty author
		if(empty($book_author)) $errors[] = "Review must have a book author";
		//check for a review
		if(strlen($review_text) < 15) $errors[] = "A review must contain at least 15 characters";
		
		//add the review to the database
		$email = $_SESSION['email'];
		$userid = $user->get_user_id();
		if(!empty($errors)) return false;
		/* insert into the database*/
	     try{
			/* get max id*/
			$query = $this->conn->prepare("SELECT MAX(id) FROM Review");
			$query->execute();
			$row = $query->fetch();
			$id = $row['MAX(id)'] + 1;
			
			/* prepare insert statement */
			$query = $this->conn->prepare("INSERT INTO Review(id, idReviewAuthor, bookName, bookYear, description, creationDate, idCateogry, bookAuthor) 
										   VALUES (:id, :userid, :bookName, :bookYear, :description, CURRENT_TIMESTAMP, :genre, :bookAuthor)");
			$query->execute(array('id' => $id, 'userid' => $userid, 'bookName' => $book_name, 'bookYear' => $book_year, 
								  'description' => $review_text, 'genre' => $genre, 'bookAuthor' => $book_author));
			return true;
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
			return false;
		}
		return false;
	}
	


	
	public function add_comment($newcomment,$idreview,$user, &$errors)
	{
		
		if(empty($newcomment)) $errors[] = "Please write a comment";
		
		//add the review to the database
		$email = $_SESSION['email'];
		$userid = $user->get_user_id();
		if(!empty($errors)) return false;
		/* insert into the database*/
	     try{
			/* get max id*/
			$query = $this->conn->prepare("SELECT MAX(id) FROM Comment");
			$query->execute();
			$row = $query->fetch();
			$id = $row['MAX(id)'] + 1;
			
			/* prepare insert statement */
			$query = $this->conn->prepare("INSERT INTO Comment(id, idReview, idCommentAuthor, comment, creeationDate) 
										   VALUES (:id, :idreview, :userid, :comment, CURRENT_TIMESTAMP)");
			$query->execute(array('id' => $id, 'idreview' => $idreview, 'userid' => $userid, 
								  'comment' => $newcomment));
			return true;
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
			return false;
		}
		return false;
	}
	
	/* 
	 * Searches the database and returns any review that contains that has an description or book
	 * title that contains the given string. Orders by date. Allows you to specifiy a genre of books to search
	 * as well
	 * 
	 * Return:
	 * 	returns value as an assoc array
	 * */
	public function search_reviews($needle, $genre)
	{
		try{
			$genreQuery = '';
			/* don't select a genre if it's not specified*/
			if($genre !== null)
			{
				$genreQuery = " AND idCateogry = :genre";
			}
			
			$sql = "SELECT id, idReviewAuthor, bookName, bookYear, LEFT(description, 150), creationDate, idCateogry, bookAuthor 
			        FROM Review WHERE (bookName LIKE :needle OR bookAuthor LIKE :needle OR description LIKE :needle)".$genreQuery;
			$sql = $sql. " ORDER BY creationDate DESC";
			$query = $this->conn->prepare($sql);
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$query->execute(array('needle' => "%$needle%", 'genre' => $genre));
			
			return $query->fetchAll();
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
	public function search_reviewshome($needle, $genre)
	{
		try{
			$genreQuery = '';
			/* don't select a genre if it's not specified*/
			if($genre !== null)
			{
				$genreQuery = " AND idCateogry = :genre";
			}
			
			$sql = "SELECT id, idReviewAuthor, bookName, bookYear, LEFT(description, 150), creationDate, idCateogry, bookAuthor 
			        FROM Review WHERE (bookName LIKE :needle OR bookAuthor LIKE :needle OR description LIKE :needle)".$genreQuery;
			$sql = $sql. " ORDER BY creationDate DESC LIMIT 4";
			$query = $this->conn->prepare($sql);
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$query->execute(array('needle' => "%$needle%", 'genre' => $genre));
			
			return $query->fetchAll();
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
	/* retrieves the list of genres and their associated id 
	 * */
	public function get_genre_list()
	{
		try{
			
			$sql = "SELECT * FROM Category";
			$query = $this->conn->prepare($sql);
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$query->execute();
			
			return $query->fetchAll();
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}

	public function check_book_name($bookName)
	{
		//require("includes/connection.php");
		$bookName = mysql_real_escape_string(strtolower($_POST["bookName"]));
		 
		//send a request to the database
		$sql = "SELECT bookName FROM Review WHERE LOWER(bookName) = '" . $bookName . "'";
		$result = mysql_query($sql, $conn) or die("This book has already existed, you can add a comment " . mysql_error());
		 
		if(mysql_num_rows($result) > 0) {
		    //bookName is already taken
		    echo 0;
		}
		else {
		    //bookName is available
		    echo 1;
}
	}
	
	
}

?>
