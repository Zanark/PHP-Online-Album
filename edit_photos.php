<?php
include_once("include/config.php");

$msg = "";

// Has album been updated?
if ( $_POST['edit'] ){
if ( empty($_POST['photo_title']) || empty($_POST['photo_desc'])){
$msg = "Please complete all required fields!<br /><a href='edit_photos.php'>Go Back</a>";
displayPage( $msg, "Error Updating Photo!");
die();
}

$dbcnx = db_connect();

// Insert updated record into DB
$sql = "UPDATE photos SET photo_title = '" . addslashes($_POST['photo_title']) . "', photo_desc = '" . addslashes($_POST['photo_desc']) . "' WHERE photo_id = " . $_POST['photo_id'];
$result = @mysqli_query( $dbcnx , $sql ) or die("Error inserting record: " . mysqli_error($dbcnx));
if ($result){
$msg = "Photo updated successfully!<br /><a href='index.php'>Return to Admin Menu</a>";
displayPage($msg, "Photo Updated Successfully!");
die();
}
} else if ( !$_POST['edit'] && !empty($_GET['photo_id'])){
$dbcnx = db_connect();
// Retrieve album information
$sql = "SELECT photo_id, photo_title, photo_desc FROM photos WHERE photo_id = " . addslashes($_GET['photo_id']);
$result = @mysqli_query( $dbcnx , $sql ) or die("Error retrieving record: " . mysqli_error($dbcnx));
while($row = mysqli_fetch_array( $result )){
// Display edit page
$msg .= "<form action=\"edit_photos.php\" method=\"post\">\n";
$msg .= "<table width=\"60%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">\n";
$msg .= "<tr>\n<td>Photo Title:</td>\n<td><input name=\"photo_title\" type=\"text\" id=\"photo_title\" size=\"40\" value=\"" . $row['photo_title'] . "\"></td>\n</tr>\n";
$msg .= "<tr>\n<td>Photo Description:</td>\n<td><textarea name=\"photo_desc\" cols=\"30\" rows=\"4\" id=\"photo_desc\">" . $row['photo_desc'] . "</textarea></td>\n</tr>\n";
$msg .= "<tr>\n<td><input type=\"hidden\" name=\"edit\" value=\"1\"><input type=\"hidden\" name=\"photo_id\" value=\"" . addslashes($_GET['photo_id']) . "\"></td>\n";
$msg .= "<td><input name=\"submit\" type=\"submit\" id=\"submit\" value=\"Continue\">";
$msg .= "<a href=\"del_photos.php?photo_id=" . addslashes($_GET['photo_id']) . "\">Delete</a>";
$msg .= "</td>\n</tr>\n</table>\n</form>";
$photo_title = $row['photo_title'];
}
displayPage($msg, "Editing Photo " . $photo_title . ":"); 
// Display album summaries
} elseif ( !$_GET['photo_id'] ){
$dbcnx = db_connect();
// Retrieve all album information 
$sql = "SELECT photos.photo_id, photos.photo_title, photos.thumbnail_location , albums.album_cover FROM photos, albums
WHERE photos.album_id = albums.album_id";
$result = @mysqli_query( $dbcnx , $sql ) or die( "Error retrieving records: " . mysqli_error($dbcnx) );
$i = 0;
while($row = mysqli_fetch_array($result)){ 
if (( $i % IMAGE_DISPLAY ) == 0 && ( $i != 0 )){
$msg .= ("</tr>\n<tr>");
}
$msg .= ("<td>" . ($i + 1) . ". <a href='edit_photos.php?photo_id=" . $row['photo_id'] . "'>");
$msg .= ($row['photo_title'] . "<br /><img src=\"" . $row['thumbnail_location'] . "\" /></td>\n"); 
$i++;
}
displayPage( $msg, "Edit Photos", false );
} 
?>