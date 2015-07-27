<?php

/**
 * Index: receive all the requests and do the Magic...
 * 
 * @package Avant
 */

/** Define the Directory Separator (DS) **/
define('DS', DIRECTORY_SEPARATOR);

/** Define the ROOT **/
define('ROOT', dirname(__FILE__) . DS);

/** Turn on all the errors: it's nice to developers **/
error_reporting(E_ALL);

/** Reading the configurations **/
if (file_exists(ROOT . 'config.php')) {
    require_once(ROOT . 'config.php');
} else {
    // Die with an error message
    die("I can't find the <code>config.php</code> file. <br> Please, check the file or create a new one.");
}

/** Loading Core **/
require_once(ROOT . CORE_DIR . DS . 'loader.php');