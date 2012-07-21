<?php

/**
 * binara ver 1.0
 * http://code.google.com/p/binara/
 * 
 * Copyright (c) 2011 Madhusanka Goonathilake
 * 
 * Licensed under the MIT licenses.
 * http://code.google.com/p/binara/wiki/License
 */
class binaraHTTPHelper {

    private static $instance;

    /**
     * Private constructor 
     */
    private function __construct() {
        
    }

    /**
     *
     * @return binaraHTTPHelper 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraHTTPHelper)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param array $headers 
     * @return bool
     */
    public function sendHeaders(array $headers) {
        foreach ($headers as $header => $value) {
            @header($header . ': ' . $value);
        }
        return true;
    }

}
