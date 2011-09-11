<?php

class binaraConfig {

    private $configurations;
    private static $instance;

    /**
     *
     * @return binaraConfig 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraConfig)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->configurations = array(
            'fonts-directory' => dirname(__FILE__) . '/../fonts/',
            'width' => 240,
            'height' => 80,
        );
    }

    public function get($key) {
        if (array_key_exists($key, $this->configurations)) {
            return $this->configurations[$key];
        } else {
            throw new Exception('Tried to access an undefined property' . $key);
        }
    }

}
