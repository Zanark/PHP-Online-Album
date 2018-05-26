<?php
     include("config.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Add Album(s)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><form action="add_album.php" method="post" name="">
        <p> </p>
        <table width="60%" border="0" align="center" cellpadding="3" cellspacing="0" id="addAlbum">
          <tr>
            <td valign="top"> Add
            New Album</td>
          </tr>
        </table>
        <table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td height="35" colspan="2">Please indicate the number of images you wish
              to upload to your album(s). If you would like to create a new album,
            click the Create New Album link below.</td>
          </tr>
          <tr>
            <td> </td>
            <td> </td>
          </tr>
          <tr>
            <td>Album Name:</td>
            <td><input name="album_name" type="text" id="album_name" size="40">
 <br>
<br><a href="edit_albums.php">Edit Existing Album(s)</a> </td>
          </tr>
          <tr>
            <td>Album Description:</td>
            <td><textarea name="album_desc" cols="30" rows="4" id="album_desc"></textarea></td>
          </tr>
          <tr>
            <td><p>             </p>
            </td>
            <td><input name="submit" type="submit" id="submit" value="Continue"></td>
          </tr>        
        </table>
        <table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td><a href="index.php">Main Menu</a> | <a href="new_album.php">Create
                New Album</a> | <a href="../gallery.php">View Gallery</a></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>