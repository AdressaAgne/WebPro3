<?php
namespace App;
use \App\Render as Render;
class View {
    public static function make($url, $vars = null){
        $url = preg_replace("/\\./uimx", "/", $url);
        return self::includeFile("view/{$url}.php", $vars);
    }
    
   
    /**
     * Return a php file in the view folder
     * @param  string  $filename      
     * @param  array   [$vars         = null]
     * @return string/boolean
     */
    
    public static function includeFile($filename, $vars = null){
        if (is_file($filename)) {
            $code = Render::code(file_get_contents($filename));
            
            //echo "<pre>".htmlentities($code)."</pre>";
            
            ob_start();
                if(!is_null($vars)) extract($vars);   
                eval("?>" . $code);
            return ob_get_clean();
        }
        return false;
    }
    
}