<?php

/** 
 * Config: the configuration file.
 * 
 * @package Avant
 */

/**
 * You know what to do...
 */

/** Site Config **/
define('SITE_NAME', 'Avant');
define('LANG', 'pt_BR');

/** URL Config **/
define('BASE_URL', 'http://localhost/avant/');

/**
 * Database configs
 * To deactivate the use of Database, exclude these 4 lines or set DB_NAME as empty: define('DB_NAME', '');
 */

define('DB_NAME', 'avant');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

/** Theme config **/
define('THEME', 'avantdoc');

/** Timezone config **/
date_default_timezone_set('America/Fortaleza');

/** Debug config **/
define('DEBUG', false);

/********************************************************************
 * 
 *  That's all. Stop editing :)
 * 
 ********************************************************************/

/** The directories name **/
define('CORE_DIR', 'core');
define('THEMES_DIR', 'themes');