<?php

/* 
 * Functions: some useful functions.
 * 
 * @package Avant
 */

/**
 * Includes the header.php file, if the THEME_PATH is defined and header.php is readable.
 */
function include_header() {
    if (defined('THEME_PATH')) {
        if (is_readable(THEME_PATH . 'header.php')) {
            include_once THEME_PATH . 'header.php';
        } else if(DEBUG) {
            die('header.php is missing or not readable.');
        }
    } else if(DEBUG) {
        die('THEME_PATH is not defined.');
    }
}

/**
 * Includes the footer.php file, if the THEME_PATH is defined and footer.php is readable.
 */
function include_footer() {
    if (defined('THEME_PATH')) {
        if (is_readable(THEME_PATH . 'footer.php')) {
            include_once THEME_PATH . 'footer.php';
        } else if(DEBUG) {
            die('footer.php is missing or not readable.');
        }
    } else if(DEBUG) {
        die('THEME_PATH is not defined.');
    }
}

/**
 * Redirect to the page 404 (like a elegant 'die()' to Front-ends).
 */
function to_404() {
    header("location:" . BASE_URL . "404");
}