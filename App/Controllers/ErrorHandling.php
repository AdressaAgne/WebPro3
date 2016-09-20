<?php
namespace App\Controllers;

class ErrorHandling {    
    public static function fire($header, $text, $arr = null){
        ?>
        <style>
            main, footer{
                width: 600px;
                margin: 50px auto 0px;
                padding: 20px;
                border: 1px solid #ff6a6a;
                border-radius: 3px;
                background-color: #f2f2f2;
                font-family: monospace;
            }
        </style>
        <main>
            <h1><?= $header ?></h1>
            <p><?= $text ?></p>
            <?php
                if($arr !== null){
                    echo '<ol>';
                    foreach($arr as $key => $value){
                        echo "<li>".$value."</li>";
                    }
                    echo '</ol>';
                }
            
            ?>
        </main>
<!--        <footer><pre><?= print_r($_SERVER, true) ?></pre></footer>-->
        <?php
            
            die();
    }
}