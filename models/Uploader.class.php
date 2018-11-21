<?php

class Uploader {
    private $filename;
    private $fileData;
    private $destination;
    private $errorMessage;
    private $errorCode;

    public function __construct( $key )
    {
        $this->filename = $_FILES[$key]['name'];
        $this->fileData = $_FILES[$key]['tmp_name'];
        $this->errorCode = ( $_FILES[$key]['error'] );
    }

    public function saveIn( $folder ) {
        $this->destination = $folder;
    }

    public function save() {
        if ( $this->readyToUpload() ) {
            move_uploaded_file(
                $this->fileData,
                "$this->destination/$this->filename" );
        } else {
            $exc = new Exception( $this->errorMessage );
            throw $exc;
        }
    }

    private function readyToUpload() {
        $finfo = new finfo(FILEINFO_MIME_TYPE );
        $folderIsWritable = is_writable( $this->destination );
        if ( $folderIsWritable === false ) {
            $this->errorMessage = "Error: destination folder is ";
            $this->errorMessage .= "not writable, change permissions";
            $canUpload = false;
        } elseif ( $this->errorCode === 1 ) {
            $maxSize = ini_get('upload_max_filesize' );
            $this->errorMessage = "Error: File is to big. ";
            $this->errorMessage .= "Max file size is $maxSize";
            $canUpload = false;
        } elseif ( $this->errorCode === 3 ) {
            $this->errorMessage = "Error: The uploaded file was only partially uploaded";
            $canUpload = false;
        } elseif ( $this->errorCode === 4 ) {
            $this->errorMessage = "Error: No file was uploaded";
            $canUpload = false;
        } elseif ( $this->errorCode === 6 ) {
            $this->errorMessage = "Error: Missing a temporary folder";
            $canUpload = false;
        } elseif ( $this->errorCode === 7 ) {
            $this->errorMessage = "Error: Failed to write file to disk";
            $canUpload = false;
        } elseif ( file_exists( "$this->destination/$this->filename")) {
            $this->errorMessage = "Error: Duplicate names. ";
            $this->errorMessage .= "Image with name: $this->filename already exists<br />";
            $this->errorMessage .= "Please, change file name before upload this image";
            $canUpload = false;
        } elseif ( false === $extension = array_search(
            $finfo->file($this->fileData),
            array(
                'jpg' => 'image/jpeg',
            ),
            true
            )) {
            $this->errorMessage = "Error: Invalid file format. ";
            $this->errorMessage .= "Try another file";
            $canUpload = false;
        } else {
            $canUpload = true;
        }
        return $canUpload;
    }
}