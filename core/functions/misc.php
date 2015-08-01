<?php

/* 
 * Misc Functions: some useful functions to another functions.
 * 
 * @package Avant
 */

/**
 * Compare two arrays to return the args.
 * 
 * @param array $args The array with developer args.
 * @param array $default_args The default args array.
 * @return array Final args.
 */
function av_parse_args($args = '', $default_args = '') {
    if (is_array($args) && is_array($default_args)) {
        foreach ($args as $param => $value) {
            if (array_key_exists($param, $default_args)) {
                $default_args[$param] = $value;
            }
        }
        return $default_args;
    } else if(is_array($default_args)) {
        return $default_args;
    }
    return array();
}