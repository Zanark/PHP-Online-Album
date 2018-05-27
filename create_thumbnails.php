<?php
include("GallerySizer.php");
include("../include/config.php");
DEFINE("IMAGE_FULL", '../photos/');
// Album cover
$cover = $_FILES['image']['name'][$_POST['album_cover']];
if (!$_REQUEST['process']){
echo("Error! No images chosen for processing. <br />");
echo("Click <a href='index.php'>here</a> to start processing your images.");
die();
} elseif (!$_POST['album_id']){
echo("No album selected. Please <a href=\"\">choose an album</a> to upload images to.");
die();
} else {
for($i = 0; $i < count($_FILES['image']['tmp_name']); $i++){
$fileName = $_FILES['image']['name'][$i];
copy($_FILES['image']['tmp_name'][$i], IMAGE_FULL . $fileName);
$thumb = new GallerySizer();
if($thumb->getLocation($_FILES['image']['name'][$i])){
if($thumb->loadImage()){
echo("Still here!");
if($thumb->getSize()){
if($thumb->setThumbnail()){
if($thumb->copyImage()){
if($thumb->resizeImage()){
$thumb->copyResize();
$thumb->display(); 
}
}
}
}
} else {
echo("Invalid image/file has been uploaded. Please upload a supported file-type (JPEG/PNG)"); 
unlink(IMAGE_FULL . $fileName);
die();
}
insert_location($thumb);
} else {
echo("Error processing images: " . mysql_error());
}
// If image matches cover selection, update album cover
if($cover == $_FILES['image']['name'][$i]){
$sql = "UPDATE albums SET album_cover = '" . $thumb->getThumbLocation() . "' WHERE album_id = " . $_POST['album_id'];
$result = @mysql_query($sql) or die("Error inserting records: " . mysql_error());
} 
}
}
function insert_location($thumb_obj){
$image_location = $thumb_obj->getImageLocation();
$thumb_location = $thumb_obj->getThumbLocation();
$dbcnx = mysql_connect("localhost", "root", "");
mysql_select_db("album", $dbcnx);
$sql = "INSERT INTO photos values(0, '$_POST[photo_title]', '$_POST[photo_desc]', NOW(), '$image_location', '$thumb_location', $_POST[album_id])";
$result = mysql_query($sql, $dbcnx) or die("Error inserting record(s) into the database: " . mysql_error());
if ($result){
echo("Images successfully converted and stored! <br />Click <a href='../admin'>here</a> to continue.");
}
}
?>