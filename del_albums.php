<?php
 include_once("include/config.php");
$msg = "";
 // No album id has been selected
 if( !$_GET['album_id'] ){
  // Display error message to user
  $msg .= "Album not selected.  Please choose an album you wish to delete!";
  $msg .= "<br /><a href=\"edit_albums.php\">Edit albums</a>";
  displayPage($msg, "Error Selecting Album");
 } else {
  $dbcnx = db_connect();
  // Delete specified album
  $sql = "DELETE FROM albums WHERE album_id = " . addslashes($_GET['album_id']);
  $result = @mysqli_query($dbcnx , $sql) or die("Error deleting record: " . mysqli_error($dbcnx));
  // Display success to user
  $msg .= "Album has been successfully deleted!<br /><a href='index.php'>Return to Admin Menu</a>";
  displayPage($msg, "Album Deleted!");
 }
?>