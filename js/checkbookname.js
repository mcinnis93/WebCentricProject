$(document).ready(function() {
    //listens for typing on the desired field
    $("#bookName").keyup(function() {
        //gets the value of the field
        var email = $("#bookName").val();
 
        //here would be a good place to check if it is a valid email before posting to your db
 
        //displays a loader while it is checking the database
        //$("#bookNameError").html('<img alt="" src="/images/loader.gif" />');
 
        //here is where you send the desired data to the PHP file using ajax
        $.post("includes/review.php", {booName:bookName},
            function(result) {
                if(result == 1) {
                    //the bookName is available
                    $("#bookNameError").html("Available");
                }
                else {
                    //the bookName is not available
                    $("#bookNameError").html("bookName already exists");
                }
            });
     });
});