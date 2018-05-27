<?php

//If number of images has not been chosen
if (!$_POST['num_images']){
echo("Please specify the # of images you wish to upload!<br />");
echo("Click <a href='javascript:history.go(-1)'>here</a> to go back.");
die();
} 

else { 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gallery - Image Upload</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><form action="create_thumbnails.php" method="post" enctype="multipart/form-data">
<p> </p>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><h1>Image Upload Area</h1>
</td>
</tr>
</table>
<table width="60%" border="0" align="center" cellpadding="5" cellspacing="0">
<?php
for ($i = 0; $i < $_POST['num_images']; $i++){
// Determine alternate row colours
if($i % 2 == 0){
$style = "bgcolor=\"#FFFFFF\"";
$bottomstyle = "bgcolor=\"#FFFFFF\"";
} else {
$style = "bgcolor=\"#EFEFEF\"";
$bottomstyle = "bgcolor=\"#EFEFEF\"";
}
echo("\n<tr>\n<td $style width='15%'>Image #" . ($i + 1) . ": </td>\n<td $style><input type='file' name='image[]'></td>\n</tr>");
echo("\n<tr>\n<td $style width='15%'>Image Title : </td>\n<td $style><input type='text' name='photo_title'></td>\n</tr>");
echo("\n<tr>\n<td $style valign=\"top\">Photo Description: </td>\n<td $style><textarea name='photo_desc' cols='30' rows='6' wrap='default'></textarea></td>\n</tr>");
echo("\n<tr>\n<td $style valign=\"top\">Album Cover? </td>\n<td $style><input type=\"radio\" name=\"album_cover\" value=\"$i\">");
}
echo("
<tr>
<td $style> </td>
<td $style>
<input name='process' type='hidden' value='1'>
<input name='album_id' type='hidden' value='" . $_POST['albums'] . "'>
<input name='submit' type='submit' id='submit' value='Continue'>
</td>
</tr>");
?>
</table>
<table width="60%" border="0" align="center" cellpadding="3" cellspacing="0" class="bottommenu">
<tr>
<td class="bottommenu"><a href="index.php">Main Menu</a> | <a href="new_album.php">Create
New Album</a> | <a href="../gallery.php">View Gallery</a></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>
<?php
}
?>