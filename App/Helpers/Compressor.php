<?php

namespace App\Helpers;

use Config;

class Compressor {
    
    
    private $image,
            $ratioW,
            $ratioH,
            $width,
            $height,
            $mime,
            $name,
            $folder = Config::$userFiles;
    
    function __construct($file){
            list($this->width, $this->height) = getimagesize($file);
            $this->image = $file;
            $this->mime = getimagesize($file)['mime'];
            $this->ratioW = $height / $width;
            $this->ratioH = $width / $height;
            $this->name = basename($file);
        
            if(!file_exists($this->folder)){
                mkdir($this->folder, 0777);
            }
           
       
    }
    
    /**
     * static call Compressor($file)->resize...
     * @author Agne *degaard
     * @param  [[Type]] $file [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function image($file){
        return new Compressor($file);
    }
    
    /**
     * resize image by Width
     * @author Agne *degaard
     * @param  integer $w    image width
     * @param  str     $name new name can be null, will use same name
     * @return string  image location
     */
    public function resizeWidth($w, $name = null){
        $h = $w * $this->ratioW;
        $name = ($name == null) ? $this->name : $name;
        return $this->resize($w, $h, $name);
        
    }
    
    /**
     * resize image by Height
     * @author Agne *degaard
     * @param  integer $h    height width
     * @param  str     $name new name can be null, will use same name
     * @return string  image location
     */
    public function resizeHeight($h, $name = null){
        $w = $h * $this->ratioH;
        $name = ($name == null) ? $this->name : $name;
        return $this->resize($w, $h, $name);
    }
    
    /**
     * Do the actuall resizeing
     * @author Agne *degaard
     * @param  integer $w    
     * @param  integer $h    
     * @param  string  $name
     * @return string  image locaton
     */
    public function resize($w, $h, $name){
        $image = imagecreatetruecolor($w, $h);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        
        $folder = $this->folder.intval($w)."x".intval($h)."_".$name;
        
        switch($this->mine){
            case "image/png":
                imagefill($image,0, 0, 0x7fff0000);
            $source = imagecreatefrompng($this->image);
                break;
                
            case "image/jpeg":
                $source = imagecreatefromjpeg($this->image);
                break;
                
            default:
                return "Wrong Image type, only jpeg or png";
                break;
                
        }
        
        // Resize
        imagecopyresized($image, $source, 0, 0, 0, 0, $w, $h, $this->width, $this->height);
        
        switch($this->mine){
            case "image/png":
                imagepng($image, $folder);
                break;
                
            case "image/jpeg":
                imagejpeg($image, $folder);
                break;
                
        }
        
        return  $folder; //'data: '.$this->mime.';base64,'.base64_encode($content);
    }
    
}