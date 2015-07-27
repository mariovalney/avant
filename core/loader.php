<?php

/* 
 * Loader: description.
 * 
 * @package Avant
 */
namespace Avant\Core;

require(ROOT . CORE_DIR . '/autoloader.php');

use Avant\Core\Load_Theme;

class Loader
{
    use Utilities\Inflector;
    use Utilities\Request;
    
    public function __construct()
    {
        $this->createQuery();
        $this->loadFunctions();
        $this->loadDatabase();
        $this->loadTheme();
    }
    
    private function createQuery()
    {
        $request = $this->request();
        
        if (isset($request['params'])) {           
            foreach ($request['params'] as $key => $param) {
                if (!empty($param)) {
                    if ($key == 0) {
                        $GLOBALS['avant']['page'] = $param;
                    } else {
                        $GLOBALS['avant']['query_params'][] = $param;
                    }
                }
            }
        }
    }
    
    private function loadFunctions()
    {
        if (is_readable(ROOT . CORE_DIR . DS . 'functions.php')) {
            include ROOT . CORE_DIR . DS . 'functions.php';
        } else if (DEBUG) {
            die("The <strong>core/functions.php</strong> couldn't be loaded or it's missing.");
        } else {
            die();
        }
    }
    
    private function loadDatabase()
    {
        include ROOT . CORE_DIR . DS . 'utilities/avdb.php';
    }
    
    private function loadTheme()
    {        
        if (defined('THEME') && THEME != "") {
            define('THEME_PATH', ROOT . THEMES_DIR . DS . THEME . DS);
        } else {
            define('THEME_PATH', ROOT . THEMES_DIR . DS . 'default' . DS);
        }
                
        if (is_readable(THEME_PATH . 'index.php')) {
            new Load_Theme($this->request());
        } else if (DEBUG) {
            die("The theme configured doesn't exist or <strong>index.php</strong> file is missing.");
        } else {
            die();
        }
    }
}

new Loader();
