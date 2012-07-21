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
class binaraMathHelper {

    private static $instance;

    /**
     * Private constructor 
     */
    private function __construct() {
        $this->config = binaraConfig::instance();
    }

    /**
     *
     * @return binaraMathHelper 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraMathHelper)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param int $min
     * @param int $max
     * @return int 
     */
    public function generateRandomNumber($min, $max) {
        return rand($min, $max);
    }

}
