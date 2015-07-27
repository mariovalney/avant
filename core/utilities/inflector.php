<?php

/**
 * Inflector: Utilities for strings
 *  
 * @package Avant
 */

namespace Avant\Core\Utilities;

trait Inflector
{
    /**
     * Make a string lower and turn ASCII characters to UTF-8 ones.
     * 
     * @param string $string A string to be converted.
     * @return string
     */
    private function superLower($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace('/[`´^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) );
        
        return $string;
    }
            
    /**
     * Convert the string to upperCamelCase convention.
     * 
     * @param string $string A string to be converted.
     * @return string
     */
    public function upperCamelCase($string = null)
    {
        $string = $this->superLower($string);
        $string = ucwords($string);
        $string = str_replace(" ", "", $string);
        
        return $string;
    }
    
    /**
     * Convert the string to a slug.
     * 
     * @param string $string A string to be converted.
     * @param string $separator A separator. "-" is default.
     * @return string
     */
    public function slug($string = null, $separator = "-")
    {
        $string = $this->superLower($string);
        $string = str_replace(" ", $separator, $string);
        $string = preg_replace('/[^A-Za-z0-9-]/', "", $string);
        
        return $string;
    }
    
}