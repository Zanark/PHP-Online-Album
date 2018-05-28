<?php
include("include/config.php");

//If no album is selected
if( !$_GET['album_id'] ){
$msg .= "No album selected! Please <a href=\"gallery.php\">choose an album</a> you would like to view.";
// Display error message
displayPage($msg);
die();
}

$dbcnx = db_connect();
$sql = "SELECT album_name FROM albums WHERE album_id = " . $_GET['album_id'];
$result = @mysqli_query($dbcnx , $sql) or die("Error retrieving record: " . mysqli_error($dbcnx)); 
while($row = @mysqli_fetch_array($result)){
$album_name = $row['album_name'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gallery - <?php echo($album_name); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>Gallery - <?php echo($album_name); ?></td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<?php
// Retrieve albums from database
$sql = "SELECT photos.photo_id, photos.photo_title, photos.photo_desc, photos.photo_date, photos.photo_location, photos.thumbnail_location FROM photos WHERE photos.album_id = " . addslashes($_GET['album_id']);
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
$photo_date = $data[$i]['photo_date']; 
if ( $data[$i]['photo_location'] )
{
echo("<td valign=\"top\" width=\"" . floor(100 / IMAGE_DISPLAY) . "%\"><p><a href=\"view_photo.php?photo_id=" . $data[$i]['photo_id'] . "\">" . $data[$i]['photo_title'] . "</p><a href=\"view_photo.php?photo_id=" . $data[$i]['photo_id'] . "\" onClick=\"displayPhoto('" . 
$data[$i]['photo_location'] . "','" . $data[$i]['photo_title'] . "'); return false;\"><img src=\"" . $data[$i]['thumbnail_location'] . "\" 
title=\"Photo Date: " . $photo_date . "\" align=\"center\"></a>");
echo("<br /><p>Photo Details: " . $data[$i]['photo_desc'] . "<br />Date: " . $photo_date . "</p></td>\n");
}
else
{
echo("<td valign=\"top\" width=\"" . floor(100 / IMAGE_DISPLAY) . "%\"> ");
echo("</td>\n");
} 
}
?>
</td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><a href="gallery.php">View Gallery</a></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>
