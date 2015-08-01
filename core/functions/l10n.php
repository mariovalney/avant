<?php

/* 
 * L10n Functions: some useful functions to locatization.
 * 
 * @package Avant
 */

function __($string = '', $textdomain = '') {
    global $locales;
    
    if ($textdomain == '') {
        $textdomain = $GLOBALS['locales']['current_locale'];
    }
    
    if (array_key_exists($textdomain, $locales) && $locales[$textdomain] != null && $string != '') {
        return $locales[$textdomain]->translate($string);
    } else {
        return $string;
    }    
}

function _e($string = '', $textdomain = '') {
    $string = __($string, $textdomain);
    echo $string;
}

function _textdomain($textdomain, $path = '') {
    global $locales;
    $locales['current_locale'] = $textdomain;
    
    if ($path != '') {
        global $mopo;
        $mopo->bind_domain($textdomain, $path);
    }
}



