<?php
namespace App;

/**
*   Small Render Engine, very inspirated by Twig
*/
class Render {
    
    private $functions = [];
    private static $regex = 'uimx';
    private $code = null;
    
    public function __construct($code){    
        $this->addFunction("Raw Output",        "{!(.*)!}", "<?= $1 ?>");
        $this->addFunction("Escaped Output",    "{{(.*)}}", "<?= htmlspecialchars($1, ENT_QUOTES, 'UTF-8') ?>");
        $this->addFunction("Helpers",           "@([if|foreach|for]*)[\s]*\((.*)\)", "<?php $1($2) : ?>");
        $this->addFunction("Helpers End",       "@(end[a-zA-Z]+)", "<?php $1 ?>");
        
        $this->addFunction("Layouts", "@layout\((.*)\)", "<?php layout($1) ?>");
        
        $this->code = $this->render($code);
    }
    
    public static function code($code){
        return new Render($code);
    }
    
    private function addFunction($name, $regex, $replacement){
        $this->functions[$name] = [
            'regex' => $regex,
            'replacement' => $replacement,
        ];
    }
    
    private function render($code){    
        foreach($this->functions as $key => $val){
             $code = preg_replace("/{$val['regex']}/{$this::$regex}", $val['replacement'], $code);
        }
        
        return $code;
    }
    
    public function __toString(){
        return $this->code;
    }
}