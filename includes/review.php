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
	 * */
	public function add_review($book_name, $book_author, $review_text, &$errors)
	{
		//check for empty title
		if(empty($book_name)) $errors[] = "Review must have a book title";
		//check for empty author
		if(empty($book_author)) $errors[] = "Review must have a book author";
		//check for a review
		if(strlen($review_text) < 15) $errors[] = "A review must contain at least 15 characters";
		
		//add the review to the database
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
			
			$sql = "SELECT * FROM Review WHERE (bookName LIKE :needle OR bookAuthor LIKE :needle OR description LIKE :needle)".$genreQuery;
			$query = $this->conn->prepare($sql);
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$query->execute(array('needle' => "%$needle%", 'genre' => $genre));
			
			return $query->fetchAll();
		}catch(PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
	
}

?>
