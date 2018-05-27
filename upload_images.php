<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gallery - Upload Images</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><form action="image_upload.php" method="post">
<p> </p>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><h1>Image Upload Area</h1></td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td colspan="2"><p>Please indicate the number of
images you wish to upload to your album(s). If you would like
to create a new album, click the Create New Album link below.</p>
</td>
</tr>
<tr>
<td> </td>
<td> </td>
</tr>
<tr>
<td>Number of Images:<br>
(JPEG / PNG)</td>
<td><input name="num_images" type="text" id="num_images" size="10">
</td>
</tr>
<tr>
<td>Photo Album:</td>
<td><select name="albums" id="albums">
<?php
include("include/config.php");
$dbcnx = db_connect();
$sql = "SELECT album_id, album_name FROM albums";
$result = mysqli_query( $dbcnx , $sql ) or die("Error retrieving records: " . mysqli_error($dbcnx));
while ( $row = mysqli_fetch_array($result) ){
echo("<option value=" . $row['album_id'] . ">" . $row['album_name'] . "</option>");
}
?>
</select>
</td>
</tr>
<tr>
<td> </td>
<td><input name="submit" type="submit" id="submit" value="Continue">
</td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0" >
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
