<?php
      include_once("include/config.php");
      // Verify that all form elements are completed
      if (empty($_POST['album_name']) || empty($_POST['album_desc'])){
   displayPage("Please complete all required fields!<br /><a href='new_album.php'>Go Back</a>", "Error Adding Album!");
         die();
      }  
      // Connect to database
      db_connect();     
      $sql = "INSERT INTO albums VALUES(0, '" . addslashes($_POST['album_name']) . "', '" . addslashes($_POST['album_desc']) . "', 0, '', '')";
      $result = @mysql_query($sql) or die("Error inserting record: " . mysql_error());
      if ($result){
      // Notify use that album was successfully created.
   $msg .= "Album <strong>" . $_POST['album_name'] . "</strong> successfully created!";
   $msg .= "<br /><a href='edit_album.php?album_id=" . mysql_insert_id() . "'>Click here</a> to administrate the " . $_POST['album_name'] . " album";
   $msg .= "<p><a href='index.php'>Click here</a> to return to the administrative area</p>";
   displayPage($msg, "Album " . $_POST['album_name'] . "Added!");
      }
?>