<?php

/* 
 * Mopo: just translating things.
 * 
 * @package Avant
 */

namespace Avant\Core;
        
class Mopo
{        
    public function __construct()
    {           
        if (!isset($GLOBALS['mopo']) || (get_class($GLOBALS['mopo']) != 'Avant\Core\Mopo')) {
            include_once ROOT . CORE_DIR . DS . 'libs' . DS . 'php-gettext' . DS . 'streams.php';
            include_once ROOT . CORE_DIR . DS . 'libs' . DS . 'php-gettext' . DS . 'gettext.php';
            
            $GLOBALS['mopo'] = $this;
        }
    }
    
    public function bind_domain($domain, $translate_path)
    {
        global $mopo, $locales;
        
        $locales[$domain] = $mopo->findMoFile($translate_path);
    }
    
    private function findMoFile($translate_path)
    {        
        $lang = LANG;
        
        if (isset( $_GET['lang'] ) && !empty( $_GET['lang'] ) ) {
            $lang = $_GET['lang'];
        }

        if ( is_readable($translate_path . DS . $lang . '.mo') ) {
            $filename = new \FileReader($translate_path . DS . $lang . '.mo');
        } else if ( is_readable($translate_path . DS . LANG . '.mo') ) {
            $filename = new \FileReader($translate_path . DS . LANG . '.mo');
            if (DEBUG) {
                die("There isn't a translate file to this <strong>lang</strong> (" . $lang . "), but we are loading the default language (" . LANG . ") file.");
            }
        } else {
            if (DEBUG) {
                die("There isn't a translate file to the default language <strong>" . LANG . "</strong>.");
            }
            return null;
        }
        
        return new \gettext_reader($filename);
    }
}