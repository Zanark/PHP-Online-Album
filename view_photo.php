<?php
include("include/config.php");

//If any photo as been selected
if( !$_GET['photo_id'] ){
$msg .= "No photo selected! Please <a href=\"gallery.php\">choose an album</a> you would like to view.";
// Display error message
displayPage($msg);
die();
}

$dbcnx = db_connect();
$sql = "SELECT photo_title, photo_location FROM photos WHERE photo_id = " . addslashes($_GET['photo_id']);
$result = @mysqli_query($dbcnx , $sql) or die("Error retrieving record: " . mysqli_error($dbcnx)); 
while($row = @mysqli_fetch_array($result)){
$photo_title = $row['photo_title'];
$photo_loc = $row['photo_location'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gallery - <?php echo($photo_title); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>Gallery - <?php echo($photo_title); ?></td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td>
<img src="<?php echo($photo_loc); ?>" />
</td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><a href="gallery.php">View Gallery</a></td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>