<?php

/** 
 * Config: the configuration file.
 * 
 * @package Avant
 */

/**
 * You know what to do...
 */

/** URL Config **/
define('BASE_URL', 'http://localhost/avant/');

/** Database configs **/
define('DB_NAME', 'avant');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

/** Theme config **/
define('THEME', 'default');

/** Timezone config **/
date_default_timezone_set('America/Fortaleza');

/** Debug config **/
define('DEBUG', false);

/********************************************************************
 * 
 *  That's all. Stop editing :)
 * 
 ********************************************************************/

/** The core directory name **/
define('CORE_DIR', 'core');
define('THEMES_DIR', 'themes');