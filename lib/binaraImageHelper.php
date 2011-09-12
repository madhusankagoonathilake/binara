<?php

class binaraImageHelper {
    private static $instance;

    /**
     *
     * @return binaraImageHelper
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraConfig)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        
    }
    
    public function addThickLine(&$image, $x1, $y1, $x2, $y2, $color, $thickness = 1) {
        for ($i = 0; $i < $thickness; $i++) {
            $factor = ceil($i / 2) * (($i % 2 === 0) ? 1 : -1);
            imageline($image, $x1, ($y1 + $factor), $x2, ($y2 + $factor), $color);
        }
    }
    
    public function addNoise(&$image) {
        imagefilter($image, IMG_FILTER_PIXELATE, 2, true);
        imagefilter($image, IMG_FILTER_SMOOTH, 4);
    }
}

