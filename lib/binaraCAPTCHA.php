<?php

class binaraCAPTCHA {

    private static $instance;
    private $image;
    private $config;

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

    public function draw() {
        $chars = $this->generateRandomChars();
        $this->generateImage($chars);
        $this->storeString($chars);
        @ob_clean();
        header('Content-type: image/png');
        imagepng($this->image);
        imagedestroy($this->image);
    }

    public function verify($input) {
        return ($_SESSION['binara.CAPTCHA-string'] == $input);
    }

    protected final function generateImage(array $chars) {


        $image = imagecreatetruecolor($this->config->get('width'), $this->config->get('height'));
        $white = imagecolorallocate($image, 255, 255, 255);
        $pink = imagecolorallocate($image, 255, 200, 200);
        $black = imagecolorallocate($image, 0, 0, 0);

        $fonts = $this->getFontPaths();

        $maxFontIndex = count($fonts) - 1;

        imagefill($image, 0, 0, $pink);

        $x = rand(10, 20);
        foreach ($chars as $i => $char) {
            $size = rand(12, 30);
            $angle = rand(10, 30) * ((rand(100, 999) % 2 == 1) ? 1 : -1);
            $font = $fonts[rand(0, $maxFontIndex)];

            $boundBox = imageftbbox($size, $angle, $font, $char);

            $x += ($boundBox[2] - $boundBox[0]) + rand(2, 3);
            $y = 50 + floor(($boundBox[7] - $boundBox[1]) / 3);
            imagefttext($image, $size, $angle, $x, $y, $black, $font, $char) or die();
        }

        $this->image = $image;
    }

    /**
     *
     * @return array 
     */
    protected final function generateRandomChars() {
        $length = rand(4, 6);
        $chars = array();
        for ($i = 0; $i < $length; $i++) {
            $seed = rand(100, 999);
            $remainder = $seed % 3;
            if ($remainder == 0) {
                $charCode = rand(48, 57);
            } elseif ($remainder == 1) {
                $charCode = rand(65, 90);
            } else {
                $charCode = rand(97, 122);
            }
            $chars[] = chr($charCode);
        }
        return $chars;
    }

    protected final function storeString(array $chars) {
        $_SESSION['binara.CAPTCHA-string'] = implode('', $chars);
    }

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
