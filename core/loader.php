<?php

/* 
 * Loader: description.
 * 
 * @package Avant
 */
namespace Avant\Core;

require(ROOT . CORE_DIR . '/autoloader.php');

use Avant\Core\Load_Theme;
use Avant\Core\Mopo;

class Loader
{
    use Utilities\Inflector;
    use Utilities\Request;
    
    public function __construct()
    {
        $this->createQuery();
        $this->setUrl();
        $this->loadFunctions();
        $this->loadDatabase();
        $this->loadLanguages();
        $this->loadTheme();
    }
    
    private function createQuery()
    {
        $params = $this->request('params');

        if (isset($params)) {           
            foreach ($params as $key => $param) {
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
    
    private function setUrl()
    {
        $GLOBALS['avant']['url'] = $this->request('url');
    }
    
    private function loadLanguages()
    {
        new Mopo();
    }
    
    private function loadFunctions()
    {
        include ROOT . CORE_DIR . DS . 'functions/misc.php';
        include ROOT . CORE_DIR . DS . 'functions/themes.php';
        include ROOT . CORE_DIR . DS . 'functions/l10n.php';
    }
    
    private function loadDatabase()
    {
        include ROOT . CORE_DIR . DS . 'utilities/avdb.php';
        
        $avdbObj = new \avdb();

        if ($avdbObj->checkDatabaseIsActive()) {
            $GLOBALS['avdb'] = $avdbObj;
        } else {
            $GLOBALS['avdb'] = 'Database is not defined';
        }
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
