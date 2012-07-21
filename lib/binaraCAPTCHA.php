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
class binaraCAPTCHA {

    private static $instance;
    private $image;
    private $config;
    private $httpHelper;

    /**
     * Private constructor 
     */
    private function __construct() {
        $this->config = binaraConfig::instance();
    }

    /**
     *
     * @return binaraCAPTCHA 
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraCAPTCHA)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @return binaraHTTPHelper 
     */
    public function getHttpHelper() {
        if (!($this->httpHelper instanceof binaraHTMLHelper)) {
            $this->httpHelper = binaraHTTPHelper::instance();
        }
        return $this->httpHelper;
    }

    /**
     *
     * @param binaraHTTPHelper $httpHelper 
     */
    public function setHttpHelper(binaraHTTPHelper $httpHelper) {
        $this->httpHelper = $httpHelper;
    }

    /**
     * Outputs the CAPTCHA image
     */
    public function draw() {
        $chars = $this->generateRandomChars();
        $this->generateImage($chars);
        $this->storeString($chars);

        @ob_clean();
        $this->getHttpHelper()->sendHeaders(array(
            'Content-type' => 'image/png',
        ));

        imagepng($this->image);
        imagedestroy($this->image);

        return true;
    }

    /**
     * Verifies whether the passed input matches with the last generated CAPTCHA
     * for the current HTTP session
     * @param string $input
     * @return bool 
     */
    public function verify($input) {
        return ($this->getHttpHelper()->getSessionValue($this->config->get('session-value-index')) == $input);
    }

    /**
     * Generates the CAPTCHA image using the passed set of characters, using GD
     * @param array $chars 
     */
    protected final function generateImage(array $chars) {

        $image = imagecreatetruecolor($this->config->get('width'), $this->config->get('height'));
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        $fonts = $this->getFontPaths();

        $maxFontIndex = count($fonts) - 1;

        imagefill($image, 0, 0, $white);

        $x = rand(5, 8);

        $prevMidRightX = null;
        $prevMidRightY = null;

        foreach ($chars as $i => $char) {
            $size = rand(20, 30);
            $angle = rand(0, 20) * ((rand(100, 999) % 2 == 1) ? 1 : -1);
            $font = $fonts[rand(0, $maxFontIndex)];

            $boundBox = imageftbbox($size, $angle, $font, $char);

            $x += ($boundBox[2] - $boundBox[0]) + rand(7, 8);
            $y = 50 + floor(($boundBox[7] - $boundBox[1]) / 3);

            $midLeftX = $x + floor(($boundBox[6] + $boundBox[0]) / 8);
            $midLeftY = $y + floor(($boundBox[7] + $boundBox[1]) / 4);
            $midRightX = $x + floor(($boundBox[4] + $boundBox[2]) / 8);
            $midRightY = $y + floor(($boundBox[5] + $boundBox[3]) / 4);

            binaraImageHelper::instance()->addThickLine($image, $midLeftX, $midLeftY, $midRightX, $midRightY, $black, 3);

            if (!is_null($prevMidRightX)) {
                binaraImageHelper::instance()->addThickLine($image, $prevMidRightX, $prevMidRightY, $midLeftX, $midLeftY, $black, 3);
            }

            $prevMidRightX = $midRightX;
            $prevMidRightY = $midRightY;

            imagefttext($image, $size, $angle, $x, $y, $black, $font, $char);
        }

        binaraImageHelper::instance()->addNoise($image);

        $this->image = $image;
    }

    /**
     * Generates a random set of characters for the CAPTCHA image
     * @return array 
     */
    protected final function generateRandomChars() {
        $length = rand($this->config->get('min-number-of-chars'), $this->config->get('max-number-of-chars'));
        $chars = array();
        for ($i = 0; $i < $length; $i++) {
            $seed = rand(100, 999);
            $charCode = $this->generateRandomCharCode($seed);
            $chars[] = chr($charCode);
        }
        return $chars;
    }

    /**
     *
     * @param int $seed
     * @return int 
     */
    protected final function generateRandomCharCode($seed) {
        $remainder = $seed % 3;
        $charCode = null;
        if ($remainder == 0) {
            $charCode = rand(48, 57);
        } elseif ($remainder == 1) {
            $charCode = rand(65, 90);
        } else {
            $charCode = rand(97, 122);
        }
        return $charCode;
    }

    /**
     * Saves the generated string for the image, in the current HTTP session
     * @param array $chars 
     */
    protected final function storeString(array $chars) {
        $this->getHttpHelper()->setSessionValue($this->config->get('session-value-index'), $chars);
    }

    /**
     * Discovers the font files in the fonts directory, specified in the configuration
     * @return array 
     */
    protected final function getFontPaths() {
        $paths = array();
        $fontsDirectory = $this->config->get('fonts-directory');

        $directoryIterator = new DirectoryIterator($fontsDirectory);
        foreach ($directoryIterator as $fileInfo) {
            $file = $fileInfo->getFilename();

            if (preg_match('/\.[ot]tf$/', $file)) {
                $paths[] = $fontsDirectory . $file;
            }
        }

        return $paths;
    }

}
