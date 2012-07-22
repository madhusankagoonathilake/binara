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
class binaraCryptographyHelper {

    private static $instance;

    /**
     * Private constructor 
     */
    private function __construct() {
        
    }

    /**
     * Returns the single instance of binaraCryptographyHelper
     * @return binaraCryptographyHelper 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraCryptographyHelper)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Converts to the passed string to a hash
     * @param string $string
     * @return string
     */
    public function hash($string) {
        return md5($string);
    }

}
