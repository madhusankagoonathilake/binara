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
            'width' => 280,
            'height' => 80,
            'min-number-of-chars' => 4,
            'max-number-of-chars' => 6,
            'input-field-name' => 'binaraCAPTCHATextInput',
            'session-value-index' => 'binara.CAPTCHA-string',
            'html-helper-image-path' => './',
            'html-helper-div-id' => 'divCAPTCHA',
            'html-helper-reload-help-text' => 'Reload',
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
