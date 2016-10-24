<?php
namespace App;

/**
*   Small Render Engine, very inspirated by Twig
*/
class Render {
    
    private $functions = [];
    private static $regex = 'uimx';
    private $code = null;
    private $shortcuts = [
        'layout',
        'active_page',
    ];
    private $helpers = [
        'if',
        'foreach',
        'for'
    ];
    
    public function __construct($code){    
        $this->addFunction("Raw Output",        "{!([^\}\{]+)!}", "<?php echo $1 ?>");
        $this->addFunction("Escaped Output",    "{{([^\}\{]+)}}", "<?php echo htmlspecialchars($1, ENT_QUOTES, 'UTF-8') ?>");
        $this->addFunction("Helpers",           "@([".implode('|', $this->helpers)."]*)[\s]*\((.*)\)", "<?php $1($2) : ?>");
        $this->addFunction("Helpers End",       "@(end[".implode('|', $this->helpers)."]*)", "<?php $1 ?>");
        $this->addFunction("shortcuts", "@([".implode('|', $this->shortcuts)."]+)\((.*)\)", "<?php Render::$1($2) ?>");
        
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
    
    
    // Render Functions, stuff you can use in the html @functionName
    
    /**
     * Universal function for layouts
     * @param string $page          php page inside the root view folder
     * @param array  [$vars         = null] variables to carrie over to file
     */
    public static function layout($page, $vars = null){
        echo View::includeFile('view/'.preg_replace("/\\./uimx", "/", $page).'.php', $vars);
    }

    /**
     * check if the page is active
     * @author Agne *degaard
     * @param string $page
     */
    public static function active_page($page){
        if($_GET['param'] == $page) {
            echo "nav__item--active";
        }
    }
    
}