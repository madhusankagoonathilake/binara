<?php

/**
 * binara ver 1.0
 * http://code.google.com/p/binara/
 * 
 * Copyright (c) 2011 Madhusanka Goonathilake
 * 
 * Licensed under the MIT licenses.
 * http://code.google.com/p/binara/wiki/License
 * 
 * @package binara-helpers
 */
class binaraHTTPHelper {

    private static $instance;

    /**
     * Private constructor 
     */
    private function __construct() {
        
    }

    /**
     * Returns the single instance of binaraHTTPHelper
     * @return binaraHTTPHelper 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraHTTPHelper)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Sends the HTTP headers based on header array passed (as a key-value pair)
     * @param array $headers 
     * @return bool
     */
    public function sendHeaders(array $headers) {
        foreach ($headers as $header => $value) {
            @header($header . ': ' . $value);
        }
        return true;
    }

    /**
     * Sets an HTTP session value with the passed key and value
     * @param string $key
     * @param mixed $value 
     */
    public function setSessionValue($key, $value) {
        $_SESSION[$key] = $value;
        return true;
    }

    /**
     * Returns the value stored in the HTTP session in the given key. Returns null
     * if the key doesn't exist
     * @param string $key
     * @return mixed
     */
    public function getSessionValue($key) {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

}
