<?php
include("GallerySizer.php");
include("include/config.php");
DEFINE("IMAGE_FULL", 'photos/');

$dbcnx = db_connect();

// Album cover
$cover = $_FILES['image']['name'][$_POST['album_cover']];

//No images Selected
if (!$_REQUEST['process']){
echo("Error! No images chosen for processing. <br />");
echo("Click <a href='index.php'>here</a> to start processing your images.");
die();
} 

//No Album selected
elseif (!$_POST['album_id']){
echo("No album selected. Please <a href=\"\">choose an album</a> to upload images to.");
die();
} 

//Inserting images to currently selected album
else {
    for($i = 0; $i < count($_FILES['image']['tmp_name']); $i++){
        
        $fileName = $_FILES['image']['name'][$i];
        copy($_FILES['image']['tmp_name'][$i], IMAGE_FULL . $fileName);
        $thumb = new GallerySizer();
        if($thumb->getLocation($_FILES['image']['name'][$i])){
            echo "here";
        if($thumb->loadImage()){
            echo("Still here!");
            if($thumb->getSize()){
                if($thumb->setThumbnail()){
                    if($thumb->copyThumbImage()){
                        if($thumb->resizeImage()){
                            $thumb->copyResizedImage();
                            //$thumb->display(); 
                        }
                    }
                }
            }
        } 
        else {
            echo("Invalid image/file has been uploaded. Please upload a supported file-type (JPEG/PNG)"); 
            unlink(IMAGE_FULL . $fileName);
            die();
        }

        insert_location($thumb);
    } 
    else {
        echo("Error processing images: " . mysqli_error($dbcnx));
    }

// If image matches cover selection, update album cover
if($cover == $_FILES['image']['name'][$i]){
    $sql = "UPDATE albums SET album_cover = '" . $thumb->getThumbLocation() . "' WHERE album_id = " . $_POST['album_id'];
    $result = @mysqli_query($dbcnx , $sql) or die("Error inserting records: " . mysqli_error($dbcnx));
} 
}
}


function insert_location($thumb_obj){
    $image_location = $thumb_obj->getImageLocation();
    $thumb_location = $thumb_obj->getThumbLocation();
    $dbcnx = mysqli_connect("localhost", "root", "");
    mysqli_select_db($dbcnx , "album");
    $sql = "INSERT INTO photos values(0, '$_POST[photo_title]', '$_POST[photo_desc]', NOW(), '$image_location', '$thumb_location', $_POST[album_id])";
    $result = mysqli_query($dbcnx , $sql) or die("Error inserting record(s) into the database: " . mysqli_error($dbcnx));
    if ($result){
        echo("Images successfully converted and stored! <br />Click <a href='index.php'>here</a> to continue.");
    }
}

?>
