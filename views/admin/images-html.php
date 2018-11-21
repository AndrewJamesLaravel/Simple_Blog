<?php

if ( isset( $uploadMessage ) === false ) {
    $uploadMessage = "Upload a new image";
}

$imagesAsHTML = "<h1>Images</h1>";
$imagesAsHTML .= "<dl id='images'>";
$folder = "img";
$filesInFolder = new DirectoryIterator( $folder );
while ( $filesInFolder->valid() ) {
    $file = $filesInFolder->current();
    $filename = $file->getFilename();
    $src = "$folder/$filename";
    $fileInfo = new Finfo( FILEINFO_MIME_TYPE );
    $mimeType = $fileInfo->file( $src );
    if ( $mimeType === 'image/jpeg' ) {
        $href = "admin.php?page=images&amp;delete-image=$src";
        $imagesAsHTML .= "<dt><img src='$src' /></dt>
                            </dd>Source: $src <a href='$href'>delete</a></dd>";
    }
    $filesInFolder->next();
}
$imagesAsHTML .= "</dl>";

return "
<form method='post' action='admin.php?page=images' enctype='multipart/form-data'>
    <p>$uploadMessage</p>
        <input type='file' name='image-data' accept='image/jpeg' />
        <input type='submit' name='new-image' value='upload' />
</form>
<div>
    $imagesAsHTML;
</div>
";