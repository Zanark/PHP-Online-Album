<?php
include("include/config.php");
$dbcnx = db_connect();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gallery</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="include/functions.js" type="text/javascript"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><form action="add_album.php" method="post" name="">
<p> </p>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><h1>My Gallery</h1></td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<?php
// Retrieve album information (photo count, description, etc.) from database
$sql = "SELECT albums.album_id, albums.album_name, albums.album_desc, albums.album_cover, COUNT(photos.photo_id) as images
FROM albums LEFT JOIN photos ON albums.album_id = photos.album_id
GROUP BY albums.album_name, albums.album_desc
ORDER BY albums.album_id ASC";
$result = @mysqli_query($dbcnx , $sql) or die("Error retrieving records from the database: " . mysqli_error($dbcnx));
$i = 0; // Row counter
while( $row = mysqli_fetch_assoc($result))
{
$data[] = $row;
}
$count = ( ceil( count( $data ) / IMAGE_DISPLAY ));
for( $i = ( int )0; $i < $count * IMAGE_DISPLAY; $i++ )
{
if ( ( $i % IMAGE_DISPLAY ) == 0 && ($i != 0))
{
echo("</tr>\n<tr>");
} 
if ( $data[$i]['album_cover'] )
{
echo("<td valign=\"top\" width=\"" . floor(100 / IMAGE_DISPLAY) . "%\">\n");
echo("<p><a href=\"view_album.php?album_id=" . $data[$i]['album_id'] . "\">" . $data[$i]['album_name'] . " (" . $data[$i]['images'] . ")</a></p><a href=\"view_album.php?album_id=" . $data[$i]['album_id'] . "\"><img src=\"" . $data[$i]['album_cover'] . "\" title=\"" . $data[$i]['album_desc'] . "\" align=\"middle\"></a>");
echo("<br /><p>" . $data[$i]['album_desc'] . "</p>\n</td>\n");
}
else
{
echo("<td valign=\"top\" width=\"" . floor(100 / IMAGE_DISPLAY) . "%\"> ");
echo("</td>\n");
}
}
?>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><a href="index.php">Main Menu</a> | <a href="new_album.php">Create
New Album</a> | <a href="gallery.php">View Gallery</a></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>