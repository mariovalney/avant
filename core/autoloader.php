<?php

/* 
 * Autoloader: It's implementes a PSR-4 class loader.
 * 
 * @package Avant
 */

class Autoloader {
    
    protected $prefix, $sufix, $ext = '.php';
    
    public function __construct()
    {
        set_include_path(ROOT);        
        $this->register();
    }
    
    protected function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    
    protected function getFilename($class)
    {
        $className = ltrim($class, "\\");
        $className = ltrim($class, "Avant\\");
        $fileName = "";
        $namespace = "";
        
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace("\\", DS, $namespace) . DS;
        }
        
        $fileName .= str_replace("_", "-", $className) . $this->ext;
        $fileName = strtolower($fileName);
        
        return $fileName;
    }


    public function loadClass($class)
    {                       
        $fileName = $this->getFilename($class);        
        $fileName = get_include_path() . $fileName;
        
        if (is_readable($fileName)) {
            include $fileName;
        } else {
            // Die with an error message
            die("I can't find the <code>" . $fileName . "</code> file.");
        }
    }
}

new Autoloader();