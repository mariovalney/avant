<?php

/* 
 * Themes Functions: some useful functions for themes.
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
 * Echo the URL to a file into theme
 * 
 * @param string $filename The file you want to print
 */
function theme_file_url($filename) {
    echo BASE_URL . THEMES_DIR . '/' . THEME . '/' . $filename;
}

function check_for_subpage($filename) {
    $filename = ROOT . THEMES_DIR . DS . THEME . DS . $filename . '.php';
    
    if (is_readable($filename)) {
        return true;
    }
    
    return false;
}

function include_subpage($filename) {
    if (check_for_subpage($filename)) {
        include ROOT . THEMES_DIR . DS . THEME . DS . $filename . '.php';
    } else {
        to_404();
    }
}

/**
 * Echo the Title (used in <title> tag)
 */
function av_title($separator = '&raquo;') {
    global $avant;
    
    $title = SITE_NAME;
    
    if (isset($avant['meta']['title'])) {
        $title = $avant['meta']['title'];
    }
    
    // TODO: Finish
    
    echo $title;
}

/**
 * Redirect to the page 404 (like a elegant 'die()' to Front-ends).
 */
function to_404() {
    header("location:" . BASE_URL . "404");
}

/**
 * Set values to Global avant['meta'] its responsible for metatags and other cool front-end uses.
 * 
 * @global array $avant Our love global <3
 * @param array $metas The values to be added/changed like 'meta' => 'value'
 */
function set_meta($metas = '') {
    global $avant;
    
    if ($metas != '' && is_array($metas) ) {
        foreach ($metas as $meta => $value) {
            $avant['meta'][$meta] = $value;
        }
    }
}

/**
 * Get values from Global avant['meta'] or use $default (and set it) if it's not setted.
 * 
 * @global array $avant Our love global <3
 * @param string $meta The meta we want to use
 * @param string $default Use this if the meta $meta is not set or empty
 */
function get_meta($meta, $default = '') {
    global $avant;
    
    if (isset($avant['meta'][$meta]) && !empty($avant['meta'][$meta])) {
        echo $avant['meta'][$meta];
    } else {
        $avant['meta'][$meta] = $default;
        echo $avant['meta'][$meta];
    }
}

/**
 * Get the permalink to current page. If it's not set, get the BASE_URL.
 * 
 * @global array $avant Our love global <3
 * @return array
 */
function get_permalink() {
    global $avant;
    
    if (isset($avant['url'])) {
        return $avant['url'];
    }
    
    return BASE_URL;
}

/**
 * Echo the body classes to make all template file (php) differentiable to CSS.
 * 
 * @global array $avant
 */
function body_class() {
    global $avant;
    
    if ($avant['page'] == 'index') {
        $classes = 'home';
    } else {
        $classes = 'page-' . $avant['page'];
    }
    
    if (isset($avant['query_params']) && count($avant['query_params']) > 0) {
        $class = $avant['page'];
        
        foreach ($avant['query_params'] as $param) {
            $class .= '-' . $param;
        }
        
        $classes .= ' ' . $class;
    }        
    
    echo $classes;
}

/**
 * Create a list of itens using a array.
 * 
 * @global array $avant
 * @param array $itens The array of itens like "name" => "slug".
 * @param array $args The list of args.
 */
function create_menu_list($itens, $args = array()) {
    $default_args = array(
        'li_class'      => '',
        'a_class'       => '',
        'active_class'  => 'active',
        'item_wrap'     => '<li id="%1$s" class="%2$s %3$s"><a class="%4$s" href="%5$s">%6$s</a></li>'
    );
    
    $args = av_parse_args($args, $default_args);
    $list = '';
    
    if (is_array($itens) && (count($itens) > 0)) {
        $i = 1;
        foreach ($itens as $name => $slug) {
            global $avant;
            
            $item_id = 'menu-item-' . $slug;
            $item_class = 'menu-item-' . $i . ' ' . $args['li_class'];
            $a_class = 'menu-item-' . $i . ' ' . $args['a_class'];
            $link = BASE_URL . $slug;
            
            if ($avant['url'] == $link) {
                $active = $args['active_class'];
            } else {
                $active = '';
            }
            
            $list .= sprintf($args['item_wrap'], trim($item_id), trim($item_class), $active, trim($a_class), $link, $name);
            $i++;
        }
    }
    
    echo $list;
}