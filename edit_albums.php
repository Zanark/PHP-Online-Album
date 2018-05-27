<?php
 include_once("include/config.php");

 $msg = "";

 // Has album been updated?
 if ( $_POST['edit'] ){
  if ( empty($_POST['album_name']) || empty($_POST['album_desc'])){
   $msg = "Please complete all required fields!<br /><a href='new_album.php'>Go Back</a>";
   displayPage( $msg, "Error Updating Album!");
   die();
  }

  //Connection
  $dbcnx = db_connect(); 

  // Insert updated record into DB
  $sql = "UPDATE albums SET album_name = '" . addslashes($_POST['album_name']) . "', album_desc = '" . addslashes($_POST['album_desc']) . "' WHERE album_id = " . addslashes($_POST['album_id']);
  $result = @mysqli_query( $dbcnx , $sql ) or die("Error inserting record: " . mysqli_error($dbcnx));
  if ($result){
   $msg = "Album updated successfully!<br /><a href='index.php'>Return to Admin Menu</a>";
   displayPage($msg, "Album Updated Successfully!");
   die();
  }

 } 

 //If the Edit album link was selected from main menu
 else if ( !$_POST['edit'] && !empty($_GET['album_id'])){
  $dbcnx = db_connect();
  // Retrieve album information
  $sql = "SELECT album_id, album_name, album_desc FROM albums WHERE album_id = " . addslahes($_GET['album_id']);
  $result = @mysqli_query( $dbcnx , $sql ) or die("Error retrieving record: " . mysqli_error($dbcnx));
  while($row = mysqli_fetch_array( $result )){
   // Display edit page
   $msg .= "<form action=\"edit_albums.php\" method=\"post\">\n";
   $msg .= "<table width=\"60%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">\n";
   $msg .= "<tr>\n<td>Album Name:</td>\n<td><input name=\"album_name\" type=\"text\" id=\"album_name\" size=\"40\" value=\"" . $row['album_name'] . "\"></td>\n</tr>\n";
   $msg .= "<tr>\n<td>Album Description:</td>\n<td><textarea name=\"album_desc\" cols=\"30\" rows=\"4\" id=\"album_desc\">" . $row['album_desc'] . "</textarea></td>\n</tr>\n";
   $msg .= "<tr>\n<td><input type=\"hidden\" name=\"edit\" value=\"1\"><input type=\"hidden\" name=\"album_id\" value=\"" . $_GET['album_id'] . "\"></td>\n";
   $msg .= "<td><input name=\"submit\" type=\"submit\" id=\"submit\" value=\"Continue\">";
   $msg .= "<a href=\"del_albums.php?album_id=" . addslashes($_GET['album_id']) . "\">Delete</a>";
   $msg .= "</td>\n</tr>\n</table>\n</form>";
   $album_name = $row['album_name'];
  }
  displayPage($msg, "Editing Album " . $album_name . ":");
 // Display album summaries
 } 
 
 
 elseif ( !$_GET['album_id'] ){

    //echo "third";

  $dbcnx = db_connect();
  // Retrieve all album information  
  $sql = "SELECT album_id, album_name FROM albums";
  $result = mysqli_query( $dbcnx , $sql ) or die( "Error retrieving records: " . mysqli_error($dbcnx) );
  $i = 0;
  while($row = mysqli_fetch_array($result)){    
   if (( $i % 2 ) == 0 && ( $i != 0 )){
    $msg .= ("</tr>\n<tr>");
   }
   $msg .= ("<td>" . ($i + 1) . ". <a href='edit_albums.php?album_id=" . $row['album_id'] . "'>" . $row['album_name'] . "</td>\n");   
   $i++;
  }
  displayPage( $msg, "Edit Albums", false );
 }   
?>