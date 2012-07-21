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
class binaraImageHelper {

    private static $instance;

    /**
     * Returns the single instance of binaraImageHelper
     * @return binaraImageHelper
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraImageHelper)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private constructor 
     */
    private function __construct() {
        
    }

    /**
     * Adds a line to the passed image resource based on the other parameters
     * @param resource $image
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @param int $color
     * @param int $thickness
     * @return boolean 
     */
    public function addThickLine(&$image, $x1, $y1, $x2, $y2, $color, $thickness = 1) {
        for ($i = 0; $i < $thickness; $i++) {
            $factor = ceil($i / 2) * (($i % 2 === 0) ? 1 : -1);
            imageline($image, $x1, ($y1 + $factor), $x2, ($y2 + $factor), $color);
        }
        return true;
    }

    /**
     * Adds noise to the passed image resource
     * @param resource $image
     * @return boolean 
     */
    public function addNoise(&$image) {
        imagefilter($image, IMG_FILTER_PIXELATE, 2, true);
        imagefilter($image, IMG_FILTER_SMOOTH, 4);
        return true;
    }

}

