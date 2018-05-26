<?php
include_once("../include/config.php");
// No album id has been selected
if( !$_GET['photo_id'] ){
// Display error message to user
$msg .= "Photo not selected. Please choose a photo you wish to delete!";
$msg .= "<br /><a href=\"edit_photos.php\">Edit photos</a>";
displayPage($msg, "Error Selecting Photo");
} else {
db_connect();
// Retrieve image and thumbnail path information
$sql = "SELECT photo_location, thumbnail_location FROM photos WHERE photo_id = " . addslashes($_GET['photo_id']);
$result = @mysql_query($sql) or die("Error retrieving records: " . mysql_error());
while ($row = mysql_fetch_array($result)){ 
$photo_location = $row['photo_location'];
$thumb_location = $row['thumbnail_location'];
}
if (@unlink("../" . $photo_location)){
} else {
die("Error deleting photo!<br /><a href=\"index.php\">Please try again</a>.");
}
if (@unlink("../" . $thumb_location)){ 
} else {
die("Error deleting thumbnail!<br /><a href=\"index.php\">Please try again</a>.");
} 
// Delete specified album 
$sql = "DELETE FROM photos WHERE photo_id = " . addslashes($_GET['photo_id']);
$result = @mysql_query($sql) or die("Error deleting record: " . mysql_error());
// Display success to user
$msg .= "Photo has been successfully deleted!<br /><a href='index.php'>Return to Admin Menu</a>";
displayPage($msg, "Photo Deleted!");
}
?>