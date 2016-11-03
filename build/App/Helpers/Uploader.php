<?php

namespace App\Helpers;

use Compressor, DB;
// Image Uploader

class Uploader {

    private $allowed_files = ["jpg", "jpeg", "png"];
    private $filename;

    private $tmp_path;
    private $folder;//Spør Agne om folder
    private $size;
    private $type = null;

    public $errors = array();
    public $upload_errors_array = array(
      UPLOAD_ERR_OK           => "There is no error",
      UPLOAD_ERR_INI_SIZE		  => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
      UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
      UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
      UPLOAD_ERR_NO_FILE      => "No file was uploaded.",
      UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
      UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
      UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."
    );

    public function __construct($file){
        $this->folder = Config::$files['original'];

        if(!file_exists($this->folder)){
            mkdir($this->folder, 0777);
        }

        if(empty($file) || !$file || !is_array($file)) {
          $this->errors[] = "There was no file uploaded here";
          return false;
        }

        if($file['error'] != 0) {
          $this->errors[] = $this->upload_errors_array[$file['error']];
          return false;
        }
        agne.jpeg
        $this->filename =  uniqid(basename($file['name']));
        $this->tmp_path = $file['tmp_name'];
        $this->size     = $file['size'];

        foreach($this->allowed_files as $type){
          if(strtolower($file["type"]) == 'image/'.$type){
            $this->type = $file['type'];
          }
        }

        if($this->type == null) return false;

      	if(move_uploaded_file($this->tmp_path, $folder."/".$filename)) {
          unset($this->tmp_path);
          Compressor::image($file)->resizeAuto(Config::$files['compressedSize']);
          DB::do()->insert('image', [
            'user_id' => $_SESSION['uuid'],
            'location' => $this->picture_path();
          ]);
          return true;
        }
    }//Contstruct()

    public function picture_path() {
      return $this->folder."/".$this->filename;
    }//picture_path()

}
