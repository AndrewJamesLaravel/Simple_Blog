<?php

include_once "models/Uploader.class.php";

$imageSubmitted = isset( $_POST['new-image'] );
if ( $imageSubmitted ) {
    $uploader = new Uploader( 'image-data' );
    $uploader->saveIn( "img" );
    try {
        $uploader->save();
        $uploadMessage = "File uploaded!";
    } catch ( Exception $exception ) {
        $uploadMessage = $exception->getMessage();
    }
}

$deleteImage = isset( $_GET['delete-image'] );
if ( $deleteImage ) {
    $whichImage = $_GET['delete-image'];
    unlink($whichImage);
}

$imageManagerHTML = include_once "views/admin/images-html.php";
return $imageManagerHTML;