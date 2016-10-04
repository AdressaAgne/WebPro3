<?php
namespace App\Controllers;
use Config;

class ErrorHandling {    
    public static function fire($header, $text, $arr = null){
        if(!Config::$debug_mode) return;
        ?>
        <style>
            main, footer {
                width: 600px;
                margin: 50px auto 0px;
                padding: 20px;
                border: 1px solid #ff6a6a;
                border-radius: 3px;
                background-color: #f2f2f2;
                font-family: monospace;
            }
        </style>
        <?php
            echo '<main>';
                echo '<h1>'.$header.'</h1>';
                echo '<p>'.$text.'</p>';
        
                if($arr !== null){
                    echo '<ol>';
                    foreach($arr as $key => $value){
                        echo "<li>".$value."</li>";
                    }
                    echo '</ol>';
                }
        
                if($last_error = error_get_last()){
                    echo '<h2>'.self::errorType($last_error['type']).'</h2>';
                    echo '<ul>';
                        echo '<li>'.$last_error['message'].'</li>';
                        echo '<li>File: '.$last_error['file'].'</li>';
                        echo '<li>Line: '.$last_error['line'].'</li>';
                    echo '</ul>';
                }
        
                echo '<h2>Debug backtrace</h2>';
                echo '<ol>';
                foreach(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $key => $value){
                    
                    echo '<li><pre>'.print_r($value, true).'</pre></li>';
                    
                }
                echo '</ol>';
            echo '</main>';
        die();
    }
    
    protected static function errorType($type) { 
        switch($type) { 
            case E_ERROR: // 1 // 
                return 'E_ERROR'; 
            case E_WARNING: // 2 // 
                return 'E_WARNING'; 
            case E_PARSE: // 4 // 
                return 'E_PARSE'; 
            case E_NOTICE: // 8 // 
                return 'E_NOTICE'; 
            case E_CORE_ERROR: // 16 // 
                return 'E_CORE_ERROR'; 
            case E_CORE_WARNING: // 32 // 
                return 'E_CORE_WARNING'; 
            case E_COMPILE_ERROR: // 64 // 
                return 'E_COMPILE_ERROR'; 
            case E_COMPILE_WARNING: // 128 // 
                return 'E_COMPILE_WARNING'; 
            case E_USER_ERROR: // 256 // 
                return 'E_USER_ERROR'; 
            case E_USER_WARNING: // 512 // 
                return 'E_USER_WARNING'; 
            case E_USER_NOTICE: // 1024 // 
                return 'E_USER_NOTICE'; 
            case E_STRICT: // 2048 // 
                return 'E_STRICT'; 
            case E_RECOVERABLE_ERROR: // 4096 // 
                return 'E_RECOVERABLE_ERROR'; 
            case E_DEPRECATED: // 8192 // 
                return 'E_DEPRECATED'; 
            case E_USER_DEPRECATED: // 16384 // 
                return 'E_USER_DEPRECATED'; 
        } 
        return ""; 
    } 
    
}