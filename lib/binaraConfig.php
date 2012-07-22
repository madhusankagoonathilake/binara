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
class binaraConfig {

    private $configurations;
    private static $instance;

    /**
     * Returns the single instance of binaraConfig
     * @return binaraConfig 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraConfig)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private constructor
     */
    private function __construct() {
        $this->configurations = array(
            'fonts-directory' => dirname(__FILE__) . '/../fonts/',
            'width' => 280,
            'height' => 80,
            'min-number-of-chars' => 4,
            'max-number-of-chars' => 6,
            'session-value-index' => 'binara.CAPTCHA-string',
            'html-helper-image-path' => './',
            'html-helper-div-id' => 'divCAPTCHA',
            'html-helper-reload-help-text' => 'Reload Image',
            'html-helper-input-field-name' => 'binaraCAPTCHATextInput',
            'html-helper-input-label-text' => 'Enter the characters shown in the image',
            'html-helper-input-tip-span-id' => 'binaraCAPTCHAInputTip',
            'html-helper-input-tip-text' => 'Letters are case-sensitive',
        );
    }

    /**
     * Returns the relevant configuration value for the passed key
     * @param string $key
     * @return mixed
     * @throws binaraException 
     */
    public function get($key) {
        if (array_key_exists($key, $this->configurations)) {
            return $this->configurations[$key];
        } else {
            throw new binaraException('Tried to access an undefined property ' . $key);
        }
    }

    /**
     * Sets the configuration values
     * @param array $configs 
     */
    public function set(array $configs) {
        foreach ($configs as $key => $value) {
            if (array_key_exists($key, $this->configurations)) {
                $this->configurations[$key] = $value;
            }
        }
    }

}
