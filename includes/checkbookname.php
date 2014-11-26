<?php
require("includes/connection.php");
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
?>