<?php

/**
 * Request: Utilities to requests
 * 
 * @package Utilities
 */

namespace Avant\Core\Utilities;

trait Request
{    
    /**
     * Return all the data about requests.
     * 
     * @return Array
     */
    public function request()
    {
        $data['post'] = $this->post();
        $data['get'] = $this->get();
        $data['path_info'] = $this->path_info();
        $data['params'] = $this->params();
        
        return $data;
    }
    
    /**
     * Get or compare the Request type.
     * 
     * @param string|null $type The request type to be compared. Nullable.
     * @return boolean|string If the param $type was specified it will be true/false. If $type is null will be the request type as string.
     */
    public function getRequestType($type = null)
    {
        $request = $_SERVER['REQUEST_METHOD'];
        
        if ($type == null) {
            return $request;
        } else {
            if ($type == $request) {
                return true;
            } else {
                return false;
            }
        }        
    }
    
    /**
     * Return the data received as post.
     *
     * @return mixed
     */
    private function post()
    {
        return $_POST;
    }

    /**
     * Return the data received as post.
     *
     * @return mixed
     */
    private function get()
    {
        return $_GET;
    }
    
    /**
     * Return the path_info.
     *
     * @return mixed
     */
    private function path_info()
    {
        if (isset($_SERVER["PATH_INFO"])) {
            return $_SERVER["PATH_INFO"];
        } else if (isset($_SERVER["ORIG_PATH_INFO"])) {
            return $_SERVER["ORIG_PATH_INFO"];
        }
    }
    
    /**
     * Return the params of URL (using path_info)
     *
     * @return mixed
     */
    private function params()
    {        
        $params = explode("/", $this->path_info());
        unset($params[0]);
        
        foreach ($params as $param) {            
            $param = mb_strtolower($param, 'UTF-8');
            $param = str_replace(" ", "-", $param);
            $param = preg_replace('/[^A-Za-z0-9-_]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $param ) );
            
            $params_array[] = strtolower($param);
            $params = array_values($params_array);
        }

        return $params;        
    }
}

